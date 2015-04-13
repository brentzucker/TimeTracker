<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>Edit Client</h1>';

editClientForm($_SESSION['Developer']);
?>