<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 06.07.17
 * Time: 20:14
 */
namespace Controller;

use Helper\Facebook;

Class Comment
{
    public function execute ()
    {
        $helper = new Facebook();
        $userId = $helper->getUserId();
        $block = new \View\Comment\Comment($userId);
        $block->render();
    }
}