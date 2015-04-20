<?php
require_once (__DIR__ . '/../include.php');

session_start();
session_destroy();

if(isset($_SESSION['Developer']))
{
	header("Location:index.php");
}

?>