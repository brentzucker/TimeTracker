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

function createProject($ClientName, $ProjectName, $Description)
{
	newProjects($ClientName, $ProjectName, $Description);
}

function deleteProject($ClientName, $ProjectName, $Description)
{
	removeProjects($ClientName, $ProjectName);
}

function createTask($ClientName, $ProjectName, $TaskName, $Description)
{
	//Select the ProjectID to the corresponding ProjectName
	$ProjectID = returnProjectID($ClientName, $ProjectName);
	newTasks($ClientName, $ProjectID, $TaskName, $Description);
}

function deleteTask($ClientName, $ProjectName, $TaskName)
{
	removeTasks($ClientName, $ProjectName, $TaskName);
}

function createTimeSheet($Username, $ClientName, $ProjectName, $TaskName, $TimeIn, $TimeOut)
{
	$ProjectID = returnProjectID($ClientName, $ProjectName);
	$TaskID = returnTaskID($ClientName, $ProjectName, $TaskName);

	newTimeSheet($Username, $ClientName, $ProjectID, $TaskID, $TimeIn, $TimeOut);
}

function deleteTimeSheet($Username, $ClientName, $ProjectName, $TaskName, $TimeIn, $TimeOut)
{
	$ProjectID = returnProjectID($ClientName, $ProjectName);
	$TaskID = returnTaskID($ClientName, $ProjectName, $TaskName);

	removeTimeSheet($Username, $ClientName, $ProjectID, $TaskID, $TimeIn, $TimeOut);
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

function newProjects($ClientName, $ProjectName, $Description)
{
	$sql = "INSERT INTO Projects(ClientName, ProjectName, Description) VALUES ('$ClientName', '$ProjectName', '$Description')";
	db_query($sql);
	return mysqli_insert_id(getConnection());
}

function removeProjects($ClientName, $ProjectName)
{
	$sql = "DELETE FROM Projects WHERE ClientName='$ClientName' AND ProjectName='$ProjectName'";
	db_query($sql);
}

function newTasks($ClientName, $ProjectID, $TaskName, $Description)
{
	$sql = "INSERT INTO Tasks(ClientName, ProjectID, TaskName, Description) VALUES ('$ClientName', '$ProjectID', '$TaskName', '$Description')";
	db_query($sql);
}

function removeTasks($ClientName, $ProjectName, $TaskName)
{
	$ProjectID = returnProjectID($ClientName, $ProjectName);

	$sql = "DELETE FROM Tasks WHERE ClientName='$ClientName' AND ProjectID=$ProjectID AND TaskName='$TaskName'";
	db_query($sql);
}

function newTimeSheet($Username, $ClientName, $ProjectID, $TaskID, $TimeIn, $TimeOut)
{
	$sql = "INSERT INTO TimeSheet(Username, ClientName, ProjectID, TaskID, TimeIn, TimeOut) VALUES ('$Username', '$ClientName', '$ProjectID', '$TaskID', '$TimeIn', '$TimeOut')";
	db_query($sql);
}

function removeTimeSheet($Username, $ClientName, $ProjectID, $TaskID, $TimeIn, $TimeOut)
{
	$sql = "DELETE FROM TimeSheet WHERE Username='$Username' AND ClientName='$ClientName' AND ProjectID=$ProjectID AND TaskID=$TaskID AND TimeIn='$TimeIn' AND TimeOut='$TimeOut'";
	db_query($sql);
}

/* Returns a row for a Table.
 *
 */

function returnRow($Tablename, $WhereColumn, $WhereValue)
{
	//Returns Team, Username, Position
	$sql = "SELECT * FROM $Tablename WHERE $WhereColumn='$WhereValue'";
	$result = db_query($sql);

	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	mysqli_free_result($result);

	return $row;
}

function returnRowByUser($Tablename, $Username)
{
	//Returns Team, Username, Position
	return returnRow($Tablename, 'Username', $Username);
}

function returnRowByClient($Tablename, $Clientname)
{
	//Returns ClientName, StartDate
	return returnRow($Tablename, 'ClientName', $Clientname);;
}

/* Returns all rows for a Table.
 *
 */

function returnRows($Tablename, $WhereColumn, $WhereValue)
{
	//Returns Team, Username, Position
	$sql = "SELECT * FROM $Tablename WHERE $WhereColumn='$WhereValue'";
	$result = db_query($sql);

	$rows = array();
	
	while($row = $result->fetch_assoc())
		array_push($rows, $row);

	return $rows;
}

function returnRowsByUser($Tablename, $Username)
{
	//Returns Team, Username, Position
	return returnRows($Tablename, 'Username', $Username);
}

function returnRowsByClient($Tablename, $Clientname)
{
	//Returns ClientName, StartDate
	return returnRows($Tablename, 'ClientName', $Clientname);;
}

/* The following functions update the database.
 *
 */

function updateTable($TableName, $Column, $Value, $WhereColumn, $WhereValue)
{
	$sql = "Update $TableName SET $Column='$Value' WHERE $WhereColumn='$WhereValue'";
	db_query($sql);
}

function updateTableByUser($TableName, $Column, $Value, $Username)
{
	updateTable($TableName, $Column, $Value, 'Username', $Username);
}

function updateTableByClient($TableName, $Column, $Value, $Clientname)
{
	updateTable($TableName, $Column, $Value, 'ClientName', $Clientname);
}

/* Get Name from ID or get ID from Name functions. 
 *
 */

function returnProjectID($ClientName, $ProjectName)
{
	$sql = "SELECT ProjectID FROM Projects WHERE ProjectName='$ProjectName' AND ClientName='$ClientName'";
	$result = db_query($sql);

	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	mysqli_free_result($result);

	return "$row[ProjectID]";
}

function returnTaskID($ClientName, $ProjectName, $TaskName)
{
	$ProjectID = returnProjectID($ClientName, $ProjectName);

	$sql = "SELECT TaskID FROM Tasks WHERE TaskName='$TaskName' AND ProjectID='$ProjectID' AND ClientName='$ClientName'";
	$result = db_query($sql);

	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	mysqli_free_result($result);

	return "$row[TaskID]";
}

function returnProjectName($ProjectID)
{
	$sql = "SELECT ProjectName FROM Projects WHERE ProjectID='$ProjectID'";
	$result = db_query($sql);

	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	mysqli_free_result($result);

	return "$row[ProjectName]";
}

function returnTaskName($TaskID)
{
	$sql = "SELECT TaskName FROM Tasks WHERE TaskID='$TaskID'";
	$result = db_query($sql);

	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	mysqli_free_result($result);

	return "$row[TaskName]";
}
?>