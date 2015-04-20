<?php
require_once(__DIR__.'/../include.php');

session_start();

open_html("Update Password");

echo '<h1>Update Password</h1>';

echo <<<END
<br>
<br>
<form action="" method="POST">
Password:
<input type="password" name="password">
<br>
<br>
<input type="Submit" name="Update" value="Update">
</form>
END;

if(isset($_POST['Update']))
{
	$hashed_password = hash('ripemd128', $_POST['password']);

	updateTableByUser('Credentials', 'Password', $hashed_password, $_SESSION['Developer']->getUsername() );

	echo 'Password successfully updated!';
}

close_html();
?>