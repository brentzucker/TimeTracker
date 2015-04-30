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
require_once (__DIR__.'/PHP/login_config.php');

//Control Class
require_once (__DIR__.'/PHP/ControlClass/Database.php');

//Entity Classes
require_once (__DIR__.'/PHP/EntityClasses/Client.php');
require_once (__DIR__.'/PHP/EntityClasses/ClientContact.php');
require_once (__DIR__.'/PHP/EntityClasses/ClientPurchase.php');
require_once (__DIR__.'/PHP/EntityClasses/Contact.php');
require_once (__DIR__.'/PHP/EntityClasses/Developer.php');
require_once (__DIR__.'/PHP/EntityClasses/Projects.php');
require_once (__DIR__.'/PHP/EntityClasses/Tasks.php');
require_once (__DIR__.'/PHP/EntityClasses/Time.php');
require_once (__DIR__.'/PHP/EntityClasses/SuperUser.php');
require_once (__DIR__.'/PHP/EntityClasses/Team.php');

//Functions Folder
require_once (__DIR__.'/PHP/Functions/page_functions.php');
require_once (__DIR__.'/PHP/Functions/javascript_functions.php');
require_once (__DIR__.'/PHP/Functions/demo_functions.php');
require_once (__DIR__.'/PHP/Functions/bootstrap_functions.php');
require_once (__DIR__.'/PHP/Functions/table_functions.php');
?>