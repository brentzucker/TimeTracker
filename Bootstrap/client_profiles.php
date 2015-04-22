<?php
/*
 Name: client_profiles.php
 Description: calls viewClientProfiles function show the client's information
 Programmers: Brent Zucker
 Dates: (4/20/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: client (dropdown)
 Output: form showing the client's information
 Error Handling:
 Modification List:
 4/20/15-Initial code up
 */

require_once(__DIR__.'/../include.php');

session_start();

open_html("Client Profiles");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-9 main-box">';
echo '<h1>Client Profiles</h1>';

viewClientProfiles();

echo '</div>';
alertBox();
echo '</main>';

close_html();
?>