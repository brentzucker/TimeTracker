<?php
require_once 'Database.php';
$username=$_POST['Username'];
$password=$_POST['Password'];

// To protect MySQL injection (more detail about MySQL injection)
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$sql="SELECT * FROM credentials WHERE Username='$username' and Password='$password'";
$result=db_query($sql);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

if($count==1)
{
	session_start();
	$un = $_SESSION['login'][$username]['username']=$username;
	$pw = $_SESSION['login'][$username]['password']=$password;
	
	print_r($_SESSION['login']);
	
	header("Location:login_success.php");
	
}
else
{
	echo "Wrong Username or Password";
}
?>