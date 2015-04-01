<?php
require_once(__DIR__.'/../../include.php');

function createDeveloperForm()
{
	if(isset($_POST['Submit']))
	{
		createEmployee($_POST['team'], $_POST['username'], $_POST['position'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['email'], $_POST['address'], $_POST['city'], $_POST['state']);
		/*echo<<<END
		<script>
		function confirmDeveloperForm()
		{
			var node = document.createElement("H3");
			var textnode = document.createTextNode("Succesfully added developer!");
			node.appendChild(textnode);
			document.getElementById("developer_form").appendChild(node);
		}
		document.getElementById("developer_form").onload = confirmDeveloperForm();
		</script>
END;*/
	}

	echo<<<END
	<form id="developer_form" action="" method="POST">
	<br>Team:<br>
	<input type="text" name="team">
	<br>Username:<br>
	<input type="text" name="username">
	<br>Password:<br>
	<input type="password" name="password">
	<br>Position:<br>
	<input type="text" name="position">
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
	<br><input type="submit" name="Submit" value="Create Developer">
	</form>
END;
}

session_start();

echo '<h2>Create Developer</h2>';

createDeveloperForm();
?>