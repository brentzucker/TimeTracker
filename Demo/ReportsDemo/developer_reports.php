<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>Developer Reports</h1>';

echo '<form action="" method="POST">';

developerDropDown($_SESSION['Developer']);

echo "</form>";

if(isset($_POST['Developer_Selected']))
{
	echo '<h2>' . $_POST['Developer_Selected'] . ' was selected</h2>';
	printAggregatedTimeLogTableByDeveloper($_POST['Developer_Selected']);
	printTimeLogTableByDeveloper($_POST['Developer_Selected']);
}
?>