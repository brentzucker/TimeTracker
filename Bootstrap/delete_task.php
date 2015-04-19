<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Delete Task");

echo '<h1>Delete Task</h1>';

deleteTaskForm();

close_html();
?>