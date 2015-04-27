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

open_html_no_sidebar('Time Tracker');

echo '<main id="page-content-wrapper">'; 

echo '<div class="col-sm-2"></div>'; //close centering div'; //centering

echo '<div class="col-sm-8 main-box">';

echo '<div class="jumbotron">';

echo '<h1 class="page-header">Time Tracker</h1>';

echo '<div class="row demo-tiles">';

//Login
echo '<div class="col-sm-4">';
echo '<div class="tile">';
echo '<h3 class="tile-title">Login</h3>';
echo '<a href="login.php">';
echo '<img class="tile-image big-illustration" src="img/icons/svg/clocks.svg" alt="Watches">';
echo '<button class="btn btn-block btn-primary">Login</button>';
echo '</a>';
echo '</div>'; //close tile
echo '</div>';

//Create Account
echo '<div class="col-sm-4">';
echo '<div class="tile">';
echo '<h3 class="tile-title">Create Account</h3>';
echo '<a href="create_team_account.php">';
echo '<img class="tile-image big-illustration" src="img/icons/svg/clipboard.svg" alt="Clipboard">';
echo '<button class="btn btn-block btn-primary">Create Account</button>';
echo '</a>';
echo '</div>'; //close tile
echo '</div>';

//About us
echo '<div class="col-sm-4">';
echo '<div class="tile">';
echo '<h3 class="tile-title">About Us</h3>';
echo '<a href="aboutus.php">';
echo '<img class="tile-image big-illustration" src="img/icons/svg/map.svg" alt="Map">';
echo '<button class="btn btn-block btn-primary">About Us</button>';
echo '</a>';
echo '</div>'; //close tile
echo '</div>';

echo '</div>'; //close row demo-tiles

echo '</div>'; //close jumbotron

echo '<div class="col-sm-2"></div>'; //close centering div'; //centering

echo '</div>';

echo '</main>';

close_html_no_sidebar();

?>