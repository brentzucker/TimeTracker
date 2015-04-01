<?php

//Database Connection
require_once (__DIR__.'/login_config.php');

//Control Class
require_once (__DIR__.'/ControlClass/Database.php');

//Entity Classes
require_once (__DIR__.'/EntityClasses/Client.php');
require_once (__DIR__.'/EntityClasses/ClientContact.php');
require_once (__DIR__.'/EntityClasses/ClientPurchase.php');
require_once (__DIR__.'/EntityClasses/Contact.php');
require_once (__DIR__.'/EntityClasses/Developer.php');
require_once (__DIR__.'/EntityClasses/Projects.php');
require_once (__DIR__.'/EntityClasses/Tasks.php');
require_once (__DIR__.'/EntityClasses/Time.php');

//Front End Functions
require_once (__DIR__.'/Demo/demo_functions.php');
?>