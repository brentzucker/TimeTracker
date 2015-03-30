<?php
require_once(__DIR__.'/../include.php');

session_start();

$_SESSION['Developer'] = new Developer('b.zucker');

echo '<h1>' . $_SESSION['Developer']->getUsername() . ' is logged in</h1>';
echo '<h3><a href="ClockinDemo/select_client.php">Clock Into Work</a>';
echo '<h3><a href="ReportsDemo/select_report.php">View Reports</a>';
echo '<h3><a href="ManageDevelopersDemo/assign_developer.php">Manage Developers</a>';
?>