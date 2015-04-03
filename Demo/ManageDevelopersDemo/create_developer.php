<?php
require_once(__DIR__.'/../../include.php');

<<<<<<< HEAD
function createDeveloperForm()
{
	/*
	if(isset($_POST['Submit']))
	{
		createEmployee($_POST['team'], $_POST['username'], $_POST['position'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['email'], $_POST['address'], $_POST['city'], $_POST['state']);
		echo<<<END
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
END;
	} */
	$teamError = $usernameError = $positionError = $passwordError = $firstnameError = $lastnameError = $phoneError = $emailError = $addressError = $cityError = $stateError = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{

	    if (empty($_POST['team'])) {
	        $teamError = "Missing";
	    }
	    else {
	        $team = $_POST['team'];
	    }

	    if (empty($_POST['username'])) {
	        $usernameError = "Missing";
	    }
			else if($_POST['username'] < 2) {
					$usernameError = "Username needs to be at least 3 characters long";
			}
	    else {
	        $username = $_POST['username'];
			}

	    if (empty($_POST['position']))  {
	        $positionError = "Missing";
	    }
	    else {
	        $position = $_POST['position'];
	    }

			if (empty($_POST['password']))  {
	        $passwordError = "Missing";
	    }
			else if($_POST['password'] < 4) {
					$passwordError = "Password needs to be at least 5 characters long";
			}
	    else {
	        $password = $_POST['password'];
	    }

			if (empty($_POST['firstname']))  {
	        $firstnameError = "Missing";
	    }
	    else {
	        $firstname = $_POST['firstname'];
	    }

			if (empty($_POST['lastname']))  {
	        $lastnameError = "Missing";
	    }
	    else {
	        $lastname = $_POST['lastname'];
	    }

			if (empty($_POST['phone']))  {
	        $phoneError = "Missing";
	    }
			else if(!is_numeric($_POST['phone'])) {
					$phoneError = "Digits only";
			}
	    else {
	        $phone = $_POST['phone'];
	    }

			if (empty($_POST['email']))  {
					$emailError = "Missing";
			}
			else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$emailError = "Please enter a valid email.";
			}
			else {
					$email = $_POST['email'];
			}

			if (empty($_POST['address']))  {
	        $addressError = "Missing";
	    }
	    else {
	        $address = $_POST['address'];
	    }
			if (empty($_POST['city']))  {
	        $cityError = "Missing";
	    }
	    else {
	        $city = $_POST['city'];
	    }
			if ($_POST['state'] == "")  {
	        $stateError = "Please select your state.";
	    }
	    else {
	        $state = $_POST['state'];
	    }
		if(!empty($_POST['team'] && $_POST['username'] && $_POST['position'] && $_POST['password'] && $_POST['firstname'] && $_POST['lastname'] && $_POST['phone'] && $_POST['email']
		&& $_POST['address'] && $_POST['city'] && $_POST['state']))
		{
			createEmployee($team, $username, $position, $password, $firstname, $lastname, $phone, $email, $address, $city, $state);
		}
			//$_POST['team'], $_POST['username'], $_POST['position'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['phone'], $_POST['email'], $_POST['address'], $_POST['city'], $_POST['state']);
		}

	echo<<<END
	<form id="developer_form" action="" method="POST">
	<br>Team:<br>
	<input type="text" name="team"> <font color="red">$teamError</font>
	<br>Username:<br>
	<input type="text" name="username"> <font color="red">$usernameError</font>
	<br>Password:<br>
	<input type="password" name="password"> <font color="red">$passwordError</font>
	<br>Position:<br>
	<input type="text" name="position"> <font color="red">$positionError</font>
	<br>Firstname:<br>
	<input type="text" name="firstname"> <font color="red">$firstnameError</font>
	<br>Lastname:<br>
	<input type="text" name="lastname"> <font color="red">$lastnameError</font>
	<br>Phone &#40 1112221234 &#41:<br>
	<input type="text" name="phone"> <font color="red">$phoneError</font>
	<br>Email:<br>
	<input type="text" name="email"> <font color="red">$emailError</font>
	<br>Address:<br>
	<input type="text" name="address"> <font color="red">$addressError</font>
	<br>City:<br>
	<input type="text" name="city"><font color="red">$cityError</font>
	<br>State:<br>
	<select name="state">
	<option value="">Select your state</option>
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select> <font color="red">$stateError</font>
<br><br><input type="submit" name="Submit" value="Create Developer">
	</form>
END;
}

=======
>>>>>>> origin/master
session_start();

echo '<h2>Create Developer</h2>';

<<<<<<< HEAD
createDeveloperForm();
?>
=======
newDeveloperForm();
?>
>>>>>>> origin/master
