<?php
/*
 Name: delete_task.php
 Description: the user selects a client, then a project, then a task then deletes it
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input: client (dropdown), project (dropdown), task (dropdown)
 Output: shows text saying the task was deleted
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated manage client pages
 4/30/15-Moved file to main folder, fixed css/js links
 */

require_once(__DIR__.'/include.php');

session_start();

open_html("Delete Task");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';

echo '<h1 class="page-header">Delete Task</h1>';

deleteTaskForm();

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();
?>