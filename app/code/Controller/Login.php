<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 06.07.17
 * Time: 21:19
 */
namespace Controller;

Class Login
{
    public function name ()
    {
        return 'name';
    }

    public function execute ()
    {
        $name = self::name();
        echo 'login' . $name;
    }
}