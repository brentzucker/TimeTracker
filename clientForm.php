<?php
/*
Name: clientForm.php
Description: user inputs information about the new client
Programmers: Ryan Graessle
Dates: (3/2/15, 
Names of files accessed: page_functions.php, include.php
Names of files changed:
Input: Client Name(String), First Name(String), Last Name(String), Phone(String), Email(String), Address(String), City(String), State(String)
Output:
Error Handling: the client name cannot be empty
Modification List:
3/2/15-Initial code up & styled form
3/6/15-Updated form
3/23/15-Created page functions
*/

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

//if there is a client name make a new client with the input information

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