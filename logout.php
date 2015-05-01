<?php
/*
 Name: logout.php
 Description: user logs out and is redirected to index.php
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/9/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input:
 Output:
 Error Handling:
 Modification List:
 4/9/15-Inital code up
 4/18/15-Logout now destroys session
 4/30/15-Moved file to main folder, fixed css/js links
 */

require_once (__DIR__ . '/include.php');

session_start();
session_destroy();

if(isset($_SESSION['Developer']))
{
	header("Location:index.php");
}

?>