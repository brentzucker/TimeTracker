<html>
<head>
<title>Client Form</title>
<style>
	.client_form {
		margin: auto;
		position: relative;
		width:550px;
		height:450px;
		padding:10px;
		border: 1px solid #999;
		line-height: 24px;
		border-radius: 5px;
	}
	
	input {
		display: block;
		width: 375px;
	}

</style>
</head>

<body>


<?php
require_once 'Database.php';

$date = date("Y-m-d");

echo<<< _END
	<form class="client_form" method="post" action="clientTest.php">
		Client Name<input type="text" name="client_name" />
		First Name<input type="text" name="first_name" />
		Last Name<input type="text" name="last_name" />
		Phone<input type="text" name="phone" />
		Email<input type="email" name="email" />
		Address<input type="text" name="address" />
		City<input type="text" name="city" />
		State<input type="text" name="state" />
		<input type="hidden" name="start_date" value="$date" />
		<input type="submit" />
	</form>
_END;
?>


</body>

</html>