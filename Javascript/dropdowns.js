
function getDeveloperSelection()
{
	var developerDropdown = document.getElementById("developerDropdown");
	var developer_selected = developerDropdown.options[developerDropdown.selectedIndex].value;

	return developer_selected;
}

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

function createClientDropdown(developer_selected)
{
	var select = document.getElementById("clientDropdown");

	if(developer_selected == 'Select a Developer')
		select.disabled = true;
	else 
		select.disabled = false;
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

function createTeamProjectDropdown(client_selected)
{
	var select = document.getElementById("projectDropdown");

	//If there are no projects from that client disable the dropdown
	if(client_selected == 'Select a Client')
		select.disabled = true;
	else 
		select.disabled = false;
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

function getClientDropdown()
{
	var developer_selected = getDeveloperSelection();

	createClientDropdown(developer_selected);
}

function getTeamProjectDropdown()
{
	var client_selected = getClientSelection();

	createTeamProjectDropdown(client_selected);	
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
	document.getElementById("ClientProjectTaskForm").submit();
}

function enableButton()
{
	var submit_button = document.getElementById('submit_button');
	submit_button.disabled = false;
}

/* Functions for text fields
 *
 */

 function clearField(id)
 {
 	var element = document.getElementById(id);
	if(element.value == 'Project Name' || element.value == 'Description' || element.value == 'Task Name')
		element.value = '';
 }

 function blurField(id)
 {
 	var element = document.getElementById(id);

 	if(element.value == '')
 	{
 		console.log(element.id);
 		if(element.id == 'projectName')
 			element.value = 'Project Name';
 		else if(element.id == 'taskName')
 			element.value = 'Task Name';
 		else if(element.id == 'description')
 			element.value = 'Description';
 	}
 }