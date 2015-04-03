<?php
require_once(__DIR__.'/../../include.php');

session_start();

//Stores the client selected in the 'assign' session variable
$_SESSION['assign']['client'] = $_POST['Client_Selected'];

echo "<h2>Manage Developers</h2><h4>Select a Project</h4>";

echo '<form action="assign_task.php" method="POST">';
projectDropDown($_SESSION['Developer'], $_POST['Client_Selected']);
echo '</form>';
?>