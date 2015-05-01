<?php
/*
 Name: functions.php
 Description: sets up the labels, looks, etc of the webpage
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/20/15,
 Names of files accessed: include.php
 Names of files changed:
 Input:
 Output: links, buttons, labels, etc
 Error Handling:
 Modification List:
 4/20/15-Initial code up
 4/21/15-Updated dropdowns, merge Flat UI
 */

require_once(__DIR__.'/../../include.php');

/* Functions below warn the user with alerts.
 *
 */

//This function consumes an amount of days and returns clients who have less days left on their contracts
function warningExpiringContracts($minimum_days_left)
{
	foreach($_SESSION['Developer']->getClientList() as $client)
		if($minimum_days_left >= $client->getContractDaysLeft())
			echo '<li class="warning"><span style="margin-right:24px; margin-left:2px;" class="fui-calendar"></span>' . $client->getClientname() . '&nbsp&nbsp<span class="fui-arrow-right"></span>&nbsp&nbsp' . $client->getContractDaysLeft() . " days</li>";
}

//This function consumes an amount of hours and returns clients who have less hours left on their contract
function warningLowHours($minimum_time_left)
{
	foreach($_SESSION['Developer']->getClientList() as $client)
		if($minimum_time_left >= $client->getHoursLeft())
			echo '<li class="warning"><span style="margin-right:24px; margin-left:2px;" class="fui-time"></span>' . $client->getClientname() . '&nbsp&nbsp<span class="fui-arrow-right"></span>&nbsp&nbsp' . $client->getTimeLeftFormatted() . "" . "</li>";
}

/* Functions that create dropdown selectors
 *
 */

//This function consumes the superUser echos a dropdwon selector for the Teams in the Database
function teamDropDown($superUser)
{
	$teams = $superUser->getTeams();

	echo '<select name="Team_Selected" class="form-control select select-primary" data-toggle="select">';
	foreach($teams as $t)
		echo '<option value="' . $t . '">' . $t . '</option>';
	echo '</select>';
	echo '<input type="submit" value="Submit" class="btn btn-block btn-lg btn-primary">';
}

//This function gets passed a Developer and echos a dropdwon selector for the Developer's developer List
function developerDropDown($developer)
{
	$developers = $developer->getDevelopers();

	echo '<select name="Developer_Selected" class="form-control select select-primary" data-toggle="select">';
	foreach($developers as $d)
		echo '<option value="' . $d->getUsername() . '">' . $d->getUsername() . '</option>';
	echo '</select><br>';
	echo '<input type="submit" value="Submit" class="btn btn-block btn-lg btn-primary">';
}

//This function gets passed a Developer and echos a dropdwon selector for the Developer's Client List
function clientDropDown($Developer)
{
	echo '<select name="Client_Selected" class="form-control select select-primary" data-toggle="select">';

	if(!isset($_POST['Client_Selected']))
		foreach($Developer->getClientList() as $client)
			echo '<option value="' . $client->getClientname() . '">' . $client->getClientname() . '</option>';
	else
		foreach($Developer->getClientList() as $client)
			if($_POST['Client_Selected'] == $client->getClientname())
				echo '<option selected="selected" value="' . $client->getClientname() . '">' . $client->getClientname() . '</option>';
			else
				echo '<option value="' . $client->getClientname() . '">' . $client->getClientname() . '</option>';

	echo '</select>';
	echo '<br>';
	echo '<input type="submit" class="btn btn-block btn-lg btn-primary" value="Submit" >';
	echo '<br>'; 

}

//This function gets passed a developer and client, and echos a dropdown selector for the list of projects that are assigned to that developer and that client
function projectDropDown($developer, $clientname)
{
	echo '<select name="Project_Selected" class="form-control select select-primary" data-toggle="select">';

	foreach($developer->getClientsProjectsAssigned($clientname) as $p)
		echo '<option value="' . $p->getProjectID() . '">' . $p->getProjectName() . '</option>';

	echo '</select>';
	echo '<input type="submit" class="btn btn-block btn-lg btn-primary" value="Submit">';
}

