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
    public function execute ()
    {
        $block = new \View\Login\Login();
        $block->render();
    }
}