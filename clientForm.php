<html>
<head>
<style>
	.client_form {
		text-align: center;
	}

</style>
</head>

<body>


<?php
require_once 'Database.php';

echo<<< _END
	<form class="client_form" method="post" action="client_form.php"><br /><br />
		Client Name:<input type="text" name="client_name" /><br /><br />
		First Name:<input type="text" name="first_name" /><br /><br />
		Last Name:<input type="text" name="last_name" /><br /><br />
		Phone:<input type="text" name="phone" /><br /><br />
		Email:<input type="email" name="email" /><br /><br />
		Address:<input type="text" name="address" /><br /><br />
		City:<input type="text" name="city" /><br /><br />
		State:<input type="text" name="state" /><br /><br />
		<input type="date" name="start_date" value="" /><br /><br />
		<input type="submit" />
	</form>
_END;
?>


</body>

</html>