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
 4/21/15-New dropdowns
 4/26/15-Made jumbotron
 4/28/15-Removed alert box
 */

require_once(__DIR__.'/include.php');

session_start();

open_html("Assign Project");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';

echo '<h1 class="page-header">Assign a Project</h1>';

assignProject();

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();

?>