<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 08.07.17
 * Time: 14:56
 */
namespace Model\ResourceModel;

Class Model
{
    const ORDER_ASC = 'ASC';

    const ORDER_DESC = 'DESC';

    protected $_dbInfo;

    protected $_table;

    protected $_entity;

    protected $_connection;

    protected $_orderBy;

    protected $_condRule = array(
        'null' => 'IS NULL',
        'not_null' => 'IS NOT NULL',
        'def' => '='
    );

    public function __construct()
    {
        $xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'] .'/app/etc/db.xml');
        $this->_dbInfo = json_decode( json_encode($xml) , 1);
    }

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

    public function closeConnection()
    {
        $this->_connection->close();
    }

    public function delete($id)
    {
        $connection = $this->connection();
        $sql = "DELETE FROM $this->_table WHERE $this->_entity = $id";
        $result = $connection->query($sql);
        $this->closeConnection();
        return $result;
    }

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

    public function addOrderBy($field, $order = self::ORDER_ASC)
    {
        $this->_orderBy[$field] = $order;
        return $this;
    }

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