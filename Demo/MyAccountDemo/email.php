<?php

require_once(__DIR__.'/../../include.php');

session_start();

//This is where you update your email
echo 'This is where you update your email';

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
echo <<<END
<br>
<a href='MyAccount.php'>Back To My Account Page</a>
END;
?>
