<?php
class ClientPurchase
{
	private $ClientName;
	private $PurchaseInfo = array(
		"HoursPurchased"=>"",
		"PurchaseDate"=>"",
		"PurchaseID"=>"");

	function __construct($Clientname, $PurchaseID, $HoursPurchased, $PurchaseDate)
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
		$this->PurchaseInfo['PurchaseID'] = $s;
	}

	function getHoursPurchased()
	{
		return $this->PurchaseInfo['HoursPurchased'];
	}

	function setHoursPurchased($s)
	{
		$this->PurchaseInfo['HoursPurchased'] = $s;
	}

	function getPurchaseDate()
	{
		return $this->PurchaseInfo['PurchaseDate'];
	}

	function setPurchaseDate($s)
	{
		$this->PurchaseInfo['PurchaseDate'] = $s;
	}
}
?>