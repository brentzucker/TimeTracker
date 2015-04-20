<?php
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