<?
require_once(__DIR__.'/../include.php');

session_start();

open_html("Clock In");

echo '<h1>Clock In</h1>';

echo '<h1>' . $_SESSION['Developer']->getUsername() . ' is logged in</h1>';

clientProjectTaskDropdownForm('currentLog');

if(isset($_POST['Task_Selected']) || isset($_SESSION['currentLog']['task']))
{
	echo '<h2>' . $_SESSION['currentLog']['task']  . ' was selected</h2>';

	echo '<h3>Clock In</h3>';

	clockForm($_SESSION['Developer'], $_SESSION['currentLog']['task']);

	printTimeSheetTableByTask($_SESSION['currentLog']['task']);
}

close_html();

?>