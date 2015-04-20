<?php
//PHP functions in this folder call javascript functions 

//This function creates a form with javascript dropdowns
function jsFormClientProjectTask()
{
	echo '<form id="ClientProjectTaskForm" action="" method="POST">';

	clientDropDownJS($_SESSION['Developer']);

	projectDropDownJS();

	taskDropDownJS();

	echo '</form>';
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

//This function creates the project dropdown with the id of projectDropdown and onchange getTaskDropdown()
function projectDropDownJS()
{
	echo '<select id="projectDropdown" onchange="getTaskDropdown()" name="Project_Selected" disabled>';

	echo '<option selected="selected" value="">Select a Project</option>';

	echo '</select>';
}

//This function creates the task dropdown with the using the project selected and the developer
function taskDropDownJS()
{
	echo '<select id="taskDropdown" onchange="submitForm()" name="Task_Selected" disabled>';

	echo '<option selected="selected" value="">Select a Task</option>';

	echo '</select>';
}

?>