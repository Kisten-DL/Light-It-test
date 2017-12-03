<?php
/**
 * PHP Version 5.5.9
 *
 * This is XML Helper
 */
namespace Helper;

use DOMDocument;

class XML
{
    /**
     * create db.xml this file contains information about data base connection setting
     *
     * @param $dbName
     * @param string $serverName
     * @param string $user
     * @param string $password
     * @return int
     */
    public function createDataBaseXML($dbName, $serverName = 'localhost', $user = 'root', $password = '', $hash = null)
    {
        $xml = new DOMDocument('1.0', 'utf-8');
        $root = $xml->createElement('db');
        $xml->appendChild($root);
        $user = $xml->createElement('user', $user);
        $pass = $xml->createElement('password', $password);
        $host = $xml->createElement('host', $serverName);
        $db = $xml->createElement('db', $dbName);
        if (is_null($hash)) {
            $hash = $this->_randomToken();
        }
        $hash = $xml->createElement('crypt', $hash);
        $root->appendChild($host);
        $root->appendChild($user);
        $root->appendChild($pass);
        $root->appendChild($db);
        $root->appendChild($hash);
        $xml->appendChild($root);
        return $xml->save($_SERVER['DOCUMENT_ROOT'] . "/app/etc/db.xml");
    }

    protected function _randomToken($length = 32){
        if(!isset($length) || intval($length) <= 8 ){
            $length = 32;
        }
        if (function_exists('random_bytes')) {
            return bin2hex(random_bytes($length));
        }
        if (function_exists('mcrypt_create_iv')) {
            return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
        }
        if (function_exists('openssl_random_pseudo_bytes')) {
            return bin2hex(openssl_random_pseudo_bytes($length));
        }
    }
}