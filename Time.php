<?php
require_once 'Database.php';
class Time
{
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

		if($this->Info['TimeSpent'] == 0 && $this->Info['TimeStampOut'] != new DateTime('0000-00-00 00:00:00'))
				$this->calculateTimeSpent();
	}

	function __construct5($Username, $ClientName, $ProjectID, $TaskID, $TimeStampIn)
	{
		$this->Username = $Username;
		$this->ClientName = $ClientName;
		$this->ProjectID = $ProjectID;
		$this->TaskID = $TaskID;
		$this->Info['TimeStampIn'] = new DateTime($TimeStampIn);
	}

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

	function getTimeLogID()
	{
		return $this->Info['TimeLogID'];
	}

	function getTimeIn()
	{
		return $this->Info['TimeStampIn']->format('Y-m-d H:i:s');
	}

	function getTimeOut()
	{
		return $this->Info['TimeStampOut']->format('Y-m-d H:i:s');
	}

	function getTimeStampIn()
	{
		return $this->Info['TimeStampIn'];
	}

	function setTimeStampIn($s)
	{
		updateTableByTimeLogID('TimeIn', $s, $this->getTimeLogID());
		$this->Info['TimeStampIn'] = new DateTime($s);
	}

	function getTimeStampOut()
	{
		return $this->Info['TimeStampOut'];
	}

	function setTimeStampOut($s)
	{
		updateTableByTimeLogID('TimeOut', $s, $this->getTimeLogID());
		$this->Info['TimeStampOut'] = new DateTime($s);
		
		//Calculate time spent
		$this->calculateTimeSpent();

		//Subtract Time spent from Client
		$this->subtractTimeSpentFromClient();
	}

	function subtractTimeSpentFromClient()
	{
		//Get Client Hours Spent
		$Client_HoursLeft_row = returnRowByClient('Client', $this->getClientName())['HoursLeft'];

		//SubtractTimeSpent
		$Client_HoursLeft_row -= $this->getTimeSpent();

		//Update Database
		updateTableByClient_NumberValue('Client', 'HoursLeft', $Client_HoursLeft_row, $this->getClientName());
	}

	function getTimeSpent()
	{
		return $this->Info['TimeSpent'];
	}

	function setTimeSpent($s)
	{
		updateTableByTimeLogID_NumberValue('TimeSpent', $s, $this->getTimeLogID());
		$this->Info['TimeSpent'] = $s;
	}

	function getUsername()
	{
		return $this->Username;
	}

	function setUsername($s)
	{
		updateTableByTimeLogID('Username', $s, $this->getTimeLogID());
		$this->Username = $s;
	}

	function getClientName()
	{
		return $this->ClientName;
	}

	function setClientName($s)
	{
		updateTableByTimeLogID('ClientName', $s, $this->getTimeLogID());
		$this->ClientName = $s;
	}

	function getProjectID()
	{
		return $this->ProjectID;
	}

	function setProjectID($s)
	{
		updateTableByTimeLogID_NumberValue('ProjectID', $s, $this->getTimeLogID());
		$this->ProjectID = $s;
	}

	function getTaskID()
	{
		return $this->TaskID;
	}

	function setTaskID($s)
	{
		updateTableByTimeLogID_NumberValue('TaskID', $s, $this->getTimeLogID());
		$this->TaskID = $s;
	}

	function calculateTimeSpent()
	{
		$DateTimeIn = $this->Info['TimeStampIn']; 
		$DateTimeOut = $this->Info['TimeStampOut'];

		$Difference = $DateTimeIn->diff($DateTimeOut);

		$timeSpent = $this->dateTimeToSeconds($Difference);

		$this->setTimeSpent($timeSpent);
	}

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