<!--
Name: Client.php
Description: sets up the data for the Client class, with get/set methods to access data
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

//creates a array with the client's information
class Client
{
	private $Info = array(
		"ClientName"=>"",
		"StartDate"=>"",
		"Contact"=>"",
		"PurchasedHours"=>""
		);
	private $HoursLeft;
	private $Purchases = array();
	private $Projects = array();
	
	function __construct($Clientname)
	{
		$db_entry_Client = returnRowByClient("Client", $Clientname);

		$this->Info['ClientName'] = $db_entry_Client['ClientName'];
		$this->Info['StartDate'] = $db_entry_Client['StartDate'];
		$this->HoursLeft = $db_entry_Client['HoursLeft'];

		$db_entry_Contact = returnRowByClient("ClientContact", $Clientname);

		//fills in the contact part of the array
		$this->Info['Contact'] = new ClientContact(
			 $db_entry_Contact['ClientName'],
			 $db_entry_Contact['Firstname'], 
			 $db_entry_Contact['Lastname'],
			 $db_entry_Contact['Phone'],
			 $db_entry_Contact['Email'],
			 $db_entry_Contact['Address'],
			 $db_entry_Contact['City'],
			 $db_entry_Contact['State']);

		//load client's purchases
		$purchase_rows = returnRowsByClient('ClientPurchases', $this->getClientname() );
		foreach($purchase_rows as $purchase)
			array_push( $this->Purchases , new ClientPurchase( $purchase['PurchaseID'] ));

		$this->calculateTotalPurchasedHours();

		//load client's projects
		$project_rows = returnRowsByClient('Projects', $this->getClientname() );
		foreach($project_rows as $project)
			array_push( $this->Projects, new Projects( $project['ProjectID'] ));
	}
	
	//returns all of the client's information
	function getInfo()
	{	
		return array_merge($this->getClientInfo(), $this->getContact()->getInfo());
	}

	//returns the client's name and start date
	function getClientInfo()
	{
		$client_info = array("ClientName"=>$this->Info['ClientName'], "StartDate"=>$this->Info['StartDate']);
		return $client_info;
	}

	//gets the client's contact array which includes the client's name, first name, last name, phone number, email, physical address, city, state
	function getContact()
	{
		return $this->Info['Contact'];
	}

	//return the client's name
	function getClientname()
	{
		return $this->Info['ClientName'];
	}
	
	//sets the client's name
	function setClientname($s)
	{
		$this->Info['ClientName'] = $s;
		updateTableByClient('Client', 'ClientName', $s, $this->Clientname);
	}

	//gets the date the client joined
	function getStartDate()
	{
		return $this->Info['StartDate'];
	}

	//sets the date the client joined
	function setStartDate($s)
	{
		$this->Info['StartDate'] = $s;
		updateTableByClient('Client', 'StartDate', $s, $this->Clientname);
	}

	//gets the amount of purchased hours in seconds, to later be converted in hours
	function getPurchasedSeconds()
	{
		return $this->Info['PurchasedHours'];
	}
	
	//gets the purchased hours, buy dividing the seconds, in a specificed format
	function getPurchasedHours()
	{
		$hours = $this->Info['PurchasedHours']/3600;
		$minutes = ($this->Info['PurchasedHours']%3600)/60;
		$seconds = (($this->Info['PurchasedHours']%3600)%60)/60;
		return "$hours:$minutes:$seconds";
	}

	//gets the hours lefs
	function getHoursLeft()
	{	
		//make sure HoursLeft is up to date
		$this->HoursLeft = returnRowByClient('Client', $this->getClientname())['HoursLeft'];
		return $this->HoursLeft;
	}


	//add purchased hours in seconds
	function addPurchasedHours($seconds)
	{
		$this->HoursLeft += $seconds;

		//update database
		updateTableByClient('Client', 'HoursLeft', $this->HoursLeft, $this->getClientname());
	}

	//gets the purchase
	function getPurchases()
	{
		return $this->Purchases;
	}

	//gets the projects
	function getProjects()
	{
		return $this->Projects;
	}

	//gets the projects in alphabetical order
	function getProjectByName($ProjectName_)
	{
		foreach($this->Projects as $p)
			if(strcmp($p->getProjectName(), $ProjectName_) == 0)
				return $p;
	}

	//add a project
	function addProject($Project)
	{
		array_push($this->Projects, $Project);
	}
	
	//adds a new project's name and description
	function newProject($ProjectName_, $Description_)
	{
		$Project = new Projects($this->getClientname(), $ProjectName_, $Description_);
		array_push($this->Projects, $Project);
	}

	//
	function PurchaseHours($HoursPurchased, $PurchaseDate)
	{	
		//Store in Database
		$p_id = newClientPurchases($this->getClientname(), $HoursPurchased, $PurchaseDate);

		//Store each purchase in a ClientPurchase Object
		$Client_Purchase = new ClientPurchase($p_id);

		//Add the Purchased hours to HoursPurchased
		$this->addPurchasedHours($Client_Purchase->getHoursPurchased());

		//Push each ClientPurchase object to the Purchases array
		array_push($this->Purchases, $Client_Purchase);

		//Recalculate the TotalPurchasedHours after the new Purchase
		$this->calculateTotalPurchasedHours();
	}

	//calculates purchased hours
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

	//checks to see if the client's are equal by name and start date
	function equals($client2)
	{
		if($this->getClientname() == $client2->getClientname() && $this->getStartDate() == $client2->getStartDate())
			return true;
		else return false;
	}
}
?>