//This function gets passed a developer and a projectid, and echos a dropdown selector for the list of tasks that are assigned to that developer and that project
function taskDropDown($developer, $projectid)
{
	echo '<select name="Task_Selected" class="form-control select select-primary" data-toggle="select">';
	foreach($developer->getProjectsTasksAssigned($projectid) as $t)
		echo '<option value="' . $t->getTaskID() . '">' . $t->getTaskName() . '</option>';
	echo '</select>';
	echo '<input type="submit" class="btn btn-block btn-lg btn-primary" value="Submit">';
}

function teamListToArrayOfDeveloperLists()
{
	$team_developer_array = array();
	foreach( ( new Team( $_SESSION['Developer']->getTeam() ) )->getDeveloperList() as $developerObject)
		$team_developer_array[ $developerObject->getUsername() ] = clientListToArrayOfProjectLists( $developerObject );

	return $team_developer_array;
}

//This function converts a list of client objects to an array list of client project arrays
function clientListToArrayOfProjectLists($developerObject)
{
	$client_project_array = array();
	foreach($developerObject->getClientList() as $clientObject)
		$client_project_array[ $clientObject->getClientname() ] = projectListToArray( $clientObject->getProjects() );
		
	return $client_project_array;
}

//This function converts a list of project objects to an associative array of projects
function projectListToArray($projectObjectList)
{
	$project_array = array();

	foreach($projectObjectList as $projectObject)
	{
		$project_array[ $projectObject->getProjectID() ] = array();
		$project_array[ $projectObject->getProjectID() ]['ProjectName'] = $projectObject->getProjectName();
		$project_array[ $projectObject->getProjectID() ]['TaskList'] = taskListToArray( $projectObject->getTaskList() );
	}
		
	return $project_array;
}

//This function converts a list of task objects to an assoicative array of tasks
function taskListToArray($taskObjectList)
{
	$task_array = array();

	foreach($taskObjectList as $taskObject)
		$task_array[ $taskObject->getTaskID() ] = $taskObject->getTaskName();

	return $task_array;
}

/* These functions query the date
 *
 */

//This function echos 2 inputs for a form. A startdate and an enddate.
function dateSelector()
{
	$today = date('Y-m-d');

	echo '<br>Start Date:<br>';

	//Saves the date in the in selector view
	if(!isset($_POST['startdate']))
		echo '<input type="date" name="startdate" value="2015-01-01">';
	else
		echo '<input type="date" name="startdate" value="' . $_POST['startdate'] . '">';

	echo '<br>End Date:<br>';

	if(!isset($_POST['enddate']))
		echo '<input type="date" name="enddate" value="' . $today. '">';
	else
		echo '<input type="date" name="enddate" value="' . $_POST['enddate'] . '">';
}

//This function echos 2 inputs for a form. A startdate and an enddate.
function dateSelectorWide()
{
	$today = date('Y-m-d');

	echo ' &nbsp  From  &nbsp ';

	//Saves the date in the in selector view
	if(!isset($_POST['startdate']))
		echo '<input type="date" name="startdate" value="2015-01-01">';
	else
		echo '<input type="date" name="startdate" value="' . $_POST['startdate'] . '">';

	echo ' &nbsp  to  &nbsp ';

	if(!isset($_POST['enddate']))
		echo '<input type="date" name="enddate" value="' . $today. '">';
	else
		echo '<input type="date" name="enddate" value="' . $_POST['enddate'] . '">';
}

/* These functions print out profiles 
 *
 */

