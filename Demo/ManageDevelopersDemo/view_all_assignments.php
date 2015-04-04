<?php
require_once(__DIR__.'/../../include.php');

session_start();

$_SESSION['assign']['task'] = $_POST['Task_Selected'];

newDeveloperAssignments($_SESSION['assign']['developer'], $_SESSION['assign']['task'], 'Task');

//Select Developer
echo "<h2>Manage Developers</h2><h4>" . $_SESSION['assign']['developer'] . " was selected</h4>";

printAssignmentsTable($_SESSION['assign']['developer']);
?>