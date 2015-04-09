<?php
require_once(__DIR__.'/../../include.php');

session_start();

$_SESSION['assign'] = null;

echo '<h1>Manage Developers</h1>';

echoManageDevelopersLinks();
?>