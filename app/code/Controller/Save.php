<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 08.07.17
 * Time: 18:15
 */
namespace Controller;

use Model\Comment;

Class Save
{
    public function execute()
    {
        $post = $_POST;
        $model = new Comment();
        $model->setData($post);
        $model->save();
    }
}