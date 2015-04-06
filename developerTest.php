<!--
Name: developerTest.php
Description: creates a client by getting their information from the form
Programmers: Delaney Rhodes
Dates: (3/6/15, 
Names of files accessed: Database.php
Names of files changed:
Input: 
Output:
Error Handling:
Modification List:
3/6/15-Initial code up & styled
-->

<?php
	require_once 'Database.php';
	
	//information comes from the developerForm.php
	createEmployee($_POST['teamName'], $_POST['username'], $_POST['position'], $_POST['password'], $_POST['firstName'], $_POST['lastName'], $_POST['phoneNumber'], $_POST['email'], $_POST['address'], $_POST['city'], $_POST['state']);
	
	//creates a developer with the developer's information from the database and puts the information in a table
	
	function test($query)
	{
		echo '<table style="border:1px solid black; text-align:center; width:50%; margin-left:25%;">';
		if($result = db_query($query))
		{
			while($row = mysqli_fetch_row($result))
			{
				echo '<tr>';
				foreach($row as $r)
					echo "<td style=\"border:1px solid black;\">$r</td>";
				echo '</tr>';
			}
		}
		echo '</table>';
	}
	
	test("SELECT * FROM developer");
	
?>