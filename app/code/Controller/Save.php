<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 08.07.17
 * Time: 18:15
 */
namespace Controller;

use Model\Comment;
use Helper\Facebook;

Class Save
{
    public function execute()
    {
        $post = $_POST;
        $model = new Comment();
        $helper = new Facebook();
        $model->setData($post);
        $model->setData('user_id', $helper->getUserId());
        $model->save();
    }
}