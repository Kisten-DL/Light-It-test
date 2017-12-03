<?php
/**
 * PHP Version 5.5.9
 *
 * This is Install View
 * This Class render install page html
 */
namespace View\Install;

use View\Template;

Class Install extends Template
{
    /**
     * Render page
     */
    public function render()
    {
        $this->addJs('lib/js/validator.min.js');
        $this->addJs('skin/js/install.js');
        $html = '<div class="container"><div class="row"><div class="col-sm-10 col-sm-offset-1 install"><p><h1>This Is Install Page</h1></p> ';
        $html .= '<form action="Controller\Install.php" id="install-form" method="post" data-toggle="validator" role="form">'
            . '<div class="form-group"><label for="server" class="control-label">Server Name</label><input type="text" name="server" id="server" class="form-control" data-error="This is required field" required><div class="help-block with-errors"></div></div>'
            . '<div class="form-group"><label for="user" class="control-label">DB User</label><input type="text" name="user" id="user" class="form-control" data-error="This is required field" required><div class="help-block with-errors"></div></div>'
            . '<div class="form-group"><label for="pass" class="control-label">DB User Password</label><input type="password" name="pass" id="pass" class="form-control" data-error="This is required field" required><div class="help-block with-errors"></div></div>'
            . '<div class="form-group"><label for="base" class="control-label">Data Base Name</label><input type="text" name="db_name" id="base" class="form-control" data-error="This is required field" required><div class="help-block with-errors"></div></div>'
            . '<div class="form-group"><label for="hash" class="control-label">Crypt key</label><input type="text" name="hash" id="hash" class="form-control"></div>'
            . '<button type="submit" class="btn btn-primary btn-lg">Submit</button>'
            . '</form>';
        $html .= '</div></div></div>';
        $this->setBodyContent($html);
        $html = $this->getHtml();
        echo $html;
    }
}