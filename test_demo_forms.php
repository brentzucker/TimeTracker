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

function loadData()
{
	echo '<h1>Loading Information to Database</h1>';
	
	//Create Developer
	createEmployee('SE', 'b.zucker', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');

	//Create Client
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');
	createClient('CocaCola', '2003-06-05', 'Muhtar', 'Kent', '7704044789', 'muhtar@coke.com', 'Beverage St.', 'Atlanta', 'GA');
	createClient('Home Depot', '1983-01-20', 'Arthur', 'Blank', '4044049111', 'arthur@homedepot.com', 'Atlanta St.', 'Atlanta', 'GA');

	//Create Project
	$p_id1 = newProjects('The Business', 'Loaded Project', 'This project was stored in the database before the Client object was created.');
	$p_id2 = newProjects('Home Depot', 'Orange App', 'This project was stored in the database before the Client object was created.');
	$p_id3 = newProjects('Home Depot', 'Store Locator', 'This project was stored in the database before the Client object was created.');
	$p_id4 = newProjects('CocaCola', 'Sprite Website', 'This project was stored in the database before the Client object was created.');

	//Create Task
	$t_id = newTasks('The Business', $p_id1, 'Loaded Task', 'This task was stored in the databse before the Client object was created.');

	//Create Assignments
	newDeveloperAssignments('b.zucker', 'The Business', 'Client');
	newDeveloperAssignments('b.zucker', 'CocaCola', 'Client');
	newDeveloperAssignments('b.zucker', 'Home Depot', 'Client');
	newDeveloperAssignments('b.zucker', $p_id1, 'Project');
	newDeveloperAssignments('b.zucker', $p_id2, 'Project');
	newDeveloperAssignments('b.zucker', $p_id3, 'Project');
	newDeveloperAssignments('b.zucker', $p_id4, 'Project');
	newDeveloperAssignments('b.zucker', $t_id, 'Task');
}

function deleteData()
{
	removeDeveloperAssignments($t_id, 'Task');
	removeDeveloperAssignments($p_id4, 'Project');
	removeDeveloperAssignments($p_id3, 'Project');
	removeDeveloperAssignments($p_id2, 'Project');
	removeDeveloperAssignments($p_id1, 'Project');
	removeDeveloperAssignments('Home Depot', 'Client');
	removeDeveloperAssignments('CocaCola', 'Client');
	removeDeveloperAssignments('The Business', 'Client');
	removeTasks('The Business', 'Loaded Project', 'Loaded Task');
	removeProjects('The Business', 'Loaded Project');
	deleteClient('Home Depot');
	deleteClient('CocaCola');
	deleteClient('The Business');
	deleteEmployee('b.zucker');
}

function testDeveloperClockInForm()
{
	echo '<h1>Loading Information to Database</h1>';
	
	//Create Developer
	createEmployee('SE', 'b.zucker', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');

	//Create Client
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');
	createClient('CocaCola', '2003-06-05', 'Muhtar', 'Kent', '7704044789', 'muhtar@coke.com', 'Beverage St.', 'Atlanta', 'GA');
	createClient('Home Depot', '1983-01-20', 'Arthur', 'Blank', '4044049111', 'arthur@homedepot.com', 'Atlanta St.', 'Atlanta', 'GA');

	//Create Project
	$p_id1 = newProjects('The Business', 'Loaded Project', 'This project was stored in the database before the Client object was created.');
	$p_id2 = newProjects('Home Depot', 'Orange App', 'This project was stored in the database before the Client object was created.');
	$p_id3 = newProjects('Home Depot', 'Store Locator', 'This project was stored in the database before the Client object was created.');
	$p_id4 = newProjects('CocaCola', 'Sprite Website', 'This project was stored in the database before the Client object was created.');

	//Create Task
	$t_id = newTasks('The Business', $p_id1, 'Loaded Task', 'This task was stored in the databse before the Client object was created.');

	//Create Assignments
	newDeveloperAssignments('b.zucker', 'The Business', 'Client');
	newDeveloperAssignments('b.zucker', 'CocaCola', 'Client');
	newDeveloperAssignments('b.zucker', 'Home Depot', 'Client');
	newDeveloperAssignments('b.zucker', $p_id1, 'Project');
	newDeveloperAssignments('b.zucker', $p_id2, 'Project');
	newDeveloperAssignments('b.zucker', $p_id3, 'Project');
	newDeveloperAssignments('b.zucker', $p_id4, 'Project');
	newDeveloperAssignments('b.zucker', $t_id, 'Task');

	test("SELECT * FROM DeveloperAssignments");

	$Developer_Demo = new Developer('b.zucker');

	form($Developer_Demo);

	removeDeveloperAssignments($t_id, 'Task');
	removeDeveloperAssignments($p_id4, 'Project');
	removeDeveloperAssignments($p_id3, 'Project');
	removeDeveloperAssignments($p_id2, 'Project');
	removeDeveloperAssignments($p_id1, 'Project');
	removeDeveloperAssignments('Home Depot', 'Client');
	removeDeveloperAssignments('CocaCola', 'Client');
	removeDeveloperAssignments('The Business', 'Client');
	removeTasks('The Business', 'Loaded Project', 'Loaded Task');
	removeProjects('The Business', 'Loaded Project');
	deleteClient('Home Depot');
	deleteClient('CocaCola');
	deleteClient('The Business');
	deleteEmployee('b.zucker');
}

function form($Developer)
{
	echo '<form>';

	echo 'Select a Client:<br>';
	echo '<select name="Client_Selected">';

	foreach($Developer->getClientList() as $client)
		echo '<option value="' . $client->getClientname() . '">' . $client->getClientname() . '</option>';

	echo '</select>';

	echo '<select name="Project_Selected">';

	foreach($Developer->getProjectList() as $project)
		echo '<option value="' . $project->getProjectName() . '">' . $project->getProjectName() . '</option>';

	echo '</select>';

	echo '<select name="Task_Selected">';

	foreach($Developer->getTaskList() as $task)
		echo '<option value="' . $task->getTaskName() . '">' . $task->getTaskName() . '</option>';

	echo '</select>';

	echo '</form>';
}

testDeveloperClockInForm();

echo 'done';
?>