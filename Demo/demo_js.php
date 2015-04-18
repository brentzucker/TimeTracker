<?php
require_once(__DIR__.'/../include.php');

session_start();

echo '<h1>Demo Javascript Dropdowns</h1>';

echo '<main id="container">';

clientDropDownJS($_SESSION['Developer']);


$client_project_array = clientListToArrayOfProjectLists();

//projectDropDown($_SESSION['Developer'], $_SESSION["$session"]['Client_Selected']);

echo '</main>';
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
	var container = document.querySelector("#container");
	var frag = document.createDocumentFragment();
	var select = document.createElement("select");

	//If Project is in both lists add it as an option (same projectID)
	for(var client_key in client_projects)
		for(var dev_key in developer_projects)
			if(client_key == dev_key)
				select.options.add( new Option( developer_projects[dev_key] , dev_key ) );
			
	frag.appendChild(select);
	container.appendChild(frag);
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