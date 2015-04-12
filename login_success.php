<?php
/*
Name: login_success.php
Description: session starts and let's user know they are logged in
Programmers: Ryan Graessle
Dates: (3/7/15, 
Names of files accessed:
Names of files changed:
Input: 
Output: text
Error Handling:
Modification List: 
3/7/15-Initial code up
*/

session_start();


if(isset($_SESSION['login']))
{
	//header("Location:login.php");
	echo "Logged In";
}

?>