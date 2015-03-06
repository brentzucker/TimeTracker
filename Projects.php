<?php
require_once 'Database.php';
class Projects
{
	private $ProjectID;
	private $ClientName;
	private $ProjectName;
	private $Description;

	//This constructor creates and entry into the database.
	function __construct($ClientName_, $ProjectName_, $Description_)
	{
		$this->ClientName = $ClientName_;
		$this->ProjectName = $ProjectName_;
		$this->Description = $Description_;
		$this->ProjectID = newProjects($this->ClientName, $this->ProjectName, $this->Description);
		echo "$this->ProjectID";
	}
}
?>