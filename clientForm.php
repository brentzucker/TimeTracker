<?php
require_once 'include.php';
require_once 'page_functions.php';

html_header("Client Form");

$date = date("Y-m-d");

echo<<< _END
	<form class="client_form" method="post" action="clientForm.php">
	<div class="form_wrap">
		Client Name<input type="text" name="client_name" />
		First Name<input type="text" name="first_name" />
		Last Name<input type="text" name="last_name" />
		Phone<input type="text" name="phone" />
		Email<input type="email" name="email" />
		Address<input type="text" name="address" />
		City<input type="text" name="city" />
		State<input type="text" name="state" />
		<input type="hidden" name="start_date" value="$date" /><br />
		<input class="submit" type="submit" />
	</div>
	</form>
	
	<div class="clientEntry">
	
	</div>
_END;

	if(!empty($_POST['client_name']))
	{
			createClient($_POST['client_name'], $_POST['start_date'], $_POST['first_name'], $_POST['last_name'], $_POST['phone'], $_POST['email'], $_POST['address'], $_POST['city'], $_POST['state']);
			
			test("SELECT * 
			FROM ClientContact 
			LEFT JOIN Client 
			ON Client.ClientName = ClientContact.ClientName
			");
			
	}
	
html_footer();

?>