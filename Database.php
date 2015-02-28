<?php
require_once 'login_config.php';

/* The following functions can be called to replace redundant tasks.
 *
 */

function db_query($query)
{
	return mysqli_query(getConnection(), $query);
}

/* The following functions perform higher-level operations on the database that require multiple tables.
 *
 */

function createEmployee($team_, $username_, $position_, $password_, $firstname_, $lastname_, $phone_, $email_, $address_, $city_, $state_)
{
	newDeveloper($team_, $username_, $position_);
	newCredentials($username_, $password_);
	newContact($username_, $firstname_, $lastname_, $phone_, $email_, $address_, $city_, $state_);
}

function removeEmployee($username_)
{
	removeCredentials($username_);
	removeContact($username_);
	removeDeveloper($username_);
}

/* The following functions directly query the database. 
 *
 */

function newDeveloper($team_, $username_, $position_)
{
	$sql = "INSERT INTO Developer(Team, Username, Position) VALUES ('$team_','$username_', '$position_')";
	db_query($sql);
}

function removeDeveloper($username_)
{
	$sql = "DELETE FROM Developer WHERE Username='$username_'";
	db_query($sql);
}

function newCredentials($username_, $password_)
{
	$sql = "INSERT INTO Credentials(Username, Password) VALUES ('$username_', '$password_')";
	db_query($sql);
}

function removeCredentials($username_)
{
	$sql = "DELETE FROM Credentials WHERE Username='$username_'";
	db_query($sql);
}

function newContact($username_, $firstname_, $lastname_, $phone_, $email_, $address_, $city_, $state_)
{
	$sql = "INSERT INTO Contact(Username, Firstname, Lastname, Phone, Email, Address, City, State) VALUES ('$username_', '$firstname_', '$lastname_', '$phone_', '$email_', '$address_', '$city_', '$state_')";
	db_query($sql);
}

function removeContact($username_)
{
	$sql = "DELETE FROM Contact WHERE Username='$username_'";
	db_query($sql);
}
?>