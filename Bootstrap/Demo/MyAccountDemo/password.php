<?php
require_once(__DIR__.'/../../include.php');

session_start();

//This is where you update your password
echo 'This is where you update your password';

echo <<<END
<br>
<br>
<form action="" method="POST">
Password:
<input type="text" name="updatepassword">
<br>
<br>
<input type="Submit" name="Update" value="Update">
</form>
END;

if(isset($_POST['Update']))
{
  //NEED TO SET PASSWORD!
  //$_SESSION['Developer']->getContact()->setPassword($_POST['updatepassword']);
  //echo 'Password successfully updated!';
}
echo <<<END
<br>
<form action='MyAccount.php'>
<input type='submit' value='Back to My Account Page'>
</form>
END;
?>
