<?php
/*
 Name: javascript_functions.php
 Description: sets up the javascript dropdowns
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/20/15,
 Names of files accessed: include.php
 Names of files changed:
 Input:
 Output: dropdowns
 Error Handling:
 Modification List:
 4/20/15-Initial code up
 4/21/15-Updated dropdowns, added classes to buttons and dropdowns
 */

require_once(__DIR__.'/../include.php');
//PHP functions in this folder call javascript functions 

/* Developer > Client
 *
 */

//This function creates a form with javascript dropdowns
function jsFormDeveloperClient()
{
	//Get the javascript functions required
	jsFunctions();

	echo '<form id="ClientProjectTaskForm" action="" method="POST">';

	developerDropDownJS( (new Team($_SESSION['Developer']->getTeam())) );

	clientDropDownJSfromTeamenableButton( (new Team($_SESSION['Developer']->getTeam())) );

	echo '<input type="submit" id="submit_button" class="btn btn-block btn-lg btn-primary" disabled>';
	echo '</form>';
}

function jsUnassignFormDeveloperClient()
{
	//Get the javascript functions required
	jsFunctions();

	echo '<form id="ClientProjectTaskForm" action="" method="POST">';

	developerDropDownJS( (new Team($_SESSION['Developer']->getTeam())) );

	clientDropDownJSunnasignEnableButton();

	echo '<input type="submit" id="submit_button" class="btn btn-block btn-lg btn-primary" disabled>';
	echo '</form>';
}

/* Developer > Client > Project
 *
 */

//This function creates a form with javascript dropdowns
function jsFormDeveloperClientProject()
{
	//Get the javascript functions required
	jsFunctions();

	echo '<form id="ClientProjectTaskForm" action="" method="POST">';

	developerDropDownJS( (new Team($_SESSION['Developer']->getTeam())) );

	clientDropDownJSfromTeam( (new Team($_SESSION['Developer']->getTeam())) );

	projectDropDownJSfromTeamenableButton((new Team($_SESSION['Developer']->getTeam())));

	echo '<input type="submit" id="submit_button" class="btn btn-block btn-lg btn-primary" disabled>';
	echo '</form>';
}

function jsUnassignFormDeveloperClientProject()
{
	//Get the javascript functions required
	jsFunctions();

	echo '<form id="ClientProjectTaskForm" action="" method="POST">';

	developerDropDownJS( (new Team($_SESSION['Developer']->getTeam())) );

	clientDropDownJSunassign();

	projectDropDownJSenableButton();

	echo '<input type="submit" id="submit_button" class="btn btn-block btn-lg btn-primary" disabled>';
	echo '</form>';
}


/* Developer > Client > Project > Task
 *
 */

function jsUnassignFormDeveloperClientProjectTask()
{
	//Get the javascript functions required
	jsFunctions();

	echo '<form id="ClientProjectTaskForm" action="" method="POST">';

	developerDropDownJS( (new Team($_SESSION['Developer']->getTeam())) );

	clientDropDownJSunassign();

	projectDropDownJS();

	taskDropDownJS();

	echo '<input type="submit" id="submit_button" class="btn btn-block btn-lg btn-primary" disabled>';
	echo '</form>';
}

//This function creates a form with javascript dropdowns
function jsFormDeveloperClientProjectTask()
{
	//Get the javascript functions required
	jsFunctions();

	echo '<form id="ClientProjectTaskForm" action="" method="POST">';

	developerDropDownJS( (new Team($_SESSION['Developer']->getTeam())) );

	clientDropDownJSfromTeam( (new Team($_SESSION['Developer']->getTeam())) );

	projectDropDownJSfromTeam((new Team($_SESSION['Developer']->getTeam())));

	taskDropDownJSfromTeamenableButton( (new Team($_SESSION['Developer']->getTeam())) );

	echo '<input type="submit" id="submit_button" class="btn btn-block btn-lg btn-primary" disabled>';
	echo '</form>';
}

/* Client > Project > Task
 * 
 */

//This function creates a form with javascript dropdowns
function jsFormClientProjectTask()
{
	//Get the javascript functions required
	jsFunctions();

	echo '<form id="ClientProjectTaskForm" action="" method="POST">';

	clientDropDownJS($_SESSION['Developer']);

	projectDropDownJS();

	taskDropDownJSsubmit();

	echo '</form>';
}

