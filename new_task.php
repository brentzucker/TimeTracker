<?php
/*
 Name: new_task.php
 Description: creates a new task based off the user-entered information
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: client (dropdown), project (downdown), task name (string), description (string)
 Output: text stating that the new task was created
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated client reports
 */

require_once(__DIR__.'/include.php');

session_start();

open_html("New Task");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';

echo '<h1 class="page-header">New Task</h1>';

newTask($_SESSION['Developer']);

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();
?>