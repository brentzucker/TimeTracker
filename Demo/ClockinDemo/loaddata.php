<?php
require_once(__DIR__.'/../../include.php');

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

loadData();

echo<<<END
<form action="login.php" method="POST">
<input type="submit" value="Log in">
</form>
END;


echo 'done';
?>