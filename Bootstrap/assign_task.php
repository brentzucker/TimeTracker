<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Assign Task");

echo "<h2>Manage Developers</h2>";

assignTask();

close_html();

?>