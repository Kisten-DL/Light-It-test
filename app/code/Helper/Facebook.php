<?php
/**
 * PHP Version 5.5.9
 *
 * This is Facebook Helper
 */
namespace Helper;

use Facebook\FacebookApp;
use Facebook\FacebookClient;
use Facebook\Helpers\FacebookJavaScriptHelper;

Class Facebook
{
    /**
     * Facebook app id
     */
    const APP_ID = 381912872206892;

    /**
     * Facebook app secret key
     */
    const APP_SECRET = '942e253e138e3c5cfd25857975d3f3f2';

    /**
     * return Facebook user id
     *
     * @return null|string
     */
    public function getUserId()
    {
        $app = new FacebookApp(\Helper\Facebook::APP_ID,\Helper\Facebook::APP_SECRET);
        $client = new FacebookClient();
        $helper = new FacebookJavaScriptHelper($app, $client);
        $userId = $helper->getUserId();
        return $userId;
    }
}