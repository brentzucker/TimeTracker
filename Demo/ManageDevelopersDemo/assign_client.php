<?php
require_once(__DIR__.'/../../include.php');

session_start();

//Stores the developer selected in the 'assign' session variable
$_SESSION['assign']['developer'] = $_POST['Developer_Selected'];

echo "<h2>Manage Developers</h2><h4>Select a Client</h4>";
echo '<form action="assign_project.php" method="POST">';
clientDropDown($_SESSION['Developer']);
echo '</form>';
?>