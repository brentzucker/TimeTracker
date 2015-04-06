<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>Project Reports</h1>';

echo '<form action="" method="POST">';

clientDropDown($_SESSION['Developer']);

echo "</form>";

if(isset($_POST['Client_Selected']) || isset($_SESSION['report']['client']))
{
	//Store the Client selected in the report session
	if(!isset($_SESSION['report']['client']))
		$_SESSION['report']['client'] = $_POST['Client_Selected'];

	echo '<h2>' . $_SESSION['report']['client'] . ' was selected</h2>';

	echo '<form action="" method="POST">';

	projectDropDown($_SESSION['Developer'], $_SESSION['report']['client']);

	echo "</form>";

	if(isset($_POST['Project_Selected']) || isset($_SESSION['report']['project']))
	{
		//Store the project selected in the report session
		if(!isset($_SESSION['report']['project']))
			$_SESSION['report']['project'] = $_POST['Project_Selected'];

		echo '<h2>' . $_SESSION['report']['project']  . ' was selected</h2>';

		echo '<h3>Developers Hours</h3>';
		printAggregatedTimeLogTableByProject($_SESSION['report']['project']);

		echo '<h3>Detailed Time Sheet</h3>';
		printTimeLogTableByProject($_SESSION['report']['project']);
	}
}

?>