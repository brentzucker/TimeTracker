<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo "<h2>Manage Developers</h2>";

//Call in javascript file
$src =  '../../Javascript/dropdowns.js';
echo '<script src="' . $src . '"></script>';

assignClient();
?>