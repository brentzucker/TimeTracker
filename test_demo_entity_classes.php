<?php
require_once 'Contact.php';
require_once 'Time.php';
require_once 'Developer.php';
require_once 'Database.php';

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

function testTime()
{
	echo '<br><br>';
	echo '<div style="text-align:center;width:50%;margin-left:25%;">';
	echo '<h3>Time</h3>';
	
	//YYYY-MM-DD HH-MM-SS
	$TimeLog = new Time('2015-03-02 17:00:00', '2015-03-02 17:40:00');

	//Stores results in $TimeLog->Info['TimeLogged'];
	$TimeLog->calculateTimeLogged();

	echo "The time In: ". $TimeLog->getTimeIn() . "<br>";
	echo "The time Out: ". $TimeLog->getTimeOut() . "<br>";
	echo "The time Logged: ". $TimeLog->getTimeLogged() . "<br>";

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

	echo "<br><h5>Update Firstname and Lastname</h5>";
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

//testContact();
//testTime();
testDeveloper();
?>