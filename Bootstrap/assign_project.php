<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Assign Project");

echo "<h1>Assign a Project</h1>";

assignProject();

close_html();

?>