<?php
require_once(__DIR__.'/../include.php');

session_start();

$_SESSION['currentLog'] = null;
$_SESSION['reports'] = null;
$_SESSION['assign'] = null;
$_SESSION['edit'] = null;

echo '<h1>' . $_SESSION['Developer']->getUsername() . ' is logged in</h1>';

warningExpiringContracts( $_SESSION['Developer']->getDaysExpirationWarning() );
warningLowHours( $_SESSION['Developer']->getHoursLeftWarning() );

echoHomePageLinks();
?>