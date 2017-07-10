<?php
/**
 * PHP Version 5.5.9
 *
 * This is Main Model
 * This Class contains main function of Business logic
 * All model classes must extended this class
 */
namespace Model;

Class Model
{
    /**
     * Resource model class
     *
     * @var Object
     */
    protected $_resourceModel;

    /**
     * Model Data
     *
     * @var array
     */
    protected $_data;

    /**
     * Collection of model data
     *
     * @var array
     */
    protected $_collectionData;

    /**
     * get model by entity id value
     *
     * @param $id int
     * @return $this
     */
    public function loadById($id)
    {
        $result = $this->_resourceModel->load($id);
        $this->_data = $result;
        return $this;
    }

    /**
     * get model by another field value
     *
     * @param $field string
     * @param $value string | int
     * @return $this
     */
    public function loadByField($field, $value)
    {
        $result = $this->_resourceModel->load($value, $field);
        $this->_data = $result;
        return $this;
    }

    /**
     * save model
     *
     * @return $this
     */
    public function save()
    {
        $result = $this->_resourceModel->save($this);
        $this->_data = $result;
        return $this;
    }

    /**
     * set model data
     *
     * @param $data
     * @param null $val
     * @return $this
     */
    public function setData($data, $val = null)
    {
        if (is_array($data)) {
            $this->_data = $data;
        } else {
            $this->_data[$data] = $val;
        }
        return $this;
    }

    /**
     * get model data
     *
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * delete model
     */
    public function delete()
    {
        if (array_key_exists('entity_id', $this->_data)) {
            $this->_resourceModel->delete($this->_data['entity_id']);
        }
    }

    /**
     * Load collection
     *
     * @param null | array $cond
     * @param null | array $fields
     * @return $this
     */
    public function loadCollection($cond = null, $fields = null)
    {
        $result = $this->_resourceModel->loadCollection($cond, $fields);
        $this->_collectionData = $result;
        return $this;
    }

    /**
     * Set order by
     *
     * @param $value
     * @param null $order
     */
    public function orderBy($value, $order = null)
    {
        if (!is_null($order)) {
            $this->_resourceModel->addOrderBy($value, $order);
        } else {
            $this->_resourceModel->addOrderBy($value);
        }
    }

    /**
     * Return collection data
     *
     * @return array
     */
    public function getCollectionData()
    {
        return $this->_collectionData;
    }
}