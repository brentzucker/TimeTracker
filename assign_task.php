<?php
/*
 Name: assign_task.php
 Description: calls assignTask function to assign a task to a developer
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: developer (dropdown), client (dropdown), project (dropdown), task (dropdown)
 Output: text saying the task was added to the developer
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated manage developers pages
 */

require_once(__DIR__.'/include.php');

session_start();

open_html("Assign Task");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';

echo '<h2 class="page-header">Assign Task</h2>';

assignTask();

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();

?>