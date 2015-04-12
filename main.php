<?php
/*
Name: main.php
Description: main page where user can access different pages of the website
Programmers: Ryan Graessle
Dates: (3/30/15, 
Names of files accessed: include.php, page_functions.php
Names of files changed:
Input: 
Output:
Error Handling:
Modification List: 
3/30/15-Initial code up
*/

require_once 'include.php';
require_once 'page_functions.php';

html_header("Home");

echo<<< _END

<div class="main">
	<div class="home-1">
		<div class="button">
			<h3><br />Button 1</h3>
		</div>
		
		<div class="button">
			<h3><br />Button 2</h3>
		</div>
		
		<div class="button">
			<h3><br />Button 3</h3>
		</div>
	</div>
	
	<div class="home-2">
		<div class="button">
			<h3><br />Button 4</h3>
		</div>
		
		<div class="button">
			<h3><br />Button 5</h3>
		</div>
		
		<div class="button">
			<h3><br />Button 6</h3>
		</div>
	</div>
</div>
	
_END;

	
html_footer();

?>