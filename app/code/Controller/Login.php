<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 06.07.17
 * Time: 21:19
 */
namespace Controller;

use Helper\Facebook;

Class Login
{
    public function execute ()
    {
        $helper = new Facebook();
        $userId = $helper->getUserId();
        if (is_null($userId)) {
            $block = new \View\Login\Login();
            $block->render();
        } else {
            header('Location: /comment');
        }
    }
}