<?php
require_once(__DIR__.'/../../include.php');

function projectDropDown($developer, $clientname)
{
	$projects = $developer->getClientsProjectsAssigned($clientname);
	echo '<select name="Project_Selected">';

	foreach($projects as $p)
		echo '<option value="' . $p->getProjectID() . '">' . $p->getProjectName() . '</option>';
	echo '</select>';
	echo '<input type="submit" value="Submit">';
}

session_start();

$_SESSION['assign']['client'] = $_POST['Client_Selected'];

//Select Developer
echo "<h2>Manage Developers</h2><h4>Select a Project</h4>";
echo '<form action="assign_task.php" method="POST">';
projectDropDown($_SESSION['Developer'], $_POST['Client_Selected']);
echo '</form>';
?>