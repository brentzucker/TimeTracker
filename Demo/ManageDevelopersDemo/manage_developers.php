<?php
require_once(__DIR__.'/../../include.php');

session_start();

$_SESSION['assign'] = null;

echoManageDevelopersLinks();
?>