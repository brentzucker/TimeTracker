<?php
require_once 'Database.php';

echo <<<_END
<br>
	<form name="Login" method="post" action="login_confirm.php">
	<p>Username:
		<input name="Username" type="text" />
  </p>
  <p>Password:
  	<input name="Password" type="password" />
  </p>
  <p>
    <input name="Login" type="submit" id="button" value="Enter" />
  </p>
</form>
_END;
?>