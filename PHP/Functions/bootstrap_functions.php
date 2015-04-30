<?php
/*
 Name: bootstrap_functions.php
 Description: sets up the functions used for the Bootstrap theme
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/20/15,
 Names of files accessed: include.php
 Names of files changed:
 Input:
 Output: links, buttons, labels, etc
 Error Handling:
 Modification List:
 4/20/15-Initial code up
 4/21/15-Edit functions, merge Flat UI
 */

require_once (__DIR__.'/../../include.php');

//This function sets up the text in the sidebar and the dropdowns
function open_html($title)
{
	isLogin();

	echo<<<_END

	<!DOCTYPE html>
	<html lang="en">

	<head>

    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta name="description" content="">
    	<meta name="author" content="">
    	<link rel="icon" type="image/png" href="Images/fav.png">

    	<title>$title</title>
_END;

	echo '<link href="css/bootstrap.min.css" rel="stylesheet">';
	echo '<link href="css/style.css" rel="stylesheet">';
	echo '<link href="css/bootstrap.min.css" rel="stylesheet">';
	echo '<link href="css/simple-sidebar.css" rel="stylesheet">';
	echo '<link href="dist/css/flat-ui.css" rel="stylesheet">';
    echo '<link href="docs/assets/css/demo.css" rel="stylesheet">';

	echo '</head>';

	echo '<body>';

	echo '<div id="wrapper-left">';
	echo '<div id="wrapper-right">';

    leftSidebar();

    rightSidebar();
        
    echo '<div id="page-content-wrapper">';
	echo '<div class="container-fluid">';
}

function leftSidebar()
{
	echo '<!-- Sidebar -->';
	echo '<div id="sidebar-wrapper-left">';
	echo '<ul class="sidebar-nav sidebar-nav-left">';
	//echo '<li><div class="col-sm-10"></div><a href="#menu-toggle-left" class="fui-list" id="menu-toggle-left"></a></li>';
	echo '<li class="sidebar-brand">';
	echo '<div style="width:60px;position:absolute; right:0px;"><a style="margin:0 auto;" href="#menu-toggle-left" class="fui-list" id="menu-toggle-left"></a></div>';
	echo '<a href="home.php">';
 	echo $_SESSION['Developer']->getTeam();
	echo '</a>';
	echo '</li>';
	echo '<li>';
	echo '<a href="home.php">Home<span class="left-bar-glyph fui-home"></span></a>';
	echo '</li>';

 	echo '<li>';
 	echo '<a href="clock.php">Clock In<span class="left-bar-glyph fui-time"></span></a>';
	echo '</li>';

	echo '<li class="dropdown">';
	echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#">Reports<span class="caret green"></span><span class="left-bar-glyph fui-document"></span></a>';
	echo '<ul class="dropdown-menu">';
	echo '<li><a href="developer_reports.php">Developer Reports</a></li>';
	echo '<li><a href="client_reports.php">Client Reports</a></li>';
	echo '<li><a href="project_reports.php">Project Reports</a></li>';
	echo '<li><a href="task_reports.php">Task Reports</a></li>';
	echo '</ul>';
	echo '</li>';

	echo '<li class="dropdown">';
	echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage Developers<span class="caret green"></span><span style="top:13px;" class="left-bar-glyph glyphicon glyphicon-user"></span></a>';
	echo '<ul class="dropdown-menu">';
	echo '<li><a href="create_developer.php">Create Developers</a></li>';
	echo '<li><a href="assign_client.php">Assign Client</a></li>';
	echo '<li><a href="assign_project.php">Assign Project</a></li>';
	echo '<li><a href="assign_task.php">Assign Task</a></li>';
	echo '<li><a href="unassign_client.php">Un-Assign Client</a></li>';
	echo '<li><a href="unassign_project.php">Un-Assign Project</a></li>';
	echo '<li><a href="unassign_task.php">Un-Assign Task</a></li>';
	echo '<li><a href="view_assignments.php">View All Assignments</a></li>';
	echo '</ul>';
	echo '</li>';

	echo '<li class="dropdown">';
	echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage Clients<span class="caret green"></span><span class="left-bar-glyph fui-user"></span></a>';
	echo '<ul class="dropdown-menu">';
	echo '<li><a href="add_hours.php">Add Purchased Hours</a></li>';
	echo '<li><a href="new_client.php">New Client</a></li>';
	echo '<li><a href="new_project.php">New Project</a></li>';
	echo '<li><a href="new_task.php">New Task</a></li>';
	echo '<li><a href="edit_client.php">Edit Client</a></li>';
	echo '<li><a href="edit_project.php">Edit Project</a></li>';
	echo '<li><a href="edit_task.php">Edit Task</a></li>';
	echo '<li><a href="delete_client.php">Delete Client</a></li>';
	echo '<li><a href="delete_project.php">Delete Project</a></li>';
	echo '<li><a href="delete_task.php">Delete Task</a></li>';
	echo '</ul>';
	echo '</li>';

	echo '<li class="dropdown">';
	echo '<a class="dropdown-toggle" data-toggle="dropdown" href="#">My Account<span class="caret green"></span><span class="left-bar-glyph fui-lock"></span></a>';
	echo '<ul class="dropdown-menu">';
	echo '<li><a href="update_info.php">Update Info</a></li>';
	echo '<li><a href="update_email.php">Update Email</a></li>';
	echo '<li><a href="update_password.php">Update Password</a></li>';
	echo '<li><a href="update_alerts.php">Update Alerts</a></li>';
	echo '</ul>';
	echo '</li>';

	echo '<li>';
	echo '<a href="edit_timesheet.php">Edit Time Sheet<span class="left-bar-glyph fui-gear"></span></a>';
	echo '</li>';

	echo '<li>';
	echo '<a href="client_profiles.php">View Client Profiles<span class="left-bar-glyph fui-image"></span></a>';
	echo '</li>';

	echo '<li>';
	echo '<a href="logout.php">Logout<span class="left-bar-glyph fui-exit"></span></a>';
	echo '</li>';

	echo '</ul>';
	echo '</div>';
	echo '<!-- /#sidebar-wrapper-left -->';
}	

