<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Update Alerts");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-9 main-box">';
echo '<div class="jumbotron">';
echo '<div class="page-header">';
echo '<h1>Update Alerts</h1>';
echo '</div>';

updateAlertsForm($_SESSION['Developer']);

echo '</div>';
echo '</div>';

alertBox();

echo '</main>';

close_html();
?>