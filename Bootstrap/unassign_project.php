<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Unassign Project");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-9 main-box">';

echo '<div class="jumbotron">';

echo '<h2 class="page-header">Unassign Project</h2>';

unassignProject();

echo '</div>'; //close jumbotron

echo '</div>';

alertBox();

echo '</main>';

close_html();

?>