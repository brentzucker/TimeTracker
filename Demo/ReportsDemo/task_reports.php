<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>Task Reports</h1>';

clientProjectTaskDropdownForm('report');

taskReports();
?>