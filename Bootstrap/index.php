<?php

require_once(__DIR__.'/../include.php');
require_once(__DIR__.'/page_functions.php');

open_login("Login");

if(isset($_POST['submit']))
{
	checkLogin($_POST['username'], $_POST['password']);
}

close_login();

?>