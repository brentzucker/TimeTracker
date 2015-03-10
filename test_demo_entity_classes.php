<?php
require_once 'config_loader.php';

function test($query)
{
	echo '<table style="border:1px solid black; text-align:center; width:80%; margin-left:25%;">';
	if($result = db_query($query))
	{
		while($row = mysqli_fetch_row($result))
		{
			echo '<tr>';
			foreach($row as $r)
				echo "<td style=\"border:1px solid black;\">$r</td>";
			echo '</tr>';
		}
	}
	mysqli_free_result($result);
	echo '</table>';
}

function testContact()
{
	echo '<div style="text-align:center;width:50%;margin-left:25%;">';
	echo '<h3>Contact</h3>';
	$ContactInfo  = new Contact("Brent", "Zucker", "1234567890", "bz@gmail.com", "Columbia St", "Milledgeville", "GA");

	$arr = $ContactInfo->getInfo();

	foreach ($arr as $a)
		echo "$a<br>";

	$ContactInfo->setFirstname("Max");

	echo " ".$ContactInfo->getFirstname();
	echo '</div>';
}

function testDeveloper()
{
	createEmployee('SE', 'b.zucker', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');

	echo "<h3>Creating Developer: b.zucker</h3>";

	$Developer_Demo = new Developer("b.zucker");

	$Developer_Info = $Developer_Demo->getInfo();
	
	foreach($Developer_Info as $k=>$d)
		echo "$k => $d<br>";

	echo "<br><h5>Update Developer's Firstname and Lastname</h5>";
	//Update Contact Object
	$Developer_Demo->getContact()->setFirstname("Max");
	$Developer_Demo->getContact()->setLastname("Graessle");

	//Print updated developer
	foreach($Developer_Demo->getInfo() as $k=>$d)
		echo "$k => $d<br>";

	test("SELECT * FROM Contact");

	deleteEmployee('b.zucker');

	echo "done";
}

function testClient()
{
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');

	echo "<h3>Creating Client: The Business</h3>";

	$Client_Demo = new Client("The Business");
	
	$Client_Info = $Client_Demo->getInfo();
	
	foreach($Client_Info as $k=>$d)
		echo "$k => $d<br>";

	echo "<br><h5>Update Client's Firstname and Lastname</h5>";
	//Update Contact Object
	$Client_Demo->getContact()->setFirstname("Max");
	$Client_Demo->getContact()->setLastname("Graessle");

	test("SELECT * FROM ClientContact");

	//Test ClientPurchase
	echo "<h4>Testing ClientPurchase</h4>";

	createClientPurchase('The Business','36000', '2015-02-14');
	createClientPurchase('The Business','360000', '2015-03-04');

	test("SELECT * FROM ClientPurchases");

	$client_purchase_rows = returnRowsByClient('ClientPurchases', 'The Business');

	foreach($client_purchase_rows as $row)
	{
		$Client_Demo->PurchaseHours($row['PurchaseID'], $row['HoursPurchased'], $row['PurchaseDate']);
	}

	$Client_Demo->calculateTotalPurchasedHours();

	echo "Purchased Hours" . $Client_Demo->getPurchasedHours();

	deleteClientPurchase('The Business');

	deleteClient('The Business');
}

function testDeveloperAndClient()
{
	//Create Developer
	createEmployee('SE', 'b.zucker', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');
	$Developer_Demo = new Developer("b.zucker");

	//Create Clients
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');
	$Client_Demo = new Client("The Business");
	createClient('Codec', '1993-06-20', 'Caroline', 'Collier', '1234567890', 'collier@gcsu.edu', 'The streets', 'Milledgeville', 'GA');
	$Client_Demo2 = new Client("Codec");

	echo "<h3>Assigning Client to Developer</h3>";

	//Assign Client to Developer
	$Developer_Demo->assignClient($Client_Demo);
	$Developer_Demo->assignClient($Client_Demo2);

	//View the Developers client list
	$Developer_Demo_Client_List = $Developer_Demo->getClientList();

	echo $Developer_Demo->getUsername() . "'s Clients: <br>";

	foreach($Developer_Demo_Client_List as $ddcl)
		echo $ddcl->getClientname() . "<br>";

	deleteClient('Codec');
	deleteClient('The Business');

	deleteEmployee('b.zucker');
}

function testProjects()
{
	echo "<h3>Testing Projects</h3>";
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');
  
	$project_demo = new Projects('The Business', 'First Project', 'This is the first project.');

	echo print_r($project_demo->getInfo());

	echo "<h6>change project name</h6>";

	$project_demo->setProjectName('Maxs Project');

	echo print_r($project_demo->getInfo());

	test("SELECT * FROM Projects");

	removeProjects('The Business', 'Maxs Project');
	deleteClient('The Business');
}

function testClientAndProjects()
{
	echo "<h3>Creating new Project for Client</h3>";
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');
	
	$Client_Demo = new Client("The Business");

	$Client_Demo->newProject('Second Project', 'Creating this project for the business');

	$Project = new Projects('The Business', 'Third Project Project', 'This is the third project.');

	$Client_Demo->addProject($Project);

	echo $Client_Demo->getClientname() . "'s Projects: <br>";

	$projects = $Client_Demo->getProjects();

	foreach($projects as $p)
		echo $p->getProjectName() . "<br>";

	test("SELECT * FROM Projects");

	removeProjects('The Business', 'Third Project Project');
	removeProjects('The Business', 'Second Project');
	deleteClient('The Business');
}

function testDeveloperAndProjects()
{
	echo "<h3>Assigning Projects to Developers and Clients</h3>";
	createEmployee('SE', 'b.zucker', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');
	$Developer_Demo = new Developer("b.zucker");

	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');
	$Client_Demo = new Client("The Business");

	$Client_Demo->newProject('Second Project', 'Creating this project for the business');

	//Assign Projects to developer
	$project = $Client_Demo->getProjectByName('Second Project');

	$Developer_Demo->assignProject($project);
	
	echo $Developer_Demo->getUsername() . "'s Projects<br>";
	
	$project_list = $Developer_Demo->getProjectList();

	foreach($project_list as $p)
		echo $p->getProjectName() . "<br>";

	removeProjects('The Business', 'Second Project');
	deleteClient('The Business');
	deleteEmployee('b.zucker');
}

function testTasks()
{
	echo "<h3>Testing Tasks</h3>";
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');
  	$Client_Demo = new Client("The Business");

	$project_demo = new Projects($Client_Demo->getClientname(), 'First Project', 'This is the first project.');
	$project_id = $project_demo->getProjectID();

	//Create Task
	$task_demo = new Tasks($Client_Demo->getClientname(), $project_demo->getProjectID(), 'First Task', 'This is the first task.');
	
	$task_demo->setDescription("I just changed the description");
	print_r($task_demo->getInfo());

	test("SELECT * FROM Tasks");

	removeTasks('The Business', 'First Project', 'First Task');
	removeProjects('The Business', 'First Project');
	deleteClient('The Business');
}

function testTasksAssignments()
{
	echo "<h3>Testing Task Assignments</h3>";
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');
  	$Client_Demo = new Client("The Business");

	$project_demo = new Projects($Client_Demo->getClientname(), 'First Project', 'This is the first project.');
	$project_id = $project_demo->getProjectID();

	//Create Task
	$task_demo = new Tasks($Client_Demo->getClientname(), $project_demo->getProjectID(), 'First Task', 'This is the first task.');
	
	//Assign Task to Developer
	createEmployee('SE', 'b.zucker', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');
	$Developer_Demo = new Developer("b.zucker");

	$Developer_Demo->assignTask($task_demo);

	test("SELECT * FROM DeveloperAssignments");

	removeDeveloperAssignments($project_demo->getClientname(), 'Client');
	removeDeveloperAssignments($project_demo->getProjectID(), 'Project');
	removeDeveloperAssignments($task_demo->getTaskID(), 'Task');
	removeTasks('The Business', 'First Project', 'First Task');
	removeProjects('The Business', 'First Project');
	deleteClient('The Business');
	deleteEmployee('b.zucker');
}

function testTimeSheet()
{

	//Create Client
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');
  	$Client_Demo = new Client("The Business");

  	//Create Project
	$project_demo = new Projects($Client_Demo->getClientname(), 'First Project', 'This is the first project.');
	$project_id = $project_demo->getProjectID();

	//Create Task
	$task_demo = new Tasks($Client_Demo->getClientname(), $project_demo->getProjectID(), 'First Task', 'This is the first task.');
	
	//Assign Task to Developer
	createEmployee('SE', 'b.zucker', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');
	$Developer_Demo = new Developer("b.zucker");

	echo '<br><br>';
	echo '<div style="text-align:center;width:80%;margin-left:10%;">';
	echo '<h3>Time</h3>';
	
	
	//YYYY-MM-DD HH-MM-SS
	$t1_id = newTimeSheet($Developer_Demo->getUsername(), $Client_Demo->getClientname(), $project_demo->getProjectID(), $task_demo->getTaskID(), '2015-03-09 10:00:00', '0000-00-00 00:00:00', 0);
	$t2_id = newTimeSheet($Developer_Demo->getUsername(), $Client_Demo->getClientname(), $project_demo->getProjectID(), $task_demo->getTaskID(), '2015-03-05 17:00:00', '2015-03-05 17:40:00', 0);
	$t3_id = newTimeSheet($Developer_Demo->getUsername(), $Client_Demo->getClientname(), $project_demo->getProjectID(), $task_demo->getTaskID(), '2015-03-09 17:00:00', '2015-03-09 17:40:00', 2400);

	test("SELECT * FROM TimeSheet");

	$t1 = new Time($t1_id);
	$t2 = new Time($t2_id);
	$t3 = new Time($t3_id);

	$current_time = date('Y-m-d H:i:s', time());
	$t1->setTimeStampOut($current_time);

	echo '<h3>Updated Table</h3>';
	test("SELECT * FROM TimeSheet");
	echo '</div>';

	removeTimeSheet($t1_id);
	removeTimeSheet($t2_id);
	removeTimeSheet($t3_id);
	
	removeTasks('The Business', 'First Project', 'First Task');
	removeProjects('The Business', 'First Project');
	deleteClient('The Business');
	deleteEmployee('b.zucker');
}

function testDeveloperClockIn()
{

	//Create Client
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');
  	$Client_Demo = new Client("The Business");

  	//Create Project
	$project_demo = new Projects($Client_Demo->getClientname(), 'First Project', 'This is the first project.');
	$project_id = $project_demo->getProjectID();

	//Create Task
	$task_demo = new Tasks($Client_Demo->getClientname(), $project_demo->getProjectID(), 'First Task', 'This is the first task.');
	
	//Assign Task to Developer
	createEmployee('SE', 'b.zucker', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');
	$Developer_Demo = new Developer("b.zucker");

	echo '<br><br>';
	echo '<div style="text-align:center;width:80%;margin-left:10%;">';
	echo '<h3>Test Developer ClockIn</h3>';
	
	
	//YYYY-MM-DD HH-MM-SS
	$Developer_Demo->clockIn($Client_Demo->getClientname(), $project_demo->getProjectID(), $task_demo->getTaskID());
	
	//This Clockin will do nothing because you are already clocked in
	$Developer_Demo->clockIn($Client_Demo->getClientname(), $project_demo->getProjectID(), $task_demo->getTaskID());

	test("SELECT * FROM TimeSheet");
	$t_id = $Developer_Demo->getCurrentTimeLog()->getTimeLogID();

	$Developer_Demo->clockOut();
	
	//Clockin again after you previously clocked out
	$Developer_Demo->clockIn($Client_Demo->getClientname(), $project_demo->getProjectID(), $task_demo->getTaskID());
	$t_id2 = $Developer_Demo->getCurrentTimeLog()->getTimeLogID();

	echo '<h3>Updated Table</h3>';
	test("SELECT * FROM TimeSheet");

	//Print all TimeLogs
	echo '<br>TimeLogs:';
	$logs = $Developer_Demo->getTimeLog();
	foreach($logs as $t)
	{
		echo "<br>";
		echo "<br>";
		print_r($t->getInfo());
	}
	echo '</div>';

	removeTimeSheet($t_id);
	removeTimeSheet($t_id2);
	removeTasks('The Business', 'First Project', 'First Task');
	removeProjects('The Business', 'First Project');
	deleteClient('The Business');
	deleteEmployee('b.zucker');
}

function testClientHoursLeft()
{
	//Create Client
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');
  	
	//Create Client Purchase
  	createClientPurchase('The Business','360000', '2015-03-04');
  	$Client_Demo = new Client("The Business");

  	$Client_Demo->PurchaseHours(3600, '2015-03-09');

  	echo $Client_Demo->getHoursLeft() . "<br>";

  	//Create Project
	$project_demo = new Projects($Client_Demo->getClientname(), 'First Project', 'This is the first project.');
	$project_id = $project_demo->getProjectID();

	//Create Task
	$task_demo = new Tasks($Client_Demo->getClientname(), $project_demo->getProjectID(), 'First Task', 'This is the first task.');
	
	//Assign Task to Developer
	createEmployee('SE', 'b.zucker', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');
	$Developer_Demo = new Developer("b.zucker");

	echo '<br><br>';
	echo '<div style="text-align:center;width:80%;margin-left:10%;">';
	echo '<h3>Subtract ClockIn Hours from Client</h3>';
	
	test("SELECT * FROM Client");

	$Developer_Demo->clockIn($Client_Demo->getClientname(), $project_demo->getProjectID(), $task_demo->getTaskID());

	$t_id = $Developer_Demo->getCurrentTimeLog()->getTimeLogID();
	
	//Takes 10 seconds to clock out
	for($i=0; $i<99999999; $i++)
		echo "";

	$Developer_Demo->clockOut();

	echo '<h3>Updated Table</h3>';
	test("SELECT * FROM TimeSheet");
	
	test("SELECT * FROM Client");

	echo '</div>';

	
  	echo "<br><br>" . $Client_Demo->getHoursLeft();

  	removeTimeSheet($t_id);
  	removeTasks('The Business', 'First Project', 'First Task');
	removeProjects('The Business', 'First Project');
  	deleteClientPurchase('The Business');
  	deleteClient('The Business');
  	deleteEmployee('b.zucker');
}

function testClientProjectLoads()
{
	echo '<h1>Loading Projects into Client</h1>';

	//Create Client
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');
	
	//Create Project
	createProject('The Business', 'Loaded Project', 'This project was stored in the database before the Client object was created.');

	$Client_Demo = new Client("The Business");
	print_r($Client_Demo->getProjects());

	removeProjects('The Business', 'Loaded Project');
	deleteClient('The Business');
}

//testContact();
//testDeveloper();
//testClient();
//testDeveloperAndClient();
//testProjects();
//testClientAndProjects();
//testDeveloperAndProjects();
//testTasks();
//testTasksAssignments();
//testTimeSheet();
//testDeveloperClockIn();
//testClientHoursLeft();
testClientProjectLoads();

echo "<br><br>done";
?>