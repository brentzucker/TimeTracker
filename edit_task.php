<?php
/*
 Name: edit_task.php
 Description: can edit information about a task that has already been made
 Programmers: Brent Zucker
 Dates: (4/30/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input: client(dropdown), project(dropdown), task(dropdown), task name (string), task description (string)
 Output: text stating that the task was edited
 Error Handling:
 Modification List:
 4/30/15-Moved file to main folder, fixed css/js links
 */

require_once(__DIR__.'/include.php');

session_start();

open_html("Edit Task");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';

echo '<h1 class="page-header">Edit Task</h1>';

editTask();

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();

?>