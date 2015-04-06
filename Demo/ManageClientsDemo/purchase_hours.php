<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>Add Purchased Hours</h1>';

echo '<h3>Select a Client</h3>';

echo '<form action="" method="POST">';
echo '<label>Hours Purchased:</label>';
echo '<br>';
echo '<input type="number" name="hours_purchased">';
echo '<input type="date" name="purchase_date">';
clientDropDown($_SESSION['Developer']);
echo '</form>';

if(isset($_POST['Client_Selected']) && isset($_POST['hours_purchased']) && isset($_POST['purchase_date']))
{
	echo '<h4>' . $_POST['Client_Selected'] . ' purchase has been accounted for.</h4>';
	$purchase_seconds = $_POST['hours_purchased'] * 3600;
	//Add the purchased hours to the client
	$_SESSION['Developer']->getClient($_POST['Client_Selected'])->PurchaseHours($purchase_seconds, $_POST['purchase_date']);
}
?>