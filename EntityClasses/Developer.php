<?php
require_once(__DIR__.'/../include.php');

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
	private $TimeSet_Flag;

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

		//Load Assigned Client List
		$assigned_clients_rows = returnRowsDeveloperAssignments($this->Info['Username'], 'Client');
		foreach($assigned_clients_rows as $assigned_client)
			array_push( $this->Client_List , new Client( $assigned_client['ClientProjectTask'] ));

		//Load Assigned Project List
		$assigned_projects_rows = returnRowsDeveloperAssignments($this->Info['Username'], 'Project');
		foreach($assigned_projects_rows as $assigned_project)
			array_push( $this->Project_List , new Projects( $assigned_project['ClientProjectTask'] ));

		//Load Assigned Task List
		$assigned_tasks_rows = returnRowsDeveloperAssignments($this->Info['Username'], 'Task');
		foreach($assigned_tasks_rows as $assigned_task)
			array_push( $this->Task_List , new Tasks( $assigned_task['ClientProjectTask'] ));

		//Loads the Time Logs
		$TimeSheet_Rows = returnRowsByUser('TimeSheet', $this->Info['Username']);
		foreach($TimeSheet_Rows as $row)
			array_push($this->Time_Log, new Time( $row['TimeLogID'] ));

		$this->TimeSet_Flag = False;
	}

	function getAssignments()
	{
		return array("Clients"=>$this->Client_List, "Projects"=>$this->Project_List, "Tasks"=>$this->Task_List);
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
		//Don't assign the same client twice!
		$already_assigned = false;

		foreach($this->Client_List as $client)
			if($client->equals($ClientObject))
				$already_assigned = true;
			
		if(!$already_assigned)	
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
		//Don't assign the same task twice! 
		$already_assigned = false; 

		foreach($this->Task_List as $task)
			if($task->equals($TaskObject))
				$already_assigned = true;

		if(!$already_assigned)
			newDeveloperAssignments($this->getUsername(), $TaskObject->getTaskID(), 'Task');
		array_push($this->Task_List, $TaskObject);
	}

	function clockIn($TaskID)
	{
		if($this->getTimeSetFlag() == False)
		{
			$task_row = returnRowByTaskID($TaskID);
			$ClientName = $task_row['ClientName'];
			$ProjectID = $task_row['ProjectID'];

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

	function getClient($ClientName)
	{
		foreach($this->Client_List as $Client)
			if(strcmp($Client->getClientname(), $ClientName) == 0)
				return $Client;
	}

	function getProject($projectid)
	{
		foreach($this->Project_List as $project)
			if($project->getProjectID() == $projectid)
				return $project;
	}

	function getClientsProjectsAssigned($clientname)
	{
		$ret = array();
		$client = $this->getClient($clientname);
		$dev_projects = $this->getProjectList();

		foreach($dev_projects as $dev_project)
			foreach($client->getProjects() as $project)
				if($dev_project->getProjectID() == $project->getProjectID())
					array_push($ret, $project);

		return $ret;
	}

	function getProjectsTasksAssigned($projectid)
	{
		$ret = array();
		$project = $this->getProject($projectid);
		$dev_tasks = $this->getTaskList();

		foreach($dev_tasks as $dev_task)
			foreach($project->getTaskList() as $task)
				if($dev_task->getTaskID() == $task->getTaskID())
					array_push($ret, $task);
			
		return $ret;
	}

	function getDevelopers()
	{
		$ret = array();

		//query database for developers with same team name
		$developers = returnRowsByTeam($this->getTeam());

		//create list of developer objects
		foreach($developers as $dev)
			array_push( $ret, new Developer( $dev['Username'] ));

		//return list
		return $ret; 
	}
}
?>