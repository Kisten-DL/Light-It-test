<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 06.07.17
 * Time: 22:03
 */
namespace Main;

use Helper\XML;

class Setup
{
    public function Setup()
    {
        $data = $_POST;
        $serverName = $data['server'];
        $userName = $data['user'];
        $userPassword = $data['pass'];
        $dbName = $data['db_name'];

        $conn = new \mysqli($serverName, $userName, $userPassword, $dbName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "CREATE TABLE Comments (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    comment VARCHAR(30) NOT NULL,
    parent INT(10),
    user VARCHAR(30) NOT NULL
    )";

        if ($conn->query($sql) === TRUE) {
            require_once('app/code/Helper/XML.php');
            $xml = new XML();
            $xml->createDataBaseXML($dbName, $serverName, $userName, $userPassword);
            echo 'success';
        } else {
            echo "Error creating table: " . $conn->error;
        }
        $conn->close();
    }
}
