<?php

	require_once 'Database.php';

	createClient($_POST['client_name'], $_POST['start_date'], $_POST['first_name'], $_POST['last_name'], $_POST['phone'], $_POST['email'], $_POST['address'], $_POST['city'], $_POST['state']);

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
	
	test("SELECT * FROM Client");
	
	removeClient("Murica");
	
	test("SELECT * FROM Client");
?>