function getClientProfile($clientName)
{
	echo '<h3>' . $clientName . '</h3>';

	//Print Client Contact information
	echo '<h5>Contact Info</h5>';
	printClientContactTable($clientName);

	//Print Client Contract Information
	echo '<h5>Contract Info</h5>';
	echo '<h6>Hours Left</h6>';
	printHoursLeftTable($clientName, 'table');

	echo '<h6>Client\'s Purchases</h6>';
	printClientsPurchasesTable($clientName, 'table');

	//Projects 
	echo '<h5>Projects</h5>';
	printProjects($clientName);

	//Tasks
	echo '<h5>Tasks</h5>';
	printTasks($clientName);

	//Assigned Developers
	echo '<h5>Assigned Developers</h5>';
	printDevelopersAssignedToClient($clientName);

	//Grouped Developers by Time
	echo '<h5>Developers Time Sheet</h5>';
	printAggregatedTimeLogTableByClient($clientName,0,0, 'table');
}

/*
 *
 */

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
	echo '<div class="col-sm-2"></div>';
	echo '<input type="submit" name="clockin" value="Clock In" class="col-sm-4 btn btn-success btn-lg">';
	echo '<div class="col-sm-1"></div>';
	echo '<input type="submit" name="clockout" value="Clock Out" class="col-sm-4 btn btn-danger btn-lg">';
	echo '</form>';
}

//This function echos the contact input fields for a form.
function echoClientContactInput($contact)
{
	echo '<label>Firstname:</label>';
	echo '<input type="text" name="firstname" class="form-control" value="' . $contact->getFirstName() . '">';
	echo '<label>Lastname:</label>';
	echo '<input type="text" name="lastname" class="form-control" value="' . $contact->getLastName() . '">';
	echo '<label>Phone:</label>';
	echo '<input type="text" name="phone" class="form-control" value="' . $contact->getPhone() . '">';
	echo '<label>Email:</label>';
	echo '<input type="text" name="email" class="form-control" value="' . $contact->getEmail() . '">';
	echo '<label>Address:</label>';
	echo '<input type="text" name="address" class="form-control" value="' . $contact->getAddress() . '">';
	echo '<label>City:</label>';
	echo '<input type="text" name="city" class="form-control" value="' . $contact->getCity() . '">';
	echo '<label>State:</label>';
	echo '<br>';
	echoStateDropdown($contact->getState());
}

//This function echos the contact input fields for a form.
function echoNewContactInput()
{
	echo '<label>Firstname:</label>';
	echo '<br>';
	echo '<input type="text" name="firstname" class="form-control">';
	echo '<br>';
	echo '<label>Lastname:</label>';
	echo '<input type="text" name="lastname" class="form-control">';
	echo '<br>';
	echo '<label>Phone:</label>';
	echo '<br>';
	echo '<input type="text" name="phone" class="form-control">';
	echo '<br>';
	echo '<label>Email:</label>';
	echo '<br>';
	echo '<input type="text" name="email" class="form-control">';
	echo '<br>';
	echo '<label>Address:</label>';
	echo '<br>';
	echo '<input type="text" name="address" class="form-control">';
	echo '<br>';
	echo '<label>City:</label>';
	echo '<br>';
	echo '<input type="text" name="city" class="form-control">';
	echo '<br>';
	echo '<label>State:</label>';
	echo '<br>';
	echoStateDropdown('');
}

