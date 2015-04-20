<?php
/*
 Name: delete_task.php
 Description: the user selects a client, then a project, then a task then deletes it
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input:
 Output: shows text saying the task was deleted
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated manage client pages
 */

require_once(__DIR__.'/../include.php');

session_start();

open_html("Delete Task");

echo '<h1>Delete Task</h1>';

deleteTaskForm();

close_html();
?>