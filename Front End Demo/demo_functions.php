<?php
require_once(__DIR__.'/../include.php');

//This function echos the links on the home page
function echoHomePageLinks()
{
	echo '<h3><a href="select_client.php">Clock Into Work</a>';
	echo '<h3><a href="select_report.php">View Reports</a>';
	echo '<h3><a href="assign_developer.php">Manage Developers</a>';
	echo '<h3><a href="manage_clients.php">Manage Clients</a>';
}

//This function gets passed a Developer and echos a dropdwon selector for the Developer's Client List
function ClientDropDown($Developer)
{
	echo '<select name="Client_Selected">';

	foreach($Developer->getClientList() as $client)
		echo '<option value="' . $client->getClientname() . '">' . $client->getClientname() . '</option>';
	
	echo '</select>';
	echo '<input type="submit" value="Submit">';

}

//This function gets passed a developer and client, and echos a dropdown selector for the list of projects that are assigned to that developer and that client
function projectDropDown($developer, $clientname)
{
	echo '<select name="Project_Selected">';

	foreach($developer->getClientsProjectsAssigned($clientname) as $p)
		echo '<option value="' . $p->getProjectID() . '">' . $p->getProjectName() . '</option>';

	echo '</select>';
	echo '<input type="submit" value="Submit">';
}

//This function gets passed a developer and a projectid, and echos a dropdown selector for the list of tasks that are assigned to that developer and that project
function taskDropDown($developer, $projectid)
{
	echo '<select name="Task_Selected">';
	foreach($developer->getProjectsTasksAssigned($projectid) as $t)
		echo '<option value="' . $t->getTaskID() . '">' . $t->getTaskName() . '</option>';
	echo '</select>';
	echo '<input type="submit" value="Submit">';
}

//This function gets passed a taskid and echos a the timeLog table for the specific task
function printTimeLogTable($task)
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, t.ProjectID, p.ProjectName, t.TaskID, Tasks.TaskName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t, Projects p, Tasks WHERE (t.ProjectID = p.ProjectID AND t.ProjectID = Tasks.ProjectID) AND t.TaskID=" . $task;
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

//This function consumes a developer and a taskid, echos a clockin/clockout form and handles the forms action (recording the developer's clockin/clockout)
function clockForm($developer, $taskid)
{
	//If the clockin button was submitted, record the time
	if(isset($_POST['clockin']))
		$developer->clockIn($taskid);

	//If the clockout button was submitted, record the time
	if(isset($_POST['clockout']))
		$developer->clockOut();

	echo '<form action="" method="POST">';
	echo '<input type="submit" name="clockin" value="Clock In">';
	echo '<input type="submit" name="clockout" value="Clock Out">';
	echo '</form>';
}
?>