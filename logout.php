<!--
Name: logout.php
Description: unsets variables if signed in, if not logged in the user is prompted to the login page
Programmers: Tyler Land
Dates: (3/9/15, 
Names of files accessed:
Names of files changed:
Input: 
Output: text
Error Handling:
Modification List: 
3/9/15-Initial code up
-->

<?php
if($_SESSION['signed_in'] == true)
{
	//unset all variables
	$_SESSION['signed_in'] = NULL;
	$_SESSION['Username'] = NULL;

	echo 'Succesfully logged out.';
}
else
{
	echo 'You are not logged in. Click <a href="login.php">here</a>? to log in.';
}
?>