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