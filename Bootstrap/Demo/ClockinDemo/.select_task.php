<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>' . $_SESSION['Developer']->getUsername() . ' is logged in</h1>';

//Stores the project selected in the 'currentLog' session variable
$_SESSION['currentLog']['project'] = $_POST['Project_Selected'];

echo '<h2>' . $_POST['Project_Selected'] . ' was selected</h2>';
echo '<h3>Select a Task</h3>';

echo '<form action="clock.php" method="POST">';

taskDropDown($_SESSION['Developer'], $_POST['Project_Selected']);

echo '</form>';
?>
