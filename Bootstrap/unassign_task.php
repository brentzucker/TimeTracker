<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Unassign Task");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-9 main-box">';
echo "<h2>Unassign Task</h2>";

unassignTask();

echo '</div>';
alertBox();
echo '</main>';

close_html();

?>