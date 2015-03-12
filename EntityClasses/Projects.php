<?php
require_once(__DIR__.'/../include.php');

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

	function __construct1($ProjectID)
	{
		$project_row = returnRowByProjectID($ProjectID);

		$this->ProjectID = $project_row['ProjectID'];
		$this->ClientName = $project_row['ClientName'];
		$this->ProjectName = $project_row['ProjectName'];
		$this->Description = $project_row['Description'];

		//Load Tasks into Task_List
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

	function getInfo()
	{
		return array("ProjectID"=>$this->ProjectID, "ClientName"=>$this->ClientName, "ProjectName"=>$this->ProjectName, "Description"=>$this->Description);
	}

	function getProjectID()
	{
		return $this->ProjectID;
	}

	function getClientName()
	{
		return $this->ClientName;
	}

	function setClientName($s)
	{
		updateTableByProjectID('Projects', 'ClientName', $s, $this->ProjectID);
		$this->ClientName = $s;
	}	

	function getProjectName()
	{
		return $this->ProjectName;
	}

	function setProjectName($s)
	{
		updateTableByProjectID('Projects', 'ProjectName', $s, $this->ProjectID);
		$this->ProjectName = $s;
	}	

	function getDescription()
	{
		return $this->Description;
	}

	function setDescription($s)
	{
		updateTableByProjectID('Projects', 'Description', $s, $this->ProjectID);
		$this->Description = $s;
	}

	function assignTask($TaskObject)
	{
		array_push($this->Task_List, $TaskObject);
	}

	function getTaskList()
	{
		return $this->Task_List;
	}
}
?>