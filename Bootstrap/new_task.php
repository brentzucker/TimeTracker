<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("New Task");

echo '<h1>New Task</h1>';

newTaskForm("new", $_SESSION['Developer']);

close_html();
?>