<?php
require_once(__DIR__.'/../include.php');

session_start();

echo '<h1>Edit Time Sheet</h1>';

echo '<form action="" method="POST">';
dateSelector();
echo '<br>';
echo '<input type="submit" value="View Time Sheet">';
echo '</form>';

if((isset($_POST['startdate']) && isset($_POST['enddate'])) || (isset($_SESSION['edit']['startdate']) && isset($_SESSION['edit']['enddate']) ))
{
	if(isset($_POST['startdate']) && isset($_POST['enddate']))
	{
		$_SESSION['edit']['startdate'] = $_POST['startdate'];
		$_SESSION['edit']['enddate'] = $_POST['enddate'];
	}

	echo '<h2>' . $_SESSION['Developer']->getUsername() . '\'s Time Sheet</h2>';

	echo '<form action="" method="POST">';
	editTimeLogTableByDeveloper($_SESSION['Developer']->getUsername(), $_SESSION['edit']['startdate'], $_SESSION['edit']['enddate']);
	echo '<input type="submit" value="Edit Time Sheet">';
	echo '</form>';
}	


if(isset($_POST['TimeLogID']))
{
	echo '<form action="" method="POST">';
	editTimeLogByID($_POST['TimeLogID']);
	echo '<input type="submit" value="Edit Time Log">';
	echo '</form>';
}
	
?>