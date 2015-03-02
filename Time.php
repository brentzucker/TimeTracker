<?php
class Time
{
	private $Info = array("TimeStampIn"=>"", "TimeStampOut"=>"", "TimeLogged"=>"");
	
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

	function __construct1($TimeStampIn)
	{
		$this->Info['TimeStampIn'] = new DateTime($TimeStampIn);
	}

	function __construct2($TimeStampIn, $TimeStampOut)
	{
		$this->Info['TimeStampIn'] = new DateTime($TimeStampIn);
		$this->Info['TimeStampOut'] = new DateTime($TimeStampOut);
		$this->calculateTimeLogged();
	}

	function __construct3($TimeStampIn, $TimeStampOut, $TimeLogged)
	{
		$this->Info['TimeStampIn'] = $TimeStampIn;
		$this->Info['TimeStampOut'] = $TimeStampOut;
		$this->Info['TimeLogged'] = $TimeLogged;
	}

	function getInfo()
	{
		return $this->Info;
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
		$this->Info['TimeStampIn'] = new DateTime($s);
	}

	function getTimeStampOut()
	{
		return $this->Info['TimeStampOut'];
	}

	function setTimeStampOut($s)
	{
		$this->Info['TimeStampOut'] = new DateTime($s);
		$this->calculateTimeLogged();
	}

	function getTimeLogged()
	{
		return $this->Info['TimeLogged'];
	}

	function setTimeLogged($s)
	{
		$this->Info['TimeLogged'] = $s;
	}


	function calculateTimeLogged()
	{
		$DateTimeIn = $this->Info['TimeStampIn']; /*= new DateTime($this->Info['TimeStampIn']);*/
		$DateTimeOut = $this->Info['TimeStampOut'];/*= new DateTime($this->Info['TimeStampOut']);*/

		$Difference = $DateTimeIn->diff($DateTimeOut);

		$this->Info['TimeLogged'] = $this->formatTime($Difference);

		return $this->Info['TimeLogged'];
	}

	private static function formatTime($Difference)
	{
		$year = $Difference->y;
		$month = $Difference->m;
		$day = $Difference->d;
		$hour = $Difference->h;
		$minute = $Difference->i;
		$second = $Difference->s;

		while(strlen($year) < 4)
		{
			$year = substr_replace($year, '0', 0, 0);
		}

		while(strlen($month) < 2)
		{
			$month = substr_replace($month, '0', 0, 0);
		}

		while(strlen($day) < 2)
		{
			$day = substr_replace($day, '0', 0, 0);
		}

		while(strlen($hour) < 2)
		{
			$hour = substr_replace($hour, '0', 0, 0);
		}

		while(strlen($minute) < 2)
		{
			$minute = substr_replace($minute, '0', 0, 0);
		}
		while(strlen($second) < 2)
		{
			$second = substr_replace($second, '0', 0, 0);
		}

		$TimeBetween =  $year ."-". $month ."-". $day ." ". $hour .":". $minute .":". $second;

		return $TimeBetween;
	}
}
?>