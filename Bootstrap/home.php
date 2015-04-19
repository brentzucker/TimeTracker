<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Home");

/*
 * Keep all content in the div #page-content-wrapper
 */
echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-12">';

//Custom Greeting Message
if(localtime(time(), true)['tm_hour'] < 11 && localtime(time(), true)['tm_hour'] > 3)
	echo '<h1>Good Morning ' . $_SESSION['Developer']->getContact()->getFirstname() . '!</h1>';
elseif(localtime(time(), true)['tm_hour'] > 11 && localtime(time(), true)['tm_hour'] < 16)	
	echo '<h1>Good Afternoon ' . $_SESSION['Developer']->getContact()->getFirstname() . '</h1>';
elseif(localtime(time(), true)['tm_hour'] > 16)	
	echo '<h1>Good Evening ' . $_SESSION['Developer']->getContact()->getFirstname() . '</h1>';
else
	echo '<h1>Welcome back ' . $_SESSION['Developer']->getContact()->getFirstname() . '!</h1>';

if(localtime(time(), true)['tm_hour'] > 12)	
	echo '<h5>The current time is ' . localtime(time(), true)['tm_hour'] % 12 . ":" . localtime(time(), true)['tm_min'] . ' pm</h5>';
else 
	echo '<h5>The current time is ' . localtime(time(), true)['tm_hour'] % 12 . ":" . localtime(time(), true)['tm_min'] . ' am</h5>';

//If they have clocked in before
if(count($_SESSION['Developer']->getTimeLog()) > 0)
{
	$last_timeObject = $_SESSION['Developer']->getTimeLog()[ count($_SESSION['Developer']->getTimeLog()) - 1 ];
	echo '<h3>You last clocked out on ' . (new DateTime($last_timeObject->getTimeOut()))->format('l F jS Y') . (new DateTime($last_timeObject->getTimeOut()))->format(' \a\t g:ia') . '.</h3>';
	echo '<h3>You were working on ' . $last_timeObject->getClientname() . ', ' . (new Projects ($last_timeObject->getProjectId()))->getProjectName() . ', ' . (new Tasks ($last_timeObject->getTaskId()))->getTaskName() . '.</h3>';

	//Load Client Profile Page of last clock in
	getClientProfile($last_timeObject->getClientname());
}

echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';    
echo '</main>';

close_html();
?>