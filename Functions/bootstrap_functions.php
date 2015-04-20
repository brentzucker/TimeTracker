<?php
require_once (__DIR__.'/../include.php');

//This function...
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
_END;

	echo '<link href="css/bootstrap.min.css" rel="stylesheet">';
	echo '<link href="css/style.css" rel="stylesheet">';
	echo '<link href="css/bootstrap.min.css" rel="stylesheet">';
	echo '<link href="css/simple-sidebar.css" rel="stylesheet">';

	echo<<<_END
	</head>

	<body>

    	<div id="wrapper">

        	<!-- Sidebar -->
        	<div id="sidebar-wrapper">
            	<ul class="sidebar-nav">
                	<li class="sidebar-brand">
                    	<a href="home.php">
                        	CODEC
                    	</a>
                	</li>
                	<li>
                    	<a href="home.php">Home</a>
                	</li>
                
            	    <li>
            		    <a href="clock.php">Clock In</a>
                	</li>
                
                	<li class="dropdown">
                    	<a class="dropdown-toggle" data-toggle="dropdown" href="Reports/reports.php">Reports<span class="caret"></span></a>
                    	<ul class="dropdown-menu">
						<li><a href="developer_reports.php">Developer Reports</a></li>
						<li><a href="client_reports.php">Client Reports</a></li>
						<li><a href="project_reports.php">Project Reports</a></li>
						<li><a href="task_reports.php">Task Reports</a></li>
					</ul>
                	</li>
                
                	<li class="dropdown">
                    	<a class="dropdown-toggle" data-toggle="dropdown" href="Reports/reports.php">Manage Developers<span class="caret"></span></a>
                    	<ul class="dropdown-menu">
						<li><a href="create_developer.php">Create Developers</a></li>
						<li><a href="assign_client.php">Assign Client</a></li>
						<li><a href="assign_project.php">Assign Project</a></li>
						<li><a href="assign_task.php">Assign Task</a></li>
						<li><a href="unassign_client.php">Un-Assign Client</a></li>
						<li><a href="unassign_project.php">Un-Assign Project</a></li>
						<li><a href="unassign_task.php">Un-Assign Task</a></li>
						<li><a href="view_assignments.php">View All Assignments</a></li>
					</ul>
                	</li>
                
                	<li class="dropdown">
                    	<a class="dropdown-toggle" data-toggle="dropdown" href="Reports/reports.php">Manage Clients<span class="caret"></span></a>
                    	<ul class="dropdown-menu">
						<li><a href="add_hours.php">Add Purchased Hours</a></li>
						<li><a href="new_client.php">New Client</a></li>
						<li><a href="new_project.php">New Project</a></li>
						<li><a href="new_task.php">New Task</a></li>
						<li><a href="edit_client.php">Edit Client</a></li>
						<li><a href="edit_project.php">Edit Project</a></li>
						<li><a href="edit_task.php">Edit Task</a></li>
						<li><a href="delete_client.php">Delete Client</a></li>
						<li><a href="delete_client.php">Delete Project</a></li>
						<li><a href="delete_task.php">Delete Task</a></li>
					</ul>
                	</li>
                
                	<li class="dropdown">
                    	<a class="dropdown-toggle" data-toggle="dropdown" href="Reports/reports.php">My Account<span class="caret"></span></a>
                    	<ul class="dropdown-menu">
						<li><a href="update_info.php">Update Info</a></li>
						<li><a href="update_email.php">Update Email</a></li>
						<li><a href="update_password.php">Update Password</a></li>
						<li><a href="update_avatar.php">Update Avatar</a></li>
						<li><a href="update_alerts.php">Update Alerts</a></li>
						<li><a href="delete_account.php">Delete Account</a></li>
					</ul>
                	</li>
                
                	<li>
                    	<a href="edit_timesheet.php">Edit Time Sheet</a>
                	</li>
                
                	<li>
                    	<a href="client_profiles.php">View Client Profiles</a>
                	</li>
                	
                	<li>
                		<a href="logout.php">Logout</a>
                	</li>
                
            	</ul>
        	</div>
        	<!-- /#sidebar-wrapper -->
        
        	<div id="page-content-wrapper">
				<div class="container-fluid">
				<a href="#menu-toggle" class="glyphicon glyphicon-menu-hamburger" id="menu-toggle">Menu</a>
_END;
}	

//This function...
function close_html()
{
	echo<<<_END
			</div>
		</div>

		<!-- /Javascript/dropdown.js -->
		<script src="../Javascript/dropdowns.js"></script>

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
	echo '<footer class="footer">';
		echo '<p>Copyright &copy; 2015 CODEC</p>';
	echo '</footer>';
}

//This function echos the error message if a login attempt is incorrect
function getWrongLoginError()
{
	echo "<div class='alert-dismissible alert alert-danger login-wrong' role='alert'>";
	echo "Wrong username/password Combination!";
	echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
	echo "<span aria-hidden='true'>";
	echo "&times;";
	echo "</span>";
	echo "</button>";
	echo "</div>";
}

//Checks user login and matches the username and hashed password to the database
function checkLogin($username, $password)
{	
	if(isset($username) && isset($password)) 
	{
		$token=hash('ripemd128',$password);			
		$result = db_query("SELECT Password FROM Credentials WHERE Username='$username'");	
		$rows=mysqli_num_rows($result);
				
		for($i=0; $i<$rows; $i++) 
		{					
			$row=mysqli_fetch_row($result);

			foreach($row as $element) 
			{			
				if($token==$element) 
				{
					$_SESSION['SuperUser'] = new SuperUser();
					$_SESSION['Developer'] = new Developer($username);
					header("Location:home.php");
				}
				else
					return false;
			}
		}
		if($rows==0)
			return false;
	}
}

//This function...
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
    <link href="css/style_home.css" rel="stylesheet">
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

//This funcion ... 
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

function alertBox()
{
echo<<<_END
		<div class="col-lg-3 alert-box">
		
			<h2>Alerts</h2>
		
		</div>
_END;
}

?>