//This function creates a form with javascript dropdowns
function jsFormClientProjectTaskStartDateEndDate()
{
	//Get the javascript functions required
	jsFunctions();
	
	echo '<form id="ClientProjectTaskForm" action="" method="POST">';

	clientDropDownJS($_SESSION['Developer']);

	projectDropDownJS();

	taskDropDownJS();

	dateSelectorWide();

	echo '<input id="submit_button" type="submit" value="Build Report" class="btn btn-block btn-lg btn-primary" disabled>';
	echo '</form>';
}

//This function creates a form with javascript dropdowns
function jsFormClientProjectTaskButton()
{
	//Get the javascript functions required
	jsFunctions();

	echo '<form id="ClientProjectTaskForm" action="" method="POST">';

	clientDropDownJS($_SESSION['Developer']);

	projectDropDownJS();

	taskDropDownJS();

	echo '<input type="submit" value="submit" id="submit_button" class="btn btn-block btn-lg btn-primary" disabled>';

	echo '</form>';
}

/* Client > Project
 *
 */

//This function creates a form with javascript dropdowns
function jsFormClientProject()
{
	//Get the javascript functions required
	jsFunctions();

	echo '<form id="ClientProjectTaskForm" action="" method="POST">';

	clientDropDownJS($_SESSION['Developer']);

	projectDropDownJSsubmit();

	echo '</form>';
}

//This function creates a form with javascript dropdowns
function jsFormClientProjectStartDateEndDate()
{
	//Get the javascript functions required
	jsFunctions();

	echo '<form id="ClientProjectTaskForm" action="" method="POST">';

	clientDropDownJS($_SESSION['Developer']);

	projectDropDownJSenableButton();

	dateSelectorWide();

	echo '<input id="submit_button" type="submit" value="Build Report" class="btn btn-block btn-lg btn-primary" disabled>';
	echo '</form>';
}

//This function creates a form with javascript dropdowns
function jsFormClientProjectEnableButton()
{
	//Get the javascript functions required
	jsFunctions();

	echo '<form id="ClientProjectTaskForm" action="" method="POST">';

	clientDropDownJS($_SESSION['Developer']);

	projectDropDownJSenableButton();

	echo '<input type="submit" value="submit" id="submit_button" class="btn btn-block btn-lg btn-primary" disabled>';
	echo '</form>';
}

/* Client >
 *
 */

//This function creates a form with javascript dropdowns
function jsFormClient()
{
	//Get the javascript functions required
	jsFunctions();

	echo '<form id="ClientProjectTaskForm" action="" method="POST">';

	clientDropDownJSsubmit($_SESSION['Developer']);

	echo '</form>';
}

//This function creates a form with javascript dropdowns
function jsFormClientStartDateEndDate()
{
	//Get the javascript functions required
	jsFunctions();

	echo '<form id="ClientProjectTaskForm" action="" method="POST">';

	clientDropDownJSenableButton($_SESSION['Developer']);

	dateSelectorWide();

	echo '<input id="submit_button" type="submit" value="Build Report" class="btn btn-block btn-lg btn-primary" disabled>';
	echo '</form>';
}

/* Developer
 *
 */

//This function is like clientDropDown except onchange calls getProjectDropdown() and it has an id of clientDropdown
function developerDropDownJS($Team)
{
	echo '<select id="developerDropdown" onchange="getUnassignClientDropdown()" name="Developer_Selected" class="form-control select select-primary" data-toggle="select">';
	echo '<option value="">Select a Developer</option>';
	foreach($Team->getDeveloperList() as $dev)
		echo '<option value="' . $dev->getUsername() . '">' . $dev->getContact()->getFirstName() . ' ' . $dev->getContact()->getLastName() . '</option>';
	echo '</select>';
}

function developerDropDownJSsubmit($Team)
{
	echo '<select id="developerDropdown" onchange="submitForm()" name="Developer_Selected" class="form-control select select-primary" data-toggle="select">';
	echo '<option value="">Select a Developer</option>';
	foreach($Team->getDeveloperList() as $dev)
		echo '<option value="' . $dev->getUsername() . '">' . $dev->getContact()->getFirstName() . ' ' . $dev->getContact()->getLastName() . '</option>';
	echo '</select>';
}

