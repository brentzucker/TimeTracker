<?php
require_once(__DIR__.'/../../include.php');

session_start();

//This is where you update your password
echo 'This is where you update your password';

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

echo <<<END
<br>
<a href='MyAccount.php'>Back To My Account Page</a>
END;
?>
