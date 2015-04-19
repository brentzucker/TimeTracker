<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Developer Reports");

echo '<h1>Developer Reports</h1>';

developerReports();

close_html();
?>