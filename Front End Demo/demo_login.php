<?php
require_once(__DIR__.'/../include.php');
require_once(__DIR__.'/page_functions.php');

session_start();

$_SESSION['Developer'] = new Developer('b.zucker');

html_header("Demo Login");

echo "<div id='box'>";
echo '<h1>' . $_SESSION['Developer']->getUsername() . ' is logged in</h1>';

echoHomePageLinks();

echo '</div>';

html_footer();

?>