<?php
require_once(__DIR__.'/../include.php');

session_start();

if(isset($_POST['Developer_Selected']))
{
	$_SESSION['Developer'] = new Developer($_POST['Developer_Selected']);
	header('Location: home.php');
}

$_SESSION['SuperUser'] = new SuperUser();

echo '<h1>Login</h1>';
echo '<form action="" method="POST">';
developerDropDown($_SESSION['SuperUser']);
echo '</form>';

?>