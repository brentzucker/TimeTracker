<?php
require_once(__DIR__.'/../include.php');

session_start();

$_SESSION['Developer'] = new Developer('b.zucker');

echo '<h1>' . $_SESSION['Developer']->getUsername() . ' is logged in</h1>';

echoHomePageLinks();
?>