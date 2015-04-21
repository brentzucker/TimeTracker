<?php
/*
 Name: assign_client.php
 Description: calls assignClient function to assign a client to a developer
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: developer (dropdown), client (dropdown)
 Output: table showing the clients/projects/tasks that the developer is assigned
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated manage developers pages
 */

require_once(__DIR__.'/../include.php');

session_start();

open_html("Assign Client");

echo "<h2>Assign Client</h2>";

assignClient();

close_html();

?>