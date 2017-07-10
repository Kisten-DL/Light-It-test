<?php
/**
 * PHP Version 5.5.9
 *
 * This is Ajax Save Controller
 */
namespace Controller;

use Model\Comment;
use Helper\Facebook;

Class Save
{
    /**
     * Save a comment to DB and return json response
     */
    public function execute()
    {
        $post = $_POST;
        $model = new Comment();
        $helper = new Facebook();
        if (!array_key_exists('comment', $post) || !$post['comment']) {
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