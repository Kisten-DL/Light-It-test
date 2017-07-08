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

    protected $_data;

    public function __construct($userId)
    {
        $this->_fbUser = $userId;
        parent::__construct();
    }

    public function render()
    {
        $this->_data = $this->_getCollectionData();
        $html = $this->_prepareHtml();
        echo $html;
    }

    protected function _getCollectionData()
    {
        $model = new \Model\Comment();
        $model->orderBy('create_at');
        $model->loadCollection();
        $data = $model->getCollectionData();
        return $data;
    }

    protected function _getAddCommentHtml()
    {
        $html = '<div class="form-group"><label for="comment">Comment:</label><textarea class="form-control" rows="5" id="comment"></textarea></div>';
        if (is_null($this->_fbUser)) {
            $html .= $this->getWarningHtml('Please Login First');
        } else {
            $html .= '<input type="hidden" value="'. $this->_fbUser .'"></input><button type="button" class="btn-primary btn">Add Comment</button>';
        }
        return $html;
    }

    protected function _prepareHtml()
    {
        $html = '<div class="container add-comment"><div class="row"><div class="col-sm-12">';
        $html .= $this->_getAddCommentHtml();
        $html .= '</div></div></div>';
        $html .= '<div class="container comment-container"><div class="row"><div class="col-sm-12">';
        foreach ($this->_data as $data) {
            $html .= $this->_getCommentHtml($data);
        }
        $html .= '</div></div></div>';
        $this->setBodyContent($html);
        $html = $this->getHtml();
        return $html;
    }

    protected function _getCommentHtml($data)
    {
        $html = '<div class="panel panel-default"><div class="panel-body"><strong>' . $data['create_at'] .'</strong><p>'. addslashes($data['comment']) .'</p></div></div>';
        return $html;
    }
}