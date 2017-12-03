<?php
/**
 * PHP Version 5.5.9
 *
 * This is Login Controller
 */
namespace Controller;

use Helper\Facebook;

Class Login
{
    /**
     * Create login page
     */
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