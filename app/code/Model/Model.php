<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 08.07.17
 * Time: 14:53
 */
namespace Model;

Class Model
{
    protected $_resourceModel;

    protected $_data;

    protected $_collectionData;

    public function loadById($id)
    {
        $result = $this->_resourceModel->load($id);
        $this->_data = $result;
        return $this;
    }

    public function loadByField($field, $value)
    {
        $result = $this->_resourceModel->load($value, $field);
        $this->_data = $result;
        return $this;
    }

    public function save()
    {
        $result = $this->_resourceModel->save($this);
        $this->_data = $result;
        return $this;
    }

    public function setData($data, $val = null)
    {
        if (is_array($data)) {
            $this->_data = $data;
        } else {
            $this->_data[$data] = $val;
        }
        return $this;
    }

    public function getData()
    {
        return $this->_data;
    }

    public function delete()
    {
        if (array_key_exists('entity_id', $this->_data)) {
            $this->_resourceModel->delete($this->_data['entity_id']);
        }
    }

    public function loadCollection($cond = null, $fields = null)
    {
        $result = $this->_resourceModel->loadCollection($cond, $fields);
        $this->_collectionData = $result;
        return $this;
    }

    public function orderBy($value, $order = null)
    {
        if (!is_null($order)) {
            $this->_resourceModel->addOrderBy($value, $order);
        } else {
            $this->_resourceModel->addOrderBy($value);
        }
    }

    public function getCollectionData()
    {
        return $this->_collectionData;
    }
}