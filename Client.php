<?php
require_once 'Database.php';
require_once 'Contact.php';
require_once 'ClientContact.php';
require_once 'ClientPurchase.php';
require_once 'Projects.php';

class Client
{
	private $Info = array(
		"ClientName"=>"",
		"StartDate"=>"",
		"Contact"=>"",
		"PurchasedHours"=>"",
		);
	private $Purchases = array();
	private $Projects = array();

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

	function getPurchasedHours()
	{
		$hours = $this->Info['PurchasedHours']/3600;
		$minutes = ($this->Info['PurchasedHours']%3600)/60;
		$seconds = (($this->Info['PurchasedHours']%3600)%60)/60;
		return "$hours:$minutes:$seconds";
	}

	function getProjects()
	{
		return $this->Projects;
	}

	function getProjectByName($ProjectName_)
	{
		foreach($this->Projects as $p)
			if(strcmp($p->getProjectName(), $ProjectName_) == 0)
				return $p;
	}

	function addProject($Project)
	{
		array_push($this->Projects, $Project);
	}

	function newProject($ProjectName_, $Description_)
	{
		$Project = new Projects($this->getClientname(), $ProjectName_, $Description_);
		array_push($this->Projects, $Project);
	}

	function PurchaseHours($PurchaseID, $HoursPurchased, $PurchaseDate)
	{	
		//Store each purchase in a ClientPurchase Object
		$Client_Purchase = new ClientPurchase($this->getClientname(), $PurchaseID, $HoursPurchased, $PurchaseDate);

		//Push each ClientPurchase object to the Purchases array
		array_push($this->Purchases, $Client_Purchase);
	}

	function calculateTotalPurchasedHours()
	{
		//Reset total hours count
		$this->Info['PurchasedHours'] = 0;
		
		foreach($this->Purchases as $Purchase)
		{
			//echo "p ".$Purchase->getHoursPurchased()->format('Y-m-d H:i:s') . " hours<br>";
			$this->Info['PurchasedHours'] += $Purchase->getHoursPurchased();
		}
	}
}
?>