<?php
/*
 Name: create_developer.php
 Description: the user clock in/out and shows the user their time log for that task
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: username(string), password (string), position (dropdown), firstname (string), lastname (string), phone (string), email (string), address (string), city (string), state (dropdown)
 Output: shows text saying the developer was made
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated manage developer pages
 */
require_once(__DIR__.'/../include.php');

session_start();

open_html("Create Developer");

echo '<h2>Create Developer</h2>';

newDeveloperForm($_SESSION['Developer']);

close_html();
?>