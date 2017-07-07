<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 07.07.17
 * Time: 14:27
 */
namespace Main;

class Autoload
{
    public static function getClass($name)
    {
        require 'code/' .$name . '.php';
        $className = str_replace('/', '\\', $name);
        return new  $className ;
    }
}