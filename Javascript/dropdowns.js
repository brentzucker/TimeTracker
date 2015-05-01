/*
 Name: dropdow.js
 Description: makes the dropdowns and add their connectivity
 Programmers: Brent Zucker
 Dates: (4/20/15, 5/1/15)
 Names of files accessed:
 Names of files changed:
 Input: 
 Output: disables dropdown if the assignment before it is not available
 Error Handling:
 Modification List:
 4/20/15-Initial code up
 4/21/15-Bug fixes
 4/24/15-New project from JS updated
 */

/* Developer
 *
 */

function getDeveloperSelection()
{
	var developerDropdown = document.getElementById("developerDropdown");
	var developer_selected = developerDropdown.options[developerDropdown.selectedIndex].value;

	return developer_selected;
}

/* Client
 *
 */

//This function gets the client selection from the client drop down and returns it
function getClientSelection()
{
	var clientDropdown = document.getElementById("clientDropdown");
	var client_selected = clientDropdown.options[clientDropdown.selectedIndex].value;

	return client_selected;
}

function createUnassignClientDropdown(developer_selected)
{
	var select = document.getElementById("clientDropdown");

	if(developer_selected == '')
		select.disabled = true;
	else 
		select.disabled = false;

	//Clear old select options	
	for (var i = select.options.length-1 ; i >=0; i--)
		select.remove(i);

	//get the developers clients
	var client_list = getDeveloperList()[developer_selected];

	//If there are no options in client_list then disable the dropdown
	if(client_list.length == 0)
	{
		select.disabled = true;
		select.options.add( new Option("No Clients Available", "") );
	}
	else 
	{
		select.options.add( new Option ( "Select a Client",  "") );

		for(var client in client_list)
			select.options.add( new Option( client, client ) );
	}
}

function getUnassignClientDropdown()
{
	var developer_selected = getDeveloperSelection();

	createUnassignClientDropdown(developer_selected);
}

function createAssignClientDropdown(developer_selected)
{
	var select = document.getElementById('clientDropdown');

	if(developer_selected == 'Select a Developer')
		select.disabled = true;
	else
		select.disabled = false;

	//Clear old select options	
	for (var i = select.options.length-1 ; i >=0; i--)
		select.remove(i);

	var client_list = getAllClients();

	//If there are no options in client_list then disable the dropdown
	if(client_list.length == 0)
	{
		select.disabled = true;
		select.options.add( new Option("No Clients Available", "") );
	}
	else 
	{
		select.options.add( new Option ( "Select a Client",  "") );

		for(var client in client_list)
			select.options.add( new Option( client, client ) );
	}
}

function getAssignClientDropdown()
{
	var developer_selected = getDeveloperSelection();

	createAssignClientDropdown(developer_selected);
}

/* Project
 *
 */

function getProjectSelection()
{
	var projectDropdown = document.getElementById("projectDropdown");
	var project_selected = projectDropdown.options[ projectDropdown.selectedIndex ].value;

	return project_selected;
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

function createUnassignProjectDropdown(developer_selected, client_selected)
{
	var select = document.getElementById("projectDropdown");

	if(developer_selected == '')
		select.disabled = true;
	else 
		select.disabled = false;

	//Clear old select options	
	for (var i = select.options.length-1 ; i >=0; i--)
		select.remove(i);

	var client_list = getDeveloperList()[developer_selected];

	console.log(client_list);

	var project_list = client_list[ client_selected ];

	console.log(project_list);

	if(project_list.length == 0)
	{
		select.disabled = true;
		select.options.add( new Option("No Projects Available", "") );
	}
	else 
	{
		select.options.add( new Option ( "Select a Project",  "") );

		for(var project in project_list)
			select.options.add( new Option( project_list[ project ]['ProjectName'] , project ) );			
	}
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

function getUnassignProjectDropdown()
{
	var developer_selected = getDeveloperSelection();
	var client_selected = getClientSelection();

	createUnassignProjectDropdown(developer_selected, client_selected);	
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

function createAssignProjectDropdown(client_selected, project_list)
{
	var select = document.getElementById("projectDropdown");

	//If there are no projects from that client disable the dropdown
	if(client_selected.length == 0)
		select.disabled = true;
	else 
		select.disabled = false;

	//Clear old select options	
	for (var i = select.options.length-1 ; i >=0; i--)
		select.remove(i);

	if(project_list.length == 0)
	{
		select.disabled = true;
		select.add( new Option("No Projects Available", "") );
	}
	else
	{
		select.add( new Option("Select a Project", "") );
		for(var project in project_list)
			select.add( new Option(project_list[project]['ProjectName'], project) );
	}
}

function getAssignProjectDropdown()
{
	var client_selected = getClientSelection();

	var project_list = getAllClients()[client_selected];

	createAssignProjectDropdown(client_selected, project_list);
}

//This function gets the array of projects that corresponds to the client selected
function getSelectedProjects()
{
	//Client Selected from DropDown
	var client_selected = getClientSelection();

	var client_projects = getClientProjects();

	return client_projects[client_selected];
}

/* Task
 *
 */

function getTaskSelection()
{
	var taskDropdown = document.getElementById("taskDropdown");
	var task_selected = taskDropdown.options[taskDropdown.selectedIndex].value;

	return task_selected;
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

function getTaskDropdown()
{
	var developer_tasks = getDeveloperTasks();

	var project_tasks = getProjectTasks();

	createTaskDropdown(developer_tasks, project_tasks);
}

function createAssignTaskDropdown(project_selected, task_list)
{
	var select = document.getElementById("taskDropdown");

	//If there are no projects from that client disable the dropdown
	if(project_selected.length == 0)
		select.disabled = true;
	else 
		select.disabled = false;

	//Clear old select options	
	for (var i = select.options.length-1 ; i >=0; i--)
		select.remove(i);

	if(task_list.length == 0)
	{
		select.disabled = true;
		select.add( new Option("No Tasks Available", "") );
	}
	else
	{
		select.add( new Option("Select a Task", "") );
		for(var task in task_list)
			select.add( new Option(task_list[task], task) );
	}
}

function getAssignTaskDropdown()
{
	var client_selected = getClientSelection();
	var project_selected = getProjectSelection();

	if(client_selected.length != 0 && project_selected.length != 0)
		var task_list = getAllClients()[client_selected][project_selected]['TaskList'];
	else 
		var task_list = [];

	createAssignTaskDropdown(project_selected, task_list);
}

/* Other Javascript
 *
 */

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
	if(element.value == 'Project Name' || element.value == 'Description' || element.value == 'Task Name' || element.value == 'Client Name')
		element.value = '';
 }

 function blurField(id, text)
 {
 	var element = document.getElementById(id);

 	if(element.value == '')
 		element.value = text;
 }