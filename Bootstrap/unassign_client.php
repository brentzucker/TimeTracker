<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("unassign_client");

echo "<h2>Unassign Client</h2>";

unassignClient();

close_html();

?>