<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>Task Reports</h1>';

echo '<form action="" method="POST">';
clientDropDown($_SESSION['Developer']);
echo "</form>";

if(isset($_POST['Client_Selected']) || isset($_SESSION['report']['client']))
{
	//Store the Client selected in the report session
	if(isset($_POST['Client_Selected']))
		$_SESSION['report']['client'] = $_POST['Client_Selected'];

	echo '<h2>' . $_SESSION['report']['client'] . ' was selected</h2>';

	echo '<form action="" method="POST">';
	projectDropDown($_SESSION['Developer'], $_SESSION['report']['client']);
	echo "</form>";

	if(isset($_POST['Project_Selected']) || isset($_SESSION['report']['project']))
	{
		//Store the project selected in the report session
		if(isset($_POST['Project_Selected']))
			$_SESSION['report']['project'] = $_POST['Project_Selected'];

		echo '<h2>' . $_SESSION['report']['project']  . ' was selected</h2>';

		echo '<form action="" method="POST">';
		taskDropDown($_SESSION['Developer'], $_SESSION['report']['project']);
		echo '</form>';

		if(isset($_POST['Task_Selected']) || isset($_SESSION['report']['task']))
		{
			//Store the project selected in the report session
			if(isset($_POST['Task_Selected']))
				$_SESSION['report']['task'] = $_POST['Task_Selected'];

			echo '<h2>' . $_SESSION['report']['task']  . ' was selected</h2>';

			echo '<h3>Developers Hours</h3>';
			printAggregatedTimeLogTableByTask($_SESSION['report']['task']);

			echo '<h3>Detailed Time Sheet</h3>';
			printTimeLogTableByTask($_SESSION['report']['task']);
		}
	}
}
?>