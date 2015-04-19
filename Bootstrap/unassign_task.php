<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Unassign Task");

echo "<h2>Unassign Task</h2>";

unassignTask();

close_html();

?>