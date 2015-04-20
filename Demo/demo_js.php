<?php
require_once(__DIR__.'/../include.php');

session_start();

echo '<h1>Demo Javascript Dropdowns</h1>';

echo '<main id="container">';

clientDropDownJS($_SESSION['Developer']);

projectDropDownJS();

$client_project_array = clientListToArrayOfProjectLists();

//projectDropDown($_SESSION['Developer'], $_SESSION["$session"]['Client_Selected']);

echo '</main>';

//This function creates the project dropdown with the id of projectDropdown and onchange getTaskDropdown()
function projectDropDownJS()
{
	echo '<select id="projectDropdown" onchange="getTaskDropdown()" name="Project_Selected" disabled>';

	echo '<option selected="selected" value="">Select a Project</option>';
	//foreach($developer->getClientsProjectsAssigned($clientname) as $p)
		//echo '<option value="' . $p->getProjectID() . '">' . $p->getProjectName() . '</option>';

	echo '</select>';
}

?>




<script>

//This function gets the client selection from the client drop down and returns it
function getClientSelection()
{
	var clientDropdown = document.getElementById("clientDropdown");
	var client_selected = clientDropdown.options[clientDropdown.selectedIndex].value;

	return client_selected;
}

//This function get the developer projects array from php
function getDeveloperProjects()
{
	//Get developer project list from php
	var developer_projects = <?php echo json_encode( projectListToArray( $_SESSION['Developer']->getProjectList() ) ); ?>;

	return developer_projects;
}

//This function gets the array of clients with their projects array from php (clientName => projectArray)
function getClientProjects()
{
	//get the clients project lists
	var client_project_array = <?php echo json_encode( clientListToArrayOfProjectLists() ); ?>;

	return client_project_array;
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
				dropdown_elements.push( new Option( developer_projects[dev_key] , dev_key ) );

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

function getProjectDropdown()
{
	var developer_projects = getDeveloperProjects();
	var client_projects = getSelectedProjects();

	createProjectDropdown(developer_projects, client_projects);	
}

/*
//This function loads the data from php into javascript
function loadProjectDropdown()
{
	//get the clients project lists
	var developer_client_project_array = <?php echo json_encode( clientListToArrayOfProjectLists() ); ?>;

	//Get developer project list from php
	var developer_projects = <?php echo json_encode( projectListToArray( $_SESSION['Developer']->getProjectList() ) ); ?>;
	
	//Client Selected from DropDown
	var client_selected = getClientSelection();

	//Select the client selected array
	var client_projects = developer_client_project_array[client_selected];
	
	//Create the Dropdown for the selected data
	createProjectDropdown(developer_projects, client_projects);
	
	/*
	//Print JSON String
	console.log(developer_projects);
	
	console.log("Developer Projects: ");
	//Print associative array
	for(var key in developer_projects)
		console.log( key + " => "+ developer_projects[key] );
	
	console.log("Client Selected Projects: ");
	//Print associative array
	for(var key in client_projects)
		console.log( key + " => "+ client_projects[key] );
	*/
//}




</script>