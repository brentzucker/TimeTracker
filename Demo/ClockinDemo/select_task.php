<?php
require_once(__DIR__.'/../../include.php');

function taskDropDown($developer, $projectid)
{
	$tasks = $developer->getProjectsTasksAssigned($projectid);

	echo '<select name="Task_Selected">';
	foreach($tasks as $t)
		echo '<option value="' . $t->getTaskID() . '">' . $t->getTaskName() . '</option>';
	echo '</select>';
}

session_start();

echo '<h1>' . $_SESSION['Developer']->getUsername() . ' is logged in</h1>';

$_SESSION['currentLog']['project'] = $_POST['Project_Selected'];

echo '<h2>' . $_POST['Project_Selected'] . ' was selected</h2>';
echo '<h3>Select a Task</h3>';

echo '<form action="clock.php" method="POST">';

taskDropDown($_SESSION['Developer'], $_POST['Project_Selected']);

echo '<input type="submit" value="Submit">';
echo '</form>';
?>
