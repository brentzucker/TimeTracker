<?php
/*
 Name: edit_timesheet.php
 Description: can edit timesheet information
 Programmers: Brent Zucker
 Dates: (4/30/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input: start date (date), end date (string), date to change (date) or time to change (int)
 Output: text saying the new time and that the information was updated
 Error Handling:
 Modification List:
 4/30/15-Moved file to main folder, fixed css/js links
 */

require_once(__DIR__.'/include.php');

session_start();

open_html("Edit Time Sheet");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';
echo '<div class="jumbotron">';

editTimeSheet();

echo '</div>'; //close jumbotron
echo '</div>';

echo '</main>';

close_html();
?>