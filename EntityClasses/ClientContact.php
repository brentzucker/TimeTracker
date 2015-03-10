<?php
class ClientContact
{
	private $Clientname;
	private $Info = array("Firstname"=>"", "Lastname"=>"", "Phone"=>"", "Email"=>"", "Address"=>"", "City"=>"", "State"=>"");

	function __construct($Clientname_, $Firstname_, $Lastname_, $Phone_, $Email_, $Address_, $City_, $State_)
	{
		$this->Clientname = $Clientname_;
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
		updateTableByClient('ClientContact', 'Firstname', $s, $this->Clientname);
	}

	function getLastname()
	{
		return $this->Info['Lastname'];
	}

	function setLastname($s)
	{
		$this->Info['Lastname'] = $s;
		updateTableByClient('ClientContact', 'Lastname', $s, $this->Clientname);
	}

	function getPhone()
	{
		return $this->Info['Phone'];
	}

	function setPhone($s)
	{
		$this->Info['Phone'] = $s;
		updateTableByClient('ClientContact', 'Phone', $s, $this->Clientname);
	}

	function getEmail()
	{
		return $this->Info['Email'];	
	}

	function setEmail($s)
	{
		$this->Info['Email'] = $s;
		updateTableByClient('ClientContact', 'Email', $s, $this->Clientname);
	}

	function getAddress()
	{
		return $this->Info['Address'];
	}

	function setAddress($s)
	{
		$this->Info['Address'] = $s;
		updateTableByClient('ClientContact', 'Address', $s, $this->Clientname);
	}

	function getCity()
	{
		return $this->Info['City'];	
	}

	function setCity($s)
	{
		$this->Info['City'] = $s;
		updateTableByClient('ClientContact', 'City', $s, $this->Clientname);
	}

	function getState()
	{
		return $this->Info['State'];
	}

	function setState($s)
	{
		$this->Info['State'] = $s;
		updateTableByClient('ClientContact', 'State', $s, $this->Clientname);
	}
}
?>