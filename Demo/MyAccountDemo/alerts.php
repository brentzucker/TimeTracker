<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>Update Alerts</h1>';

updateAlertsForm();

function updateAlertsForm()
{
	echo '<form action="" method="POST">';
	echo '<label>Days Before a Contract Expires:</labels>';
	echo '<input type="number" name="days" value="100">';
	echo '<br>';
	echo '<label>Hours Left on Contract:</label>';
	echo '<input type="number" name="hours" value="10">';
	echo '<br>';
	echo '<input type="submit" value="Update Alerts">';
	echo '</form>';

	if(isset($_POST['days']) && isset($_POST['hours']))
	{
		echo '<h3>Alerts has been updated.</h3>';
		echo '<h4>Days: ' . $_POST['days'] .'</h4>';
		echo '<h4>Hours: ' . $_POST['hours'] . '</h4>';
	}
}
?>
