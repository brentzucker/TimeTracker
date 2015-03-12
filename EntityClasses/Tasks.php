<?php
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

	function getInfo()
	{
		return array("TaskID"=>$this->TaskID, "ClientName"=>$this->ClientName, "ProjectID"=>$this->ProjectID, "TaskName"=>$this->TaskName, "Description"=>$this->Description);
	}

	function getTaskID()
	{
		return $this->TaskID;
	}

	function getClientName()
	{
		return $this->ClientName;
	}

	function setClientName($s)
	{
		updateTableByTaskID('Tasks', 'ClientName', $s, $this->getTaskID());
		$this->ClientName = $s;
	}

	function getProjectID()
	{
		return $this->ProjectID;
	}

	function setProjectID($s)
	{
		updateTableByTaskID('Tasks', 'ProjectID', $s, $this->getTaskID());
		$this->ProjectID = $s;
	}

	function getTaskName()
	{
		return $this->TaskName;
	}

	function setTaskName($s)
	{
		updateTableByTaskID('Tasks', 'TaskName', $s, $this->getTaskID());
		$this->TaskName = $s;
	}

	function getDescription()
	{
		return $this->Description;
	}

	function setDescription($s)
	{
		updateTableByTaskID('Tasks', 'Description', $s, $this->getTaskID());
		$this->Description = $s;
	}
}
?>