<?php

require_once 'include.php';

function html_header($title) //Function to load the header of the webpage. Takes in the title of the page.
{
echo<<<_END

<html>
	<head>
		<title>$title</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<div class="header-wrap">
			<div class="logo">
				<a><img src="Logo Here" /></a>
			<div>
			<div class="menu">
				<p>//**If we want a menu it will go here**//</p>
			</div>
		</div>
_END;

}

function html_footer() //Function to load the footer of the webpage and close out the HTML.
{
echo<<<_END

	</body>
</html>

_END;
}

?>