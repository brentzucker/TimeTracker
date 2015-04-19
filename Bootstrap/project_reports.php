<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Project Reports");

echo '<h1>Project Reports</h1>';

clientProjectDropDownForm('report');

projectReports();

close_html();

?>