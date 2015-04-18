<?php

require_once(__DIR__.'/../include.php');
require_once(__DIR__.'/page_functions.php');

if(isset($_POST['submit']))
{
	checkLogin($_POST['username'], $_POST['password']);
}

open_login("Login");
close_login();

?>