<?php
require_once(__DIR__.'/../../include.php');

//createEmployee('SE', 'm.graessle', 'Developer', 'pass', 'Max', 'graessle', '1234567890', 'max@fatstacks.com', '15 main st', 'College Park', 'GA');

function developerDropDown()
{
	$developers = $_SESSION['Developer']->getDevelopers();

	echo '<select name="Developer_Selected">';
	foreach($developers as $d)
		echo '<option value="' . $d->getUsername() . '">' . $d->getUsername() . '</option>';
	echo '</select>';
	echo '<input type="submit" value="Submit">';
}

session_start();

//Select Developer
echo "<h2>Manage Developers</h2><h4>Select a Developer</h4>";
echo '<form action="assign_client.php" method="POST">';
developerDropDown();
echo '</form>';
?>