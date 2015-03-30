<?php
require_once(__DIR__.'/../../include.php');

function printAssignmentsTable($developer)
{
	$query = "SELECT * FROM DeveloperAssignments WHERE Username='" . $developer ."'";
	echo '<table style="border:1px solid black; text-align:center;">';

	echo '<tr><th>Username</th><th>ClientProjectTask</th><th>Type</th></tr>';

	if($result = db_query($query))
	{
		while($row = mysqli_fetch_row($result))
		{
			echo '<tr>';
			foreach($row as $r)
				echo "<td style=\"border:1px solid black;padding:5px;\">$r</td>";
			echo '</tr>';
		}
	}
	mysqli_free_result($result);
	echo '</table>';
}

session_start();

$_SESSION['assign']['task'] = $_POST['Task_Selected'];

newDeveloperAssignments($_SESSION['assign']['developer'], $_SESSION['assign']['task'], 'Task');

//Select Developer
echo "<h2>Manage Developers</h2><h4>" . $_SESSION['assign']['developer'] . " was selected</h4>";

printAssignmentsTable($_SESSION['assign']['developer']);
?>