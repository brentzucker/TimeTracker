<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Delete Project");

echo '<h1>Delete Project</h1>';

deleteProjectForm();

close_html();
?>