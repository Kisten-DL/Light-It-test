<?php
/**
 * PHP Version 5.5.9
 *
 * This is Comment View
 * This Class render comment page html
 */
namespace View\Comment;

use View\Template;

Class Comment extends Template
{
    /**
     * Facebook user id
     *
     * @var int
     */
    protected $_fbUser;

    /**
     * Data of all comments with the value parent = null
     *
     * @var array
     */
    protected $_dataParentComment;

    /**
     * Data of all comments with the value parent != null
     *
     * @var
     */
    protected $_dataChildComment;

    /**
     * Set Facebook user id from Controller
     *
     * @param $userId
     */


    protected $_crypt;

    public function __construct($userId, $crypt = null)
    {
        $this->_fbUser = $userId;
        $this->_crypt = $crypt;
        parent::__construct();
    }

    /**
     * Render page
     */
    public function render()
    {
        $this->_getCollectionData();
        $html = $this->_prepareHtml();
        echo $html;
    }

    /**
     * set all comment data
     */
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

    /**
     * Return Add Comment Form Html
     *
     * @return string
     */
    protected function _getAddCommentHtml()
    {
        $html = '<div class="form-group"><label for="comment">Comment:</label><textarea class="form-control" required rows="5" id="comment" name="comment"></textarea></div></div>';
//        if (is_null($this->_fbUser)) {
//            $html .= $this->getWarningHtml('Please <a href="/login">Login</a> First');
//        } else {
            $html .= '<input type="hidden" value="' . $this->_fbUser . '"></input><div class="col-sm-3 col-sm-offset-9"><button type="button" class="btn-primary btn btn-block" id="add-comment">Add Comment</button></div>';
//        }
        return $html;
    }

    /**
     * Prepare Html
     *
     * @return string
     */
    protected function _prepareHtml()
    {
        $this->_modifyHeader();
        $this->addJs('lib/js/validator.min.js');
        $html = $this->_getNavBarHtml();
        $html .= $this->getFacebookApiHtml();
        $html .= '<div class="container add-comment"><div class="row add-form"><form id="add-form" data-toggle="validator" role="form"><div class="col-sm-12">';
        $html .= $this->_getAddCommentHtml();
        $html .= '</form></div>';
        $html .= '<form method="POST" action="Controller/Crypt"><div class="form-group"><input type="text" name="crypt" class="col-xs-9"><div class="col-xs-3"><button type="submit" class="btn-primary btn btn-block">DECRYPT</button></div></div></form>';
        $html .= '</div>';
        $html .= '<div class="container comment-container"><div class="row"><div class=""><button class="btn btn-primary show-all">Show All</button></div><div class="clearfix"></div><table class="table tree"><tbody>';
        foreach ($this->_dataParentComment as $data) {
            $html .= $this->_getCommentHtml($data);
        }

        $html .= '</tbody></table></div></div>';
        $this->setBodyContent($html);
        $html = $this->getHtml();
        return $html;
    }

    /**
     * Return Bootstrap Nav bar html
     *
     * @return string
     */
    protected function _getNavBarHtml()
    {
        $html = '<nav class="navbar navbar-inverse navbar-fixed-top"><div class="navbar-header"><a class="navbar-brand" href="/login">Test</a></div><div class="container-fluid"><ul class="nav navbar-nav navbar-right"><li>';
        $html .= $this->getFacebookButtonHtml();
        $html .= '</li></ul></div></nav>';
        return $html;
    }

    /**
     * Set All js and css of this page
     */
    protected function _modifyHeader()
    {
        $this->addCss('lib/css/jquery.treegrid.css');
        $this->addJs('skin/js/comment.js');
        $this->addJs('skin/js/facebook.js');
        $this->addJs('lib/js/jquery.treegrid.js');
        $this->addJs('lib/js/jquery.treegrid.bootstrap3.js');
        $this->addJs('lib/js/jquery.cookie.js');
    }

    /**
     * Return all comments html
     *
     * @param $data
     * @return string
     */
    protected function _getCommentHtml($data)
    {
        $html = '<tr class="treegrid-' . $data['entity_id'];
        if (!is_null($data['parent'])) {
            $html .= ' treegrid-parent-' . $data['parent'];
        } else {
            $html .= ' treegrid-not-parent';
        }

        $html .= '">';
        if ($this->_crypt) {
            $comment = openssl_decrypt($data['comment'], 'blowfish', $this->_crypt, 0, '111');
        } else {
            $comment = $data['comment'];
        }
        $html .= '<td><input class="entity_id" type="hidden" value="' . $data['entity_id'] . '" name="entity_id"></input><strong>' . $data['create_at'] . '</strong></td><td><span class="comment-text">' . addslashes($comment) . '</span></td><td><a class="text-right"><span class="pull-right answer">Answer</span></a>';

        if ($data['user_id'] == $this->_fbUser) {
            $html .= '<span class="pull-right separator">|</span><a class="text-right"><span class="pull-right delete">Delete</span></a>';
        }
        $html .= $this->_getLikeButtonHtml($data['entity_id']);
        $html .= '</td></tr>';
        $child = $this->_getChild($data['entity_id']);
        foreach ($child as $data) {
            $html .= $this->_getCommentHtml($data);
        }

        return $html;
    }

    /**
     * Return child comment of comment witch entity_id = $id
     *
     * @param $id int
     * @return array
     */
    protected function _getChild($id)
    {
        $result = array();
        foreach ($this->_dataChildComment as $data) {
            if ($data['parent'] == $id) {
                $result[] = $data;
            }
        }
        return $result;
    }

    /**
     * added facebook like button for current comment
     *
     * @param $id
     * @return string
     */
    protected function _getLikeButtonHtml($id)
    {
        $html = '<span class="separator pull-right">|</span><div class="fb-like pull-right" data-href="http://kistendltest.loc/comment/'.$id.'" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>';
        return $html;
    }
}