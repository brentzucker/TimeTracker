<?php
require_once(__DIR__.'/../../include.php');

session_start();

echo '<h1>New Client</h1>';

newClientForm();

function newClientForm()
{
	if(isset($_POST['Submit']))
	{
		createClient($_POST['clientname'], $_POST['startdate'], $_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['email'], $_POST['address'], $_POST['city'], $_POST['state']);
	}

	echo<<<END
	<form id="developer_form" action="" method="POST">
	<br>Client Name:<br>
	<input type="text" name="clientname">
	<br>StartDate:<br>
	<input type="date" name="startdate">
	<br>Firstname:<br>
	<input type="text" name="firstname">
	<br>Lastname:<br>
	<input type="text" name="lastname">
	<br>Phone:<br>
	<input type="text" name="phone">
	<br>Email:<br>
	<input type="text" name="email">
	<br>Address:<br>
	<input type="text" name="address">
	<br>City:<br>
	<input type="text" name="city">
	<br>State:<br>
	<input type="text" name="state">
	<br><input type="submit" name="Submit" value="Create Client">
	</form>
END;
}
?>