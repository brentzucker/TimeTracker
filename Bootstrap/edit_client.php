<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Edit Client");

echo '<h1>Edit Client</h1>';

editClient();

close_html();
?>