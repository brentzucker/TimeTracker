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
		echo "Username: $username<br>";
		
		$db_entry_Developer = returnDeveloperTable($Username);

		$this->Info['Team'] = $db_entry_Developer['Team'];
		$this->Info['Username'] = $db_entry_Developer['Username'];
		$this->Info['Position'] = $db_entry_Developer['Position'];

		$db_entry_Contact = returnContactTable($Username);

		$this->Info['Contact'] = new Contact($db_entry_Contact['Firstname'], 
											 $db_entry_Contact['Lastname'],
											 $db_entry_Contact['Phone'],
											 $db_entry_Contact['Email'],
											 $db_entry_Contact['Address'],
											 $db_entry_Contact['City'],
											 $db_entry_Contact['State']);
	}
}
?>