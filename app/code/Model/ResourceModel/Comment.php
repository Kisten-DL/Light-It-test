<?php
/**
 * PHP Version 5.5.9
 *
 * This is Comment Resource Model
 */
namespace Model\ResourceModel;

use Model\ResourceModel\Model;

Class Comment extends Model
{
    /**
     * set current table and entity field
     */
    public function __construct()
    {
        $this->_table = 'Comments';
        $this->_entity = 'entity_id';
        parent::__construct();
    }
}