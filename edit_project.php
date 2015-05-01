<?php
/*
 Name: edit_project.php
 Description: can edit information about a project that has already been made
 Programmers: Brent Zucker
 Dates: (4/30/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input: client(dropdown), project(dropdown), project name (string), project description (string)
 Output: text stating that the project was edited
 Error Handling:
 Modification List:
 4/30/15-Moved file to main folder, fixed css/js links
 */

require_once(__DIR__.'/include.php');

session_start();

open_html("Edit Project");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';

echo '<h1 class="page-header">Edit Project</h1>';

editProject();

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();
?>