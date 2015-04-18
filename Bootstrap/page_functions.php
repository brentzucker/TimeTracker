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

    <title>$title</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        CODEC
                    </a>
                </li>
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#">Clock In</a>
                </li>
                <li>
                    <a href="#">Overview</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
_END;
}	

function close_html()
{
echo<<<_END
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

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

		$token=hash('ripemd128',$password);			
		$result = db_query("SELECT Password FROM Credentials WHERE Username='$username'");	
		$rows=mysqli_num_rows($result);
				
		for($i=0; $i<$rows; $i++) {					
		$row=mysqli_fetch_row($result);
				
			foreach($row as $element) {			
				if($token==$element) {
					header("Location:sidebar.php");
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

function open_login($title)
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
    <link rel="icon" href="images/fav.jpg">
  	</head>

	<body>
	
	<img class="img-responsive center-block" src="http://i.imgur.com/dupUHP0.jpg" />
    <div class="container">
      <form class="form-signin" action="" method="POST">
        <h2 class="form-signin-heading">Please Sign In</h2>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
        </div>
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign In</button>
      </form>
    </div>	
    
    

_END;
}

function close_login()
{
echo<<<_END
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  	</body>
</html>
_END;
}




?>