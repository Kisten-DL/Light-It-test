<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 06.07.17
 * Time: 20:14
 */
namespace Controller;

Class Comment
{
    public function name ()
    {
        return 'name';
    }

    public function execute ()
    {
        $name = self::name();
        echo 'comment' . $name;
    }
}