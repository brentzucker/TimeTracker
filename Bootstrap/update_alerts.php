<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Update Alerts");

echo '<h1>Update Alerts</h1>';

updateAlertsForm($_SESSION['Developer']);

close_html();
?>