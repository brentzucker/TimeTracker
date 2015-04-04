<?php
require_once(__DIR__.'/../../include.php');

session_start();

//Stores the task selected in the 'currentLog' session variable
if(isset($_POST['Task_Selected']))
	$_SESSION['currentLog']['task'] = $_POST['Task_Selected'];
	
echo '<h1>' . $_SESSION['Developer']->getUsername() . ' is logged in</h1>';

echo '<h2>' . $_SESSION['currentLog']['task'] . ' was selected</h2>';
echo '<h3>Clock In</h3>';

clockForm($_SESSION['Developer'], $_SESSION['currentLog']['task']);

printTimeLogTableByTask($_SESSION['currentLog']['task']);
?>
