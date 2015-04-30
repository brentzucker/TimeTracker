<?php
/*
Name: Time.php
Description: functions used in calculating the time spent for developer, clients and the time stamp's information
Programmers: Brent Zucker
Dates: (3/10/15, 
Names of files accessed: include.php
Names of files changed:
Input: 
Output:
Error Handling:
Modification List:
3/10/15-Initial code up 
3/12/15-Updated path directories 
4/10/15-Developers set up
*/

require_once(__DIR__.'/../../include.php');

class Time
{
	
	//an array with information about the time the developer's clock in/out time
	private $Info = array(
		"TimeLogID"=>"",
		"TimeStampIn"=>"",
		"TimeStampOut"=>"", 
		"TimeSpent"=>""
						  );
	private $Username;
	private $ClientName;
	private $ProjectID;
	private $TaskID;
	
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

	//query the database for a for time based on the timelog ID
	function __construct1($TimeLogID)
	{
		$row = returnRowByTimeLogID($TimeLogID);

		$this->Info['TimeLogID'] = $TimeLogID;
		$this->Username = $row['Username'];
		$this->ClientName = $row['ClientName'];
		$this->ProjectID = $row['ProjectID'];
		$this->TaskID = $row['TaskID'];
		$this->Info['TimeStampIn'] = new DateTime($row['TimeIn']);
		$this->Info['TimeStampOut'] = new DateTime($row['TimeOut']);
		$this->Info['TimeSpent'] = $row['TimeSpent'];

		//if there is no time spent and the time of the stamp out is not 0 calculate the time spent
		if($this->Info['TimeSpent'] == 0 && $this->Info['TimeStampOut'] != new DateTime('0000-00-00 00:00:00'))
				$this->calculateTimeSpent();
	}

	//query the database for a for time based on the username, client name, project ID, task ID, time stamp in
	function __construct5($Username, $ClientName, $ProjectID, $TaskID, $TimeStampIn)
	{
		$this->Username = $Username;
		$this->ClientName = $ClientName;
		$this->ProjectID = $ProjectID;
		$this->TaskID = $TaskID;
		$this->Info['TimeStampIn'] = new DateTime($TimeStampIn);
	}

	//query the database for a for time based on the username, client name, project ID, task ID, time stamp in, and the time out
	function __construct6($Username, $ClientName, $ProjectID, $TaskID, $TimeStampIn, $TimeStampOut)
	{
		$this->Username = $Username;
		$this->ClientName = $ClientName;
		$this->ProjectID = $ProjectID;
		$this->TaskID = $TaskID;
		$this->Info['TimeStampIn'] = new DateTime($TimeStampIn);
		$this->Info['TimeStampOut'] = new DateTime($TimeStampOut);
		$this->calculateTimeSpent();
	}

	//query the database for a for time based on the username, client name, project ID, task ID, time stamp in, the time out, and the time spent
	function __construct7($Username, $ClientName, $ProjectID, $TaskID, $TimeStampIn, $TimeStampOut, $TimeSpent)
	{
		$this->Username = $Username;
		$this->ClientName = $ClientName;
		$this->ProjectID = $ProjectID;
		$this->TaskID = $TaskID;
		$this->Info['TimeStampIn'] = new DateTime($TimeStampIn);
		$this->Info['TimeStampOut'] = new DateTime($TimeStampOut);
		$this->Info['TimeSpent'] = $TimeSpent;
	}

	function getInfo()
	{
		return array_merge($this->Info, array("Username"=>$this->Username,"ClientName"=>$this->ClientName,"ProjectID"=>$this->ProjectID,"TaskID"=>$this->TaskID));
		//return $this->Info;
	}

	//get the time log ID
	function getTimeLogID()
	{
		return $this->Info['TimeLogID'];
	}

	//get the time in
	function getTimeIn()
	{
		return $this->Info['TimeStampIn']->format('Y-m-d H:i:s');
	}

	//get the time out
	function getTimeOut()
	{
		return $this->Info['TimeStampOut']->format('Y-m-d H:i:s');
	}

	//get the time stamp for logging in
	function getTimeStampIn()
	{
		return $this->Info['TimeStampIn'];
	}

	//set the time stamp for logging in
	function setTimeStampIn($s)
	{
		updateTableByTimeLogID('TimeIn', $s, $this->getTimeLogID());
		$this->Info['TimeStampIn'] = new DateTime($s);
	}

