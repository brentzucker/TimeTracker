<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Unassign Project");

echo "<h2>Unassign Project</h2>";

unassignProject();

close_html();

?>