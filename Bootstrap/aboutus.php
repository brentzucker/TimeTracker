<?php
/*
 Name: index.php
 Description: if login is correct to to page or load error
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input:
 Output: error message (if login information is incorrect)
 Error Handling: if the user informaltion is incorrect load the error message
 Modification List:
 4/18/15-Initial code up
 4/19/15-Starts session
 */

require_once(__DIR__.'/../include.php');

navigationBarHomePage('About Us');
open_html_no_sidebar('About Time Tracker');

echo '<main id="page-content-wrapper">'; 

echo '<div class="col-lg-1"></div>'; //close centering div'; //centering

echo '<div class="col-lg-10 main-box">';

echo '<div class="jumbotron">';

echo '<h1 class="page-header">About Time Tracker</h1>';


echo '</div>'; //close jumbotron

echo '<div class="col-sm-2"></div>'; //close centering div'; //centering

echo '</div>';

echo '</main>';

close_html_no_sidebar();

?>