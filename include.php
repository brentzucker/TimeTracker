<?php
/*
Name: include.php
Description: has all the files needed for the program in one place
Programmers: Brent Zucker
Dates: (3/12/15, 
Names of files accessed: login_config.php, Database.php, Client.php, ClientContact.php, ClientPurchase.php, Contact.php, Developer.php, Project.php, Tasks.php, Time.php, demo_functions.php
Names of files changed:
Input: 
Output:
Error Handling:
Modification List:
3/12/15-Added entity and control classes to the file
4/1/15-Moved code into the demo_functions file/
4/9/15-Added Super User Entity class
*/

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
require_once (__DIR__.'/EntityClasses/SuperUser.php');
require_once (__DIR__.'/EntityClasses/Team.php');

//Functions Folder
require_once (__DIR__.'/Functions/page_functions.php');
require_once (__DIR__.'/Functions/javascript_functions.php');
require_once (__DIR__.'/Functions/demo_functions.php');
require_once (__DIR__.'/Functions/bootstrap_functions.php');
require_once (__DIR__.'/Functions/table_functions.php');
?>