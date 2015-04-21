<?php
/*
 Name: update_password.php
 Description: lets the user update their password
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: password (string)
 Output: text showing the password has been updated
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/20/15-Migrated my account pages
 */

require_once(__DIR__.'/../include.php');

session_start();

open_html("Update Password");

echo '<main id="page-content-wrapper">'; 
echo '<div class="col-lg-9 main-box">';
echo '<h1>Update Password</h1>';

echo <<<END
<form action="" method="POST">
Password:
<input type="password" name="password" class="form-control">
<br>
<input type="Submit" name="Update" value="Update" class="btn btn-block btn-lg btn-primary">
</form>
END;

if(isset($_POST['Update']))
{
	$hashed_password = hash('ripemd128', $_POST['password']);

	updateTableByUser('Credentials', 'Password', $hashed_password, $_SESSION['Developer']->getUsername() );

	echo 'Password successfully updated!';
}

echo '</div>';

alertBox();

echo '</main>';

close_html();
?>