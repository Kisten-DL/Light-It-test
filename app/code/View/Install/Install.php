<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 07.07.17
 * Time: 19:37
 */
namespace View\Install;

use View\Template;

Class Install extends Template
{
    public function render()
    {
        $html = '<form action="Controller\Install.php" method="post">'
            . '<label for="server">Server Name</label><input type="text" name="server" id="server">'
            . '<label for="user">DB User</label><input type="text" name="user" id="user">'
            . '<label for="pass">DB User Password</label><input type="text" name="pass" id="pass">'
            . '<label for="base">Data Base Name</label><input type="text" name="db_name" id="base">'
            . '<button type="submit">Submit</button>'
            . '</form>';
        $this->setBodyContent($html);
        $html = $this->getHtml();
        echo $html;
    }
}