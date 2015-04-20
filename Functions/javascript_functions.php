<?php
require_once(__DIR__.'/../include.php');
//PHP functions in this folder call javascript functions 

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

	echo '<input id="BuildReport" type="submit" value="Build Report" class="btn btn-primary" disabled>';
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

	echo '<input id="BuildReport" type="submit" value="Build Report" class="btn btn-primary" disabled>';
	echo '</form>';
}


/* Client 
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

//This function is like clientDropDown except onchange calls getProjectDropdown() and it has an id of clientDropdown
function clientDropDownJSsubmit($Developer)
{
	echo '<select id="clientDropdown" onchange="submitForm()" name="Client_Selected">';
	echo '<option value="">Select a Client</option>';
	foreach($Developer->getClientList() as $client)
		echo '<option value="' . $client->getClientname() . '">' . $client->getClientname() . '</option>';
	echo '</select>';
}

//This function is like clientDropDown except onchange calls getProjectDropdown() and it has an id of clientDropdown
function clientDropDownJS($Developer)
{
	echo '<select id="clientDropdown" onchange="getProjectDropdown()" name="Client_Selected">';
	echo '<option value="">Select a Client</option>';
	foreach($Developer->getClientList() as $client)
		echo '<option value="' . $client->getClientname() . '">' . $client->getClientname() . '</option>';
	echo '</select>';
}

/* Project Dropdowns
 *
 */

//This function creates the project dropdown with the id of projectDropdown and onchange getTaskDropdown()
function projectDropDownJSsubmit()
{
	echo '<select id="projectDropdown" onchange="submitForm()" name="Project_Selected" disabled>';
	echo '<option selected="selected" value="">Select a Project</option>';
	echo '</select>';
}

//This function creates the project dropdown with the id of projectDropdown and onchange getTaskDropdown()
function projectDropDownJS()
{
	echo '<select id="projectDropdown" onchange="getTaskDropdown()" name="Project_Selected" disabled>';
	echo '<option selected="selected" value="">Select a Project</option>';
	echo '</select>';
}

//This function creates the project dropdown with the id of projectDropdown and onchange getTaskDropdown()
function projectDropDownJSenableButton()
{
	echo '<select id="projectDropdown" onchange="enableBuildReport()" name="Project_Selected" disabled>';
	echo '<option selected="selected" value="">Select a Project</option>';
	echo '</select>';
}

/* Task Dropdowns
 *
 */

//This function creates the task dropdown with the using the project selected and the developer
function taskDropDownJSsubmit()
{
	echo '<select id="taskDropdown" onchange="submitForm()" name="Task_Selected" disabled>';
	echo '<option selected="selected" value="">Select a Task</option>';
	echo '</select>';
}

function taskDropDownJS()
{
	echo '<select id="taskDropdown" onchange="enableBuildReport()" name="Task_Selected" disabled>';
	echo '<option selected="selected" value="">Select a Task</option>';
	echo '</select>';
}

?>