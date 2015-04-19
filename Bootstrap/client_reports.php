<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Client Reports");

echo '<h1>Client Reports</h1>';

//Form to select a client, start date, and end date
echo '<form action="" method="POST">';
clientDropDown($_SESSION['Developer']);
dateSelector();
echo "</form>";

//This function prints out the reports tables for a client
clientReport();
close_html();

?>