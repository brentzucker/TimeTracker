<?php
require_once(__DIR__.'/../include.php');

session_start();

if( isset($_POST['joinTeamName']) && isset($_POST['joinTeamCode']) )
{
	//check to see if credentials match
	if( returnRowByTeam($_POST['joinTeamName'])['Password'] == hash('ripemd128', $_POST['joinTeamCode']) )
	{
		$_SESSION['Team'] = $_POST['joinTeamName'];
		header("Location:create_developer_account.php");
	}
	else
		echo 'Inccorrect code or Team does not exist.';
}
elseif( isset($_POST['createTeamName']) && isset($_POST['createTeamCode']))
{
	//check to see if team name is taken
	if( count(returnRowByTeam($_POST['createTeamName'])) == 0 )
	{
		$hashed_team_code = hash('ripemd128', $_POST['createTeamCode']);
		newTeam($_POST['createTeamName'], $hashed_team_code);
		header("Location:create_developer_account.php");
	}
	else
		echo '<h6>Team Name Taken</h6>';
}

open_html_no_sidebar("Select A Team");
navigationBarHomePage('Sign Up');

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
	echo '<label>Team Code</label>';
	echo '<input type="password" name="joinTeamCode" class="form-control">';
	echo '<br>';
	echo '<input type="submit" name="joinTeam" value="Join Team" class="btn btn-block btn-lg btn-primary team-top">';
	echo '</form>';
}

function formCreateTeam()
{
	echo '<h4>Create Team</h4>';
	echo '<form action="" method="POST">';
	echo '<label>Team Name</label>';
	echo '<input type="text" name="createTeamName" class="form-control">';
	echo '<br>';
	echo '<label>Team Code</label>';
	echo '<input type="password" name="createTeamCode" class="form-control">';
	echo '<br>';
	echo '<input type="submit" name="createTeam" value="Create Team" class="btn btn-block btn-lg btn-primary">';
	echo '</form>';
	echo '</div>';
}
?>