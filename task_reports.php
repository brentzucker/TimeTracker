<?php
/*
 Name: task_reports.php
 Description: shows the report for a certain task for user-picked dates
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: client (dropdown), project (dropdown), task (dropdown), start date (date), end date (date)
 Output: table showing the user/task/time information for the task
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated reports
 4/20/15-Removed extra form
 */

require_once(__DIR__.'/include.php');

session_start();

if(isset($_POST['selected']) && isset($_POST['toExcel']))
{
	if($_POST['report'] == 'AggregatedTimeLogTableByTask')
		printAggregatedTimeLogTableByTask($_POST['selected'], $_POST['startdate'], $_POST['enddate'], 'csv');
	elseif($_POST['report'] == 'TimeSheet')
		printTimeLogTableByTask($_POST['selected'], $_POST['startdate'], $_POST['enddate'], 'csv');
}

open_html("Task Reports");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';
echo '<div class="jumbotron">';
echo '<div class="page-header">';
echo '<h1>Task Reports</h1>';
echo '</div>';

taskReports();

echo '</div>';
echo '</div>';

echo '</main>';

close_html();
?>