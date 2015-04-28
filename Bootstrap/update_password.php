<?php
/*
 Name: update_password.php
 Description: lets the user update their password
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: password (string)
 Output: text showing the password has been updated
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/20/15-Migrated my account pages
 */

require_once(__DIR__.'/../include.php');

session_start();

open_html("Update Password");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';
echo '<div class="jumbotron">';
echo '<div class="page-header">';
echo '<h1>Update Password</h1>';
echo '</div>';

updatePassword();

echo '</div>';
echo '</div>';

echo '</main>';

close_html();
?>