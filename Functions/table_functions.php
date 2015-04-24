<?php
require_once(__DIR__.'/../include.php');

/* Print table functions
 *
 */

//This function consumes a query and table headers and prints out the results in a table
function printTableHeaders($table_headers)
{
	echo '<tr>';
	foreach($table_headers as $t_h)
		echo '<th>' . $t_h . '</th>';
	echo '</tr>';
}

function printTable($query, $table_headers)
{
	echo '<table class="table table-hover table-condensed table-bordered" style="text-align:left;">';

	printTableHeaders($table_headers);

	if($result = db_query($query))
	{
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			echo '<tr>';
			foreach($row as $column=>$value)
					echo '<td>' . $row[$column] . '</td>';
			echo '</tr>';
		}
	}
	echo '</table>';
	mysqli_free_result($result);
}

function printTableTimeSheet($query, $table_headers)
{
	echo '<table class="table table-hover table-condensed table-bordered" style="text-align:left;">';

	printTableHeaders($table_headers);

	if($result = db_query($query))
	{
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			//Change the color of the row when clocking in
			if($row['TimeOut'] == '0000-00-00 00:00:00')
				echo '<tr class="success">';
			elseif(substr($row['TimeOut'], 11, 5) == (localtime(time(), true)['tm_hour'] . ':' . localtime(time(), true)['tm_min']) )
				echo '<tr class="info">';
			else
				echo '<tr>';
			foreach($row as $column=>$value)
				if($column == 'TimeIn' || $column == 'TimeOut') //Remove the date from the time
					echo '<td>' . substr($row[$column], 11, 5) . '</td>';
				else
					echo '<td>' . $row[$column] . '</td>';
			echo '</tr>';
		}
	}
	echo '</table>';
	mysqli_free_result($result);
}


//This function consumes a taskid and echos the timeLog table for the specific task. Displays by TimeLogID Descending and limits 10 results
function printTimeSheetTableByTask($task)
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, p.ProjectName, Tasks.TaskName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t, Projects p, Tasks WHERE (t.TaskID=Tasks.TaskID) AND (t.ProjectID = p.ProjectID AND t.ProjectID = Tasks.ProjectID) AND t.TaskID=" . $task . " ORDER BY TimeLogID DESC LIMIT 10";

	$table_headers = array('ID', 'Username', 'Client', 'Project', 'Task', 'Time In', 'Time Out', 'Total');

	printTableTimeSheet($query, $table_headers);
}

