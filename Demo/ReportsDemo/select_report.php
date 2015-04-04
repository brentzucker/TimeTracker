<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo "<h1>Select a Report</h1>";

echo '<h3><a href="developer_reports.php">Developer Reports</a></h3>';
echo '<h3><a href="client_reports.php">Client Reports</a></h3>';
echo '<h3><a href="project_reports.php">Project Reports</a></h3>';
echo '<h3><a href="task_reports.php">Task Reports</a></h3>';
?>