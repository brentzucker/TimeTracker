<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>Task Reports</h1>';

clientProjectTaskDropdownForm('report');

if(isset($_POST['Task_Selected']) || isset($_SESSION['report']['task']))
{
	echo '<h2>' . $_SESSION['report']['task']  . ' was selected</h2>';

	echo '<h3>Developers Hours</h3>';
	printAggregatedTimeLogTableByTask($_SESSION['report']['task']);

	echo '<h3>Detailed Time Sheet</h3>';
	printTimeLogTableByTask($_SESSION['report']['task']);
}
?>