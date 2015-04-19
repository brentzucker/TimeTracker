<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("View All Assignments");

echo '<h2>View All Assignments</h2>';

viewAllAssignments();

close_html();

?>