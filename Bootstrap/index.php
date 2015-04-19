<?php
require_once(__DIR__.'/../include.php');

session_start();

//If submit has been pressed and its a bad login load the error otherwise load the normal page
if(isset($_POST['submit']))
{
	if(!checkLogin($_POST['username'], $_POST['password']))
	{
		open_login("Login");
		getWrongLoginError();
		close_login();

	}
}
else
{	
	open_login("Login");
	close_login();
}
?>