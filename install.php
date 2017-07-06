<?php
/**
 * Created by PhpStorm.
 * User: kisten
 * Date: 06.07.17
 * Time: 22:07
 */

if (file_exists($_SERVER['DOCUMENT_ROOT']. '/app/etc/db.xml')) {
    header('Location: ' . $_SERVER['HTTP_HOST'] . '/index');
    exit;
}
?>
<?php if (!$_POST): ?>
<html>
    <head>
        <title>Install</title>
    </head>
    <body>
        <form action="install.php" method="post">
            <label for="server">Server Name</label>
            <input type="text" name="server" id="server">
            <label for="user">DB User</label>
            <input type="text" name="user" id="user">
            <label for="pass">DB User Password</label>
            <input type="text" name="pass" id="pass">
            <label for="base">Data Base Name</label>
            <input type="text" name="db_name" id="base">
            <button type="submit">Submit</button>
        </form>
    </body>
</html>
<?php else: {
    require_once 'app/code/Setup.php';
    $setup = new \Main\Setup();
    $setup->Setup();
}?>
<?php endif ?>