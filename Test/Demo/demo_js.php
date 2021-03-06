<?php
require_once(__DIR__.'/../include.php');

session_start();

echo '<h1>Demo Javascript Dropdowns</h1>';

echo '<main id="container">';


jsFormClientProjectTask();

if(isset($_POST['Task_Selected']))
	echo $_POST['Client_Selected'] . ' ' . $_POST['Project_Selected'] . ' ' . $_POST['Task_Selected'];

echo '</main>';



?>

<script>
/*
//This function gets the client selection from the client drop down and returns it
function getClientSelection()
{
	var clientDropdown = document.getElementById("clientDropdown");
	var client_selected = clientDropdown.options[clientDropdown.selectedIndex].value;

	return client_selected;
}

function getProjectSelection()
{
	var projectDropdown = document.getElementById("projectDropdown");
	var project_selected = projectDropdown.options[ projectDropdown.selectedIndex ].value;

	return project_selected;
}

function getTaskSelection()
{
	var taskDropdown = document.getElementById("taskDropdown");
	var task_selected = taskDropdown.options[taskDropdown.selectedIndex].value;

	return task_selected;
}
*/

//This function get the developer projects array from php
function getDeveloperProjects()
{
	//Get developer project list from php
	var developer_projects = <?php echo json_encode( projectListToArray( $_SESSION['Developer']->getProjectList() ) ); ?>;

	return developer_projects;
}

function getDeveloperTasks()
{
	//Get developer task list from php
	var developer_tasks = <?php echo json_encode( taskListToArray( $_SESSION['Developer']->getTaskList() ) ); ?>;

	return developer_tasks;
}

//This function gets the array of clients with their projects array from php (clientName => projectArray)
function getClientProjects()
{
	//get the clients project lists
	var client_project_array = <?php echo json_encode( clientListToArrayOfProjectLists($_SESSION['Developer']) ); ?>;

	return client_project_array;
}

/*
function getProjectTasks()
{
	var client_name = getClientSelection();

	var project_name = getProjectSelection();

	//get the clients project lists
	var client_project_array = getClientProjects();

	if(client_project_array[ client_name ][ project_name ] != null)
		return client_project_array[ client_name ][ project_name ][ 'TaskList' ];
	else 
		return null;
}

//This function gets the array of projects that corresponds to the client selected
function getSelectedProjects()
{
	//Client Selected from DropDown
	var client_selected = getClientSelection();

	var client_projects = getClientProjects();

	return client_projects[client_selected];
}

function createProjectDropdown(developer_projects, client_projects)
{
	var select = document.getElementById("projectDropdown");

	//If there are no projects from that client disable the dropdown
	if(client_projects == null)
		select.disabled = true;
	else 
		select.disabled = false;

	//Clear old select options	
	for (var i = select.options.length-1 ; i >=0; i--)
		select.remove(i);

	//This array holds the common elements between the developer and the client selected
	var dropdown_elements = [];

	//If Project is in both lists add it to the dropdown_elements array (same projectID)
	for(var client_key in client_projects)
		for(var dev_key in developer_projects)
			if(client_key == dev_key)
				dropdown_elements.push( new Option( developer_projects[dev_key]['ProjectName'] , dev_key ) );

	//If there are no options in dropdown_elements then disable the dropdown
	if(dropdown_elements.length == 0)
	{
		select.disabled = true;
		select.options.add( new Option ( "No Projects Available",  "") );
	}
	else
	{
		var default_option = (new Option ( "Select a Project",  "")).setAttribute("selected", "selected");
		select.options.add( new Option ( "Select a Project",  "") );

		for(var i=0; i<dropdown_elements.length; i++)
			select.options.add( dropdown_elements[i] );
	}
}

function createTaskDropdown(developer_tasks, project_tasks)
{
	var select = document.getElementById("taskDropdown");

	//If there are no tasks from the project selected disable the dropdown
	if(project_tasks == null)
		select.disabled = true;
	else 
		select.disabled = false;

	//Clear old select options	
	for (var i = select.options.length-1 ; i >=0; i--)
		select.remove(i);

	//This array holds the common elements between the developer and the project selected
	var dropdown_elements = [];

	//If Task is in both lists add it to the dropdown_elements array (same projectID)
	for(var task_key in project_tasks)
		for(var dev_key in developer_tasks)
			if(task_key == dev_key)
				dropdown_elements.push( new Option( developer_tasks[dev_key] , dev_key ) );

	//If there are no options in dropdown_elements then disable the dropdown
	if(dropdown_elements.length == 0)
	{
		select.disabled = true;
		select.options.add( new Option ( "No Tasks Available",  "") );
	}
	else
	{
		var default_option = (new Option ( "Select a Task",  "")).setAttribute("selected", "selected");
		select.options.add( new Option ( "Select a Task",  "") );

		for(var i=0; i<dropdown_elements.length; i++)
			select.options.add( dropdown_elements[i] );
	}
}

function getProjectDropdown()
{
	var developer_projects = getDeveloperProjects();
	var client_projects = getSelectedProjects();

	createProjectDropdown(developer_projects, client_projects);	
}

function getTaskDropdown()
{
	var developer_tasks = getDeveloperTasks();

	var project_tasks = getProjectTasks();

	createTaskDropdown(developer_tasks, project_tasks);
}

function submitForm()
{
	var client_selected = getClientSelection();
	var project_selected = getProjectSelection();
	var task_selected = getTaskSelection();

	document.getElementById("ClientProjectTaskForm").submit();
}
*/

</script>