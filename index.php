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

if (!file_exists(FOLDER . '/app/etc/db.xml')) {
    require_once FOLDER . '/install.php';
    die();
}

require_once  FOLDER . '/app/Autoload.php';

switch ($path) {
    case 'comment':
        $controller = \Main\Autoload::getClass('Controller/Comment');
        $controller->execute();
        break;
    case '':
    case 'index':
    case 'login':
        $controller = \Main\Autoload::getClass('Controller/Login');
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