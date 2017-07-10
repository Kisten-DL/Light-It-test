<?php
/**
 * PHP Version 5.5.9
 *
 * This is Comment Controller
 */
namespace Controller;

use Helper\Facebook;

Class Comment
{
    /**
     * Create comment page
     */
    public function execute ()
    {
        $helper = new Facebook();
        $userId = $helper->getUserId();
        $block = new \View\Comment\Comment($userId);
        $block->render();
    }
}