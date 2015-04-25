<?php
/*
 Name: project_reports.php
 Description: shows the report for a certain project for user-picked dates
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: client (dropdown), project (dropdown), start date (date), end date (date)
 Output: table showing the user/task/time information for the project
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated reports
 4/20/15-Updated JavaScript
 */

require_once(__DIR__.'/../include.php');

session_start();

open_html("Project Reports");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-9 main-box">';
echo '<div class="jumbotron">';
echo '<div class="page-header">';
echo '<h1>Project Reports</h1>';
echo '</div>';

projectReports();

echo '</div>';
echo '</div>';

alertBox();

echo '</main>';

close_html();
?>