function rightSidebar()
{
	echo '<!-- Sidebar -->';
	echo '<div id="sidebar-wrapper-right">';
	echo '<ul class="sidebar-nav sidebar-nav-right">';
	echo '<li class="sidebar-brand">';
	echo '<div style="width:60px;position:absolute; left:0px;"><a href="#menu-toggle-right" class="fui-mail" id="menu-toggle-right"></a></div>';
	echo '<a style="position:absolute; right:100px; text-align:center;" href="update_alerts.php">Alerts</a>';
	echo '</li>';

 	warningExpiringContracts( $_SESSION['Developer']->getDaysExpirationWarning() );
	warningLowHours( $_SESSION['Developer']->getHoursLeftWarning() );
 	
	echo '</ul>';
	echo '</div>';
	echo '<!-- /#sidebar-wrapper-right -->';
}	

//This function sets up the text in the sidebar and the dropdowns
function open_html_no_sidebar($title)
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
    	<link rel="icon" type="image/png" href="Images/fav.png">

    	<title>$title</title>
_END;

	echo '<link href="css/bootstrap.min.css" rel="stylesheet">';
	echo '<link href="css/style.css" rel="stylesheet">';
	echo '<link href="css/bootstrap.min.css" rel="stylesheet">';
	echo '<link href="css/simple-sidebar.css" rel="stylesheet">';
	echo '<link href="dist/css/flat-ui.css" rel="stylesheet">';
    echo '<link href="docs/assets/css/demo.css" rel="stylesheet">';

	echo '</head>';
	echo '<body>';
	echo '<div id="page-content-wrapper">';
	echo '<div class="container-fluid">';
}	

