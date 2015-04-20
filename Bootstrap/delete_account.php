<?php
/*
 Name: delete_account.php
 Description: the user clicks the 'delete' button to delete themselves
 Programmers: Ryan Graessle
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input:
 Output: shows text saying the account was deleted
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 */

require_once(__DIR__.'/../include.php');
require_once(__DIR__.'/page_functions.php');

open_html("Delete Account");

echo<<<_END
	<h1>Delete Account</h1>
_END;

close_html();

?>