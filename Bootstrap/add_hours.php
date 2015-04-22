<?php
/*
Name: add_hours.php
Description: calls addHours function to add hours to a client 
Programmers: Ryan Graessle, Brent Zucker
Dates: (4/18/15, 
Names of files accessed: include.php
Names of files changed:
Input: client (dropdown), number of hours (int), date of purchase (date)
Output: text saying the hours were added
Error Handling:
Modification List:
4/18/15-Initial code up 
4/19/15-Migrated manage client pages
*/

require_once(__DIR__.'/../include.php');

session_start();

open_html("Add Purchased Hours");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-9 main-box">';
echo '<h1>Add Purchased Hours</h1>';

addHours();

echo '</div>';
alertBox();
echo '</main>';

close_html();
?>