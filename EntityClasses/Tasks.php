<?php
/*
Name: Tasks.php
Description: creates an array with the task's information and creates get/set methods
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
4/6/15-Assign developers/task
4/10/15-Developers set up
*/

require_once(__DIR__.'/../include.php');


class Tasks
{
	private $TaskID;
	private $ClientName;
	private $ProjectID;
	private $TaskName;
	private $Description;

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

	//query the database for a task based on its ID
	function __construct1($TaskID)
	{
		$task_row = returnRowByTaskID($TaskID);

		$this->TaskID = $task_row['TaskID'];
		$this->ClientName = $task_row['ClientName'];
		$this->ProjectID = $task_row['ProjectID'];
		$this->TaskName = $task_row['TaskName'];
		$this->Description = $task_row['Description'];
	}

	//This constructor creates a new record in the database.
	function __construct4($ClientName_, $ProjectID_, $TaskName_, $Description_)
	{
		$this->ClientName = $ClientName_;
		$this->ProjectID = $ProjectID_;
		$this->TaskName = $TaskName_;
		$this->Description = $Description_;
		$this->TaskID = newTasks($ClientName_, $ProjectID_, $TaskName_, $Description_);
	}

	//gets the information about the task
	function getInfo()
	{
		return array("TaskID"=>$this->TaskID, "ClientName"=>$this->ClientName, "ProjectID"=>$this->ProjectID, "TaskName"=>$this->TaskName, "Description"=>$this->Description);
	}

	//gets the task ID
	function getTaskID()
	{
		return $this->TaskID;
	}

	//gets the task's client's name
	function getClientName()
	{
		return $this->ClientName;
	}

	//sets the task's client's name
	function setClientName($s)
	{
		updateTableByTaskID('Tasks', 'ClientName', $s, $this->getTaskID());
		$this->ClientName = $s;
	}

	//gets the projectID that is associated with the task
	function getProjectID()
	{
		return $this->ProjectID;
	}

	//sets the projectID that is associated with the task
	function setProjectID($s)
	{
		updateTableByTaskID('Tasks', 'ProjectID', $s, $this->getTaskID());
		$this->ProjectID = $s;
	}

	//get's the task's name
	function getTaskName()
	{
		return $this->TaskName;
	}

	//sets the task's name
	function setTaskName($s)
	{
		updateTableByTaskID('Tasks', 'TaskName', $s, $this->getTaskID());
		$this->TaskName = $s;
	}

	//gets the task's description
	function getDescription()
	{
		return $this->Description;
	}

	//set the task's description
	function setDescription($s)
	{
		updateTableByTaskID('Tasks', 'Description', $s, $this->getTaskID());
		$this->Description = $s;
	}

	//Boolean function to compare 2 Tasks
	function equals($task2)
	{
		if(($this->TaskID == $task2->getTaskID()) && ($this->ClientName == $task2->getClientName()) && ($this->ProjectID == $task2->getProjectID()) && ($this->TaskName == $task2->getTaskName()) && ($this->Description == $task2->getDescription()))
			return true; 
		else return false;
	}
}
?>