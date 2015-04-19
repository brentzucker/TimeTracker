<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("New Client");

echo '<h1>New Client</h1>';

newClientForm($_SESSION['Developer']);

close_html();
?>