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

    public function getFacebookApiHtml()
    {
        $html = '<div id="fb-root"></div>'
                . '<script>(function(d, s, id) {'
                . 'var js, fjs = d.getElementsByTagName(s)[0];'
                . 'if (d.getElementById(id)) return;'
                . 'js = d.createElement(s); js.id = id;'
                . 'js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.9&appId=381912872206892";'
                . 'fjs.parentNode.insertBefore(js, fjs);'
                . '}(document, "script", "facebook-jssdk"));</script>';
        return $html;
    }

    public function getFacebookButtonHtml()
    {
        $html = '<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="true"></div>';
        return $html;
    }
}