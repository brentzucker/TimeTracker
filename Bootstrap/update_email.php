<?php
/*
 Name: update_email.php
 Description: lets the user update their email address
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15,
 Names of files accessed: include.php
 Names of files changed:
 Input: email (string)
 Output: text showing the email was updated
 Error Handling:
 Modification List:
 4/18/15-Initial code up
 4/20/15-Migrated my account pages
 */

require_once(__DIR__.'/../include.php');

session_start();

open_html("Update Email");

$currentemail = $_SESSION['Developer']->getContact()->getEmail();

echo <<<END
<br>
<br>
<form action="" method="POST">
Email:
<input type="text" name="updateemail" value="$currentemail">
<br>
<br>
<input type="Submit" name="Update" value="Update">
</form>
END;

if(isset($_POST['Update']))
{
  $_SESSION['Developer']->getContact()->setEmail($_POST['updateemail']);
  echo 'Email successfully updated!';
}

close_html();
?>