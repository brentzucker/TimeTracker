<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>Client Reports</h1>';

echo '<form action="" method="POST">';

clientDropDown($_SESSION['Developer']);

echo "</form>";

if(isset($_POST['Client_Selected']))
{
	echo '<h2>' . $_POST['Client_Selected'] . ' was selected</h2>';

	echo '<h3>Hours Left</h3>';
	printHoursLeftTable($_POST['Client_Selected']);

	echo '<h3>Client\'s Purchases</h3>';
	printClientsPurchasesTable($_POST['Client_Selected']);

	echo '<h3>Developers Hours</h3>';
	printAggregatedTimeLogTableByClient($_POST['Client_Selected']);

	echo '<h3>Detailed Time Sheet</h3>';
	printTimeLogTableByClient($_POST['Client_Selected']);
}
?>