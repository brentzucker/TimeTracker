<?php
require_once 'Database.php';

/* Testing Functions to print database functions
 *
 */

function test($query)
{
	echo '<table style="border:1px solid black; text-align:center; width:50%; margin-left:25%;">';
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

function testEmployee()
{
	createEmployee('SE', 'b.zucker', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');
	createEmployee('SE', 'd.rhodes', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');
	createEmployee('SE', 't.land', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');
	createEmployee('SE', 'm.graessle', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');

	echo "<h3>Developers</h3>";
	test("SELECT * 
	FROM Developer 
	LEFT JOIN Contact 
	ON Developer.Username = Contact.Username
	LEFT JOIN Credentials 
	ON Developer.Username = Credentials.Username
	");

	deleteEmployee("b.zucker");
	deleteEmployee("d.rhodes");
	deleteEmployee("t.land");
	deleteEmployee("m.graessle");

	test("SELECT * 
	FROM Developer 
	LEFT JOIN Contact 
	ON Developer.Username = Contact.Username
	LEFT JOIN Credentials 
	ON Developer.Username = Credentials.Username
	");
}

function testClient()
{
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');
	
	echo "<h3>Client Info</h3>";
	test("SELECT ClientContact.*, StartDate FROM Client, ClientContact WHERE (Client.clientname=ClientContact.clientname)");
	
	createClientPurchase('The Business','0000-00-00 10-30-00', '2015-02-14');

	echo "<h3>Client Purchases</h3>";
	test("SELECT * FROM ClientPurchases");

	echo "<h3>Client Info With Purchases</h3>";
	test("SELECT ClientContact.*, StartDate, PurchaseID, HoursPurchased, PurchaseDate FROM Client, ClientContact, ClientPurchases WHERE (Client.clientname=ClientContact.clientname) AND (Client.clientname=ClientPurchases.clientname)");
	
	deleteClientPurchase('The Business');
	test("SELECT * FROM ClientPurchases");

	deleteClient('The Business');
	test("SELECT * FROM Client c, ClientPurchases cp, ClientContact cc WHERE (c.ClientName=cp.ClientName)");	
}

function testProject()
{	
	//Create client to associate with Project
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');
	createProject('The Business', 'Build Website', 'Build a website for the Business.');
	createProject('The Business', 'Fix CSS', 'Restyle the website');

	createClient('Mountain Dew', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');
	createProject('Mountain Dew', 'Make App', 'Build an app for Mountain Dew.');

	echo "<h3>Projects</h3>";
	test("SELECT * FROM Projects");

	deleteProject('Mountain Dew', 'Make App');
	deleteProject('The Business', 'Fix CSS');
	deleteProject('The Business', 'Build Website');
	deleteClient('The Business');
	deleteClient('Mountain Dew');
	test("SELECT * FROM Projects");
}

function testTasks()
{
	//Create client to assign task
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');

	//Create Project to assign task
	createProject('The Business', 'Build Website', 'Build a website for the Business.');
	createProject('The Business', 'Fix CSS', 'Restyle the website');

	//Create Tasks
	createTask('The Business', 'Build Website', 'Start the Project', 'This is the first task for Build Website.');
	createTask('The Business', 'Build Website', 'Register domain name', 'Reserach webservices and make a good url');
	createTask('The Business', 'Fix CSS', 'Start the Project', 'Dont be lazy');

	echo "<h3>Tasks</h3>";
	test("SELECT TaskID, Tasks.ClientName, ProjectName, TaskName, Tasks.Description FROM Tasks, Projects WHERE Projects.ProjectID=Tasks.ProjectID");

	deleteTask('The Business', 'Build Website', 'Start the Project');
	deleteTask('The Business', 'Build Website', 'Register domain name');
	deleteTask('The Business', 'Fix CSS', 'Start the Project');

	deleteProject('The Business', 'Fix CSS');
	deleteProject('The Business', 'Build Website');
	
	deleteClient('The Business');
}

function testTimeSheet()
{
	//Create client to assign task
	createClient('The Business', '1993-06-20', 'LeRoy', 'Jenkins', '1234567890', 'leeroy@gmail.com', 'The streets', 'Las Vegas', 'NV');

	//Create Project to assign task
	createProject('The Business', 'Build Website', 'Build a website for the Business.');
	createProject('The Business', 'Fix CSS', 'Restyle the website');

	//Create Tasks
	createTask('The Business', 'Build Website', 'Start the Project', 'This is the first task for Build Website.');
	createTask('The Business', 'Build Website', 'Register domain name', 'Reserach webservices and make a good url');
	createTask('The Business', 'Fix CSS', 'Start the Project', 'Dont be lazy');

	//Create Developer to record time
	createEmployee('SE', 'b.zucker', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');

	//Create TimeSheet Entry
	createTimeSheet('b.zucker', 'The Business', 'Build Website', 'Start the Project', '2015-03-02 10-30-00', '2015-03-02 15-30-00');
	
	echo "<h3>TimeSheet</h3>";
	test("SELECT * FROM TimeSheet");

	deleteTimeSheet('b.zucker', 'The Business', 'Build Website', 'Start the Project', '2015-03-02 10-30-00', '2015-03-02 15-30-00');

	deleteTask('The Business', 'Build Website', 'Start the Project');
	deleteTask('The Business', 'Build Website', 'Register domain name');
	deleteTask('The Business', 'Fix CSS', 'Start the Project');

	deleteProject('The Business', 'Fix CSS');
	deleteProject('The Business', 'Build Website');
	
	deleteClient('The Business');

	deleteEmployee('b.zucker');
}

/* Call Operations to test Database
 *
 */

testEmployee();
testClient();
testProject();
testTasks();
testTimeSheet();
echo 'done';

?>