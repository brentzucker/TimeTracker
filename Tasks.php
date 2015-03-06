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
}
?>