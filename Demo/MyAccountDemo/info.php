<?php
require_once(__DIR__.'/../../include.php');

session_start();

//This is where you update your name and contact info
echo 'This is where you update your name and contact info';

$currentfirstname = $_SESSION['Developer']->getContact()->getFirstname();
$currentlastname = $_SESSION['Developer']->getContact()->getLastname();
$currentphone = $_SESSION['Developer']->getContact()->getPhone();
$currentaddress = $_SESSION['Developer']->getContact()->getAddress();
$currentcity = $_SESSION['Developer']->getContact()->getCity();
$currentstate = $_SESSION['Developer']->getContact()->getState();

echo <<<END
<br>
<br>
<form action="" method="POST">
First name:
<input type="text" name="updatefirstname" value="$currentfirstname">
<br>
<br>
<input type="Submit" name="UpdateFirstname" value="UpdateFirstname">
<br>
<br>
Last name:
<input type="text" name="updatelastname" value="$currentlastname">
<br>
<br>
<input type="Submit" name="UpdateLastname" value="UpdateLastname">
<br>
<br>
Phone:
<input type="text" name="updatephone" value="$currentphone">
<br>
<br>
<input type="Submit" name="UpdatePhone" value="UpdatePhone">
<br>
<br>
Address:
<input type="text" name="updateaddress" value="$currentaddress">
<br>
<br>
<input type="Submit" name="UpdateAddress" value="UpdateAddress">
<br>
<br>
City:
<input type="text" name="updatecity" value="$currentcity">
<br>
<br>
<input type="Submit" name="UpdateCity" value="UpdateCity">
<br>
<br>
State:
<select name="updatestate">
<option value="">Select your state</option>
<option value="AL">Alabama</option>
<option value="AK">Alaska</option>
<option value="AZ">Arizona</option>
<option value="AR">Arkansas</option>
<option value="CA">California</option>
<option value="CO">Colorado</option>
<option value="CT">Connecticut</option>
<option value="DE">Delaware</option>
<option value="DC">District of Columbia</option>
<option value="FL">Florida</option>
<option value="GA">Georgia</option>
<option value="GU">Guam</option>
<option value="HI">Hawaii</option>
<option value="ID">Idaho</option>
<option value="IL">Illinois</option>
<option value="IN">Indiana</option>
<option value="IA">Iowa</option>
<option value="KS">Kansas</option>
<option value="KY">Kentucky</option>
<option value="LA">Louisiana</option>
<option value="ME">Maine</option>
<option value="MD">Maryland</option>
<option value="MA">Massachusetts</option>
<option value="MI">Michigan</option>
<option value="MN">Minnesota</option>
<option value="MS">Mississippi</option>
<option value="MO">Missouri</option>
<option value="MT">Montana</option>
<option value="NE">Nebraska</option>
<option value="NV">Nevada</option>
<option value="NH">New Hampshire</option>
<option value="NJ">New Jersey</option>
<option value="NM">New Mexico</option>
<option value="NY">New York</option>
<option value="NC">North Carolina</option>
<option value="ND">North Dakota</option>
<option value="OH">Ohio</option>
<option value="OK">Oklahoma</option>
<option value="OR">Oregon</option>
<option value="PA">Pennsylvania</option>
<option value="PR">Puerto Rico</option>
<option value="RI">Rhode Island</option>
<option value="SC">South Carolina</option>
<option value="SD">South Dakota</option>
<option value="TN">Tennessee</option>
<option value="TX">Texas</option>
<option value="UT">Utah</option>
<option value="VT">Vermont</option>
<option value="VA">Virginia</option>
<option value="WA">Washington</option>
<option value="WV">West Virginia</option>
<option value="WI">Wisconsin</option>
<option value="WY">Wyoming</option>
</select>
<br>
<br>
<input type="Submit" name="UpdateState" value="UpdateState">
</form>
END;

if(isset($_POST['UpdateFirstname']))
{
  $_SESSION['Developer']->getContact()->setFirstname($_POST['updatefirstname']);
  echo 'First Name successfully updated!';
}

if(isset($_POST['UpdateLastname']))
{
  $_SESSION['Developer']->getContact()->setLastname($_POST['updatelastname']);
  echo 'Last Name successfully updated!';
}

if(isset($_POST['UpdatePhone']))
{
  $_SESSION['Developer']->getContact()->setPhone($_POST['updatephone']);
  echo 'Phone successfully updated!';
}

if(isset($_POST['UpdateAddress']))
{
  $_SESSION['Developer']->getContact()->setAddress($_POST['updateaddress']);
  echo 'Address successfully updated!';
}

if(isset($_POST['UpdateCity']))
{
  $_SESSION['Developer']->getContact()->setCity($_POST['updatecity']);
  echo 'City successfully updated!';
}

if(isset($_POST['UpdateState']))
{
  $_SESSION['Developer']->getContact()->setState($_POST['updatestate']);
  echo 'State successfully updated!';
}
echo <<<END
<br>
<br>
<form action='MyAccount.php'>
<input type='submit' value='Back to My Account Page'>
</form>
END;
?>
