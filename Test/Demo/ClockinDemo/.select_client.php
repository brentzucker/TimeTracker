<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>' . $_SESSION['Developer']->getUsername() . ' is Clocking in</h1>';
echo '<h3>Select a Client</h3>';

echo '<form action="select_project.php" method="POST">';

ClientDropDown($_SESSION['Developer']);

echo '</form>';
?>