<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Assign Client");

echo "<h2>Assign Client</h2>";

assignClient();

close_html();

?>