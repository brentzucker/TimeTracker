<?php
/*
 Name: clock.php
 Description: the user clock in/out and shows the user their time log for that task
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: client (dropdown), project (dropdown), task (dropdown)
 Output: shows a table with the developer's clock in/out information and what task they were working on
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated reports
 4/20/15-Updated button style
 */

require_once(__DIR__.'/../include.php');

session_start();

open_html("Clock In");

echo '<h1>Clock In</h1>';

echo '<h4>' . $_SESSION['Developer']->getUsername() . ' is logged in</h4>';

clock();

close_html();

?>