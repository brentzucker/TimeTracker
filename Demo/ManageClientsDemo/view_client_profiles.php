<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>Client Profiles</h1>';

viewClientProfiles();

function viewClientProfiles()
{
	echo '<form action="" method="POST">';
	clientDropDown($_SESSION['Developer']);
	echo '</form>';

	if( isset($_POST['Client_Selected']) )
	{
		echo '<h2>' . $_POST['Client_Selected'] . '</h2>';

		//Print Client Contact information
		echo '<h3>Contact Info</h3>';
		printClientContactTable($_POST['Client_Selected']);
	}
}


function printClientContactTable($client)
{
	$query = "SELECT * FROM ClientContact WHERE ClientName='$client'";
	$table_headers = array('Client Name', 'First Name', 'Last Name', 'Phone', 'Email', 'Address', 'City', 'State');
	printTable($query, $table_headers);
}
?>