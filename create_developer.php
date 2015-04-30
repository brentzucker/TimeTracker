<?php
/*
 Name: create_developer.php
 Description: the user clock in/out and shows the user their time log for that task
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input: username(string), password (string), position (dropdown), firstname (string), lastname (string), phone (string), email (string), address (string), city (string), state (dropdown)
 Output: shows text saying the developer was made
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated manage developer pages
 4/21/15-Styled page
 4/22/15-Fixed bugs
 4/26/15-Made jumbotron
 4/28/15-Removed alert box
 */
<<<<<<< HEAD:create_developer.php
require_once(__DIR__.'/include.php');
=======

require_once(__DIR__.'/../include.php');
>>>>>>> origin/master:Bootstrap/create_developer.php

session_start();

open_html("Create Developer");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';

echo '<h2 class="page-header">Create Developer</h2>';

newDeveloperPage();

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();
?>