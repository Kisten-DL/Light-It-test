<?php
/**
 * PHP Version 5.5.9
 *
 * This is Main Template Class for View.
 * All View Classes Must extended this class
 */
namespace View;

class Template
{
    /**
     * Array of js files Which will be connected in the Head tag
     *
     * @var array
     */
    protected $_headJs = array();

    /**
     * Array of css files Which will be connected in the Head tag
     *
     * @var array
     */
    protected $_headCss = array();

    /**
     * Body Content
     *
     * @var String
     */
    protected $_bodyContent;

    /**
     * This Simple Constructor add Bootstrap 3 library to Header
     */
    public function __construct()
    {
        $this->_addBootstrap();
    }

    /**
     * Create Head Html String
     *
     * @return string
     */
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

    /**
     * Create Body Html String
     *
     * @return string
     */
    protected function _getBodyHtml()
    {
        $html = '<body>';
        $html .= $this->_bodyContent;
        $html .= '</body>';
        return $html;
    }

    /**
     * Create Full Page Html String
     *
     * @return string
     */
    public function getHtml ()
    {
        $html = $this->_getHeadHtml();
        $html .= $this->_getBodyHtml();
        $html .= $this->_getFooterHtml();
        return $html;
    }

    /**
     * Create Footer Html String
     *
     * @return string
     */
    protected function _getFooterHtml()
    {
        $html = '<footer class="footer"><div class="container"><p class="text-muted"><strong>Kisten D.L</strong> | <strong>2017</strong> | <a href="https://github.com/Kisten-DL/Light-It-test">GitHub</a></p></div></footer>';
        return $html;
    }

    /**
     * Added Bootstrap library
     */
    protected function _addBootstrap()
    {
        $this->addJs('lib/js/jquery-3.2.1.min.js');
        $this->addJs('lib/js/bootstrap.min.js');
        $this->addCss('lib/css/bootstrap.min.css');
        $this->addCss('lib/css/bootstrap-theme.min.css');
        $this->addCss('skin/css/style.css');
    }

    /**
     * Create Facebook Api Html
     *
     * @return string
     */
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

    /**
     * added js
     *
     * @param String
     */
    public function addJs ($js)
    {
        $this->_headJs[] = $js;
    }

    /**
     * added css
     *
     * @param string
     */
    public function addCss ($css)
    {
        $this->_headCss[] = $css;
    }

    /**
     * Returns all Css path
     *
     * @return array
     */
    public function getCss()
    {
        return $this->_headCss;
    }

    /**
     * Returns all Js path
     *
     * @return array
     */
    public function getJs()
    {
        return $this->_headJs;
    }

    /**
     * Set Body Content
     *
     * @param $content
     */
    public function setBodyContent($content)
    {
        $this->_bodyContent = $content;
    }

    /**
     * Return Bootstrap Warning Alert Html
     *
     * @param string
     * @return string
     */
    public function getWarningHtml($text)
    {
        $html = '<div class="alert alert-warning"><strong>' . $text . '</strong></div>';
        return $html;
    }

    /**
     * Return Facebook login button Html
     *
     * @return string
     */
    public function getFacebookButtonHtml()
    {
        $html = '<div class="fb-login-button" style="margin-top: 5px; margin-right: 5px" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="true"></div>';
        return $html;
    }
}