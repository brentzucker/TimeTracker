<?php
require_once 'Database.php';
require_once 'Contact.php';
require_once 'ClientContact.php';

class Client
{
	private $Info = array(
		"ClientName"=>"",
		"StartDate"=>"",
		"Contact"=>"",
		"Purchases"=>"",
		);

	function __construct($Clientname)
	{
		$db_entry_Client = returnRowByClient("Client", $Clientname);

		$this->Info['ClientName'] = $db_entry_Client['ClientName'];
		$this->Info['StartDate'] = $db_entry_Client['StartDate'];

		$db_entry_Contact = returnRowByClient("ClientContact", $Clientname);

		

		$this->Info['Contact'] = new ClientContact(
			 $db_entry_Contact['ClientName'],
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
		return array_merge($this->getClientInfo(), $this->getContact()->getInfo());
	}

	function getClientInfo()
	{
		$client_info = array("ClientName"=>$this->Info['ClientName'], "StartDate"=>$this->Info['StartDate']);
		return $client_info;
	}

	function getContact()
	{
		return $this->Info['Contact'];
	}

	function getClientname()
	{
		return $this->Info['ClientName'];
	}

	function setClientname($s)
	{
		$this->Info['ClientName'] = $s;
		updateTableByClient('Client', 'ClientName', $s, $this->Clientname);
	}

	function getStartDate()
	{
		return $this->Info['StartDate'];
	}

	function setStartDate($s)
	{
		$this->Info['StartDate'] = $s;
		updateTableByClient('Client', 'StartDate', $s, $this->Clientname);
	}
}
?>