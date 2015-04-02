<?php
require_once(__DIR__.'/../include.php');
require_once(__DIR__.'/page_functions.php');

function developerDropDown()
{
	$developers = $_SESSION['Developer']->getDevelopers();

	echo '<select name="Developer_Selected">';
	foreach($developers as $d)
		echo '<option value="' . $d->getUsername() . '">' . $d->getUsername() . '</option>';
	echo '</select>';
	echo '<input type="submit" value="Submit">';
}

session_start();

html_header("Demo Login");

echo "<div id='box'>";

echo "<h2>Developer Reports</h2><h4>Select a Developer</h4>";
echo '<form action="developer_reports.php" method="POST">';


developerDropDown();

echo "</form>";

echo "</div>";

html_footer();
?>