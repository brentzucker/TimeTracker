<?php
/*
Name: ClientPurchase.php
Description: creates an array with the client's purchase information, with get/set methods and constructors 
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

//creates an array with a client's purchase information
class ClientPurchase
{
	private $ClientName;
	private $PurchaseInfo = array(
		"HoursPurchased"=>"",
		"PurchaseDate"=>"",
		"PurchaseID"=>"");

	function __construct()
	{
        $a = func_get_args(); 
        $i = func_num_args(); 

        //calls the constructor with the corresponding number of arguments.
        if (method_exists($this,$f='__construct'.$i)) 
        { 
            call_user_func_array(array($this,$f),$a); 
        } 
	}

	//contructs a row for every time a client purchases hours by the purchaseID
	function __construct1($PurchaseID)
	{
		$Purchase = returnRowByPurchaseID($PurchaseID);

		$this->Clientname = $Purchase['Clientname'];
		$this->PurchaseInfo['PurchaseID'] = $Purchase['PurchaseID'];
		$this->PurchaseInfo['HoursPurchased'] = $Purchase['HoursPurchased'];
		$this->PurchaseInfo['PurchaseDate'] = $Purchase['PurchaseDate'];

	}

	//creates a row using the client and purchase information
	function __construct4($Clientname, $PurchaseID, $HoursPurchased, $PurchaseDate)
	{
		$this->Clientname = $Clientname;
		$this->PurchaseInfo['PurchaseID'] = $PurchaseID;
		$this->PurchaseInfo['HoursPurchased'] = $HoursPurchased;
		$this->PurchaseInfo['PurchaseDate'] = $PurchaseDate;
	}

	//gets the purchase information array
	function getPurchaseInfo()
	{
		return $this->PurchaseInfo;
	}

	//gets the purchase ID
	function getPurchaseID()
	{
		return $this->PurchaseInfo['PurchaseID'];
	}

	//sets the purchase ID
	function setPurchaseID($s)
	{	
		updateTableByClient('ClientPurchases', 'PurchaseID', $s, $ClientName);
		$this->PurchaseInfo['PurchaseID'] = $s;
	}

	//gets the amount of hours purchased
	function getHoursPurchased()
	{
		return $this->PurchaseInfo['HoursPurchased'];
	}

	//gets the amount of hours purchased
	function setHoursPurchased($s)
	{
		updateTableByClient('ClientPurchases', 'HoursPurchased', $s, $ClientName);
		$this->PurchaseInfo['HoursPurchased'] = $s;
	}

	//gets the amount of hours purchased
	function getPurchaseDate()
	{
		return $this->PurchaseInfo['PurchaseDate'];
	}

	//sets purchase date
	function setPurchaseDate($s)
	{
		updateTableByClient('ClientPurchases', 'PurchaseDate', $s, $ClientName);
		$this->PurchaseInfo['PurchaseDate'] = $s;
	}
}
?>