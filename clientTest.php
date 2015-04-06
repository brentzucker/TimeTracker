<!--
Name: clientTest.php
Description: creates a client by getting their information from the form
Programmers: Ryan Graessle
Dates: (3/2/15, 
Names of files accessed: Database.php
Names of files changed:
Input:
Output:
Error Handling:
Modification List:
3/2/15-Initial code up
3/6/15-Updated form & styled form
-->

<?php

	require_once 'Database.php';
	
	//information comes from the clientForm.php

	createClient($_POST['client_name'], $_POST['start_date'], $_POST['first_name'], $_POST['last_name'], $_POST['phone'], $_POST['email'], $_POST['address'], $_POST['city'], $_POST['state']);

	//creates a client with the client's information from the database and puts the information in a table
	
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
?>

