<html>
<head>
<meta charset="ISO-8859-1">
<title>New Employee</title>
</head>
<!-- PHP Starts -->
<?php
require_once 'Database.php';
?>
<center>
<br>
<h3>New Employee</h3>
<div class = "formbox"  method="post">
<form>
<br>
Team Name:<br>
<input type="text" name="teamName">
<br>
<br>
Username:<br>
<input type="text" name="username">
<br>
<br>
Position:<br>
<input type="text" name="position">
<br>
<br>
Password:<br>
<input type="text" name="password">
<br>
<br>
First Name:<br>
<input type="text" name="firstName">
<br>
<br>
Last Name:<br>
<input type="text" name="lastName">
<br>
<br>
Phone Number:<br>
<input type="text" name="phoneNumber">
<br>
<br>
Email:<br>
<input type="text" name="email">
<br>
<br>
Address:<br>
<input type="text" name="address">
<br>
<br>
City:<br>
<input type="text" name="firstName">
<br>
<br>
State:<br>
<input type="text" name="state">
<br>
<br>
<input type="submit" value="Submit">
</form>
<?php 

?>
</center>
</div>
</html>
