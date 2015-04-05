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
	//printAggregatedTimeLogTableByClient($_POST['Client_Selected']);
	printTimeLogTableByClient($_POST['Client_Selected']);
}
?>