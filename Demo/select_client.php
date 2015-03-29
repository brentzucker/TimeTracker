<?php
require_once(__DIR__.'/../include.php');

function beforeHTML()
{
	session_start();
}

function ClientDropDown($Developer)
{
	echo '<select name="Client_Selected">';

	foreach($Developer->getClientList() as $client)
		echo '<option value="' . $client->getClientname() . '">' . $client->getClientname() . '</option>';

	echo '</select>';
}

beforeHTML();

echo '<h1>' . $_SESSION['Developer']->getUsername() . ' is Clocking in</h1>';
echo '<h3>Select a Client</h3>';

echo '<form action="select_project.php" method="POST">';
echo ClientDropDown($_SESSION['Developer']);
echo '<input type="submit" value="Submit">';
echo '</form>';
?>