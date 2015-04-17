<?php
require_once(__DIR__.'/../include.php');

//Sets Default timezone.
date_default_timezone_set('America/New_York');

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
	newAlert($username);
}

function deleteEmployee($username)
{
	removeAlert($username);
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

function editClientContact($ClientName, $Firstname, $Lastname, $Phone, $Email, $Address, $City, $State)
{
	$sql = "UPDATE clientcontact SET Firstname='$Firstname', Lastname='$Lastname', Phone='$Phone', Email='$Email',
	Address='$Address', City='$City', State='$State' WHERE ClientName='$ClientName'";
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
	//Return PurchaseID
	return mysqli_insert_id(getConnection());
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
	//Returns ProjectID
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
	//Returns TaskID
	return mysqli_insert_id(getConnection());
}

function removeTasks($ClientName, $ProjectName, $TaskName)
{
	$ProjectID = returnProjectID($ClientName, $ProjectName);

	$sql = "DELETE FROM Tasks WHERE ClientName='$ClientName' AND ProjectID=$ProjectID AND TaskName='$TaskName'";
	db_query($sql);
}

function newTimeSheet($Username, $ClientName, $ProjectID, $TaskID, $TimeIn, $TimeOut, $TimeSpent)
{
	$sql = "INSERT INTO TimeSheet(Username, ClientName, ProjectID, TaskID, TimeIn, TimeOut, TimeSpent) VALUES ('$Username', '$ClientName', '$ProjectID', '$TaskID', '$TimeIn', '$TimeOut', $TimeSpent)";
	db_query($sql);
	//Returns TimeLogID
	return mysqli_insert_id(getConnection());
}

function removeTimeSheet($TimeLogID)
{
	$sql = "DELETE FROM TimeSheet WHERE TimeLogID=$TimeLogID";
	db_query($sql);
}

function newDeveloperAssignments($Username, $ClientProjectTask, $Type)
{
	//Assign to Team
	$Team = returnRowByUser('Developer', $Username)['Team'];
	newTeamAssignment($Team, $ClientProjectTask, $Type);

	//Only create the assignment if it doesn't exist
	if(count(returnRowsDeveloperAssignmentsUnique($Username, $Type, $ClientProjectTask)) == 0)
	{
		$sql = "INSERT INTO DeveloperAssignments(Username, ClientProjectTask, Type) VALUES ('$Username', '$ClientProjectTask', '$Type')";
		db_query($sql);
		return true;
	}
	return false;	
}

function removeDeveloperAssignments($Username, $ClientProjectTask, $Type)
{
	$sql = "DELETE FROM DeveloperAssignments WHERE Username='$Username' AND ClientProjectTask='$ClientProjectTask' AND Type='$Type'";
	db_query($sql);
}

function newAlert($Username)
{
	$sql = "INSERT INTO DeveloperAlerts(Username) VALUES ('$Username')";
	db_query($sql);
}

function removeAlert($Username)
{
	$sql = "DELETE FROM DeveloperAlerts WHERE Username='$Username'";
	db_query($sql);
}

function newTeamAssignment($Team, $ClientProjectTask, $Type)
{
	//Only create the assignment if it doesnt exist
	if(count(returnRowsTeamAssignmentsUnique($Team, $Type, $ClientProjectTask)) == 0)
	{
		$sql = "INSERT INTO TeamAssignments(Team, ClientProjectTask, Type) VALUES ('$Team', '$ClientProjectTask', '$Type')";
		db_query($sql);
		return true;
	}
	return false;
}

function removeTeamAssignment($Team, $ClientProjectTask, $Type)
{
	$sql = "DELETE FROM TeamAssignments WHERE Team='$Team' AND ClientProjectTask='$ClientProjectTask' AND Type='$Type'";
	db_query($sql);
}

/* Returns a row for a Table.
 *
 */

function returnRow($Tablename, $WhereColumn, $WhereValue)
{
	$sql = "SELECT * FROM $Tablename WHERE $WhereColumn='$WhereValue'";
	$result = db_query($sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	mysqli_free_result($result);

	return $row;
}

function returnRowByNumber($Tablename, $WhereColumn, $WhereValue)
{
	$sql = "SELECT * FROM $Tablename WHERE $WhereColumn=$WhereValue";
	$result = db_query($sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	mysqli_free_result($result);
	return $row;
}

function returnRowByUser($Tablename, $Username)
{
	return returnRow($Tablename, 'Username', $Username);
}

function returnRowByClient($Tablename, $Clientname)
{
	return returnRow($Tablename, 'ClientName', $Clientname);;
}

function returnRowByTimeLogID($TimeLogID)
{
	//Returns TimeLogID, Username, ClientName, ProjectID, TaskID, TimeIn, TimeOut, TimeSpent
	return returnRow('TimeSheet', 'TimeLogID', $TimeLogID);
}

function returnRowByPurchaseID($PurchaseID)
{	
	//Returns PurchaseID, ClientName, HoursPurchased, PurchaseDate
	return returnRow('ClientPurchases', 'PurchaseID', $PurchaseID);
}

function returnRowByProjectID($ProjectID)
{
	//Returns ProjectID, ClientName, ProjectName, Description
	return returnRow('Projects', 'ProjectID', $ProjectID);
}

function returnRowByTaskID($TaskID)
{
	//Returns TaskID, ClientName, ProjectID, TaskName, Description
	return returnRowByNumber('Tasks', 'TaskID', $TaskID);
}

/* Returns all rows for a Table based off one Where value.
 *
 */
function returnAllRows($Tablename)
{
	$sql = "SELECT * FROM $Tablename";
	$result = db_query($sql);
	$rows = array();
	
	while($row = $result->fetch_assoc())
		array_push($rows, $row);

	return $rows;
}

function returnRows($Tablename, $WhereColumn, $WhereValue)
{
	$sql = "SELECT * FROM $Tablename WHERE $WhereColumn='$WhereValue'";
	$result = db_query($sql);
	$rows = array();
	
	while($row = $result->fetch_assoc())
		array_push($rows, $row);

	return $rows;
}

function returnRowsByUser($Tablename, $Username)
{
	return returnRows($Tablename, 'Username', $Username);
}

function returnRowsByClient($Tablename, $Clientname)
{
	return returnRows($Tablename, 'ClientName', $Clientname);
}

function returnRowsByTimeLogID($TimeLogID)
{
	//Returns TimeLogID, Username, ClientName, ProjectID, TaskID, TimeIn, TimeOut, TimeSpent
	return returnRows('TimeSheet', 'TimeLogID', $TimeLogID);
}

function returnRowsByProjectID($ProjectID)
{
	//Returns TaskID, ClientName, ProjectID, TaskName, Description
	return returnRows('Tasks', 'ProjectID', $ProjectID);
}

function returnRowsByTeam($team)
{
	return returnRows('Developer', 'Team', $team);
}

function returnTeamAssignmentsByTeam($team)
{
	return returnRows('TeamAssignments', 'Team', $team);
}

/* Returns all rows for a Table based off one Where value.
 *
 */

function returnRowsForTwoValues($Tablename, $WhereColumn1, $WhereValue1, $WhereColumn2, $WhereValue2)
{
	//Returns Team, Username, Position
	$sql = "SELECT * FROM $Tablename WHERE $WhereColumn1='$WhereValue1' AND $WhereColumn2='$WhereValue2'";
	$result = db_query($sql);
	$rows = array();
	
	while($row = $result->fetch_assoc())
		array_push($rows, $row);
	return $rows;
}

function returnRowsForThreeValues($Tablename, $WhereColumn1, $WhereValue1, $WhereColumn2, $WhereValue2, $WhereColumn3, $WhereValue3)
{
	//Returns Team, Username, Position
	$sql = "SELECT * FROM $Tablename WHERE $WhereColumn1='$WhereValue1' AND $WhereColumn2='$WhereValue2' AND $WhereColumn3='$WhereValue3'";
	$result = db_query($sql);
	$rows = array();
	
	while($row = $result->fetch_assoc())
		array_push($rows, $row);
	return $rows;
}

function returnRowsDeveloperAssignments($WhereValue1, $WhereValue2)
{
	return returnRowsForTwoValues('DeveloperAssignments', 'Username', $WhereValue1, 'Type', $WhereValue2);
}

function returnRowsTeamAssignments($WhereValue1, $WhereValue2)
{
	return returnRowsForTwoValues('TeamAssignments', 'Team', $WhereValue1, 'Type', $WhereValue2);
}

function returnRowsDeveloperAssignmentsUnique($WhereValue1, $WhereValue2, $WhereValue3)
{
	return returnRowsForTwoValues('DeveloperAssignments', 'Username', $WhereValue1, 'Type', $WhereValue2, 'ClientProjectTask', $WhereValue3);
}

function returnRowsTeamAssignmentsUnique($WhereValue1, $WhereValue2, $WhereValue3)
{
	return returnRowsForThreeValues('TeamAssignments', 'Team', $WhereValue1, 'Type', $WhereValue2, 'ClientProjectTask', $WhereValue3);
}

/* The following functions update the database.
 *
 */
function updateTable_NumberValue($TableName, $Column, $Value, $WhereColumn, $WhereValue)
{
	$sql = "Update $TableName SET $Column=$Value WHERE $WhereColumn='$WhereValue'";
	db_query($sql);
}

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

function updateTableByProjectID($TableName, $Column, $Value, $ProjectID)
{
	updateTable($TableName, $Column, $Value, 'ProjectID', $ProjectID);
}

function updateTableByTaskID($TableName, $Column, $Value, $TaskID)
{
	updateTable($TableName, $Column, $Value, 'TaskID', $TaskID);
}

function updateTableByTimeLogID($Column, $Value, $TimeLogID)
{
	updateTable('TimeSheet', $Column, $Value, 'TimeLogID', $TimeLogID);
}

function updateTableByTimeLogID_NumberValue($Column, $Value, $TimeLogID)
{
	updateTable_NumberValue('TimeSheet', $Column, $Value, 'TimeLogID', $TimeLogID);
}

function updateTableByClient_NumberValue($TableName, $Column, $Value, $Clientname)
{
	updateTable_NumberValue($TableName, $Column, $Value, 'ClientName', $Clientname);
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

/* Load table rows into objects. Constructor will call these methods. 
 *
 */

function returnDeveloperAssignments($Username)
{
	returnRowsByUser('DeveloperAssignments', $Username);
}

?>