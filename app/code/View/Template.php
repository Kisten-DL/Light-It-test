<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 07.07.17
 * Time: 15:10
 */
namespace View;

class Template
{
    protected $_headJs = array();

    protected $_headCss = array();

    protected $_bodyContent;

    public function __construct()
    {
        $this->_addBootstrap();
    }

    protected function _getHeadHtml()
    {
        $html = '<head>';
        foreach ($this->_headJs as $js) {
            $html .= '<script type="text/javascript" src="/' . $js . '"></script>';
        }
        foreach ($this->_headCss as $css) {
            $html .= '<link rel="stylesheet" href="/' . $css . '">';
        }
        $html .= '</head>';
        return $html;
    }

    protected function _getBodyHtml()
    {
        $html = '<body>';
        $html .= $this->_bodyContent;
        $html .= '</body>';
        return $html;
    }

    public function getHtml ()
    {
        $html = $this->_getHeadHtml();
        $html .= $this->_getBodyHtml();
        $html .= $this->_getFooterHtml();
        return $html;
    }

    protected function _getFooterHtml()
    {
        $html = '<footer class="footer"><div class="container"><p class="text-muted"><strong>Kisten D.L</strong> | <strong>2017</strong> | <a href="https://github.com/Kisten-DL/Light-It-test">GitHub</a></p></div></footer>';
        return $html;
    }

    protected function _addBootstrap()
    {
        $this->addJs('lib/js/jquery-3.2.1.min.js');
        $this->addJs('lib/js/bootstrap.min.js');
        $this->addCss('lib/css/bootstrap.min.css');
        $this->addCss('lib/css/bootstrap-theme.min.css');
        $this->addCss('skin/css/style.css');
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

    public function addJs ($js)
    {
        $this->_headJs[] = $js;
    }

    public function addCss ($css)
    {
        $this->_headCss[] = $css;
    }

    public function getCss()
    {
        return $this->_headCss;
    }

    public function getJs()
    {
        return $this->_headJs;
    }

    public function setBodyContent($content)
    {
        $this->_bodyContent = $content;
    }

    public function getWarningHtml($text)
    {
        $html = '<div class="alert alert-warning"><strong>' . $text . '</strong></div>';
        return $html;
    }

    public function getFacebookButtonHtml()
    {
        $html = '<div class="fb-login-button" style="margin-top: 5px; margin-right: 5px" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="true"></div>';
        return $html;
    }
}