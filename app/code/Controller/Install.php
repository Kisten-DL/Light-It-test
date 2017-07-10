<?php
/**
 * PHP Version 5.5.9
 *
 * This is Login Controller
 */
namespace Controller;

Class Install
{
    /**
     * create install page
     */
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
            $result = $setup->Setup();
            if ($result === true) {
                $block = new \View\Success\Success();
                $block->render();
            } else {
                echo $result;
            }
        }
    }
}