<?php
$host = 'localhost';
$username = 'System';
$password = 'system';
$database = 'clientdevelopmentmanagement_database';

//$con = mysqli_connect($host, $username, $password, $database);
$con = mysqli_connect("localhost", "root", "root", "clientdevelopmentmanagement_database");

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
