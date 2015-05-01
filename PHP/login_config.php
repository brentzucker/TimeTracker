<?php
/*
 Name: login_config.php
 Description: connects to the database
 Programmers: Brent Zucker
 Dates: (4/30/15, 5/1/15)
 Names of files accessed:
 Names of files changed:
 Input:
 Output: text if failed to connect
 Error Handling: checks to make sure it can connect to the database
 Modification List:
 4/30/15-Moved file to PHP folder, fixed include links
 */

$host = 'localhost';
$username = 'System';
$password = 'system';
$database = 'ClientDevelopmentManagement_Database';

//$con = mysqli_connect($host, $username, $password, $database);
$con = mysqli_connect("localhost", "root", "root", "ClientDevelopmentManagement_Database");

//Check connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else 
{
	//echo "connected";
}

function getConnection()
{
	global $con;
	return $con;
}
?>