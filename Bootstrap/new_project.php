<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("New Project");

echo '<h1>New Project</h1>';

newProjectForm('new', $_SESSION['Developer']);

close_html();
?>