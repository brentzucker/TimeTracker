<?php
require_once(__DIR__.'/../include.php');

class Team
{
	private $Team;
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
}
?>