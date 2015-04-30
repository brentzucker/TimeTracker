<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>New Client</h1>';

newClientForm($_SESSION['Developer']);
?>