<?php
require_once 'Database.php';
class Projects
{
	private $ProjectID;
	private $ClientName;
	private $ProjectName;
	private $Description;
	private $Task_List = array();

	//This constructor creates and entry into the database.
	function __construct($ClientName_, $ProjectName_, $Description_)
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
}
?>