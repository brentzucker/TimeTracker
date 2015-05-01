<?php
/*
 Name: index.php
 Description: if login is correct to to page or load error
 Programmers: Ryan Graessle, Brent Zucker
 Dates: (4/18/15, 5/1/15)
 Names of files accessed: include.php
 Names of files changed:
 Input:
 Output: error message (if login information is incorrect)
 Error Handling: if the user informaltion is incorrect load the error message
 Modification List:
 4/18/15-Initial code up
 4/19/15-Starts session
 4/30/15-Moved file to main folder, fixed css/js links
 */

require_once(__DIR__.'/include.php');

navigationBarHomePage('Home');


open_html_no_sidebar('Time Tracker');

echo '<main id="page-content-wrapper">'; 

echo '<div class="col-lg-1"></div>'; //close centering div'; //centering

echo '<div class="col-lg-10 main-box">';

echo '<div class="jumbotron">';

echo '<h1 class="page-header">Time Tracker</h1>';

imageCarousel();

echo '<br>';

echo '<div class="row demo-tiles">';

//Login
echo '<div class="col-sm-4">';
echo '<div class="tile">';
echo '<h3 class="tile-title">Login</h3>';
echo '<a href="login.php">';
echo '<img class="tile-image big-illustration" src="Bootstrap/img/icons/svg/clocks.svg" alt="Watches">';
echo '<button class="btn btn-block btn-primary">Login</button>';
echo '</a>';
echo '</div>'; //close tile
echo '</div>';

//Create Account
echo '<div class="col-sm-4">';
echo '<div class="tile">';
echo '<h3 class="tile-title">Create Account</h3>';
echo '<a href="create_team_account.php">';
echo '<img class="tile-image big-illustration" src="Bootstrap/img/icons/svg/clipboard.svg" alt="Clipboard">';
echo '<button class="btn btn-block btn-primary">Create Account</button>';
echo '</a>';
echo '</div>'; //close tile
echo '</div>';

//About us
echo '<div class="col-sm-4">';
echo '<div class="tile">';
echo '<h3 class="tile-title">About Us</h3>';
echo '<a href="aboutus.php">';
echo '<img class="tile-image big-illustration" src="Bootstrap/img/icons/svg/map.svg" alt="Map">';
echo '<button class="btn btn-block btn-primary">About Us</button>';
echo '</a>';
echo '</div>'; //close tile
echo '</div>';

echo '</div>'; //close row demo-tiles

echo '</div>'; //close jumbotron

echo '<div class="col-sm-2"></div>'; //close centering div'; //centering

echo '</div>';

echo '</main>';

close_html_no_sidebar();

function imageCarousel()
{
	echo<<<END
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div style="border-radius:5px;" class="carousel-inner" role="listbox">

      <div class="item active" style="border-radius:5px;">
        <img src="Bootstrap/img/screenshots/ClockIn.png" alt="Clock In" width="100%" class="img-rounded img-center">
        <div class="carousel-caption">
        </div>
      </div>

      <div class="item">
        <img src="Bootstrap/img/screenshots/ViewReports.png" alt="View Reports" width="100%" class="img-rounded img-center">
        <div class="carousel-caption">
        </div>
      </div>
    
      <div class="item">
        <img src="Bootstrap/img/screenshots/AssignTask.png" alt="Assign Tasks" width="100%" class="img-rounded img-center">
        <div class="carousel-caption">
        </div>
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a style="border-radius:5px;" class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a style="border-radius:5px;" class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
END;
}

?>