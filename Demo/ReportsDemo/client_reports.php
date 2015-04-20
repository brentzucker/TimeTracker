<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>Client Reports</h1>';

//This function prints out the reports tables for a client
clientReport();
?>