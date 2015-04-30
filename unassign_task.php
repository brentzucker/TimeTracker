<?php
require_once(__DIR__.'/include.php');

session_start();

open_html("Unassign Task");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12 main-box">';

echo '<div class="jumbotron">';
	
echo '<h2 class="page-header">Unassign Task</h2>';

unassignTask();

echo '</div>'; //close jumbotron

echo '</div>';

echo '</main>';

close_html();

?>