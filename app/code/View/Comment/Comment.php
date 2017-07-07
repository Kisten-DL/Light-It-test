<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 07.07.17
 * Time: 20:35
 */
namespace View\Comment;

use View\Template;

Class Comment extends Template
{
    protected $_fbUser;

    public function __construct($userId)
    {
        $this->_fbUser = $userId;
        parent::__construct();
    }

    public function render()
    {
        echo 'test';
    }
}