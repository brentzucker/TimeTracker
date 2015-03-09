<?php
require_once 'Database.php';

if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
	echo 'You are already signed in. Click<a href="logout.php">here</a> if you want to log out.';
}
else
{
	if($_SERVER['REQUEST_METHOD'] != 'POST')
	{
		/*the form hasn't been posted yet, display it
		 note that the action="" will cause the form to post to the same page it is on */
		echo <<<_END
<br>
	<form name="Login" method="post" action="login_confirm.php">
	<p>Username:
		<input name="Username" type="text" />
  </p>
  <p>Password:
  	<input name="Password" type="text" />
  </p>
  <p>
    <input name="Login" type="submit" id="button" value="Enter" />
  </p>
</form>
_END;
		
	}
	else
	{
		/* so, the form has been posted, we'll process the data in three steps:
			1.	Check the data
			2.	Let the user refill the wrong fields (if necessary)
			3.	Varify if the data is correct and return the correct response
			*/
		$errors = array(); /* declare the array for later use */

		if(!isset($_POST['Username']) || !isset($_POST['Password']))
		{
			echo 'The username/password field is empty.';
		}
		else
		{
			//the form has been posted without errors, so save it
			//notice the use of mysql_real_escape_string, keep everything safe!
			//also notice the sha1 function which hashes the password
			$query = "SELECT
						Username,
					FROM
						credentials
					WHERE
						Username = '" . ($_POST['Username']) . "'
					AND
						Password = '" . ($_POST['Password']) . "'";

			$result = mysql_query($query);
			if(!$result)
			{
				//something went wrong, display the error
				echo 'Error signing in. Please try again later.';
				//echo mysql_error(); //debugging purposes, uncomment when needed
			}
			else
			{
				//the query was successfully executed, there are 2 possibilities
				//1. the query returned data, the user can be signed in
				//2. the query returned an empty result set, the credentials were wrong
				if(mysql_num_rows($result) == 0)
				{
					echo 'Wrong user/password combination. Please try again.';
				}
				else
				{
					//set the $_SESSION['signed_in'] variable to TRUE
					$_SESSION['signed_in'] = true;

					//we also put the user_id and user_name values in the $_SESSION, so we can use it at various pages
					while($row = mysql_fetch_assoc($result))
					{
						$_SESSION['Username'] 	= $row['Username'];
					}

					echo 'Welcome ' . $_SESSION['Username'] . '. <br /><a href="login_success.php"></a>.';
				}
			}
		}
	}
}


?>