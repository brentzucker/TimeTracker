<!--
Name: login_confirm.php
Description: protects from SQL injection, logs the user in and starts the session
Programmers: Tyler Land, Ryan Graessle
Dates: (3/6/15, 
Names of files accessed: Database.php
Names of files changed:
Input: 
Output: text
Error Handling: checks to make sure the username/password combination is correct
Modification List: 
3/6/15-Initial code up
3/7/15-Fixed sessions
-->

<?php
require_once 'Database.php';

//information comes from the login.php
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


//starts the session with the user's information or outputs an error
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