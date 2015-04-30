<?php
require_once(__DIR__.'/../../include.php');

class Team
{
	private $Team;
	private $Developer_List;
	private $Client_List;
	private $Project_List;
	private $Task_List;

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

	function __construct1($Team)
	{

		$this->Team = $Team;

		$developer_rows = returnRowsByTeam($Team);

		foreach($developer_rows as $developer_row)
			$this->Developer_List[] = new Developer($developer_row['Username']);

		$client_rows = returnRowsTeamAssignments($Team, 'Client');

		foreach($client_rows as $client_row)
			$this->Client_List[] = new Client($client_row['ClientProjectTask']);

		$project_rows = returnRowsTeamAssignments($Team, 'Project');

		foreach($project_rows as $project_row)
			$this->Project_List[] = new Projects($project_row['ClientProjectTask']);

		$task_rows = returnRowsTeamAssignments($Team, 'Task');

		foreach($task_rows as $task_row)
			$this->Task_List[] = new Tasks($task_row['ClientProjectTask']);
	}

	function test()
	{
		print_r( $this->Client_List );
		print_r( $this->Project_List );
		print_r( $this->Task_List );
	}

	function getDeveloperList()
	{
		//Update Developer List
		$this->Developer_List = null;
		$developer_rows = returnRowsByTeam($this->Team);
		foreach($developer_rows as $developer_row)
			$this->Developer_List[] = new Developer($developer_row['Username']);

		return $this->Developer_List;
	}

	function getClientList()
	{
		//Update Client List
		$this->Client_List = null;
		$client_rows = returnRowsTeamAssignments($this->Team, 'Client');
		foreach($client_rows as $client_row)
			$this->Client_List[] = new Client($client_row['ClientProjectTask']);

		return $this->Client_List;
	}

	function getProjectList()
	{
		//Update Project List
		$this->Project_List = null;
		$project_rows = returnRowsTeamAssignments($this->Team, 'Project');
		foreach($project_rows as $project_row)
			$this->Project_List[] = new Projects($project_row['ClientProjectTask']);

		return $this->Project_List;
	}

	function getTaskList()
	{
		//Update Task List
		$this->Task_List = null;
		$task_rows = returnRowsTeamAssignments($this->Team, 'Task');
		foreach($task_rows as $task_row)
			$this->Task_List[] = new Tasks($task_row['ClientProjectTask']);
		return $this->Task_List;
	}

	//gets the project that are under the client's name
	function getClientsProjectsAssigned($clientname)
	{
		$ret = array();
		$client = new Client($clientname);
		$team_projects = $this->getProjectList();

		//for each project if they have the same ID push if into the list
		foreach($team_projects as $team_project)
			foreach($client->getProjects() as $project)
				if($team_project->getProjectID() == $project->getProjectID())
					array_push($ret, $project);

		return $ret;
	}

	//gets the tasks that are under the project ID
	function getProjectsTasksAssigned($projectid)
	{
		$ret = array();
		$project = new Projects($projectid);
		$team_tasks = $this->getTaskList();

		//for each tasks if the developer's tasks and the task have the ID push it into the list
		foreach($team_tasks as $team_task)
			foreach($project->getTaskList() as $task)
				if($team_task->getTaskID() == $task->getTaskID())
					array_push($ret, $task);

		return $ret;
	}
}
?>