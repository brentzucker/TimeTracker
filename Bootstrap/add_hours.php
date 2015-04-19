<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Add Purchased Hours");

echo '<h1>Add Purchased Hours</h1>';

addHours();

close_html();
?>