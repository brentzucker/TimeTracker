<?php
require_once(__DIR__.'/../include.php');
require_once(__DIR__.'/page_functions.php');

session_start();

html_header("Demo Login");

echo "<div id='box'>";

echo '<h1>Manage Clients</h1>';
echo '<h3><a href="new_client.php">New Client</a>';
echo '<h3><a href="new_project.php">New Project</a>';
echo '<h3><a href="new_task.php">New Task</a>';

echo '</div>';

html_footer();
?>