<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 07.07.17
 * Time: 19:44
 */
namespace Controller;

Class Install
{
    public function execute ()
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT']. '/app/etc/db.xml')) {
            header('Location: /index');
            exit;
        }
        if (!$_POST) {
            $block = new \View\Install\Install();
            $block->render();
        } else {
            $setup = new \Setup();
            $setup->Setup();
        }
    }
}