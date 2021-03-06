<?php
/*
 Name: delete_client.php
 Description: the user selects then deletes the client
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input: client (dropdown)
 Output: shows text saying the client was deleted
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated manage client pages
 4/30/15-Moved file to main folder, fixed css/js links
 */

require_once(__DIR__.'/include.php');

session_start();

open_html("Delete Client");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';

echo '<h1 class="page-header">Delete Client</h1>';

deleteClientForm();

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();
?>