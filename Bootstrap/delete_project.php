<?php
/*
 Name: delete_project.php
 Description: the user selects a client, then a project then deletes it
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: client (dropdown), project (dropdown)
 Output: shows text saying the project was deleted
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated manage client pages
 */

require_once(__DIR__.'/../include.php');

session_start();

open_html("Delete Project");

echo '<h1>Delete Project</h1>';

deleteProjectForm();

close_html();
?>