<?php
require_once 'Database.php';
require_once 'Contact.php';
require_once 'Time.php';

class Developer
{
	private $Info = array(
		"Team"=>"",
		"Username"=>"",
		"Position"=>"",
		"Contact"=>"",
		);

	function __construct($Username)
	{
		$db_entry_Developer = returnRow("Developer", $Username);

		$this->Info['Team'] = $db_entry_Developer['Team'];
		$this->Info['Username'] = $db_entry_Developer['Username'];
		$this->Info['Position'] = $db_entry_Developer['Position'];

		$db_entry_Contact = returnRow("Contact", $Username);

		$this->Info['Contact'] = new Contact(
			 $db_entry_Contact['Username'],
			 $db_entry_Contact['Firstname'], 
			 $db_entry_Contact['Lastname'],
			 $db_entry_Contact['Phone'],
			 $db_entry_Contact['Email'],
			 $db_entry_Contact['Address'],
			 $db_entry_Contact['City'],
			 $db_entry_Contact['State']);
	}

	function getInfo()
	{	
		return array_merge($this->getDeveloperInfo(), $this->getContact()->getInfo());
	}

	function getDeveloperInfo()
	{
		$developer_info = array("Team"=>$this->Info['Team'], "Username"=>$this->Info['Username'], "Position"=>$this->Info['Position']);
		return $developer_info;
	}

	function getContact()
	{
		return $this->Info['Contact'];
	}

	function getTeam()
	{
		return $this->Info['Team'];
	}

	function setTeam($s)
	{
		$this->Info['Team'] = $s;
		updateTable('Developer', 'Team', $s, $this->Username);
	}

	function getUsername()
	{
		return $this->Info['Username'];
	}

	function setUsername($s)
	{
		$this->Info['Username'] = $s;
		updateTable('Developer', 'Username', $s, $this->Username);
	}

	function getPosition()
	{
		return $this->Info['Position'];
	}

	function setPosition($s)
	{
		$this->Info['Position'] = $s;
		updateTable('Developer', 'Position', $s, $this->Username);
	}
}
?>