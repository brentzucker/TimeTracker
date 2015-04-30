<?php
/*
 Name: aboutus.php
 Description: the about us page tells users about TimeTracker
 Programmers: Brent Zucker, Ryan Graessle, Tyler Land
 Dates: (4/27/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input:
 Output: text
 Error Handling:
 Modification List:
 4/27/15-Initial code up
 4/28/15-Fixed iPad style
 4/29/15-Menu bar styed
 4/30/15-Added text to the about page
 */

require_once(__DIR__.'/../include.php');

navigationBarHomePage('About Us');
open_html_no_sidebar('About Time Tracker');

echo '<main id="page-content-wrapper">';

echo '<div class="col-lg-1"></div>'; //close centering div'; //centering

echo '<div class="col-lg-10 main-box">';

echo '<div class="jumbotron">';

echo '<h1 class="page-header">About Time Tracker</h1>';
echo '<p>TimeTracker is a web application made for businesses to keep track of their developers, clients and projects they are working on.';

echo '<h3>Clock In/Clock Out</h1>';
echo '<p>TimeTracker&prime;s main feature allows you as a developer to keep track of the amount of time that you spend on a certain project.</p>';

echo '<h3>Make Reports</h1>';
echo '<p>TimeTracker allows you to build reports from time sheets. You can also choose which type of reports ranging from developer to task reports.</p>';

echo '<h3>Manage Clients and Tasks</h1>';
echo '<p>As a developer, you can add, edit or delete your clients, projects and tasks. You can also add hours to a client.</p>';

echo '<h3>Account Customization</h1>';
echo '<p>TimeTracker allows you to customize your account. You can edit your profile infomation that includes your contact information.
You can update your email, password and alert settings. You can also delete your account as you wish.</p>';

echo '</div>'; //close jumbotron

echo '<div class="col-sm-2"></div>'; //close centering div'; //centering

echo '</div>';

echo '</main>';

close_html_no_sidebar();

?>
