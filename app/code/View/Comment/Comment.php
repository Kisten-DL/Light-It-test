<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 07.07.17
 * Time: 20:35
 */
namespace View\Comment;

use View\Template;

Class Comment extends Template
{
    protected $_fbUser;

    protected $_dataParentComment;

    protected $_dataChildComment;

    public function __construct($userId)
    {
        $this->_fbUser = $userId;
        parent::__construct();
    }

    public function render()
    {
        $this->_getCollectionData();
        $html = $this->_prepareHtml();
        echo $html;
    }

    protected function _getCollectionData()
    {
        $model = new \Model\Comment();
        $model->orderBy('create_at');
        $model->loadCollection(array(
            'parent' => 'null'
        ));
        $this->_dataParentComment = $model->getCollectionData();
        $model = new \Model\Comment();
        $model->orderBy('create_at', \Model\ResourceModel\Comment::ORDER_DESC);
        $model->loadCollection(array(
            'parent' => 'not_null'
        ));
        $this->_dataChildComment = $model->getCollectionData();
    }

    protected function _getAddCommentHtml()
    {
        $html = '<div class="form-group"><label for="comment">Comment:</label><textarea class="form-control" rows="5" id="comment" name="comment"></textarea></div></div>';
        if (is_null($this->_fbUser)) {
            $html .= $this->getWarningHtml('Please <a href="/login">Login</a> First');
        } else {
            $html .= '<input type="hidden" value="'. $this->_fbUser .'"></input><div class="col-sm-3 col-sm-offset-9"><button type="button" class="btn-primary btn btn-block" id="add-comment">Add Comment</button></div>';
        }

        return $html;
    }

    protected function _prepareHtml()
    {
        $this->_modifyHeader();
        $html = $this->_getNavBarHtml();
        $html .= $this->getFacebookApiHtml();
        $html .= '<div class="container add-comment"><div class="row add-form"><form id="add-form"><div class="col-sm-12">';
        $html .= $this->_getAddCommentHtml();
        $html .= '</form></div></div>';
        $html .= '<div class="container comment-container"><div class="row"><table class="table tree"><tbody>';
        foreach ($this->_dataParentComment as $data) {
            $html .= $this->_getCommentHtml($data);
        }

        $html .= '</tbody></table></div></div>';
        $this->setBodyContent($html);
        $html = $this->getHtml();
        return $html;
    }

    protected function _getNavBarHtml()
    {
        $html = '<nav class="navbar navbar-inverse"><div class="navbar-header"><a class="navbar-brand" href="/login">Test</a></div><div class="container-fluid"><ul class="nav navbar-nav navbar-right"><li>';
        $html .= $this->getFacebookButtonHtml();
        $html .= '</li></ul></div></nav>';
        return $html;
    }

    protected function _modifyHeader()
    {
        $this->addCss('lib/css/jquery.treegrid.css');
        $this->addJs('skin/js/comment.js');
        $this->addJs('skin/js/facebook.js');
        $this->addJs('lib/js/jquery.treegrid.js');
        $this->addJs('lib/js/jquery.treegrid.bootstrap3.js');
        $this->addJs('lib/js/jquery.cookie.js');
    }

    protected function _getCommentHtml($data)
    {
        $html = '<tr class="treegrid-' .$data['entity_id'];
        if (!is_null($data['parent'])) {
            $html .= ' treegrid-parent-' .$data['parent'];
        } else {
            $html .= ' treegrid-not-parent-';
        }

        $html .= '">';
        $html .= '<td><input class="entity_id" type="hidden" value="'. $data['entity_id'] .'" name="entity_id"></input><strong>' . $data['create_at'] .'</strong><span class="separator">|</span><span class="comment-text">'. addslashes($data['comment']) . '</span><a class="text-right"><span class="pull-right answer">Answer</span></a>';
        if ($data['user_id'] == $this->_fbUser) {
            $html .= '<span class="pull-right separator">|</span><a class="text-right"><span class="pull-right delete">Delete</span></a>';
        }

        $html .= '</td></tr>';
        $child = $this->_getChild($data['entity_id']);
        foreach ($child as $data) {
            $html .= $this->_getCommentHtml($data);
        }

        return $html;
    }

    protected function _getChild($id)
    {
        $result = array();
        foreach ($this->_dataChildComment as $data) {
            if($data['parent'] == $id) {
                $result[] = $data;
            }
        }
        return $result;
    }
}