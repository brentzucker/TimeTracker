<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Edit Time Sheet");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-9 main-box">';
echo '<div class="jumbotron">';

editTimeSheet();

echo '</div>'; //close jumbotron
echo '</div>';
alertBox();
echo '</main>';

close_html();
?>