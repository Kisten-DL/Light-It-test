<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 07.07.17
 * Time: 14:27
 */
class Autoload
{
    public static $loader;

    public static function init()
    {
        if (self::$loader == NULL)
            self::$loader = new self();

        return self::$loader;
    }

    public function __construct()
    {
        spl_autoload_register(array($this, 'controller'));
    }

    public function controller($className)
    {
        $fileName = __DIR__ . '/code/' .  str_replace('\\', '/', $className) . ".php";
        if (file_exists($fileName)) {
            require_once($fileName);
        } else {
            header('Location: error/404.php');
        }
    }
}