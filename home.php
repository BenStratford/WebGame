<?php 
	session_start();
	 //establish connection with MySQL 
	$con = mysql_connect("localhost","root","classic1") or die('Could not connect: ' . mysql_error());
	 //Select The required Database
	mysql_select_db("webgamedb",$con) or die('Could not select database: ' . mysql_error());
	$Username = mysql_query("select username from login where id=".$_SESSION["cuserid"],$con);
	$Username=mysql_fetch_array($Username);
	$Username=$Username["username"];

	$Money = mysql_query("select money from userinfo where id=".$_SESSION["cuserid"],$con);
	$Money=mysql_fetch_array($Money);
	$Money=$Money["money"];

  $curActivity = mysql_query("select currentActivity from userinfo where id=".$_SESSION["cuserid"],$con);
  $curActivity = mysql_fetch_array($curActivity);
  $curActivity=$curActivity["currentActivity"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ben Stratford's Web Game</title>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>

</head>

<body>
  <div class = "background" id = "centrebg"></div>
	<div class = "background" id = "leftbg"></div>
  <div class = "background" id = "rightbg"></div>
    <!-- Navigation -->

  <nav class="navbar navbar-default" style ="margin-bottom:0px;border-radius:0px">
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header" style="margin-left:220px;">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><?= $Username ?></a>
      </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="#">Link</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
      	  <li><a href="#"><?php 
      		  setlocale(LC_MONETARY, 'en_US'); 
      		  echo money_format ( '$%i' , $Money ); ?>
      		  </a>
      	  </li>
          <li><a href="logout.php">Log Out</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
    <!-- Page Content -->

  <div class="sidebar">
    <div id="locationsHeader"><strong>LOCATIONS</strong></div>
    <input type="button" class="button" onclick="displayActivities('Supermarket')"; value="Supermarket">
    <input type="button" class="button" onclick="displayActivities('Hardware Store')"; value="Hardware Store">
    <input type="button" class="button" onclick="displayActivities('Electronics Store')"; value="Electronics Store">
    <input type="button" class="button" onclick="displayActivities('Town Hall')"; value="Town Hall">
    <input type="button" class="button" onclick="displayActivities('Training')"; value="Training">
    <input type="button" class="button" onclick="displayActivities('Docks')"; value="Docks">
    <input type="button" class="button" onclick="displayActivities('Casino')"; value="Casino">
    <input type="button" class="button" onclick="displayActivities('Phone Booth')"; value="Phone Booth">
    <input type="button" class="button" onclick="displayActivities('Bank')"; value="Bank">
  </div>

  <div class="sidebar" id="right" style="float: right;">
    <div id="currentActivity">
      <strong>Current Activity:<br></strong>
      <?= $curActivity ?>
    </div>
    <div id="activities">
    </div>
  </div>
  <iframe id="iframe" src="#"></iframe>
  <script>
    function displayActivities(str){
      switch(str){
        case "Supermarket":
        document.getElementById("activities").innerHTML = 
        "Supermarket<input type='button' class='button' onclick= \x22document.getElementById('iframe').src='Supermarket.php'\x22 value='Buy'><input type='button' class='button' value='Sell'><input type='button' class='button' value='Shoplift'>";
        break;
        case "Hardware Store":
        document.getElementById("activities").innerHTML = 
        "<input type='button' class='button' value='Buy'><input type='button' class='button' value='Sell'><input type='button' class='button' value='Shoplift'>";
        break;
        case "Electronics Store":
        document.getElementById("activities").innerHTML = 
        "<input type='button' class='button' value='Buy'><input type='button' class='button' value='Sell'><input type='button' class='button' value='Shoplift'>";
        break;
        case "Town Hall":
        document.getElementById("activities").innerHTML = 
        "<input type='button' class='button' value='Player List'><input type='button' class='button' value='Change Name'>";
        break;
        case "Training":
        document.getElementById("activities").innerHTML = 
        "<input type='button' class='button' value='Gym'><input type='button' class='button' value='Firing Range'><input type='button' class='button' value='Internet Cafe'>";
        break;
        case "Docks":
        document.getElementById("activities").innerHTML = 
        "<input type='button' class='button' value='Black Market'><input type='button' class='button' value='Smuggle'>";
        break;
        case "Casino":
        document.getElementById("activities").innerHTML = 
        "<input type='button' class='button' value='Slots'><input type='button' class='button' value='Yahtzee'>";
        break;
        case "Phone Booth":
        document.getElementById("activities").innerHTML = 
        "<input type='button' class='button' value='Hire Hitman'><input type='button' class='button' value='Assassination Jobs'>";
        break;
        case "Bank":
        document.getElementById("activities").innerHTML = 
        "<input type='button' class='button' value='Plan Heist'>";
        break;
      }
    }
  </script>

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
 </body>