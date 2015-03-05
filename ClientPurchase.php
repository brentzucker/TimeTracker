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

	function getHoursPurchased()
	{
		return $this->PurchaseInfo['HoursPurchased'];
	}
}
?>