//This function consumes a develper username and echos the timeLog table for the specific developer
function printTimeLogTableByDeveloper($developer, $startdate, $enddate)
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, t.ProjectID, p.ProjectName, t.TaskID, Tasks.TaskName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t, Projects p, Tasks WHERE (t.TaskID=Tasks.TaskID) AND (t.TimeIn BETWEEN '$startdate' AND '$enddate') AND (t.ProjectID = p.ProjectID AND t.ProjectID = Tasks.ProjectID) AND t.Username='" . $developer ."'";

	$table_headers = array('TimeLogID', 'Username', 'Client', 'ProjectID', 'Project Name', 'TaskID', 'Task Name', 'Time In', 'Time Out', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a developer username and echos an aggregated view of the TimeSheet table with a sum of timespent and grouped by client names
function printAggregatedTimeLogTableByDeveloper($developer, $startdate, $enddate)
{
	$query = "SELECT t.Username, t.ClientName, SUM(t.TimeSpent) FROM TimeSheet t WHERE (t.TimeIn BETWEEN '$startdate' AND '$enddate') AND t.Username='" . $developer ."'GROUP BY t.ClientName";

	$table_headers = array('Username', 'Client', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a client name and echos the timeLog table for the specific developer
function printTimeLogTableByClient($client, $startdate, $enddate)
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t WHERE (t.TimeIn BETWEEN '$startdate' AND '$enddate') AND t.ClientName='" . $client ."'";

	$table_headers = array('TimeLogID', 'Username', 'Client', 'Time in', 'Time Out', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a client name and echos an aggregated view of the TimeSheet table with a sum of timespent and grouped by client names
function printAggregatedTimeLogTableByClient($client, $startdate, $enddate)
{
	if($startdate != 0 && $endate != 0)
		$query = "SELECT t.ClientName, t.Username, SUM(t.TimeSpent) FROM TimeSheet t WHERE (t.TimeIn BETWEEN '$startdate' AND '$enddate') AND t.ClientName='" . $client ."'GROUP BY t.Username";
	else
		$query = "SELECT t.ClientName, t.Username, SUM(t.TimeSpent) FROM TimeSheet t WHERE t.ClientName='" . $client ."'GROUP BY t.Username";

	$table_headers = array('Client', 'Username', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a projectid and echos an aggregated view of the TimeSheet table with a sum of timespent and grouped by developers names
function printAggregatedTimeLogTableByProject($project, $startdate, $enddate)
{
	$query = "SELECT t.ClientName, p.ProjectName , t.Username, SUM(t.TimeSpent) FROM TimeSheet t, Projects p WHERE (t.TimeIn BETWEEN '$startdate' AND '$enddate') AND (t.ProjectID = p.ProjectID) AND t.ProjectID='" . $project ."' GROUP BY t.Username";

	$table_headers = array('Client', 'Project Name', 'Username', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a projectid and echos the timeLog table for the specific project
function printTimeLogTableByProject($project, $startdate, $enddate)
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, p.ProjectName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t, Projects p WHERE (t.TimeIn BETWEEN '$startdate' AND '$enddate') AND (t.ProjectID = p.ProjectID) AND t.ProjectID='" . $project ."'";

	$table_headers = array('TimeLogID', 'Username', 'Client', 'Project', 'Time In', 'Time Out', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a taskid and echos an aggregated view of the TimeSheet table with a sum of timespent and grouped by developers names
function printAggregatedTimeLogTableByTask($task, $startdate, $enddate)
{
	$query = "SELECT t.ClientName, p.ProjectName, a.TaskName, t.Username, SUM(t.TimeSpent) FROM TimeSheet t, Projects p, Tasks a WHERE (t.TimeIn BETWEEN '$startdate' AND '$enddate') AND (t.ProjectID = p.ProjectID AND a.TaskID=t.TaskID) AND t.TaskID='" . $task ."' GROUP BY t.Username";

	$table_headers = array('Client', 'Project Name', 'Task Name', 'Username', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a taskid and echos the timeLog table for the specific task
function printTimeLogTableByTask($task, $startdate, $enddate)
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, p.ProjectName, a.TaskName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t, Projects p, Tasks a WHERE (t.TimeIn BETWEEN '$startdate' AND '$enddate') AND (t.ProjectID = p.projectID AND a.TaskID=t.TaskID) AND t.TaskID='" . $task ."'";

	$table_headers = array('TimeLogID', 'Username', 'Client', 'Project', 'Task', 'Time In', 'Time Out', 'Time Spent');

	printTable($query, $table_headers);
}

//This function consumes a client name and echos a view of the ClientPurchases table
function printHoursLeftTable($client)
{
	$query = 'SELECT p.ClientName, c.StartDate, SUM(p.HoursPurchased), COUNT(p.PurchaseDate), c.HoursLeft FROM ClientPurchases p, Client c WHERE (c.ClientName = p.ClientName) AND c.ClientName="' . $client . '"';

	$table_headers = array('Client', 'Start Date', 'Hours Purchased', 'Purchases', 'Hours Left');

	printTable($query, $table_headers);
}

function printClientsPurchasesTable($client)
{
	$query = 'SELECT p.ClientName, p.HoursPurchased, p.PurchaseDate FROM ClientPurchases p WHERE p.ClientName="' . $client . '"';

	$table_headers = array('Client', 'Hours Purchased', 'Purchase Date');

	printTable($query, $table_headers);
}

//This function consumes a developer username and echos an Assignment table for the specific developer
function printAssignmentsTable($developer)
{
	$query = "SELECT * FROM DeveloperAssignments WHERE Username='" . $developer ."'";

	$table_headers = array('Username', 'Client/Project/Task', 'Type');

	printTable($query, $table_headers);
}

//This function consumes a developer username and echos their client Assignment table for the specific developer
function printAssignmentsTableClient($developer)
{
	$query = "SELECT Username, ClientProjectTask FROM DeveloperAssignments WHERE Type='Client' AND Username='" . $developer ."'";
	$table_headers = array('Username', 'Clients');

	printTable($query, $table_headers);
}

//This function consumes a developer username and echos their Project Assignment table for the specific developer
function printAssignmentsTableProject($developer)
{
	$query = "SELECT Username, ProjectName FROM DeveloperAssignments, Projects WHERE ClientProjectTask=ProjectID AND Type='Project' AND Username='" . $developer ."'";

	$table_headers = array('Username', 'Projects');

	printTable($query, $table_headers);
}

//This function consumes a developer username and echos their Task Assignment table for the specific developer
function printAssignmentsTableTask($developer)
{
	$query = "SELECT Username, TaskName FROM DeveloperAssignments, Tasks WHERE ClientProjectTask=TaskID AND Type='Task' AND Username='" . $developer ."'";

	$table_headers = array('Username', 'Tasks');

	printTable($query, $table_headers);
}

function printClientContactTable($client)
{
	$query = "SELECT * FROM ClientContact WHERE ClientName='$client'";
	$table_headers = array('Client Name', 'First Name', 'Last Name', 'Phone', 'Email', 'Address', 'City', 'State');
	printTable($query, $table_headers);
}

function printProjects($client)
{
	$query = "SELECT ProjectName, Description FROM Projects WHERE ClientName='$client'";
	$table_headers = array('Project Name', 'Description');
	printTable($query, $table_headers);
}

function printTasks($client)
{
	$query = "SELECT TaskName, Description FROM Tasks WHERE ClientName='$client'";
	$table_headers = array('Task Name', 'Description');
	printTable($query, $table_headers);
}

function printDevelopersAssignedToClient($client)
{
	$query = "SELECT Username FROM DeveloperAssignments WHERE (Type='Client') AND ClientProjectTask='" . $client ."'";
	$table_headers = array('Developer');
	printTable($query, $table_headers);
}

/* The below functions print editable tables.
 *
 */

//This function consumes a query and table headers and prints out the results in a table
function printTableEditColumn($query, $table_headers)
{
	echo '<table class="table table-condensed table-bordered" style="text-align:left;">';

	echo '<tr>';
	foreach($table_headers as $t_h)
		echo '<th>' . $t_h . '</th>';
	echo '</tr>';

	if($result = db_query($query))
	{
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			echo '<tr>';
			foreach($row as $r)
				echo "<td>$r</td>";

			echo '<td>';
			//Print the radio button
			echo '<input type="radio" name="TimeLogID" value="' . $row['TimeLogID'] . '">';
			echo '</td>';
			echo '</tr>';
		}
	}
	echo '</table>';
	mysqli_free_result($result);
}

//This function consumes a develper username, startdate, and enddate and echos an editable table for the specific developers time sheet
function editTimeLogTableByDeveloper($developer, $startdate, $enddate)
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, t.ProjectID, p.ProjectName, t.TaskID, Tasks.TaskName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t, Projects p, Tasks WHERE (t.TimeIn BETWEEN '$startdate' AND '$enddate') AND (t.ProjectID = p.ProjectID AND t.ProjectID = Tasks.ProjectID) AND t.Username='" . $developer ."'";

	$table_headers = array('TimeLogID', 'Username', 'Client', 'ProjectID', 'Project Name', 'TaskID', 'Task Name', 'Time In', 'Time Out', 'Time Spent', 'Edit');

	printTableEditColumn($query, $table_headers);
}

//This function prints out a 1 row table that allows you to edit the selected row via text boxes
function editTable($query, $table_headers)
{
	echo '<table class="table table-condensed table-bordered" style="border:1px solid black; text-align:center;">';

	echo '<tr>';
	foreach($table_headers as $t_h)
		echo '<th>' . $t_h . '</th>';
	echo '</tr>';

	if($result = db_query($query))
	{
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			echo '<tr>';
			foreach($row as $k=>$v)
			{
				echo '<td style=\"border:1px solid black;padding:5px;\">';
				if($k == 'TimeLogID' || $k == 'Username' || $k == 'ClientName' || $k == 'ProjectName' || $k == 'TaskName' || $k == 'TimeIn')
					echo '<label>' . $v . '</label>';
			}

			//In order to have the timeout be the default value in the datetime selector, a "T" must be before the time
			echo '<input type="datetime-local" name="TimeOut" min="' . substr_replace($row['TimeIn'], "T", 10, 1) . '" value="' . substr_replace($row['TimeOut'], "T", 10, 1) . '">';
			echo '<input type="number" name="TimeSpent" value="' . $row['TimeSpent'] . '">';
			echo '</td>';

			echo '</tr>';
		}
	}
	echo '</table>';
	mysqli_free_result($result);
}

//This function creates a query for a row in timesheet that has a matching time log. It then calls edit table
function editTimeLogByID($timeLogID)
{
	$query = "SELECT t.TimeLogID, t.Username, t.ClientName, p.ProjectName, Tasks.TaskName, t.TimeIn, t.TimeOut, t.TimeSpent FROM TimeSheet t, Projects p, Tasks WHERE (t.TaskID=Tasks.TaskID AND t.ProjectID=p.ProjectID) AND t.TimeLogID='" . $timeLogID ."'";
	$table_headers = array('TimeLogID', 'Username', 'Client', 'Project Name', 'Task Name', 'Time In', 'Time Out', 'Time Spent');

	editTable($query, $table_headers);
}
?>