	//get the time stamp for logging out
	function getTimeStampOut()
	{
		return $this->Info['TimeStampOut'];
	}

	//set the time stamp for logging out
	function setTimeStampOut($s)
	{
		updateTableByTimeLogID('TimeOut', $s, $this->getTimeLogID());
		$this->Info['TimeStampOut'] = new DateTime($s);
		
		//Calculate time spent
		$this->calculateTimeSpent();

		//Subtract Time spent from Client
		$this->subtractTimeSpentFromClient();
	}

	function updateTimeStampOut($s)
	{
		//Add original time back to client
		$this->addTimeBackToClient();

		updateTableByTimeLogID('TimeOut', $s, $this->getTimeLogID());
		$this->Info['TimeStampOut'] = new DateTime($s);

		//Calculate time spent
		$this->calculateTimeSpent();

		//Subtract Time spent from Client
		$this->subtractTimeSpentFromClient();
	}

	//subtract time spent from the client hours left
	function subtractTimeSpentFromClient()
	{
		//Get Client Hours Spent
		$Client_HoursLeft_row = returnRowByClient('Client', $this->getClientName())['HoursLeft'];

		//SubtractTimeSpent
		$Client_HoursLeft_row -= $this->getTimeSpent();

		//Update Database
		updateTableByClient_NumberValue('Client', 'HoursLeft', $Client_HoursLeft_row, $this->getClientName());
	}

	function addTimeBackToClient()
	{
		//Get Client Hours Spent
		$Client_HoursLeft_row = returnRowByClient('Client', $this->getClientName())['HoursLeft'];

		//Add TimeSpent
		$Client_HoursLeft_row += $this->getTimeSpent();

		//Update Database
		updateTableByClient_NumberValue('Client', 'HoursLeft', $Client_HoursLeft_row, $this->getClientName());
	}

	//get the time spent
	function getTimeSpent()
	{
		return $this->Info['TimeSpent'];
	}

	//set the time spent
	function setTimeSpent($s)
	{
		updateTableByTimeLogID_NumberValue('TimeSpent', $s, $this->getTimeLogID());
		$this->Info['TimeSpent'] = $s;
	}

	//get the username
	function getUsername()
	{
		return $this->Username;
	}

	//set the username
	function setUsername($s)
	{
		updateTableByTimeLogID('Username', $s, $this->getTimeLogID());
		$this->Username = $s;
	}

	//get the client's name
	function getClientName()
	{
		return $this->ClientName;
	}

	//set the client's name
	function setClientName($s)
	{
		updateTableByTimeLogID('ClientName', $s, $this->getTimeLogID());
		$this->ClientName = $s;
	}

	//get the project ID
	function getProjectID()
	{
		return $this->ProjectID;
	}

	//set the project ID
	function setProjectID($s)
	{
		updateTableByTimeLogID_NumberValue('ProjectID', $s, $this->getTimeLogID());
		$this->ProjectID = $s;
	}

	//gte the task ID
	function getTaskID()
	{
		return $this->TaskID;
	}

	//set the task ID
	function setTaskID($s)
	{
		updateTableByTimeLogID_NumberValue('TaskID', $s, $this->getTimeLogID());
		$this->TaskID = $s;
	}
	
	//time spent is the TimeStampIn-TimeStampOut converted into seconds using the dateTimeToSeconds
	function calculateTimeSpent()
	{
		$DateTimeIn = $this->Info['TimeStampIn']; 
		$DateTimeOut = $this->Info['TimeStampOut'];

		$Difference = $DateTimeIn->diff($DateTimeOut);

		$timeSpent = $this->dateTimeToSeconds($Difference);

		$this->setTimeSpent($timeSpent);
	}
	
	//converts dateTime to seconds
	private static function dateTimeToSeconds($Difference)
	{
		$year = $Difference->y;
		$month = $Difference->m;
		$day = $Difference->d;
		$hour = $Difference->h;
		$minute = $Difference->i;
		$second = $Difference->s;

		$sum = 0;

		$sum += ($year*365*24*60*60);

		$sum += ($month*30*24*60*60);

		$sum += ($day*24*60*60);

		$sum += ($hour*60*60);

		$sum += ($minute*60);

		$sum += ($second);

		return $sum;
	}
}
?>