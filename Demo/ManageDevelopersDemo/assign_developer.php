<?php
require_once(__DIR__.'/../../include.php');

session_start();

//Call in javascript file
$src =  '../../Javascript/dropdowns.js';
echo '<script src="' . $src . '"></script>';

echo '<a href="create_developer.php"><h2>Create Developer</h2></a>';

//Select Developer
echo "<h2>Manage Developers</h2><h4>Select a Developer</h4>";
echo '<form action="assign_client.php" method="POST">';
developerDropDown($_SESSION['Developer']);
echo '</form>';
?>