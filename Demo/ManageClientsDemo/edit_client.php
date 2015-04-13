<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>Edit Client</h1>';

echo '<form action="" method="POST">';
echo '<h2>Select a Client</h2>';
clientDropDown($developer);
echo '</form>';

$client = $_POST['Client_Selected'];

editClientForm($_SESSION['Developer'], $client);
?>