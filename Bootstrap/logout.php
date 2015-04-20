<?php
/*
 Name: logout.php
 Description: user logs out and is redirected to index.php
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input:
 Output:
 Error Handling:
 Modification List:
 4/18/15-Update logout
 4/20/15-Initial code up
 */

require_once (__DIR__ . '/../include.php');

session_start();
session_destroy();

if(isset($_SESSION['Developer']))
{
	header("Location:index.php");
}

?>