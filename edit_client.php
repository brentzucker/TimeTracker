<?php
/*
 Name: edit_client.php
 Description: can edit information about a client that has already been made
 Programmers: Brent Zucker
 Dates: (4/30/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input: client(dropdown), first name (string), last name (string), phone (string), email (string), address (string), city (string), state (dropdown)
 Output: text stating that the client's information has been updated
 Error Handling:
 Modification List:
 4/30/15-Moved file to main folder, fixed css/js links
 */

require_once(__DIR__.'/include.php');

session_start();

open_html("Edit Client");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';

echo '<h1 class="page-header">Edit Client</h1>';

editClient();

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();
?>