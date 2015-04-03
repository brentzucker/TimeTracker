<?php
require_once(__DIR__.'/../include.php');
require_once(__DIR__.'/page_functions.php');

function ClientDropDown($Developer)
{
	echo '<select name="Client_Selected">';

	foreach($Developer->getClientList() as $client)
		echo '<option value="' . $client->getClientname() . '">' . $client->getClientname() . '</option>';
	echo '</select>';
	echo '<input type="submit" value="Submit">';
}

session_start();

html_header("Demo Login");

echo "<div id='box'>";

$_SESSION['assign']['developer'] = $_POST['Developer_Selected'];

echo "<h2>Manage Developers</h2><h4>Select a Client</h4>";
echo '<form action="assign_project.php" method="POST">';
ClientDropDown($_SESSION['Developer']);
echo '</form>';
echo '</div>';

html_footer();
?>