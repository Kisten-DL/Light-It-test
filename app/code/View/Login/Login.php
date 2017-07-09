<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 07.07.17
 * Time: 15:13
 */
namespace View\Login;

use View\Template;

Class Login extends Template
{
    public function render()
    {
        $this->addJs('skin/js/facebook.js');
        $html = '<div class="container login-container"><div class="row"><div class="col-md-4 col-sm-4 col-xs-4 col-lg-4 col-lg-offset-4 col-xs-offset-4 col-sm-offset-4 col-md-offset-4"> ';
        $html .= $this->getFacebookApiHtml();
        $html .= $this->getFacebookButtonHtml();
        $html .= '<div class="clearfix"></div>';
        $html .= $this->getWarningHtml('Please Log In With You Facebook Account');
        $html .= '</div></div></div>';
        $this->setBodyContent($html);
        $html = $this->getHtml();
        echo $html;
    }
}