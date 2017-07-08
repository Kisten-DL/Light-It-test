<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 06.07.17
 * Time: 19:35
 */

define('FOLDER', getcwd());

$host = $_SERVER['HTTP_HOST'];

$path = strtolower(substr(preg_replace('/\..*/', '', $_SERVER['REQUEST_URI']), 1));

require_once  FOLDER . '/app/Autoload.php';
require_once  FOLDER . '/vendor/Facebook/autoload.php';

Autoload::init();

if (!file_exists(FOLDER . '/app/etc/db.xml')) {
    $setup = new Controller\Install();
    $setup->execute();
    die();
}

switch ($path) {
    case 'comment':
        $controller = new \Controller\Comment();
        $controller->execute();
        break;
    case '':
    case 'index':
    case 'login':
        $controller = new \Controller\Login();
        $controller->execute();
        break;
    case 'setup':
    case 'install':
        require_once FOLDER . 'install.php';
        break;
    default :
        require_once FOLDER . '/error/404.php';
}

die();