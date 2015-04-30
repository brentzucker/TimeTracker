<?php
/*
 Name: assign_client.php
 Description: calls assignClient function to assign a client to a developer
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input: developer (dropdown), client (dropdown)
 Output: table showing the clients/projects/tasks that the developer is assigned
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated manage developers pages
 4/21/15-New dropdowns
 4/26/15-Made jumbotron
 4/28/15-Removed alert box
 */

require_once(__DIR__.'/../include.php');

session_start();

open_html("Assign Client");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';

echo '<h2 class="page-header">Assign Client</h2>';

assignClient();

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();
?>