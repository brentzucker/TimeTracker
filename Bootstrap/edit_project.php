<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Edit Project");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-9 main-box">';
echo '<h1>Edit Project</h1>';

editProject();

echo '</div>';
alertBox();
echo '</main>';

close_html();
?>