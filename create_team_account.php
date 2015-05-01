<?php
require_once(__DIR__.'/include.php');
/*
 Name: create_team_account.php
 Description: lets the user create a team others can join or join a premade one
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/27/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input: team name(string), team code(string)
 Output: form and text
 Error Handling: checks to mae sure that the team name and code is correct or that the team name is not taken
 Modification List:
 4/27/15-Initial code up
 4/28/15-Fixed iPad style
 4/29/15-Styled page, error checking
 4/30/15-Moved file to main folder, fixed css/js links
 */

session_start();

if( isset($_POST['joinTeamName']) && isset($_POST['joinTeamCode']) )
{
	//check to see if credentials match
	if( isTeamCodeCorrect() )
	{
		$_SESSION['Team'] = $_POST['joinTeamName'];
		header("Location:create_developer_account.php");
	}
}
elseif( isset($_POST['createTeamName']) && isset($_POST['createTeamCode']))
{
	//check to see if team name is taken
	if(!isTeamNameTaken())
	{
		$hashed_team_code = hash('ripemd128', $_POST['createTeamCode']);
		newTeam($_POST['createTeamName'], $hashed_team_code);
		$_SESSION['Team'] = $_POST['createTeamName'];
		header("Location:create_developer_account.php");
	}
		
}

navigationBarHomePage('Sign Up');
open_html_no_sidebar("Select A Team");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-1">';
echo '</div>';
echo '<div class="col-lg-10 team-box">';
echo '<div class="jumbotron team-jumbo">';
echo '<h1 class="page-header">Select A Team</h1>';

echo '<div class="col-lg-6">';
formJoinTeam();
echo '</div>';

echo '<div class="col-lg-6">';
formCreateTeam();
echo '</div>';

echo '</div>'; // close jumbotron
echo '</div>';


close_html_no_sidebar();

function formJoinTeam()
{
	echo '<h4>Join Team</h4>';
	echo '<form action="" method="POST">';
	echo '<label>Team Name</label>';
	echo '<input type="text" name="joinTeamName" class="form-control">';
	echo '<br>';
	if(isTeamCodeCorrect())
		echo '<label>Team Code</label>';
	else
		echo '<label style="color:red;">Invalid Team Code</label>';
	echo '<input type="password" name="joinTeamCode" class="form-control">';
	echo '<br>';
	echo '<input type="submit" name="joinTeam" value="Join Team" class="btn btn-block btn-lg btn-primary team-top">';
	echo '</form>';
}

function formCreateTeam()
{
	echo '<h4>Create Team</h4>';
	echo '<form action="" method="POST">';
	if(!isTeamNameTaken())
		echo '<label>Team Name</label>';
	else
		echo '<label style="color:red;">Team Name Taken</label>';
	echo '<input type="text" name="createTeamName" class="form-control">';
	echo '<br>';
	echo '<label>Team Code</label>';
	echo '<input type="password" name="createTeamCode" class="form-control">';
	echo '<br>';
	echo '<input type="submit" name="createTeam" value="Create Team" class="btn btn-block btn-lg btn-primary">';
	echo '</form>';
	echo '</div>';
}

function isTeamNameTaken()
{
	if(isset($_POST['createTeamName']))
	{
		if(count(returnRowByTeam($_POST['createTeamName'])) == 0 )
		return false;
	else
		return true;
	}
	return false;
}

function isTeamCodeCorrect()
{
	if( returnRowByTeam($_POST['joinTeamName'])['Password'] == hash('ripemd128', $_POST['joinTeamCode']) )
		return true;
	else
		return false;
}
?>