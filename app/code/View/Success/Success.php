<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 09.07.17
 * Time: 20:34
 */
namespace View\Success;

use View\Template;

class Success extends Template
{
    public function render()
    {
        $html = '<div class="jumbotron"><div class="container"><h1>SUCCESS INSTALL</h1><p><a class="btn btn-primary btn-lg" href="/login" role="button">Go To Login Page</a></p></div></div>';
        $this->setBodyContent($html);
        $html = $this->getHtml();
        echo $html;
    }
}