<?php
/*
Name: Developer.php
Description: sets up the an array with the developer's work information as well as how to handle the clock in/out functions
Programmers: Brent Zucker
Dates: (3/10/15, 
Names of files accessed: include.php
Names of files changed:
Input: 
Output:
Error Handling: the assignClient and assignTask classes make sure that you can't assign the same client and task more than once
Modification List:
3/10/15-Initial code up 
3/12/15-Updated path directories 
3/29/15-Demo report and clock in/out
4/6/15-Assign client/task
4/10/15-Developers set up
*/

require_once(__DIR__.'/../include.php');

//creates an array with the developer's work informationa
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

	//constructs a developer position with the contact information from the contact class
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

	//gets the assignments
	function getAssignments()
	{
		return array("Clients"=>$this->Client_List, "Projects"=>$this->Project_List, "Tasks"=>$this->Task_List);
	}

	//gets the developer's work and contact information
	function getInfo()
	{	
		return array_merge($this->getDeveloperInfo(), $this->getContact()->getInfo());
	}

	//gets the developer's work information
	function getDeveloperInfo()
	{
		$developer_info = array("Team"=>$this->Info['Team'], "Username"=>$this->Info['Username'], "Position"=>$this->Info['Position']);
		return $developer_info;
	}

	//gets the client list
	function getClientList()
	{
		return $this->Client_List;
	}

	//gets the project list
	function getProjectList()
	{
		return $this->Project_List;
	}

	//gets the task list
	function getTaskList()
	{
		return $this->Task_List;
	}

	//puts the time log in the array
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

	//gets the developer's contact information array
	function getContact()
	{
		return $this->Info['Contact'];
	}

	//gets the developer's team
	function getTeam()
	{
		return $this->Info['Team'];
	}

	//sets the developer's team
	function setTeam($s)
	{
		$this->Info['Team'] = $s;
		updateTableByUser('Developer', 'Team', $s, $this->Username);
	}

	//gets the developer's username
	function getUsername()
	{
		return $this->Info['Username'];
	}

	//sets the developer's username
	function setUsername($s)
	{
		$this->Info['Username'] = $s;
		updateTableByUser('Developer', 'Username', $s, $this->Username);
	}

	//gets the developer's position
	function getPosition()
	{
		return $this->Info['Position'];
	}

	//sets the developer's position
	function setPosition($s)
	{
		$this->Info['Position'] = $s;
		updateTableByUser('Developer', 'Position', $s, $this->Username);
	}

	//sees if the flag is set
	function getTimeSetFlag()
	{
		return $this->TimeSet_Flag;
	}

	//sets the flag for time set
	function setTimeSetFlag($boolean)
	{
		$this->TimeSet_Flag = $boolean;
	}

	//gets the current time log
	function getCurrentTimeLog()
	{
		return $this->Current_TimeLog;
	}

	//sets the current time log
	function setCurrentTimeLog($TimeObject)
	{
		$this->Current_TimeLog = $TimeObject;
	}

	//puts the current time log in the list and sets the variable to null
	function pushCurrentTimeLog()
	{
		array_push($this->Time_Log, $this->Current_TimeLog);
		$this->setCurrentTimeLog(NULL);
	}

	//assigns client to developer
	function assignClient($ClientObject)
	{
		if(newDeveloperAssignments($this->getUsername(), $ClientObject->getClientname(), 'Client'))
			array_push($this->Client_List, $ClientObject);
	}
	
	//assigns project to developer
	function assignProject($ProjectObject)
	{
		if(newDeveloperAssignments($this->getUsername(), $ProjectObject->getProjectID(), 'Project'))
			array_push($this->Project_List, $ProjectObject);
	}

	//assigns task to developer
	function assignTask($TaskObject)
	{
		if(newDeveloperAssignments($this->getUsername(), $TaskObject->getTaskID(), 'Task'))
			array_push($this->Task_List, $TaskObject);
	}

	//how to clock developer in
	function clockIn($TaskID)
	{
		if($this->getTimeSetFlag() == False)
		{
			$task_row = returnRowByTaskID($TaskID);
			$ClientName = $task_row['ClientName'];
			$ProjectID = $task_row['ProjectID'];

			//sets the date format
			$TimeIn = date('Y-m-d H:i:s', time());
			//put the developer's work information and time log in a timesheet
			$TimeLogID = newTimeSheet($this->getUsername(), $ClientName, $ProjectID, $TaskID, $TimeIn, '0000-00-00 00:00:00', 0);
			$this->setCurrentTimeLog(new Time($TimeLogID));
			$this->setTimeSetFlag(True);
		}
	}
	
	//clock developer out 
	function clockOut()
	{
		if($this->getTimeSetFlag() == True)
		{
			//sets date format
			$TimeOut = date('Y-m-d H:i:s', time());
			//the current time is now the time out
			$this->getCurrentTimeLog()->setTimeStampOut($TimeOut);
			//pushes this information
			$this->pushCurrentTimeLog();
			$this->setTimeSetFlag(False);
		}
	}

	//get client name from Client_List
	function getClient($ClientName)
	{
		foreach($this->Client_List as $Client)
			if(strcmp($Client->getClientname(), $ClientName) == 0)
				return $Client;
	}

	//gets projects from Project_List
	function getProject($projectid)
	{
		foreach($this->Project_List as $project)
			if($project->getProjectID() == $projectid)
				return $project;
	}
	
	//gets the project that are under the client's name
	function getClientsProjectsAssigned($clientname)
	{
		$ret = array();
		$client = $this->getClient($clientname);
		$dev_projects = $this->getProjectList();

		//for each project if they have the same ID push if into the list
		foreach($dev_projects as $dev_project)
			foreach($client->getProjects() as $project)
				if($dev_project->getProjectID() == $project->getProjectID())
					array_push($ret, $project);

		return $ret;
	}
	
	//gets the tasks that are under the project ID
	function getProjectsTasksAssigned($projectid)
	{
		$ret = array();
		$project = $this->getProject($projectid);
		$dev_tasks = $this->getTaskList();

		//for each tasks if the developer's tasks and the task have the ID push it into the list
		foreach($dev_tasks as $dev_task)
			foreach($project->getTaskList() as $task)
				if($dev_task->getTaskID() == $task->getTaskID())
					array_push($ret, $task);
			
		return $ret;
	}

	//gets the developers 
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

	function newClient($clientname, $startdate, $firstname, $lastname, $phone, $email, $address, $city, $state)
	{
		createClient($clientname, $startdate, $firstname, $lastname, $phone, $email, $address, $city, $state);
		$this->assignClient( new Client($clientname) );
	}
	
	function editClient($newName, $clientname, $startdate, $firstname, $lastname, $phone, $email, $address, $city, $state);
	{
		edittingClient($newName, $clientname, $startdate, $firstname, $lastname, $phone, $email, $address, $city, $state);
		/*
		 *will need help with adding to assigned developer list 
		 */
	}

	function newProject($ClientName, $ProjectName, $Description)
	{
		$this->assignProject(new Projects($ClientName, $ProjectName, $Description));
	}
}
?>