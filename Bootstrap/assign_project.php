<?php
/*
 Name: assign_project.php
 Description: calls assignProject function to assign a client to a developer
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: developer (dropdown), client (dropdown), project (dropdown)
 Output: text saying the project was added to the developer
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated manage developers pages
 */

require_once(__DIR__.'/../include.php');

session_start();

open_html("Assign Project");

echo "<h1>Assign a Project</h1>";

assignProject();

close_html();

?>