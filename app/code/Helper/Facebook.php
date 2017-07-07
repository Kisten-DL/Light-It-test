<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 07.07.17
 * Time: 20:31
 */
namespace Helper;

use Facebook\FacebookApp;
use Facebook\FacebookClient;
use Facebook\Helpers\FacebookJavaScriptHelper;

Class Facebook
{
    const APP_ID = 381912872206892;

    const APP_SECRET = '942e253e138e3c5cfd25857975d3f3f2';

    public function getUserId()
    {
        $app = new FacebookApp(\Helper\Facebook::APP_ID,\Helper\Facebook::APP_SECRET);
        $client = new FacebookClient();
        $helper = new FacebookJavaScriptHelper($app, $client);
        $userId = $helper->getUserId();
        return $userId;
    }
}