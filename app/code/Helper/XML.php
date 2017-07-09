<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 06.07.17
 * Time: 22:45
 */
namespace Helper;

use DOMDocument;

class XML
{
    public function createDataBaseXML($dbName, $serverName = 'localhost', $user = 'root', $password = '')
    {
        $xml = new DOMDocument('1.0', 'utf-8');
        $root = $xml->createElement('db');
        $xml->appendChild($root);
        $user = $xml->createElement('user', $user);
        $pass = $xml->createElement('password', $password);
        $host = $xml->createElement('host', $serverName);
        $db = $xml->createElement('db', $dbName);
        $root->appendChild($host);
        $root->appendChild($user);
        $root->appendChild($pass);
        $root->appendChild($db);
        $xml->appendChild($root);
        return $xml->save($_SERVER['DOCUMENT_ROOT'] . "/app/etc/db.xml");
    }
}