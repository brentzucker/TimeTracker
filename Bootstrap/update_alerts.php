<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Update Alerts");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-9 main-box">';
echo '<h1>Update Alerts</h1>';

updateAlertsForm($_SESSION['Developer']);

echo '</div>';

alertBox();

echo '</main>';

close_html();
?>