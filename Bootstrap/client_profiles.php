<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Client Profiles");

echo '<h1>Client Profiles</h1>';

viewClientProfiles();

close_html();
?>