<?php
require_once(__DIR__.'/../include.php');

class Contact
{
	private $Username;
	private $Info = array("Firstname"=>"", "Lastname"=>"", "Phone"=>"", "Email"=>"", "Address"=>"", "City"=>"", "State"=>"");

	function __construct($Username_, $Firstname_, $Lastname_, $Phone_, $Email_, $Address_, $City_, $State_)
	{
		$this->Username = $Username_;
		$this->Info['Firstname'] = $Firstname_;
	 	$this->Info['Lastname'] = $Lastname_;
	 	$this->Info['Phone'] = $Phone_;
	 	$this->Info['Email'] = $Email_;
	 	$this->Info['Address'] = $Address_;
	 	$this->Info['City'] = $City_;
	 	$this->Info['State'] = $State_;
	}

	function getInfo()
	{
		return $this->Info;
	}

	function getFirstname()
	{
		return $this->Info['Firstname'];
	}

	function setFirstname($s)
	{
		$this->Info['Firstname'] = $s;
		updateTableByUser('Contact', 'Firstname', $s, $this->Username);
	}

	function getLastname()
	{
		return $this->Info['Lastname'];
	}

	function setLastname($s)
	{
		$this->Info['Lastname'] = $s;
		updateTableByUser('Contact', 'Lastname', $s, $this->Username);
	}

	function getPhone()
	{
		return $this->Info['Phone'];
	}

	function setPhone($s)
	{
		$this->Info['Phone'] = $s;
		updateTableByUser('Contact', 'Phone', $s, $this->Username);
	}

	function getEmail()
	{
		return $this->Info['Email'];	
	}

	function setEmail($s)
	{
		$this->Info['Email'] = $s;
		updateTableByUser('Contact', 'Email', $s, $this->Username);
	}

	function getAddress()
	{
		return $this->Info['Address'];
	}

	function setAddress($s)
	{
		$this->Info['Address'] = $s;
		updateTableByUser('Contact', 'Address', $s, $this->Username);
	}

	function getCity()
	{
		return $this->Info['City'];	
	}

	function setCity($s)
	{
		$this->Info['City'] = $s;
		updateTableByUser('Contact', 'City', $s, $this->Username);
	}

	function getState()
	{
		return $this->Info['State'];
	}

	function setState($s)
	{
		$this->Info['State'] = $s;
		updateTableByUser('Contact', 'State', $s, $this->Username);
	}
}
?>