//This function toggles the side menu
function close_html()
{
	echo<<<_END
			</div>
			</div>
		</div>
			<script src="dist/js/vendor/jquery.min.js"></script>
			<script src="dist/js/flat-ui.min.js"></script>
			<script src="docs/assets/js/application.js"></script>
			<script src="../Javascript/dropdowns.js"></script>
			<script src="js/jquery.js"></script>
			<script>
				$("#menu-toggle-left").click(function(e) {
					e.preventDefault();
					$("#wrapper-left").toggleClass("toggled");
				});
				$("#menu-toggle-right").click(function(e) {
					e.preventDefault();
					$("#wrapper-right").toggleClass("toggled");
				});
			</script>
		</body>
	</html>
_END;
}

function close_html_no_sidebar()
{
	echo<<<_END
	</div>
	</div>
	<script src="dist/js/vendor/jquery.min.js"></script>
			<script src="dist/js/flat-ui.min.js"></script>
			<script src="docs/assets/js/application.js"></script>
			<script src="../Javascript/dropdowns.js"></script>
			<script src="js/jquery.js"></script>
		</body>
	</html>
_END;
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

//This function sets up the login page
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
    	<link rel="icon" type="image/png" href="Images/fav.png">

    	<title>$title</title>
_END;


	echo '<link href="css/bootstrap.min.css" rel="stylesheet">';
	echo '<link href="css/style.css" rel="stylesheet">';
	echo '<link href="css/bootstrap.min.css" rel="stylesheet">';
	echo '<link href="css/simple-sidebar.css" rel="stylesheet">';
	echo '<link href="dist/css/flat-ui.css" rel="stylesheet">';
    echo '<link href="docs/assets/css/demo.css" rel="stylesheet">';

	echo '</head>';
	echo '<body>';
	
	navigationBarHomePage('Log In');
	echo '<div id="page-content-wrapper">';
	echo '<div class="container-fluid">';
	
	
    echo '<main id="page-content-wrapper">'; 
	echo '<div class="col-lg-1">';
	echo '</div>';
	echo '<div class="col-lg-10 team-box">';
	echo '<div class="jumbotron">';
	echo '<h1 class="page-header">Login</h1>';
echo<<<_END
      <form  action="" method="POST">
		<label>User Name</label>
        <input type="text" name="username" class="form-control" required>
		<br>
		<label>Password</label>
        <input type="password" name="password" class="form-control" required>
		<br>
        <input type="submit" name="submit" value="Login" class="btn btn-block btn-lg btn-primary">
		<br>
      </form>
_END;
}

//This funcion sets up the logout page
function close_login()
{
	echo<<<_END
  	</body>
	<script src="dist/js/vendor/jquery.min.js"></script>
	<script src="dist/js/flat-ui.min.js"></script>
	<script src="docs/assets/js/application.js"></script>
	<script src="../Javascript/dropdowns.js"></script>
	<script src="js/jquery.js"></script>
</html>
_END;
}

//Navigation bar when not logged in
function navigationBarHomePage($active_page)
{
	$pages = array(
		"Home"=>"index.php",
		"About Us"=>"aboutus.php");
  echo<<<END
 <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">TimeTracker</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
END;
	foreach($pages as $key=>$value)
		if($active_page == $key )
			echo '<li style="z-index:2;background-color:#34495e;" class="active"><a href="' . $value . '">' . $key . '</a></li>';
		else 
			echo '<li style="z-index:2;background-color:#34495e;"><a href="' . $value . '">' . $key . '</a></li>';

echo<<<END
	</ul>
      <ul class="nav navbar-nav navbar-right">
        <li style="z-index:2;background-color:#34495e;"><a href="create_team_account.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li style="z-index:2;background-color:#34495e;"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
END;

	echo '<div id="page-content-wrapper">';
	echo '<div class="container-fluid">';
}

function isLogin()
{
	if(isset($_SESSION['Developer']))
	{
		//Nothing
	}
	else
	{
		header("Location:index.php");
	}
}

?>