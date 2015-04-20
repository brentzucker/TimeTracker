<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Task Reports");

echo '<h1>Task Reports</h1>';

taskReports();

close_html();
?>