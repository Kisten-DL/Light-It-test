<?php
/**
 * PHP Version 5.5.9
 *
 * This is Main Resource Model
 * This Class contains main function of Resource logic
 * All resource model classes must extended this class
 */
namespace Model\ResourceModel;

Class Model
{
    const ORDER_ASC = 'ASC';

    const ORDER_DESC = 'DESC';

    /**
     * Data base info from db.xml
     *
     * @var array
     */
    protected $_dbInfo;

    /**
     * current table
     *
     * @var string
     */
    protected $_table;

    /**
     * current table entity field
     *
     * @var string
     */
    protected $_entity;

    /**
     * connection class
     *
     * @var
     */
    protected $_connection;

    /**
     * Order by
     *
     * @var
     */
    protected $_orderBy;

    /**
     * array of condition rules
     *
     * @var array
     */
    protected $_condRule = array(
        'null' => 'IS NULL',
        'not_null' => 'IS NOT NULL',
        'def' => '='
    );

    /**
     * Retrieve DB info from db.xml
     */
    public function __construct()
    {
        $xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'] .'/app/etc/db.xml');
        $this->_dbInfo = json_decode( json_encode($xml) , 1);
    }

    /**
     * Load data from data base table
     *
     * @param $value
     * @param null $field
     * @param null $cond
     * @param null $fields
     * @return array|bool|\mysqli_result
     */
    public function load($value, $field = null, $cond =null, $fields = null)
    {
        $connection = $this->connection();
        if (is_null($field)) {
            $field = $this->_entity;
        }
        $select = 'SELECT ';
        if (is_null($fields)) {
            $select .= '*';
        } else {
            $select .= $fields;
        }
        $select .= ' FROM ' .$this->_table;
        $select .= ' WHERE ' .$field .'=' .$value;
        $result = $connection->query($select);
        $result = $result->fetch_assoc();
        $this->closeConnection();
        return $result;
    }

    /**
     * save data to data base table
     *
     * @param $obj
     * @return array|bool|\mysqli_result
     */
    public function save($obj)
    {
        $connection = $this->connection();
        $dataKey = array();
        $dataValue = array();
        foreach ($obj->getData() as $key => $item) {
            $dataKey[] = $key;
            $dataValue[] = "'$item'";
        }
        $sql = 'INSERT INTO ' .$this->_table . ' (' . implode(', ', $dataKey) . ')';
        $sql .= ' VALUES (' . implode(', ', $dataValue) . ')';
        $connection->query($sql);
        $result = $this->load($connection->insert_id);
        return $result;
    }

    /**
     * set connection
     *
     * @return \mysqli
     */
    public function connection()
    {
        $serverName = $this->_dbInfo['host'];
        $userName = $this->_dbInfo['user'];
        $userPassword = $this->_dbInfo['password'];
        $dbName = $this->_dbInfo['db'];
        $conn = new \mysqli($serverName, $userName, $userPassword, $dbName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $this->_connection = $conn;
        return $this->_connection;
    }

    /**
     * end connection
     */
    public function closeConnection()
    {
        $this->_connection->close();
    }

    /**
     * delete row from data base
     *
     * @param $id
     * @return bool|\mysqli_result
     */
    public function delete($id)
    {
        $connection = $this->connection();
        $sql = "DELETE FROM $this->_table WHERE $this->_entity = $id";
        $result = $connection->query($sql);
        $this->closeConnection();
        return $result;
    }

    /**
     * get data collection from table
     *
     * @param null $value
     * @param null $fields
     * @return array
     */
    public function loadCollection($value = null, $fields = null)
    {
        $connection = $this->connection();

        $select = 'SELECT ';
        if (is_null($fields)) {
            $select .= '*';
        } else {
            $select .= $fields;
        }
        $select .= ' FROM ' .$this->_table;
        if (!is_null($value)) {
            $select .= ' WHERE ';
            $select .= $this->_renderConditions($value);
        }
        if (!is_null($this->_orderBy)) {
            $select .= ' ORDER BY';
            foreach ($this->_orderBy as $key => $val) {
                $select .= " $key $val";
            }
        }
        $result = $connection->query($select);
        $results = array();
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
        $this->closeConnection();
        return $results;
    }

    /**
     * set order by
     *
     * @param $field
     * @param string $order
     * @return $this
     */
    public function addOrderBy($field, $order = self::ORDER_ASC)
    {
        $this->_orderBy[$field] = $order;
        return $this;
    }

    /**
     * render sql conditions
     *
     * @param $cond
     * @return string
     */
    protected function _renderConditions($cond)
    {
        $select = '';
        foreach ($cond as $key => $value) {
            if ($key == 'def') {
                foreach ($value as $condKey => $condValue) {
                    $cond = $this->_condRule[$key];
                    $select .= "$condKey $cond $condValue";
                }
            } else {
                $cond = $this->_condRule[$value];
                $select .= "$key $cond";
            }
        }
        return $select;
    }
}