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

echo '<h2>View All Assignments</h2>';

viewAllAssignments();

close_html();

?>