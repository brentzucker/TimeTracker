<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Edit Project");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';

echo '<h1 class="page-header">Edit Project</h1>';

editProject();

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();
?>