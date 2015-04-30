<?php
/*
Name: Projects.php
Description: sets/gets the infromation about the project and assigns them to developers
Programmers: Brent Zucker
Dates: (3/10/15, 
Names of files accessed: include.php
Names of files changed:
Input: 
Output:
Error Handling: 
Modification List:
3/10/15-Initial code up 
3/12/15-Updated path directories
4/10/15-Developers set up
*/

require_once(__DIR__.'/../../include.php');



class Projects
{
	private $ProjectID;
	private $ClientName;
	private $ProjectName;
	private $Description;
	private $Task_List = array();
	
	
	function __construct()
	{
        $a = func_get_args(); 
        $i = func_num_args(); 

        //Calls the constructor with the corresponding number of arguments.
        if (method_exists($this,$f='__construct'.$i)) 
        { 
            call_user_func_array(array($this,$f),$a); 
        } 
	}

	//query the database for a project based on its ID
	function __construct1($ProjectID)
	{
		$project_row = returnRowByProjectID($ProjectID);

		$this->ProjectID = $project_row['ProjectID'];
		$this->ClientName = $project_row['ClientName'];
		$this->ProjectName = $project_row['ProjectName'];
		$this->Description = $project_row['Description'];

		//load Tasks into Task_List
		$tasks_rows = returnRowsByProjectID($this->ProjectID);
		foreach($tasks_rows as $task)
			array_push( $this->Task_List, new Tasks($task['TaskID']) );
	}

	//This constructor creates and entry into the database.
	function __construct3($ClientName_, $ProjectName_, $Description_)
	{
		$this->ClientName = $ClientName_;
		$this->ProjectName = $ProjectName_;
		$this->Description = $Description_;
		$this->ProjectID = newProjects($this->ClientName, $this->ProjectName, $this->Description);
	}

	//gets the project's information array
	function getInfo()
	{
		return array("ProjectID"=>$this->ProjectID, "ClientName"=>$this->ClientName, "ProjectName"=>$this->ProjectName, "Description"=>$this->Description);
	}

	//gets the project's ID
	function getProjectID()
	{
		return $this->ProjectID;
	}

	//gets the project's client's name
	function getClientName()
	{
		return $this->ClientName;
	}
	
	//set the project's client's name 
	function setClientName($s)
	{
		updateTableByProjectID('Projects', 'ClientName', $s, $this->ProjectID);
		$this->ClientName = $s;
	}	

	//get the project's name
	function getProjectName()
	{
		return $this->ProjectName;
	}

	
	//set the project's name
	function setProjectName($s)
	{
		updateTableByProjectID('Projects', 'ProjectName', $s, $this->ProjectID);
		$this->ProjectName = $s;
	}	

	//get the project's description
	function getDescription()
	{
		return $this->Description;
	}

	//set the project's description
	function setDescription($s)
	{
		updateTableByProjectID('Projects', 'Description', $s, $this->ProjectID);
		$this->Description = $s;
	}

	//add a task object to the Task_List array
	function assignTask($TaskObject)
	{
		array_push($this->Task_List, $TaskObject);
	}
	
	//return the array of the Tasks Object
	function getTaskList()
	{
		return $this->Task_List;
	}
}
?>