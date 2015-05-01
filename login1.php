<?php
/*
 Name: login.php
 Description: if login is correct to to page or load error
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input:
 Output: error message (if login information is incorrect)
 Error Handling: if the user informaltion is incorrect load the error message
 Modification List:
 4/18/15-Initial code up
 4/19/15-Starts session
 */

require_once(__DIR__.'/include.php');

session_start();

//If submit has been pressed and its a bad login load the error otherwise load the normal page
if(isset($_POST['submit']))
{
	if(!checkLogin($_POST['username'], $_POST['password']))
	{
		open_login("Login");
		getWrongLoginError();
		echo '</div>';
		close_login();
	}
}
else
{	
	open_login("Login");
	close_login();
}
?>