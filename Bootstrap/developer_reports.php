<?php
/*
 Name: developer_reports.php
 Description: shows the report for a certain developer for user-picked dates
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: developer (dropdown), start date (date), end date (date)
 Output: table showing the user's information as well as their timelogs
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated reports
 */

require_once(__DIR__.'/../include.php');

session_start();

open_html("Developer Reports");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-9 main-box">';
echo '<h1>Developer Reports</h1>';

developerReports();

echo '</div>';

alertBox();

echo '</main>';

close_html();
?>