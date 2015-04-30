<?php
require_once(__DIR__.'/../../include.php');

session_start();

$_SESSION['assign']['developer'] = $_POST['Task_Selected'];

//Select Developer
echo "<h2>Manage Developers</h2>";

viewAllAssignments();
?>