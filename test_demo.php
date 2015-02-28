<?php
require_once 'Database.php';

/* Testing Functions to print database functions
 *
 */

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

/* Call Operations to test Database
 *
 */

createEmployee('SE', 'b.zucker', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');
createEmployee('SE', 'd.rhodes', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');
createEmployee('SE', 't.land', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');
createEmployee('SE', 'm.graessle', 'Developer', 'bz', 'Brent', 'Zucker', '4045801384', 'brentzucker@gmail.com', 'Columbia St', 'Milledgeville', 'GA');


test("SELECT * 
FROM Developer 
LEFT JOIN Contact 
ON Developer.Username = Contact.Username
LEFT JOIN Credentials 
ON Developer.Username = Credentials.Username
");

removeEmployee("b.zucker");
removeEmployee("d.rhodes");
removeEmployee("t.land");
removeEmployee("m.graessle");

test("SELECT * 
FROM Developer 
LEFT JOIN Contact 
ON Developer.Username = Contact.Username
LEFT JOIN Credentials 
ON Developer.Username = Credentials.Username
");
?>