function echoStateDropdown($state_selected)
{
	$state_array = array(
		""=>"Select your state",
		"AL"=>"Alabama",
		"AK"=>"Alaska",
		"AZ"=>"Arizona",
		"AR"=>"Arkansas",
		"CA"=>"California",
		"CO"=>"Colorado",
		"CT"=>"Connecticut",
		"DE"=>"Delaware",
		"DC"=>"District of Columbia",
		"FL"=>"Florida",
		"GA"=>"Georgia",
		"GU"=>"Guam",
		"HI"=>"Hawaii",
		"ID"=>"Idaho",
		"IL"=>"Illinois",
		"IN"=>"Indiana",
		"IA"=>"Iowa",
		"KS"=>"Kansas",
		"KY"=>"Kentucky",
		"LA"=>"Louisiana",
		"ME"=>"Maine",
		"MD"=>"Maryland",
		"MA"=>"Massachusetts",
		"MI"=>"Michigan",
		"MN"=>"Minnesota",
		"MS"=>"Mississippi",
		"MO"=>"Missouri",
		"MT"=>"Montana",
		"NE"=>"Nebraska",
		"NV"=>"Nevada",
		"NH"=>"New Hampshire",
		"NJ"=>"New Jersey",
		"NM"=>"New Mexico",
		"NY"=>"New York",
		"NC"=>"North Carolina",
		"ND"=>"North Dakota",
		"OH"=>"Ohio",
		"OK"=>"Oklahoma",
		"OR"=>"Oregon",
		"PA"=>"Pennsylvania",
		"PR"=>"Puerto Rico",
		"RI"=>"Rhode Island",
		"SC"=>"South Carolina",
		"SD"=>"South Dakota",
		"TN"=>"Tennessee",
		"TX"=>"Texas",
		"UT"=>"Utah",
		"VT"=>"Vermont",
		"VA"=>"Virginia",
		"WA"=>"Washington",
		"WV"=>"West Virginia",
		"WI"=>"Wisconsin",
		"WY"=>"Wyoming");
	
	echo '<select name="state" class="form-control select select-primary" data-toggle="select">';
	
	foreach($state_array as $key=>$state)
		if($state_selected == $key)
			echo '<option value="' . $key . '" selected="selected">' . $state . '</option>';
		else
			echo '<option value="' . $key . '">' . $state . '</option>';
	
	echo '</select>';
	echo '<br>';
}

//This function echos a form to update a pre existing client by changing the client's contact information via editClient method
function editClientForm($developer)
{
	if(isset($_POST['Client_Selected']))
	{
		$_SESSION['edit']['client'] = $_POST['Client_Selected'];

		echo '<form action="" method="POST" class="form-horizontal">';
		echoClientContactInput( (new Client($_POST['Client_Selected']))->getContact() );
		echo '<input type="submit" name="submit" class="btn btn-block btn-lg btn-primary">';
		echo '</form>';
	}
}

function editProjectForm($projectID)
{
	echo '<form action="" method="POST">';
	echo '<label>Project Name:</label>';
	echo '<br>';
	echo '<input type="text" name="projectName" value="' . (new Projects($projectID))->getProjectName() . '">';
	echo '<br>';
	echo '<label>Description:</label>';
	echo '<br>';
	echo '<textarea rows=4 name="description" >' . (new Projects($projectID))->getDescription() . '</textarea>';
	echo '<br>';
	echo '<input type="submit" class="btn btn-block btn-lg btn-primary">';
	echo '</form>';
}

function editTaskForm($taskID)
{
	echo '<form action="" method="POST">';
	echo '<label>Task Name:</label>';
	echo '<br>';
	echo '<input type="text" name="taskName" value="' . (new Tasks($taskID))->getTaskName() . '">';
	echo '<br>';
	echo '<label>Description:</label>';
	echo '<br>';
	echo '<textarea rows=4 name="description" >' . (new Tasks($taskID))->getDescription() . '</textarea>';
	echo '<br>';
	echo '<input type="submit">';
	echo '</form>';
}

function editEmailForm()
{
	echo '<form action="" method="POST">';
	echo '<input type="text" name="email" value="' . $_SESSION['Developer']->getContact()->getEmail() . '" class="form-control input-lg">';
	echo '<input type="Submit" name="submit" value="Update Email" class="btn btn-block btn-lg btn-primary">';
	echo '</form>';
}


