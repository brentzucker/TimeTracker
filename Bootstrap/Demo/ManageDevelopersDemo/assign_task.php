<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo "<h2>Manage Developers</h2>";

echo '<h4>Select a Developer</h4>';

echo '<form action="" method="POST">';
developerDropDown($_SESSION['Developer']);
echo '</form>';

developerClientProjectTaskDropDownForm('assign');

//If all of the drop downs have been selected, assign the task and print the table
if(isset($_POST['Task_Selected']) || isset($_SESSION['assign']['task']))
{
	echo '<h2>' . $_SESSION['assign']['task']  . ' was selected</h2>';

	//Assign the selected task to the developer (Creates a Task object and stores it in the Task_List). Makes an entry in the DeveloperAssignments Table
	$task_to_assign = new Tasks($_SESSION['assign']['task']);

	$developer_to_assign = new Developer($_SESSION['assign']['developer']);
	$developer_to_assign->assignTask($task_to_assign);

	printAssignmentsTable($_SESSION['assign']['developer']);
}
?>