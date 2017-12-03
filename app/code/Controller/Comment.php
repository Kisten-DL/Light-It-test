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
        $xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'] .'/app/etc/db.xml');
        $info = json_decode( json_encode($xml) , 1);
        $name = hash_hmac('sha256', 'name', $info['crypt']);
        $crypt = null;
        if ($_COOKIE[$name]) {
            $crypt = openssl_decrypt($_COOKIE[$name], 'blowfish', $info['crypt'], 0, '111');
        }
        $block = new \View\Comment\Comment($userId, $crypt);
        $block->render();
    }
}