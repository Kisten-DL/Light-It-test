<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 06.07.17
 * Time: 19:35
 */

define('FOLDER', getcwd());

$host = $_SERVER['HTTP_HOST'];

$path = preg_replace('/\..*/', '', $_SERVER['REQUEST_URI']);

require_once  FOLDER . '/app/Autoload.php';
require_once  FOLDER . '/vendor/Facebook/autoload.php';

Autoload::init();

if (!file_exists(FOLDER . '/app/etc/db.xml') && $path != '/favicon') {
    $setup = new Controller\Install();
    $setup->execute();
    die();
}

switch ($path) {
    case '/comment':
        $controller = new \Controller\Comment();
        $controller->execute();
        break;
    case '':
    case '/index':
    case '/login':
        $controller = new \Controller\Login();
        $controller->execute();
        break;
    default :
        $path = str_replace('/', '\\', $path);
        if (strpos(substr($path, 0, 11), 'Controller')) {
            $controller = new $path;
            $controller->execute();
        } elseif (!strpos(substr($path, 0, 6), 'error')){
            header('Location: http://'.$_SERVER['HTTP_HOST'].'/error/404.php');
            die();
        }
}

die();