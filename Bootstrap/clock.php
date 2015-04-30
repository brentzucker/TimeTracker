<?php
/*
 Name: clock.php
 Description: the user clock in/out and shows the user their time log for that task
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input: client (dropdown), project (dropdown), task (dropdown)
 Output: shows a table with the developer's clock in/out information and what task they were working on
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/19/15-Migrated reports
 4/20/15-Updated button style
 4/21/15-Setup clock
 4/24/15-Styled clock page
 4/28/15-Removed alert box
 */

require_once(__DIR__.'/../include.php');

session_start();

open_html("Clock In");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';

echo '<h1 class="page-header">Clock In</h1>';

echo '<h4>' . $_SESSION['Developer']->getUsername() . ' is logged in</h4>';

clock();

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();

?>