function editPasswordForm()
{
	//If the form has been submitted
	if(isset($_POST['Update']))
	{
		//If the current password is correct
		if(isset($_POST['currentpassword']) && verifyCurrentPassword( $_SESSION['Developer']->getUsername(), $_POST['currentpassword']) )
		{
			//If the new passwords match
			if(isset($_POST['password']) && isset($_POST['confirmpassword']) && $_POST['password'] == $_POST['confirmpassword'])
			{
				//Hashing function to encrypt password
				$hashed_password = hash('ripemd128', $_POST['password']);

				//Store encrypted password in database
				updateTableByUser('Credentials', 'Password', $hashed_password, $_SESSION['Developer']->getUsername() );

				echo '<h4>Successfully updated password!</h4';
			}
			else
			{
				echo '<form action="" method="POST">';
				echo '<label>Current Password:</label>';
				echo '<input type="password" name="currentpassword" class="form-control">';
				echo '<label>Password:</label>';
				echo '<input type="password" name="password" class="form-control">';
				echo '<label style="color:red;">Password Mismatch</label>';
				echo '<input type="password" name="confirmpassword" class="form-control">';
				echo '<input type="Submit" name="Update" value="Update" class="btn btn-block btn-lg btn-primary">';
				echo '</form>';
			}
		}
		else
		{
			echo '<form action="" method="POST">';
			echo '<label style="color:red;">Incorrect Password:</label>';
			echo '<input type="password" name="currentpassword" class="form-control">';
			echo '<label>New Password:</label>';
			echo '<input type="password" name="password" class="form-control">';
			echo '<label>Confirm Password:</label>';
			echo '<input type="password" name="confirmpassword" class="form-control">';
			echo '<input type="Submit" name="Update" value="Update" class="btn btn-block btn-lg btn-primary">';
			echo '</form>';
		}
	}
	else
	{
		echo '<form action="" method="POST">';
		echo '<label>Current Password:</label>';
		echo '<input type="password" name="currentpassword" class="form-control">';
		echo '<label>New Password:</label>';
		echo '<input type="password" name="password" class="form-control">';
		echo '<label>Confirm Password:</label>';
		echo '<input type="password" name="confirmpassword" class="form-control">';
		echo '<input type="Submit" name="Update" value="Update" class="btn btn-block btn-lg btn-primary">';
		echo '</form>';
	}	
}

function newDeveloperForm($developer)
{
	echo '<form action="" method="POST">';
	
	//If the form has already been submitted display the error, otherwise print out the form	
	if(isset($_POST['submit']))
	{
		if(verifyUsername($_POST['username']))
			echo '<label>Username:</label>';
		else
			echo '<label style="color:red;">Username must be at least 3 characters</label>';

		echo '<input type="text" name="username" class="form-control" value="' . $_POST['username'] . '">';
		
		if(verifyEmail($_POST['email']))
			echo '<label>Email:</label>';
		else
			echo '<label style="color:red;">Enter a valid email address</label>';
		
		echo '<input type="text" name="email" class="form-control" value="' . $_POST['email'] . '">';
		
		if(verifyPassword($_POST['password']))
			echo '<label>Password:</label>';
		else
			echo '<label style="color:red;">Password must be at least 5 characters</label>';
		
		echo '<input type="password" name="password" class="form-control">';

		echo '<input type="hidden" name="position" value="Developer">';
		echo '<input type="submit" name="submit" value="Create Developer" class="btn btn-block btn-lg btn-primary">';
	}
	else
	{
		echo '<label>Username:</label>';
		echo '<input type="text" name="username" class="form-control">';
		echo '<label>Email:</label>';
		echo '<input type="text" name="email" class="form-control">';
		echo '<label>Password:</label>';
		echo '<input type="password" name="password" class="form-control">';
		echo '<input type="hidden" name="position" value="Developer">';
		echo '<input type="submit" name="submit" value="Create Developer" class="btn btn-block btn-lg btn-primary">';	
	}

	echo '</form>';
}

function newProjectForm($developer)
{
	echo '<form action="" method="POST">';
	clientDropDownJSenableButton($developer);
	echo '<input type="text" class="form-control" name="project" value="Project Name" id="projectName" onfocus="clearField(\'projectName\')" onblur="blurField(\'projectName\', \'Project Name\')">';
	echo '<textarea rows=4 name="description" value="Description" id="description" class="form-control" onfocus="clearField(\'description\')" onblur="blurField(\'description\', \'Description\')">' . 'Description' . '</textarea>';
	echo '<input type="submit" value="Create Project" id="submit_button" class="btn btn-block btn-lg btn-primary" disabled>';
	echo '</form>';
}

