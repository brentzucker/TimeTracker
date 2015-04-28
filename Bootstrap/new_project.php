<?php
/*
 Name: new_project.php
 Description: creates a new project based off the user-entered information
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: client (dropdown), project name (string), description (string)
 Output: text stating that the new project was created
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated client reports
 4/20/15-Updated purchase hours
*/

require_once(__DIR__.'/../include.php');

session_start();

open_html("New Project");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';

echo '<h1 class="page-header">New Project</h1>';

newProject($_SESSION['Developer']);

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();
?>