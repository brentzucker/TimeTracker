<?php
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