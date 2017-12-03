<?php
/**
 * PHP Version 5.5.9
 *
 * This is Ajax Save Controller
 */
namespace Controller;

use Helper\Facebook;

Class Crypt
{
    /**
     * Save a comment to DB and return json response
     */
    public function execute()
    {
        $data = $_POST;
        $xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'] .'/app/etc/db.xml');
        $info = json_decode( json_encode($xml) , 1);
        $name = hash_hmac('sha256', 'name', $info['crypt']);
        $crypt = openssl_encrypt($data['crypt'], 'blowfish', $info['crypt'], $options = 0, '111');
        $result = setcookie($name, $crypt, 0, '/');
        header('Location: '. $_SERVER['HTTP_ORIGIN'] . '/comment');
    }
}