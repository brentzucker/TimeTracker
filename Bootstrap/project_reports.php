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

echo '<h1>Project Reports</h1>';

projectReports();

close_html();
?>