/* Client 
 *
 */

//This function is like clientDropDown except onchange calls getProjectDropdown() and it has an id of clientDropdown
function clientDropDownJS($Developer)
{
	echo '<select id="clientDropdown" onchange="getProjectDropdown()" name="Client_Selected" class="form-control select select-primary" data-toggle="select">';
	echo '<option value="">Select a Client</option>';
	foreach($Developer->getClientList() as $client)
		echo '<option value="' . $client->getClientname() . '">' . $client->getClientname() . '</option>';
	echo '</select>';
}

//This function is like clientDropDown except onchange calls getProjectDropdown() and it has an id of clientDropdown
function clientDropDownJSsubmit($Developer)
{
	echo '<select id="clientDropdown" onchange="submitForm()" name="Client_Selected" class="form-control select select-primary" data-toggle="select">';
	echo '<option value="">Select a Client</option>';
	foreach($Developer->getClientList() as $client)
		echo '<option value="' . $client->getClientname() . '">' . $client->getClientname() . '</option>';
	echo '</select>';
}

//This function is like clientDropDown except onchange calls getProjectDropdown() and it has an id of clientDropdown
function clientDropDownJSenableButton($Developer)
{
	echo '<select id="clientDropdown" onchange="enableButton()" name="Client_Selected" class="form-control select select-primary" data-toggle="select">';
	echo '<option value="">Select a Client</option>';
	foreach($Developer->getClientList() as $client)
		echo '<option value="' . $client->getClientname() . '">' . $client->getClientname() . '</option>';
	echo '</select>';
}

//This function is like clientDropDown except onchange calls getProjectDropdown() and it has an id of clientDropdown
function clientDropDownJSfromTeamenableButton($Team)
{
	echo '<select id="clientDropdown" onchange="enableButton()" name="Client_Selected" class="form-control select select-primary" data-toggle="select" disabled>';
	echo '<option selected="selected" value="">Select a Client</option>';
	echo '</select>';
}

//This function is like clientDropDown except onchange calls getProjectDropdown() and it has an id of clientDropdown
function clientDropDownJSfromTeam($Team)
{
	echo '<select id="clientDropdown" onchange="getProjectDropdown()" name="Client_Selected" class="form-control select select-primary" data-toggle="select" disabled>';
	echo '<option selected="selected" value="">Select a Client</option>';
	foreach($Team->getClientList() as $client)
		echo '<option value="' . $client->getClientname() . '">' . $client->getClientname() . '</option>';
	echo '</select>';
}
//This function is like clientDropDown except onchange calls getProjectDropdown() and it has an id of clientDropdown
function clientDropDownJSunnasignEnableButton()
{
	echo '<select id="clientDropdown" onchange="enableButton()" name="Client_Selected" class="form-control select select-primary" data-toggle="select" disabled>';
	echo '<option selected="selected" value="">Select a Client</option>';
	echo '</select>';
}

function clientDropDownJSunassign()
{
	echo '<select id="clientDropdown" onchange="getProjectDropdown()" name="Client_Selected" class="form-control select select-primary" data-toggle="select" disabled>';
	echo '<option selected="selected" value="">Select a Client</option>';
	echo '</select>';
}

/* Project Dropdowns
 *
 */

//This function creates the project dropdown with the id of projectDropdown and onchange getTaskDropdown()
function projectDropDownJSsubmit()
{
	echo '<select id="projectDropdown" onchange="submitForm()" name="Project_Selected" class="form-control select select-primary" data-toggle="select" disabled>';
	echo '<option selected="selected" value="">Select a Project</option>';
	echo '</select>';
}

//This function creates the project dropdown with the id of projectDropdown and onchange getTaskDropdown()
function projectDropDownJS()
{
	echo '<select id="projectDropdown" onchange="getTaskDropdown()" name="Project_Selected" class="form-control select select-primary" data-toggle="select" disabled>';
	echo '<option selected="selected" value="">Select a Project</option>';
	echo '</select>';
}

