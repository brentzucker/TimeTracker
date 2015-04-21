<?php

function open_html($title)
{
echo<<<_END
<!DOCTYPE html> 
<html>

<head>
  <title>$title</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>
</head>

<body>
  <div id="main">		
    <header>	  
	  <nav>
	    <div id="menubar">
          <ul id="nav">
            <li class="current"><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="conferences.php">Conferences</a></li>
            <li><a href="cart.php">Cart</a></li>
			<li><a href="login.php">Log In</a></li>
            <li><a href="contact.php">Contact Us</a></li>
          </ul>
        </div>
      </nav>
    </header>
_END;
}

function close_html()
{
echo<<<_END
	<footer>
		<p>Copyright &copy; 2015 Georgia Rural Health Association</p>
    </footer>
	
  </div>
  
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/image_slide.js"></script>
  
</body>
</html>
_END;
}

?>