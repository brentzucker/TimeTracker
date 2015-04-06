<?php
require_once(__DIR__.'/../include.php');

session_start();

$_SESSION['Developer'] = new Developer('b.zucker');
$_SESSION['currentLog'] = null;
$_SESSION['reports'] = null;
$_SESSION['assign'] = null;

echo '<h1>' . $_SESSION['Developer']->getUsername() . ' is logged in</h1>';

echoHomePageLinks();
?>