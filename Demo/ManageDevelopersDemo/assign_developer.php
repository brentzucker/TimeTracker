<?php
require_once(__DIR__.'/../../include.php');

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

echo '<a href="create_developer.php"><h2>Create Developer</h2></a>';

//Select Developer
echo "<h2>Manage Developers</h2><h4>Select a Developer</h4>";
echo '<form action="assign_client.php" method="POST">';
developerDropDown();
echo '</form>';
?>