//This function creates the project dropdown with the id of projectDropdown and onchange getTaskDropdown()
function projectDropDownJSenableButton()
{
	echo '<select id="projectDropdown" onchange="enableButton()" name="Project_Selected" class="form-control select select-primary" data-toggle="select" disabled>';
	echo '<option selected="selected" value="">Select a Project</option>';
	echo '</select>';
}

//This function creates the project dropdown with the id of projectDropdown and onchange getTaskDropdown()
function projectDropDownJSfromTeam($Team)
{
	echo '<select id="projectDropdown" onchange="getTaskDropdown()" name="Project_Selected" class="form-control select select-primary" data-toggle="select" disabled>';
	echo '<option selected="selected" value="">Select a Project</option>';
	foreach($Team->getProjectList() as $project)
		echo '<option value="' . $project->getProjectID() . '">' . $project->getProjectName() . '</option>';
	echo '</select>';
}

//This function creates the project dropdown with the id of projectDropdown and onchange getTaskDropdown()
function projectDropDownJSfromTeamenableButton($Team)
{
	echo '<select id="projectDropdown" onchange="enableButton()" name="Project_Selected" class="form-control select select-primary" data-toggle="select" disabled>';
	echo '<option selected="selected" value="">Select a Project</option>';
	foreach($Team->getProjectList() as $project)
		echo '<option value="' . $project->getProjectID() . '">' . $project->getProjectName() . '</option>';
	echo '</select>';
}

function projectDropDownJSunassign()
{
	echo '<select id="projectDropdown" onchange="getUnassignTaskDropdown()" name="Project_Selected" class="form-control select select-primary" data-toggle="select" disabled>';
	echo '<option selected="selected" value="">Select a Project</option>';
	echo '</select>';
}
/* Task Dropdowns
 *
 */

//This function creates the task dropdown with the using the project selected and the developer
function taskDropDownJSsubmit()
{
	echo '<select id="taskDropdown" onchange="submitForm()" name="Task_Selected" class="form-control select select-primary" data-toggle="select" disabled>';
	echo '<option selected="selected" value="">Select a Task</option>';
	echo '</select>';
}

function taskDropDownJS()
{
	echo '<select id="taskDropdown" onchange="enableButton()" name="Task_Selected" class="form-control select select-primary" data-toggle="select" disabled>';
	echo '<option selected="selected" value="">Select a Task</option>';
	echo '</select>';
}

function taskDropDownJSfromTeamenableButton($Team)
{
	echo '<select id="taskDropdown" onchange="enableButton()" name="Task_Selected" class="form-control select select-primary" data-toggle="select" disabled>';
	echo '<option selected="selected" value="">Select a Task</option>';
	foreach($Team->getTaskList() as $task)
		echo '<option value="' . $task->getTaskID() . '">' . $task->getTaskName() . '</option>';
	echo '</select>';
}

/* These functions help with the javascript drop down selectors
 *
 */

//This function echos 3 javascript functions that read php encoded with json
function jsFunctions()
{
	echo '<script>';

	//This function get the developer projects array from php
	echo 'function getDeveloperProjects()';
	echo '{';
				//Get developer project list from php
	echo 	'var developer_projects = ' . json_encode( projectListToArray( $_SESSION["Developer"]->getProjectList() )) . ';';
	echo 	'return developer_projects;';
	echo '}';

	echo 'function getDeveloperTasks()';
	echo '{';
				//Get developer task list from php
	echo 	'var developer_tasks = ' . json_encode( taskListToArray( $_SESSION['Developer']->getTaskList() )) . ';';
	echo 	'return developer_tasks;';
	echo '}';

	//This function gets the array of clients with their projects array from php (clientName => projectArray)
	echo 'function getClientProjects()';
	echo '{';
				//get the clients project lists
	echo 	'var client_project_array = ' . json_encode( clientListToArrayOfProjectLists($_SESSION['Developer']) ) . ';';
	echo 	'return client_project_array;';
	echo '}';

	//This function get the developer projects array from php
	echo 'function getDeveloperList()';
	echo '{';
				//Get developer project list from php
	echo 	'var developer_projects = ' . json_encode( teamListToArrayOfDeveloperLists() ) . ';';
	echo 	'return developer_projects;';
	echo '}';

	echo '</script>';
}

?>