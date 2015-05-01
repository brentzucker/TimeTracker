<?php
/*
 Name: home.php
 Description: home page for the web application with alerts
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input:
 Output: text greeting the user and alerts
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Shows last login time
 4/20/15-Created footer function
 4/30/15-Moved file to main folder, fixed css/js links
 */

require_once(__DIR__.'/include.php');

session_start();

isLogin();

open_html("Home");

homePage();

close_html();
?>