<?php
require_once(__DIR__.'/../include.php');

function projectDropDown($developer, $clientname)
{
	$projects = $developer->getClientsProjectsAssigned($clientname);
	echo '<select name="Project_Selected">';

	foreach($projects as $p)
		echo '<option value="' . $p->getProjectID() . '">' . $p->getProjectName() . '</option>';

	echo '</select>';
}

session_start();

echo '<h1>' . $_SESSION['Developer']->getUsername() . ' is logged in</h1>';

$_SESSION['currentLog']['client'] = $_POST['Client_Selected'];

echo '<h2>' . $_POST['Client_Selected'] . ' was selected</h2>';
echo '<h3>Select a Project</h3>';

echo '<form action="select_task.php" method="POST">';
projectDropDown($_SESSION['Developer'], $_POST['Client_Selected']);
echo '<input type="submit" value="Submit">';
echo '</form>';
?>
