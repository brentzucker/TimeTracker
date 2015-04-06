<!--
Name: developerForm.php
Description: user inputs information about the new developer
Programmers: Delaney Rhodes
Dates: (3/6/15, 
Names of files accessed: Database.php
Names of files changed:
Input: Team Name(String), Username(String), Position(String), Password(String), First Name(String), Last Name(String), Phone Number(String), Email(String), Address(String), City(String), State(String)
Output:
Error Handling:
Modification List:
3/6/15-Initial code up & styled
-->

<html>
<head>
<meta charset="ISO-8859-1">
<title>New Employee</title>
<style>
	.developerform {
		text-align: center;
		margin: auto;
		position: relative;
		width:300px;
		height:850px;
		padding:10px;
		border: 1px solid #999;
		line-height: 24px;
		border-radius: 5px;
	}
</style>
</head>
<body>
<!-- PHP Starts -->
<?php
require_once 'Database.php';
echo<<<_END
<br>
<h3><center>New Employee</center></h3>
<form class="developerform" method="post" action="developerTest.php">
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
<input type="text" name="city">
<br>
<br>
State:<br>
<input type="text" name="state">
<br>
<br>
<input type="submit" value="Submit">
</form>
_END;
?>
</body>
</div>
</html>