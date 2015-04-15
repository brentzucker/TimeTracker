<?php
require_once(__DIR__.'/../include.php');

session_start();

$_SESSION['currentLog'] = null;
$_SESSION['reports'] = null;
$_SESSION['assign'] = null;
$_SESSION['edit'] = null;

echo '<h1>' . $_SESSION['Developer']->getUsername() . ' is logged in</h1>';

//If a Client has less than 366 days left on their contract provide a warning
$minimum_days_left_before_warning = 366;
$minimum_hours_left_before_warning = 20;

warningExpiringContracts( $minimum_days_left_before_warning );
warningLowHours( $minimum_hours_left_before_warning );

echoHomePageLinks();

?>