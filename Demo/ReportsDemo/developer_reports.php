<?php
require_once(__DIR__.'/../../include.php');

function printTimeTable($developer)
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, t.ProjectID, p.ProjectName, t.TaskID, Tasks.TaskName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t, Projects p, Tasks WHERE (t.ProjectID = p.ProjectID AND t.ProjectID = Tasks.ProjectID) AND t.Username='" . $developer ."'";
	echo '<table style="border:1px solid black; text-align:center;">';

	echo '<tr><th>TimeLogID</th><th>Username</th><th>Client</th><th>ProjectID</th><th>Project Name</th><th>TaskID</th><th>TaskName</th><th>Time In</th><th>Time Out</th><th>Time Spent</th></tr>';

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

$dev = $_POST['Developer_Selected'];
echo '<h2>' . $dev . ' was selected</h2>';

printTimeTable($dev);
?>