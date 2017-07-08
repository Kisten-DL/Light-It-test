<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 08.07.17
 * Time: 15:03
 */
namespace Model\ResourceModel;

use Model\ResourceModel\Model;

Class Comment extends Model
{
    public function __construct()
    {
        $this->_table = 'Comments';
        $this->_entity = 'entity_id';
        parent::__construct();
    }
}