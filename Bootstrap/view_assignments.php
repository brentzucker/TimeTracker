<?php
/*
 Name: view_assignments.php
 Description: shows the clients/projects/tasks the developer is assigned to
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: developer (dropdown)
 Output: table showing the clients/projects/tasks that the developer is assigned
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated manage developers pages
 */

require_once(__DIR__.'/../include.php');

session_start();

open_html("View All Assignments");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';

echo '<h2 class="page-header">View All Assignments</h2>';

viewAllAssignments();

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();

?>