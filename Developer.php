<?php
require_once 'Database.php';
require_once 'Contact.php';
require_once 'Time.php';
require_once 'Client.php';

class Developer
{
	private $Info = array(
		"Team"=>"",
		"Username"=>"",
		"Position"=>"",
		"Contact"=>"",
		);
	private $Client_List = array();
	private $Project_List = array();
	private $Task_List = array();
	private $Time_Log = array();
	private $Current_TimeLog;

	//If False Clock In, if True Clock out
	private $TimeSet_Flag = False;

	function __construct($Username)
	{
		$db_entry_Developer = returnRowByUser("Developer", $Username);

		$this->Info['Team'] = $db_entry_Developer['Team'];
		$this->Info['Username'] = $db_entry_Developer['Username'];
		$this->Info['Position'] = $db_entry_Developer['Position'];

		$db_entry_Contact = returnRowByUser("Contact", $Username);

		$this->Info['Contact'] = new Contact(
			 $db_entry_Contact['Username'],
			 $db_entry_Contact['Firstname'], 
			 $db_entry_Contact['Lastname'],
			 $db_entry_Contact['Phone'],
			 $db_entry_Contact['Email'],
			 $db_entry_Contact['Address'],
			 $db_entry_Contact['City'],
			 $db_entry_Contact['State']);

		//Loads the TimeLogs
		$TimeSheet_Rows = returnRowsByUser('TimeSheet', $this->Info['Username']);
		foreach($TimeSheet_Rows as $row)
			array_push($this->Time_Log, new Time( $row['TimeLogID'] ));
	}

	function getInfo()
	{	
		return array_merge($this->getDeveloperInfo(), $this->getContact()->getInfo());
	}

	function getDeveloperInfo()
	{
		$developer_info = array("Team"=>$this->Info['Team'], "Username"=>$this->Info['Username'], "Position"=>$this->Info['Position']);
		return $developer_info;
	}

	function getClientList()
	{
		return $this->Client_List;
	}

	function getProjectList()
	{
		return $this->Project_List;
	}

	function getTaskList()
	{
		return $this->Task_List;
	}

	function getTimeLog()
	{
		if($this->getTimeSetFlag() == True)
		{
			$temp = $this->Time_Log;
			array_push($temp, $this->getCurrentTimeLog());
			return $temp;
		}	
		return $this->Time_Log;
	}

	function getContact()
	{
		return $this->Info['Contact'];
	}

	function getTeam()
	{
		return $this->Info['Team'];
	}

	function setTeam($s)
	{
		$this->Info['Team'] = $s;
		updateTableByUser('Developer', 'Team', $s, $this->Username);
	}

	function getUsername()
	{
		return $this->Info['Username'];
	}

	function setUsername($s)
	{
		$this->Info['Username'] = $s;
		updateTableByUser('Developer', 'Username', $s, $this->Username);
	}

	function getPosition()
	{
		return $this->Info['Position'];
	}

	function setPosition($s)
	{
		$this->Info['Position'] = $s;
		updateTableByUser('Developer', 'Position', $s, $this->Username);
	}

	function getTimeSetFlag()
	{
		return $this->TimeSet_Flag;
	}

	function setTimeSetFlag($boolean)
	{
		$this->TimeSet_Flag = $boolean;
	}

	function getCurrentTimeLog()
	{
		return $this->Current_TimeLog;
	}

	function setCurrentTimeLog($TimeObject)
	{
		$this->Current_TimeLog = $TimeObject;
	}

	function pushCurrentTimeLog()
	{
		array_push($this->Time_Log, $this->Current_TimeLog);
		$this->setCurrentTimeLog(NULL);
	}

	function assignClient($ClientObject)
	{
		newDeveloperAssignments($this->getUsername(), $ClientObject->getClientname(), 'Client');
		array_push($this->Client_List, $ClientObject);
	}

	function assignProject($ProjectObject)
	{
		newDeveloperAssignments($this->getUsername(), $ProjectObject->getProjectID(), 'Project');
		array_push($this->Project_List, $ProjectObject);
	}

	function assignTask($TaskObject)
	{
		newDeveloperAssignments($this->getUsername(), $TaskObject->getTaskID(), 'Task');
		array_push($this->Task_List, $TaskObject);
	}

	function clockIn($ClientName, $ProjectID, $TaskID)
	{
		if($this->getTimeSetFlag() == False)
		{
			$TimeIn = date('Y-m-d H:i:s', time());
			$TimeLogID = newTimeSheet($this->getUsername(), $ClientName, $ProjectID, $TaskID, $TimeIn, '0000-00-00 00:00:00', 0);
			$this->setCurrentTimeLog(new Time($TimeLogID));
			$this->setTimeSetFlag(True);
		}
	}
	
	function clockOut()
	{
		if($this->getTimeSetFlag() == True)
		{
			$TimeOut = date('Y-m-d H:i:s', time());
			$this->getCurrentTimeLog()->setTimeStampOut($TimeOut);
			$this->pushCurrentTimeLog();
			$this->setTimeSetFlag(False);
		}
	}
}
?>