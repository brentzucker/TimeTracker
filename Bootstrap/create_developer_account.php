<?php
require_once(__DIR__.'/../include.php');

session_start();

//Verify the Username, Email, and Password are valid
if( isset($_SESSION['Team']) && isset($_POST['position']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && verifyUsername($_POST['username']) && verifyEmail($_POST['email']) && verifyPassword($_POST['password']) )
{
	$new_developer = new Developer( $_SESSION['Team'] , $_POST['username'], $_POST['email'], $_POST['position'], hash('ripemd128', $_POST['password']));
	$_SESSION['Team'] = null;
	$_SESSION['SuperUser'] = new SuperUser();
	$_SESSION['Developer'] = new Developer($username);
	header("Location:home.php");
}


echo '<h4>Join ' . $_SESSION['Team'] . '</h4>';

formCreateDeveloperAccount();

function formCreateDeveloperAccount()
{
	echo '<form action="" method="POST">';
	
	//If the form has already been submitted display the error, otherwise print out the form	
	if(isset($_POST['submit']))
	{
		if(isUsernameTaken($_POST['username']))
			echo '<label style="color:red;">Username is taken</label>';
		else
		{
			if(verifyUsername($_POST['username']))
				echo '<label>Username:</label>';
			else
				echo '<label style="color:red;">Username must be at least 3 characters</label>';
		}
		
		echo '<input type="text" name="username" class="form-control" value="' . $_POST['username'] . '">';
		
		if(verifyEmail($_POST['email']))
			echo '<label>Email:</label>';
		else
			echo '<label style="color:red;">Enter a valid email address</label>';
		
		echo '<input type="text" name="email" class="form-control" value="' . $_POST['email'] . '">';
		
		if(verifyPassword($_POST['password']))
			echo '<label>Password:</label>';
		else
			echo '<label style="color:red;">Password must be at least 5 characters</label>';
		
		echo '<input type="password" name="password" class="form-control">';

		echo '<input type="hidden" name="position" value="Developer">';
		echo '<input type="submit" name="submit" value="Create Developer" class="btn btn-block btn-lg btn-primary">';
	}
	else
	{
		echo '<label>Username:</label>';
		echo '<input type="text" name="username" class="form-control">';
		echo '<label>Email:</label>';
		echo '<input type="text" name="email" class="form-control">';
		echo '<label>Password:</label>';
		echo '<input type="password" name="password" class="form-control">';
		echo '<input type="hidden" name="position" value="Developer">';
		echo '<input type="submit" name="submit" value="Create Developer" class="btn btn-block btn-lg btn-primary">';	
	}

	echo '</form>';
}

function isUsernameTaken($Username)
{
	if( count( returnRowByUser('Developer', $Username) ) > 0 )
		return true;
	else 
		return false; 
}

?>