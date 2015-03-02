<?php
require_once 'login_config.php';

/* The following functions can be called to replace redundant tasks.
 *
 */

function db_query($query)
{
	return mysqli_query(getConnection(), $query);
}

/* The following functions perform higher-level operations on the database that require multiple tables.
 *
 */

function createEmployee($team, $username, $position, $password, $firstname, $lastname, $phone, $email, $address, $city, $state)
{
	newDeveloper($team, $username, $position);
	newCredentials($username, $password);
	newContact($username, $firstname, $lastname, $phone, $email, $address, $city, $state);
}

function deleteEmployee($username)
{
	removeCredentials($username);
	removeContact($username);
	removeDeveloper($username);
}

function createClient($ClientName, $StartDate, $Firstname, $Lastname, $Phone, $Email, $Address, $City, $State)
{
	newClient($ClientName, $StartDate);
	newClientContact($ClientName, $Firstname, $Lastname, $Phone, $Email, $Address, $City, $State);
}

function deleteClient($ClientName)
{
	removeClientContact($ClientName);
	removeClient($ClientName);
}

function createClientPurchase($ClientName, $HoursPurchased, $PurchaseDate)
{
	newClientPurchases($ClientName, $HoursPurchased, $PurchaseDate);
}

function deleteClientPurchase($ClientName)
{
	removeClientPurchases($ClientName);
}
/* The following functions directly query the database. 
 *
 */

function newDeveloper($team, $username, $position)
{
	$sql = "INSERT INTO Developer(Team, Username, Position) VALUES ('$team','$username', '$position')";
	db_query($sql);
}

function removeDeveloper($username)
{
	$sql = "DELETE FROM Developer WHERE Username='$username'";
	db_query($sql);
}

function newCredentials($username, $password)
{
	$sql = "INSERT INTO Credentials(Username, Password) VALUES ('$username', '$password')";
	db_query($sql);
}

function removeCredentials($username)
{
	$sql = "DELETE FROM Credentials WHERE Username='$username'";
	db_query($sql);
}

function newContact($username, $firstname, $lastname, $phone, $email, $address, $city, $state)
{
	$sql = "INSERT INTO Contact(Username, Firstname, Lastname, Phone, Email, Address, City, State) VALUES ('$username', '$firstname', '$lastname', '$phone', '$email', '$address', '$city', '$state')";
	db_query($sql);
}

function removeContact($username)
{
	$sql = "DELETE FROM Contact WHERE Username='$username'";
	db_query($sql);
}

function newClient($ClientName, $StartDate)
{
	$sql = "INSERT INTO Client(ClientName, StartDate) VALUES ('$ClientName', '$StartDate')";
	db_query($sql);
}

function removeClient($ClientName)
{
	$sql = "DELETE FROM Client WHERE ClientName='$ClientName'";
	db_query($sql);
}

function newClientContact($ClientName, $Firstname, $Lastname, $Phone, $Email, $Address, $City, $State)
{
	$sql = "INSERT INTO ClientContact(ClientName, Firstname, Lastname, Phone, Email, Address, City, State) VALUES ('$ClientName', '$Firstname', '$Lastname', '$Phone', '$Email', '$Address', '$City', '$State')";
	db_query($sql);
}

function removeClientContact($ClientName)
{
	$sql = "DELETE FROM ClientContact WHERE ClientName='$ClientName'";
	db_query($sql);
}

function newClientPurchases($ClientName, $HoursPurchased, $PurchaseDate)
{
	$sql = "INSERT INTO ClientPurchases(ClientName, HoursPurchased, PurchaseDate) VALUES ('$ClientName', '$HoursPurchased', '$PurchaseDate')";
	db_query($sql);
}

function removeClientPurchases($ClientName)
{
	$sql = "DELETE FROM ClientPurchases WHERE ClientName='$ClientName'";
	db_query($sql);
}

function newProjects($ProjectID, $ClientName, $ProjectName, $Description)
{
	$sql = "INSERT INTO Projects(ProjectID, ClientName, ProjectName, Description) VALUES ('$ProjectID', '$ClientName', '$ProjectName', '$Description')";
	db_query($sql);
}

function newTasks($TaskID, $ClientName, $ProjectID, $TaskName, $Description)
{
	$sql = "INSERT INTO Tasks(TaskID, ClientName, ProjectID, TaskName, Description) VALUES ('$TaskID', '$ClientName', '$ProjectID', '$TaskName', '$Description')";
	db_query($sql);
}

function newTimeSheet($TimeLogID, $Username, $ClientName, $ProjectID, $TaskID, $TimeIn, $TimeOut)
{
	$sql = "INSERT INTO TimeSheet(TimeLogID, Username, ClientName, ProjectID, TaskID, TimeIn, TimeOut) VALUES ('$TimeLogID', '$Username', '$ClientName', $'ProjectID', '$TaskID', '$TimeIn', '$TimeOut')";
	db_query($sql);
}
?>