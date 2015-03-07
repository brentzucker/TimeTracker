<?php
require_once 'Database.php';
class Tasks
{
	private $TaskID;
	private $ClientName;
	private $ProjectID;
	private $TaskName;
	private $Description;

	function __construct($ClientName_, $ProjectID_, $TaskName_, $Description_)
	{
		echo "$ClientName_";
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