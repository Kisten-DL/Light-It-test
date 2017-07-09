<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 09.07.17
 * Time: 14:40
 */
namespace Controller;

use Helper\Facebook;
use Model\Comment;

Class Delete
{
    public function execute()
    {
        $helper = new Facebook();
        $model = new Comment();
        $data = $_POST;
        $id = $helper->getUserId();
        $model->loadById($data['entity_id']);
        $modelData = $model->getData();
        if ($modelData['user_id'] == $id) {
            $model->loadCollection(array(
                'def' => array(
                    'parent' => $data['entity_id']
                )
            ));

            if (!$model->getCollectionData()) {
                $model->delete();
                $response = array(
                    'error' => 'no'
                );
            } else {
                $response = array(
                    'error' => 'yes',
                    'text' => 'this comment had answers'
                );
            }
        } else {
            $response = array(
                'error' => 'yes',
                'this is not your comment'
            );
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($response);

    }
}