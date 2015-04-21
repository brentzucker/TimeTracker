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

require_once(__DIR__.'/../include.php');

session_start();

open_html("New Task");

echo '<h1>New Task</h1>';

newTaskForm("new", $_SESSION['Developer']);

close_html();
?>