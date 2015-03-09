<?php
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

        //Calls the constructor with the corresponding number of arguments.
        if (method_exists($this,$f='__construct'.$i)) 
        { 
            call_user_func_array(array($this,$f),$a); 
        } 
	}

	function __construct1($PurchaseID)
	{
		$Purchase = returnRowByPurchaseID($PurchaseID);

		$this->Clientname = $Purchase['Clientname'];
		$this->PurchaseInfo['PurchaseID'] = $Purchase['PurchaseID'];
		$this->PurchaseInfo['HoursPurchased'] = $Purchase['HoursPurchased'];
		$this->PurchaseInfo['PurchaseDate'] = $Purchase['PurchaseDate'];

	}

	function __construct4($Clientname, $PurchaseID, $HoursPurchased, $PurchaseDate)
	{
		$this->Clientname = $Clientname;
		$this->PurchaseInfo['PurchaseID'] = $PurchaseID;
		$this->PurchaseInfo['HoursPurchased'] = $HoursPurchased;
		$this->PurchaseInfo['PurchaseDate'] = $PurchaseDate;
	}

	function getPurchaseInfo()
	{
		return $this->PurchaseInfo;
	}

	function getPurchaseID()
	{
		return $this->PurchaseInfo['PurchaseID'];
	}

	function setPurchaseID($s)
	{	
		updateTableByClient('ClientPurchases', 'PurchaseID', $s, $ClientName);
		$this->PurchaseInfo['PurchaseID'] = $s;
	}

	function getHoursPurchased()
	{
		return $this->PurchaseInfo['HoursPurchased'];
	}

	function setHoursPurchased($s)
	{
		updateTableByClient('ClientPurchases', 'HoursPurchased', $s, $ClientName);
		$this->PurchaseInfo['HoursPurchased'] = $s;
	}

	function getPurchaseDate()
	{
		return $this->PurchaseInfo['PurchaseDate'];
	}

	function setPurchaseDate($s)
	{
		updateTableByClient('ClientPurchases', 'PurchaseDate', $s, $ClientName);
		$this->PurchaseInfo['PurchaseDate'] = $s;
	}
}
?>