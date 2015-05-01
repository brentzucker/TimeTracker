<?php
/*
 Name: update_email.php
 Description: lets the user update their email address
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input: email (string)
 Output: text showing the email was updated
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/20/15-Migrated my account pages
 4/30/15-Moved file to main folder, fixed css/js links
 */

require_once(__DIR__.'/include.php');

session_start();

open_html("Update Email");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';
echo '<div class="jumbotron">';
echo '<div class="page-header">';
echo '<h1>Update Email</h1>';
echo '</div>';

updateEmail();

echo '</div>';
echo '</div>';

echo '</main>';

close_html();
?>