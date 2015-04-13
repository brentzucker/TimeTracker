<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>Project Reports</h1>';

clientProjectDropDownForm('report');

projectReports();
?>