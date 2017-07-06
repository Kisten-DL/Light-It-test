<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 06.07.17
 * Time: 19:35
 */
use Controller\Comment;
use Controller\Login;

define('FOLDER', getcwd());

$host = $_SERVER['HTTP_HOST'];

$path = strtolower(substr(preg_replace('/\..*/', '', $_SERVER['REQUEST_URI']), 1));

if (!file_exists(FOLDER . '/app/etc/db.xml')) {
    require_once FOLDER . '/install.php';
    die();
}

switch ($path) {
    case 'comment':
        require_once  FOLDER . '/app/code/Controller/Comment.php';
        $controller = new Comment();
        $controller->execute();
        break;
    case '':
    case 'index':
    case 'login':
        require_once FOLDER . '/app/code/Controller/Login.php';
        $controller = new Login();
        $controller->execute();
        break;
    case 'setup':
        require_once FOLDER . '/app/code/Setup.php';
        break;
    default :
        require_once FOLDER . '/error/404.php';
}

die();