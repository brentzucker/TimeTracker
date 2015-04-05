<?php
require_once(__DIR__.'/../include.php');

//This function echos the links on the home page
function echoHomePageLinks()
{
	echo '<ul>';
	echo '<li><h3><a href="ClockinDemo/select_client.php">Clock Into Work</a></li>';
	echo '<li><h3><a href="ReportsDemo/select_report.php">View Reports</a></li>';
	echo '<li><h3><a href="ManageDevelopersDemo/assign_developer.php">Manage Developers</a></li>';
	echo '<li><h3><a href="ManageClientsDemo/manage_clients.php">Manage Clients</a></li>';
	echo '</ul>';
}

//This function echos the links on the manage clients page
function echoManageClientsLinks()
{
	echo '<ul>';
	echo '<li><h3><a href="new_client.php">New Client</a></li>';
	echo '<li><h3><a href="new_project.php">New Project</a></li>';
	echo '<li><h3><a href="new_task.php">New Task</a></li>';
	echo '</ul>';
}

//This function gets passed a Developer and echos a dropdwon selector for the Developer's developer List
function developerDropDown($developer)
{
	$developers = $developer->getDevelopers();

	echo '<select name="Developer_Selected">';
	foreach($developers as $d)
		echo '<option value="' . $d->getUsername() . '">' . $d->getUsername() . '</option>';
	echo '</select>';
	echo '<input type="submit" value="Submit">';
}

//This function gets passed a Developer and echos a dropdwon selector for the Developer's Client List
function clientDropDown($Developer)
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

//This function consumes a taskid and echos the timeLog table for the specific task
function printTimeLogTableByTask($task)
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

//This function consumes a develper username and echos the timeLog table for the specific developer
function printTimeLogTableByDeveloper($developer)
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

//This function consumes a developer username and echos an aggregated view of the TimeSheet table with a sum of timespent and grouped by client names
function printAggregatedTimeLogTableByDeveloper($developer)
{
	$query = "SELECT t.Username, t.ClientName, SUM(t.TimeSpent) FROM TimeSheet t WHERE t.Username='" . $developer ."'GROUP BY t.ClientName";
	echo '<table style="border:1px solid black; text-align:center;">';

	echo '<tr><th>Username</th><th>Client</th><th>Time Spent</th></tr>';

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

//This function consumes a client name and echos the timeLog table for the specific developer
function printTimeLogTableByClient($client)
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t WHERE  t.ClientName='" . $client ."'";
	echo '<table style="border:1px solid black; text-align:center;">';

	echo '<tr><th>TimeLogID</th><th>Username</th><th>Client</th><th>Time In</th><th>Time Out</th><th>Time Spent</th></tr>';

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

//This function consumes a client name and echos an aggregated view of the TimeSheet table with a sum of timespent and grouped by client names
function printAggregatedTimeLogTableByClient($client)
{
	$query = "SELECT t.Username, t.ClientName, SUM(t.TimeSpent) FROM TimeSheet t WHERE t.Username='" . $developer ."'GROUP BY t.ClientName";
	echo '<table style="border:1px solid black; text-align:center;">';

	echo '<tr><th>Username</th><th>Client</th><th>Time Spent</th></tr>';

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

//This function consumes a developer username and echos an Assignment table for the specific developer
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

//This function echos the contact input fields for a form.
function echoContactInput()
{
	echo<<<END
	<br>Firstname:<br>
	<input type="text" name="firstname">
	<br>Lastname:<br>
	<input type="text" name="lastname">
	<br>Phone:<br>
	<input type="text" name="phone">
	<br>Email:<br>
	<input type="text" name="email">
	<br>Address:<br>
	<input type="text" name="address">
	<br>City:<br>
	<input type="text" name="city">
	<br>State:<br>
	<input type="text" name="state">
	<br>
END;
}

//This function echos a form to create a new Client and calls the createClient method which stores the info in the database.
function newClientForm()
{
	if(isset($_POST['Submit']))
		createClient($_POST['clientname'], $_POST['startdate'], $_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['email'], $_POST['address'], $_POST['city'], $_POST['state']);

	echo '<form id="developer_form" action="" method="POST">';
	echo '<br>Client Name:<br>';
	echo '<input type="text" name="clientname">';
	echo '<br>StartDate:<br>';
	echo '<input type="date" name="startdate">';
	echoContactInput();
	echo '<input type="submit" name="Submit" value="Create Client">';
	echo '</form>';
}

//This function echos a form to create a new Developer and calls the createEmployee method which stores the info in the database.
function newDeveloperForm()
{
	if(isset($_POST['Submit']))
		createEmployee($_POST['team'], $_POST['username'], $_POST['position'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['email'], $_POST['address'], $_POST['city'], $_POST['state']);

	echo '<form id="developer_form" action="" method="POST">';
	echo '<br>Team:<br>';
	echo '<input type="text" name="team">';
	echo '<br>Username:<br>';
	echo '<input type="text" name="username">';
	echo '<br>Password:<br>';
	echo '<input type="password" name="password">';
	echo '<br>Position:<br>';
	echo '<input type="text" name="position">';
	echoContactInput();
	echo '<br><input type="submit" name="Submit" value="Create Developer">';
	echo '</form>';
}
?>