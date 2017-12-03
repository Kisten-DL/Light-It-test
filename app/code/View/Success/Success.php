<?php
/**
 * PHP Version 5.5.9
 *
 * This is Success View
 * This Class render success page html
 * This page appears after a successful installation is complete
 */
namespace View\Success;

use View\Template;

class Success extends Template
{
    /**
     * render page
     */
    public function render()
    {
        $html = '<div class="jumbotron success"><div class="container"><h1>SUCCESS INSTALL</h1><p><a class="btn btn-primary btn-lg" href="/login" role="button">Go To Login Page</a></p></div></div>';
        $this->setBodyContent($html);
        $html = $this->getHtml();
        echo $html;
    }
}