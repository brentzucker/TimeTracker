<?php
/*
Name: SuperUser.php
Description: returns all of the teams, developers, clients, projects, and tasks in the database
Programmers: Brent Zucker
Dates: (4/9/15, 
Names of files accessed: include.php
Names of files changed:
Input: 
Output:
Error Handling:
Modification List:
4/9/15-Initial code up 
*/

require_once(__DIR__.'/../../include.php');

class SuperUser
{
	
	function __construct()
	{
		
	}
	
	//Get all of the Teams in the database
	function getTeams()
	{
		$TeamName_Array = array();
		$developer_rows = returnAllRows('Developer');

		foreach($developer_rows as $row)
			$TeamName_Array[] = $row['Team'];

		return $TeamName_Array;
	}

	//Get all of the Developers in the database
	function getDevelopers()
	{
		$DeveloperObject_Array = array();
		$developer_rows = returnAllRows('Developer');

		foreach($developer_rows as $row)
			$DeveloperObject_Array[] = new Developer($row['Username']);

		return $DeveloperObject_Array;
	}

	//Get all of the Clients in the database
	function getClients()
	{
		$ClientObject_Array = array();
		$client_rows = returnAllRows('Client');

		foreach($client_rows as $row)
			$ClientObject_Array[] = new Client($row['ClientName']);

		return $ClientObject_Array;
	}

	//Get all of the Projects in the database
	function getProjects()
	{
		$ProjectObject_Array = array();
		$project_rows = returnAllRows('Projects');

		foreach($project_rows as $row)
			$ProjectObject_Array[] = new Projects($row['ProjectID']);

		return $ProjectObject_Array;
	}

	//Get all of the Tasks in the database
	function getTasks()
	{
		$TaskObject_Array = array();
		$task_rows = returnAllRows('Tasks');

		foreach($task_rows as $row)
			$TaskObject_Array[] = new Tasks($row['TaskID']);

		return $TaskObject_Array;
	}

}
?>