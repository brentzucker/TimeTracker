<?php
class ClientPurchase
{
	private $ClientName;
	private $PurchaseInfo = array(
		"HoursPurchased"=>"",
		"PurchaseDate"=>"",
		"PurchaseID"=>"");

	function __construct($Clientname, $HoursPurchased, $PurchaseDate, $PurchaseID)
	{
		$this->Clientname = $Clientname;
		$this->PurchaseInfo['HoursPurchased'] = $HoursPurchased;
		$this->PurchaseInfo['PurchaseDate'] = $PurchaseDate;
		$this->PurchaseInfo['PurchaseID'] = $PurchaseID;
	}
}
?>