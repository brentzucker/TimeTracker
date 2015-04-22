<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("unassign_client");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-9 main-box">';
echo "<h2>Unassign Client</h2>";

unassignClient();

echo '</div>';
alertBox();
echo '</main>';

close_html();

?>