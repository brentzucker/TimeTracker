<?php
require_once 'Contact.php';
require_once 'Time.php';

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

testContact();
testTime();
?>