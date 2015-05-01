<?php
/*
 Name: update_alerts.php
 Description: alerts show when a client's contract is ending and how many hours they have on their contract
 Programmers: Brent Zucker
 Dates: (4/30/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input:
 Output: text showing the hours and days until the contract is up
 Error Handling:
 Modification List:
 4/30/15-Moved file to main folder, fixed css/js links
 */

require_once(__DIR__.'/include.php');

session_start();

open_html("Update Alerts");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';
echo '<div class="jumbotron">';
echo '<div class="page-header">';
echo '<h1>Update Alerts</h1>';
echo '</div>';

updateAlertsForm($_SESSION['Developer']);

echo '</div>';
echo '</div>';

echo '</main>';

close_html();
?>