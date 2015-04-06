<?php
require_once(__DIR__.'/../include.php');

//This function echos the links on the home page
function echoHomePageLinks()
{
	echo '<ul>';
	echo '<li><h3><a href="ClockinDemo/clock.php">Clock Into Work</a></li>';
	echo '<li><h3><a href="ReportsDemo/select_report.php">View Reports</a></li>';
	echo '<li><h3><a href="ManageDevelopersDemo/assign_developer.php">Manage Developers</a></li>';
	echo '<li><h3><a href="ManageClientsDemo/manage_clients.php">Manage Clients</a></li>';
	echo '</ul>';
}

//This function echos the links on the manage clients page
function echoManageClientsLinks()
{
	echo '<ul>';
	echo '<li><h3><a href="purchase_hours.php">Add Purchased Hours</a></li>';
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

//This function consumes a session variable to store values in and echos forms based on preceding selections.
function clientProjectTaskDropdownForm($session_variable)
{
	echo '<h3>Select a Client</h3>';
	echo '<form action="" method="POST">';
	clientDropDown($_SESSION['Developer']);
	echo "</form>";

	if(isset($_POST['Client_Selected']) || isset($_SESSION["$session_variable"]['client']))
	{
		//If the client selection is changed
		if(isset($_POST['Client_Selected']) && $_POST['Client_Selected'] != $_SESSION["$session_variable"]['client']) 
		{
			unset($_SESSION["$session_variable"]['project']);
			unset($_SESSION["$session_variable"]['task']);
		}

		//Store the Client selected in the report session
		if(isset($_POST['Client_Selected']))
			$_SESSION["$session_variable"]['client'] = $_POST['Client_Selected'];

		echo '<h2>' . $_SESSION["$session_variable"]['client'] . ' was selected</h2>';

		echo '<h3>Select a Project</h3>';
		echo '<form action="" method="POST">';
		projectDropDown($_SESSION['Developer'], $_SESSION["$session_variable"]['client']);
		echo "</form>";

		if(isset($_POST['Project_Selected']) || isset($_SESSION["$session_variable"]['project']))
		{
			//If the project selection is changed
			if(isset($_POST['Project_Selected']) && $_POST['Project_Selected'] != $_SESSION["$session_variable"]['project']) 
				unset($_SESSION["$session_variable"]['task']);

			//Store the project selected in the report session
			if(isset($_POST['Project_Selected']))
				$_SESSION["$session_variable"]['project'] = $_POST['Project_Selected'];

			echo '<h2>' . $_SESSION["$session_variable"]['project']  . ' was selected</h2>';

			echo '<h3>Select a Task</h3>';
			echo '<form action="" method="POST">';
			taskDropDown($_SESSION['Developer'], $_SESSION["$session_variable"]['project']);
			echo '</form>';

			if(isset($_POST['Task_Selected']) || isset($_SESSION["$session_variable"]['task']))
			{
				//Store the project selected in the report session
				if(isset($_POST['Task_Selected']))
					$_SESSION["$session_variable"]['task'] = $_POST['Task_Selected'];
			}
		}
	}
}

//This function consumes a query and table headers and prints out the results in a table
function printTable($query, $table_headers)
{
	echo '<table style="border:1px solid black; text-align:center;">';

	echo '<tr>';
	foreach($table_headers as $t_h)
		echo '<th>' . $t_h . '</th>';
	echo '</tr>';
	
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
	echo '</table>';
	mysqli_free_result($result);
}


//This function consumes a taskid and echos the timeLog table for the specific task
function printTimeSheetTableByTask($task)
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, t.ProjectID, p.ProjectName, t.TaskID, Tasks.TaskName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t, Projects p, Tasks WHERE (t.ProjectID = p.ProjectID AND t.ProjectID = Tasks.ProjectID) AND t.TaskID=" . $task;
	
	$table_headers = array('TimeLogID', 'Username', 'Client', 'ProjectID', 'Project Name', 'TaskID', 'TaskName', 'Time In', 'Time Out', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a develper username and echos the timeLog table for the specific developer
function printTimeLogTableByDeveloper($developer)
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, t.ProjectID, p.ProjectName, t.TaskID, Tasks.TaskName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t, Projects p, Tasks WHERE (t.ProjectID = p.ProjectID AND t.ProjectID = Tasks.ProjectID) AND t.Username='" . $developer ."'";
	
	$table_headers = array('TimeLogID', 'Username', 'Client', 'ProjectID', 'Project Name', 'TaskID', 'Task Name', 'Time In', 'Time Out', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a developer username and echos an aggregated view of the TimeSheet table with a sum of timespent and grouped by client names
function printAggregatedTimeLogTableByDeveloper($developer)
{
	$query = "SELECT t.Username, t.ClientName, SUM(t.TimeSpent) FROM TimeSheet t WHERE t.Username='" . $developer ."'GROUP BY t.ClientName";
	
	$table_headers = array('Username', 'Client', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a client name and echos the timeLog table for the specific developer
function printTimeLogTableByClient($client)
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t WHERE  t.ClientName='" . $client ."'";

	$table_headers = array('TimeLogID', 'Username', 'Client', 'Time in', 'Time Out', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a client name and echos an aggregated view of the TimeSheet table with a sum of timespent and grouped by client names
function printAggregatedTimeLogTableByClient($client)
{
	$query = "SELECT t.ClientName, t.Username, SUM(t.TimeSpent) FROM TimeSheet t WHERE t.ClientName='" . $client ."'GROUP BY t.Username";

	$table_headers = array('Client', 'Username', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a projectid and echos an aggregated view of the TimeSheet table with a sum of timespent and grouped by developers names
function printAggregatedTimeLogTableByProject($project)
{
	$query = "SELECT t.ClientName, p.ProjectName , t.Username, SUM(t.TimeSpent) FROM TimeSheet t, Projects p WHERE (t.ProjectID = p.ProjectID) AND t.ProjectID='" . $project ."' GROUP BY t.Username";
	
	$table_headers = array('Client', 'Project Name', 'Username', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a projectid and echos the timeLog table for the specific project
function printTimeLogTableByProject($project)
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, p.ProjectName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t, Projects p WHERE (t.ProjectID = p.ProjectID) AND t.ProjectID='" . $project ."'";
	
	$table_headers = array('TimeLogID', 'Username', 'Client', 'Time In', 'Time Out', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a taskid and echos an aggregated view of the TimeSheet table with a sum of timespent and grouped by developers names
function printAggregatedTimeLogTableByTask($task)
{
	$query = "SELECT t.ClientName, p.ProjectName, a.TaskName, t.Username, SUM(t.TimeSpent) FROM TimeSheet t, Projects p, Tasks a WHERE (t.ProjectID = p.ProjectID AND a.TaskID=t.TaskID) AND t.TaskID='" . $task ."' GROUP BY t.Username";
	
	$table_headers = array('Client', 'Project Name', 'Task Name', 'Username', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a taskid and echos the timeLog table for the specific task
function printTimeLogTableByTask($task)
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, p.ProjectName, a.TaskName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t, Projects p, Tasks a WHERE (t.ProjectID = p.projectID AND a.TaskID=t.TaskID) AND t.TaskID='" . $task ."'";
	
	$table_headers = array('TimeLogID', 'Username', 'Client', 'Time In', 'Time Out', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a client name and echos a view of the ClientPurchases table 
function printHoursLeftTable($client)
{
	$query = 'SELECT p.ClientName, p.HoursPurchased, p.PurchaseDate, c.HoursLeft FROM ClientPurchases p, Client c WHERE (c.ClientName = p.ClientName) AND c.ClientName="' . $client . '"';
		
	$table_headers = array('Client', 'Hours Purchased', 'Purchase Date', 'Hours Left');

	printTable($query, $table_headers);
}

//This function consumes a developer username and echos an Assignment table for the specific developer
function printAssignmentsTable($developer)
{
	$query = "SELECT * FROM DeveloperAssignments WHERE Username='" . $developer ."'";
	
	$table_headers = array('Username', 'Client/Project/Task', 'Type');

	printTable($query, $table_headers);
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
	<select name="state">
<option value="">Select your state</option>
<option value="AL">Alabama</option>
<option value="AK">Alaska</option>
<option value="AZ">Arizona</option>
<option value="AR">Arkansas</option>
<option value="CA">California</option>
<option value="CO">Colorado</option>
<option value="CT">Connecticut</option>
<option value="DE">Delaware</option>
<option value="DC">District of Columbia</option>
<option value="FL">Florida</option>
<option value="GA">Georgia</option>
<option value="HI">Hawaii</option>
<option value="ID">Idaho</option>
<option value="IL">Illinois</option>
<option value="IN">Indiana</option>
<option value="IA">Iowa</option>
<option value="KS">Kansas</option>
<option value="KY">Kentucky</option>
<option value="LA">Louisiana</option>
<option value="ME">Maine</option>
<option value="MD">Maryland</option>
<option value="MA">Massachusetts</option>
<option value="MI">Michigan</option>
<option value="MN">Minnesota</option>
<option value="MS">Mississippi</option>
<option value="MO">Missouri</option>
<option value="MT">Montana</option>
<option value="NE">Nebraska</option>
<option value="NV">Nevada</option>
<option value="NH">New Hampshire</option>
<option value="NJ">New Jersey</option>
<option value="NM">New Mexico</option>
<option value="NY">New York</option>
<option value="NC">North Carolina</option>
<option value="ND">North Dakota</option>
<option value="OH">Ohio</option>
<option value="OK">Oklahoma</option>
<option value="OR">Oregon</option>
<option value="PA">Pennsylvania</option>
<option value="RI">Rhode Island</option>
<option value="SC">South Carolina</option>
<option value="SD">South Dakota</option>
<option value="TN">Tennessee</option>
<option value="TX">Texas</option>
<option value="UT">Utah</option>
<option value="VT">Vermont</option>
<option value="VA">Virginia</option>
<option value="WA">Washington</option>
<option value="WV">West Virginia</option>
<option value="WI">Wisconsin</option>
<option value="WY">Wyoming</option>
</select>
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
	/*
	if(isset($_POST['Submit']))
		createEmployee($_POST['team'], $_POST['username'], $_POST['position'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['email'], $_POST['address'], $_POST['city'], $_POST['state']);
	*/
	
	$teamError = $usernameError = $positionError = $passwordError = $firstnameError = $lastnameError = $phoneError = $emailError = $addressError = $cityError = $stateError = "";

	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
	    if ($_POST['team'] == "") 
	    {
	        $teamError = "Please Select the Team.";
	    }
	    else 
	    {
	        $team = $_POST['team'];
	    }

	    if (empty($_POST['username'])) 
	    {
	        $usernameError = "Missing";
	    }
		else if($_POST['username'] < 2) 
		{
				$usernameError = "Username needs to be at least 3 characters long";
		}
	    else 
	    {
	        $username = $_POST['username'];
		}

	    if ($_POST['position'] == "")
		{
	        $positionError = "Please select your position.";
	    }
	    else 
	    {
	        $position = $_POST['position'];
	    }

		if (empty($_POST['password']))
		{
        	$passwordError = "Missing";
    	}
		else if($_POST['password'] < 4)
		{
			$passwordError = "Password needs to be at least 5 characters long";
		}
	    else 
	    {
	        $password = $_POST['password'];
	    }

		if(!empty($_POST['team']) && !empty($_POST['username']) && !empty($_POST['position']) && !empty($_POST['password']))
		{
			createEmployee($team, $username, $position, $password, $firstname, $lastname, $phone, $email, $address, $city, $state);
		}
	}

	echo <<<END
	<form id="developer_form" action="" method="POST">
	<br>Team: <font color="red">*</font><br>
	<select name="team">
		<option value="">Select the team</option>
		<option value="Team 1">Team 1</option>
		<option value="Team 2">Team 2</option>
		<option value="Team 3">Team 3</option>
	</select>
	<font color="red">$teamError</font>
	<br>Username: <font color="red">*</font><br>
	<input type="text" name="username"> <font color="red">$usernameError</font>
	<br>Password: <font color="red">*</font><br>
	<input type="password" name="password"> <font color="red">$passwordError</font>
	<br>Position: <font color="red">*</font><br>
	<select name="position">
		<option value="">Select your position</option>
		<option value="Project Manager">Project Manager</option>
		<option value="Developer">Developer</option>
	</select>
	<font color="red">$positionError</font>
	<br>
END;

	echoContactInput();
	
	echo <<<END
	<br><input type="submit" name="Submit" value="Create Developer">
	<br><font color="red">* Required fields.</font>
	</form>;
END;
	
}
?>
