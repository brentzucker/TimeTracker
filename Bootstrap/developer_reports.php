<?php
require_once(__DIR__.'/../include.php');

open_html("Developer Reports");

session_start();

echo '<h1>Developer Reports</h1>';

developerReports();

close_html();
?>