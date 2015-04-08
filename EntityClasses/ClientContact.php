<!--
Name: ClientContact.php
Description: creates an array with the client's contact information and creates get/set methods 
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
-->

<?php
require_once(__DIR__.'/../include.php');

//creates and arrya with the client's contact information
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

	//gets the info array
	function getInfo()
	{
		return $this->Info;
	}

	//gets the client's first name 
	function getFirstname()
	{
		return $this->Info['Firstname'];
	}

	//sets the client's first name
	function setFirstname($s)
	{
		$this->Info['Firstname'] = $s;
		updateTableByClient('ClientContact', 'Firstname', $s, $this->Clientname);
	}

	//gets the client's last name
	function getLastname()
	{
		return $this->Info['Lastname'];
	}

	//sets the client's last name
	function setLastname($s)
	{
		$this->Info['Lastname'] = $s;
		updateTableByClient('ClientContact', 'Lastname', $s, $this->Clientname);
	}

	//gets the client's phone number
	function getPhone()
	{
		return $this->Info['Phone'];
	}
	
	//sets the client's phone number
	function setPhone($s)
	{
		$this->Info['Phone'] = $s;
		updateTableByClient('ClientContact', 'Phone', $s, $this->Clientname);
	}

	//gets the client's email
	function getEmail()
	{
		return $this->Info['Email'];	
	}

	//sets the client's email
	function setEmail($s)
	{
		$this->Info['Email'] = $s;
		updateTableByClient('ClientContact', 'Email', $s, $this->Clientname);
	}

	//gets the client's address
	function getAddress()
	{
		return $this->Info['Address'];
	}

	//sets the client's address
	function setAddress($s)
	{
		$this->Info['Address'] = $s;
		updateTableByClient('ClientContact', 'Address', $s, $this->Clientname);
	}

	//gets the client's city
	function getCity()
	{
		return $this->Info['City'];	
	}

	//sets the client's city
	function setCity($s)
	{
		$this->Info['City'] = $s;
		updateTableByClient('ClientContact', 'City', $s, $this->Clientname);
	}
	
	//gets the client's state
	function getState()
	{
		return $this->Info['State'];
	}

	//sets the client's state
	function setState($s)
	{
		$this->Info['State'] = $s;
		updateTableByClient('ClientContact', 'State', $s, $this->Clientname);
	}
}
?>