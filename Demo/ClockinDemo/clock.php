<?php
require_once(__DIR__.'/../../include.php');

function printTimeTable()
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, t.ProjectID, p.ProjectName, t.TaskID, Tasks.TaskName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t, Projects p, Tasks WHERE (t.ProjectID = p.ProjectID AND t.ProjectID = Tasks.ProjectID) AND t.TaskID=" . $_SESSION['currentLog']['task'];
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

function clockIn($taskid)
{
	$_SESSION['Developer']->clockIn($taskid);
}

function clockOut()
{
	$_SESSION['Developer']->clockOut();
}

session_start();

if(isset($_POST['Task_Selected']))
	$_SESSION['currentLog']['task'] = $_POST['Task_Selected'];

if(isset($_POST['clockin']))
{
	clockIn($_SESSION['currentLog']['task']);
}

if(isset($_POST['clockout']))
{
	clockOut();
}
	
echo '<h1>' . $_SESSION['Developer']->getUsername() . ' is logged in</h1>';

echo '<h2>' . $_SESSION['currentLog']['task'] . ' was selected</h2>';
echo '<h3>Clock In</h3>';

echo '<form action="clock.php" method="POST">';
echo '<input type="submit" name="clockin" value="Clock In">';
echo '<input type="submit" name="clockout" value="Clock Out">';
echo '</form>';

printTimeTable();
?>
