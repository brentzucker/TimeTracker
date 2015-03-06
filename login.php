<?php
require_once 'Database.php';
session_start();


//if($_SERVER["REQUEST_METHOD"] == "POST")
//{
//	$username = mysqli_real_escape_string($database, $_POST['Username']);
//	$password = mysqli_real_escape_string($database, $_POST['Password']);
	
//	$query = "SELECT Username, Password FROM credentials WHERE Username='$username' AND Password = '$password'";
//	$result = mysqli_query($database, $query);
//	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
//	$active = $row['active'];
//	$count = mysqli_num_rows($result);
	
//	if($count == 1)
//	{
//		session_register("username");
//		$_SESSION['login_user'] = $username;
		
//		header("location: home.php");
//	}
//	else {
//		$error = "Your Username or Password is invalid.";
//	}	
//}
// username and password sent from form


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
?>