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

echo '<h1>Client Profiles</h1>';

viewClientProfiles();

close_html();
?>