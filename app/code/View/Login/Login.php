<?php
/**
 * PHP Version 5.5.9
 *
 * This is Login View
 * This Class render login page html
 */
namespace View\Login;

use View\Template;

Class Login extends Template
{
    /**
     * render page
     */
    public function render()
    {
        $this->addJs('skin/js/facebook.js');
        $html = '<div class="container login-container"><div class="row"><div class="col-xs-12>"><p><h1>Hi, This is a demo site, If you enter, you can leave comments.<p><strong>Enjoy.</strong></p></h1></p></div><div class="col-xs-6 col-xs-offset-4 facebook-button-container">';
        $html .= $this->getFacebookApiHtml();
        $html .= $this->getFacebookButtonHtml();
        $html .= '<div class="clearfix"></div>';
        $html .= '</div></div></div>';
        $this->setBodyContent($html);
        $html = $this->getHtml();
        echo $html;
    }
}