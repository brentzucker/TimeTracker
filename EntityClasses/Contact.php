<?php
/*
Name: Contact.php
Description: creates an array with the developer's contact information and creates get/set methods
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

require_once(__DIR__.'/../include.php');


//creates info array with the contact information of the developer
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

	//gets the developer's contact information array
	function getInfo()
	{
		return $this->Info;
	}

	//gets the developer's first name
	function getFirstname()
	{
		return $this->Info['Firstname'];
	}

	//sets the developer's first name
	function setFirstname($s)
	{
		$this->Info['Firstname'] = $s;
		updateTableByUser('Contact', 'Firstname', $s, $this->Username);
	}

	//gets the developer's last name
	function getLastname()
	{
		return $this->Info['Lastname'];
	}
	
	//sets the developer'slast name
	function setLastname($s)
	{
		$this->Info['Lastname'] = $s;
		updateTableByUser('Contact', 'Lastname', $s, $this->Username);
	}

	//gets the developer's phone number
	function getPhone()
	{
		return $this->Info['Phone'];
	}

	//sets the developer's phone number
	function setPhone($s)
	{
		$this->Info['Phone'] = $s;
		updateTableByUser('Contact', 'Phone', $s, $this->Username);
	}

	//gets the developer's email
	function getEmail()
	{
		return $this->Info['Email'];	
	}

	//sets the developer's email
	function setEmail($s)
	{
		$this->Info['Email'] = $s;
		updateTableByUser('Contact', 'Email', $s, $this->Username);
	}

	//gets the developer's address
	function getAddress()
	{
		return $this->Info['Address'];
	}

	//sets the developer's address
	function setAddress($s)
	{
		$this->Info['Address'] = $s;
		updateTableByUser('Contact', 'Address', $s, $this->Username);
	}

	//gets the developer's city
	function getCity()
	{
		return $this->Info['City'];	
	}

	//sets the developer's city
	function setCity($s)
	{
		$this->Info['City'] = $s;
		updateTableByUser('Contact', 'City', $s, $this->Username);
	}

	//gets the developer's state
	function getState()
	{
		return $this->Info['State'];
	}

	//sets the developer's state
	function setState($s)
	{
		$this->Info['State'] = $s;
		updateTableByUser('Contact', 'State', $s, $this->Username);
	}
}
?>