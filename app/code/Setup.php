<?php
/**
 * PHP Version 5.5.9
 *
 * This is Setup Class for create core tables
 */
use Helper\XML;

class Setup
{
    public function __construct()
    {

    }

    public function Setup()
    {
        $data = $_POST;
        $serverName = $data['server'];
        $userName = $data['user'];
        $userPassword = $data['pass'];
        $dbName = $data['db_name'];
        $hash = $data['hash'] ? $data['hash'] : null ;
        $conn = new \mysqli($serverName, $userName, $userPassword, $dbName);
        if ($conn->connect_error) {
            return "Connection failed: " . $conn->connect_error;
        }


        $sql[] = "CREATE TABLE Comments (
    entity_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    comment VARCHAR(256) NOT NULL,

    parent INT(10),
    user_id BIGINT(30) NOT NULL,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
        foreach ($sql as $query) {
            $result = $conn->query($query);
        }
        if ($result === TRUE) {
            $xml = new XML();
            $xml->createDataBaseXML($dbName, $serverName, $userName, $userPassword, $hash);


            $conn->close();
            return true;
        } else {
            $conn->close();
            return "Error creating table: " . $conn->error;
        }
    }
}

