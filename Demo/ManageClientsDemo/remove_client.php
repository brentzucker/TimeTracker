<?php
require_once(__DIR__.'/../../include.php');

session_start();

delClient("new", $_SESSION['Developer']);
?>