<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo "<h2>Manage Developers</h2>";

developerClientDropdownForm('assign');

if(isset($_POST['Client_Selected']) || isset($_SESSION['assign']['client']))
{
	echo '<h4>' . $_SESSION['assign']['client'] . ' was selected.</h4>';

	//Assign the selected client to the developer (Creates a Client object and stores it in the Client_List). Makes an entry in the DeveloperAssignments Table
	$client_to_assign = new Client($_SESSION['assign']['client']);

	$developer_to_assign = new Developer($_SESSION['assign']['developer']);
	$developer_to_assign->assignClient($client_to_assign);

	printAssignmentsTableClient($_SESSION['assign']['developer']);
}
?>