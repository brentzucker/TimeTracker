<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Edit Client");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-9 main-box">';
echo '<h1>Edit Client</h1>';

editClient();

echo '</div>';
alertBox();
echo '</main>';

close_html();
?>