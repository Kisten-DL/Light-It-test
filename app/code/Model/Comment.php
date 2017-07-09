<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 08.07.17
 * Time: 15:06
 */
namespace Model;

use Model\Model;

Class Comment extends Model
{
    public function __construct()
    {
        $this->_resourceModel = new \Model\ResourceModel\Comment();
    }
}