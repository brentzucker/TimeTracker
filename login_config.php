<!--
Name: login_config.php
Description: connects to the database
Programmers: Brent Zucker, Delaney Rhodes, Tyler Land, Ryan Graessle
Dates: (2/28/15, 
Names of files accessed:
Names of files changed:
Input: 
Output: text
Error Handling: checks to make sure the connection works
Modification List: 
2/28/15-Initial code up
3/2/15-Changed the database name
3/6/15-Updates on the same page
-->

<?php
$host = 'localhost';
$username = 'System';
$password = 'system';
$database = 'clientdevelopmentmanagement_database';

//$con = mysqli_connect($host, $username, $password, $database);
$con = mysqli_connect("localhost", "root", "", "clientdevelopmentmanagement_database");

//checks connection
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
