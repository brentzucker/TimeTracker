<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Delete Client");

echo '<h1>Delete Client</h1>';

deleteClientForm();

close_html();
?>