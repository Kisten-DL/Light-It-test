<?php
/**
 * PHP Version 5.5.9
 *
 * This is Comment Model
 */
namespace Model;

use Model\Model;

Class Comment extends Model
{
    /**
     * Set a current resource model class
     */
    public function __construct()
    {
        $this->_resourceModel = new \Model\ResourceModel\Comment();
    }
}