<?php
require_once(__DIR__.'/../../include.php');

session_start();

//Stores the project selected in the 'assign' session variable
$_SESSION['assign']['project'] = $_POST['Project_Selected'];

//Select Developer
echo "<h2>Manage Developers</h2><h4>Select a Task</h4>";
echo '<form action="view_all_assignments.php" method="POST">';
taskDropDown($_SESSION['Developer'], $_POST['Project_Selected']);
echo '</form>';
?>