function verifyEmail($email)
{
	if(strpos($email, '@') !== false && strpos($email, '.') !== false && strlen($email) > 4)
		return true;
	else 
		return false;
}

function verifyUsername($username)
{
	if(strlen($username) > 2)
		return true;
	else 
		return false;
}

function verifyPassword($password)
{
	if(strlen($password) > 4)
		return true;
	else
		return false;
}

function verifyCurrentPassword($username, $password)
{
	if(isset($username) && isset($password)) 
	{
		$token=hash('ripemd128',$password);			
		$result = db_query("SELECT Password FROM Credentials WHERE Username='$username'");	
		$rows=mysqli_num_rows($result);
				
		for($i=0; $i<$rows; $i++) 
		{					
			$row=mysqli_fetch_row($result);

			foreach($row as $element) 
			{			
				if($token==$element) 
				{
					return true;
				}
				else
					return false;
			}
		}
		if($rows==0)
			return false;
	}
}

//This function echos a form to create a new Client and calls the createClient method which stores the info in the database.
function newClientForm($developer)
{
	echo '<form id="developer_form" action="" method="POST">';
	echo '<br>';
	echo '<label>Client Name:</label>';
	echo '<br>';
	echo '<input type="text" class="form-control" id="clientName" name="clientname" value="Client Name" onfocus="clearField(\'clientName\')" onblur="blurField(\'clientName\', \'Client Name\')">';
	echo '<font color="red">' . $clientError . '</font>';
	echo '<br>';
	echo '<label>StartDate:</label>';
	echo '<br>';
	echo '<input type="date" class="form-control" name="startdate" value="' . date('Y-m-d') . '">';
	echo '<font color="red">' . $dateError . '</font>';
	echo '<input type="submit" name="Submit" value="Create Client" class="btn btn-block btn-lg btn-primary">';
	echo '<br>';
	echo '</form>';
}

function newTaskForm($developer)
{
	jsFunctions();
	echo '<form action="" method="POST">';
	echo "<h2>Select a Client</h2>";
	clientDropDownJS($developer);
	projectDropDownJSenableButton();
	echo '<input type="text" class="form-control" name="task" value="Task Name" id="taskName" onfocus="clearField(\'taskName\')" onblur="blurField(\'taskName\',\'Client Name\')">';
	echo '<input type="textarea" class="form-control" name="description" value="Description" id="description" onfocus="clearField(\'description\')" onblur="blurField(\'description\', \'Description\')">';
	echo '<input type="submit" name="Create Task" id="submit_button" class="btn btn-block btn-lg btn-primary"  disabled>';
	echo"</form>";
}

function formExportToExcel($client, $report, $startdate, $enddate)
{
	echo '<div class="col-sm-4"></div>';
	echo '<form action="" method="POST" class="col-sm-4 excel">';
	echo '<input type="submit" name="toExcel" value="Export to Excel" class="btn btn-info btn-xs">';
	echo '<input type="hidden" name="selected" value="' . $client . '">';
	echo '<input type="hidden" name="report" value="' . $report . '">';
	echo '<input type="hidden" name="startdate" value="' . $startdate . '">';
	echo '<input type="hidden" name="enddate" value="' . $enddate . '">';
	echo '</form>';
}

//Convert Seconds to Formatted Time
function secondsToFormattedTime($unformatted_seconds)
{
	$hours = (int)( $unformatted_seconds / 3600 ); 
	$minutes = (int)( ($unformatted_seconds % 3600) / 60 );
	$seconds = (int)( ($unformatted_seconds % 3600) % 60 );

	//Format time 
	$hours = strlen($hours) == 1 ? '0' . $hours : $hours;
	$minutes = strlen($minutes) == 1 ? '0' . $minutes : $minutes;
	$seconds = strlen($seconds) == 1 ? '0' . $seconds : $seconds;
	return $hours . ':' . $minutes . ':' . $seconds;
}

?>
