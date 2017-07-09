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
        $html = '<div class="container login-container"><div class="row"><div class="col-xs-12>"><p><h1>Hi, This is a demo site, If you enter, you can leave comments.<p>Enjoy</p></h1></p></div><div class="col-xs-6 col-xs-offset-4 facebook-button-container">';
        $html .= $this->getFacebookApiHtml();
        $html .= $this->getFacebookButtonHtml();
        $html .= '<div class="clearfix"></div>';
        $html .= '</div></div></div>';
        $this->setBodyContent($html);
        $html = $this->getHtml();
        echo $html;
    }
}