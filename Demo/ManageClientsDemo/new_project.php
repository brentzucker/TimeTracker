<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>New Project</h1>';

newProjectForm($_SESSION['Developer']);
?>