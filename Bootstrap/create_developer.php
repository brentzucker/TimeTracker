<?php

require_once(__DIR__.'/../include.php');
require_once(__DIR__.'/page_functions.php');

open_html("Create Developer");

echo '<h2>Create Developer</h2>';

newDeveloperForm($_SESSION['Developer']);

close_html();
?>