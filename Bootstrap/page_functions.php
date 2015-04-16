<?php

function open_html($title)
{
echo<<<_END

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/fav.jpg">

    <title>$title</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>
  
  <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="main.php">Codec</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="clockin.php">Clock In</a></li>
			
            <li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="reports.php">Reports<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#">Developer Reports</a></li>
					<li><a href="#">Client Reports</a></li>
					<li><a href="#">Project Reports</a></li>
					<li><a href="#">Task Reports</a></li>
				</ul>
			</li>
			
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="developers.php">Manage Developers<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#">Create Developer</a></li>
					<li><a href="#">Assign Task</a></li>
					<li><a href="#">Assign Project</a></li>
					<li><a href="#">Assign Client</a></li>
					<li><a href="#">View Assignments</a></li>
				</ul>
			</li>
			
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="clients.php">Manage Clients<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#">Add Purchased Hours</a></li>
					<li><a href="#">New Client</a></li>
					<li><a href="#">New Project</a></li>
					<li><a href="#">New Task</a></li>
					<li><a href="#">Remove Client</a></li>
					<li><a href="#">Remove Project</a></li>
					<li><a href="#">Remove Task</a></li>
				</ul>
			</li>
			
			<li><a href="account.php">My Account</a></li>
          </ul>
		  
		<ul class="nav navbar-nav navbar-right">
			<li><a href="#">Log Out</a></li>
		</ul>
		
        </div>
      </div>
    </nav>
_END;
}	

function close_html()
{
echo<<<_END
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
_END;
}

function open_header()
{
	
}

function close_header()
{
	
}

function open_footer()
{
echo<<<_END
<footer>

_END;
}

function close_footer()
{
echo<<<_END

</footer>

_END;
}

//Checks user login and matches the username and hashed password to the database
function checkLogin($username, $password){
		
	if(isset($username) && isset($password)) {
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
				
		$token=hash('ripemd128',$password);			
		$result = db_query("SELECT Password FROM credentials WHERE Username='$username'");	
		$rows=mysqli_num_rows($result);
				
		for($i=0; $i<$rows; $i++) {					
		$row=mysqli_fetch_row($result);
				
			foreach($row as $element) {			
				if($token==$element) {
					header("Location:main.php");
				}
				else
				{
					echo "<div class='alert-dismissible alert alert-danger login-wrong' role='alert'>Wrong username/password Combination!
					
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					
					</div>";
				}
			}
		}

		if($rows==0)
		{
			echo "<div class='alert-dismissible alert alert-danger login-wrong' role='alert'>Wrong username/password Combination!
					
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					
					</div>";
		}
	}
}




?>