<?php
/*
 Name: unassign_project.php
 Description: a project can be unassigned from a developer
 Programmers: Brent Zucker
 Dates: (4/30/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input: developer(dropdown), client(dropdown), project(dropdown)
 Output: text saying the project was unassigned
 Error Handling:
 Modification List:
 4/30/15-Moved file to main folder, fixed css/js links
 */

require_once(__DIR__.'/include.php');

session_start();

open_html("Unassign Project");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';

echo '<h2 class="page-header">Unassign Project</h2>';

unassignProject();

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();

?>