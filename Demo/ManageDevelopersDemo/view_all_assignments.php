<?php
require_once(__DIR__.'/../../include.php');

session_start();

$_SESSION['assign']['developer'] = $_POST['Task_Selected'];

//Select Developer
echo "<h2>Manage Developers</h2>";

echo '<h4>Select a Developer</h4>';
echo '<form action="" method="POST">';
developerDropDown($_SESSION['Developer']);
echo '</form>';

if(isset($_POST['Developer_Selected']))
{
	echo '<h4>' . $_POST['Developer_Selected'] . " was selected</h4>";

	echo '<h4>Client\'s Assigned </h4>';
	printAssignmentsTableClient($_POST['Developer_Selected']);

	echo '<h4>Project\'s Assigned </h4>';
	printAssignmentsTableProject($_POST['Developer_Selected']);

	echo '<h4>Task\'s Assigned </h4>';
	printAssignmentsTableTask($_POST['Developer_Selected']);
}
?>