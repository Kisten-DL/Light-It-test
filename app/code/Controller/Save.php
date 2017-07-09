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
        if (!array_key_exists('comment', $post)) {
            $response = array(
                'error' => 'yes',
                'text' => 'please set comment'
            );
        } else {
            try {
                $model->setData($post);
                $model->setData('user_id', $helper->getUserId());
                $model->save();
                $response = array(
                    'error' => 'no',
                );
            } catch (\mysqli_sql_exception $e) {
                $response = array(
                    'error' => 'yes',
                    'text' => $e->getMessage()
                );
            }
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);
    }
}