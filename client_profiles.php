<?php
/*
 Name: client_profiles.php
 Description: calls viewClientProfiles function show the client's information
 Programmers: Brent Zucker
 Dates: (4/20/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input: client (dropdown)
 Output: form showing the client's information
 Error Handling:
 Modification List:
 4/20/15-Initial code up
 4/21/15-Finished styling
 4/26/15-Reports can be exported to Excel
 4/28/15-Removed alert box
 */

require_once(__DIR__.'/include.php');

session_start();

open_html("Client Profiles");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';
echo '<div class="jumbotron">';
echo '<h1 class="page-header">Client Profiles</h1>';

viewClientProfiles();

echo '</div>'; // close jumbotron
echo '</div>';

echo '</main>';

close_html();
?>