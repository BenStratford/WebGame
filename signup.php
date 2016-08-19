
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sign Up</title>

    <!-- Bootstrap Core CSS -->
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Log in</a>
            </div>
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Ben Stratford's Webgame</h1>
                <p class="lead">Sign Up</p>
                 <form name="login" id="login" method="post">
   					<table>
   						<tr><td>Username</td><td>:-</td><td><input type="text" name="uname" ></td></tr>
   						<tr><td>Password</td><td>:-</td><td><input type="password" name="pwd"></td></tr>
   						<tr><td><input type="submit" name="sbutton" value="SIGN UP"></td></tr>
   					</table>
  				</form>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
<?php
error_reporting(E_ALL);
 
if($_POST["uname"] != NULL)
$username=$_POST["uname"];
 
if($_POST["pwd"] != NULL)
$password=$_POST["pwd"];
 
if($_POST["sbutton"] !=NULL)
{
 //establish connection with MySQL
 
 $con = mysql_connect("localhost","root","classic1") or die('Could not connect: ' . mysql_error());
  
 //Select The required Database
 
 mysql_select_db("webgamedb",$con) or die('Could not select database: ' . mysql_error());
  
 //Extract the decrypted passwords and usernames from login table 
 
 $result=mysql_query("select username from login",$con)or die(mysql_error());
  
 //Find Out number of Rows of the desired table ie. the login table  
  
 $num_rows=mysql_num_rows($result);
 //Loop through the rows of table to check the password

 while($num_rows > 0)
 {
  $flag=0;  
  //fetch a row 
  $row=mysql_fetch_array($result);
  //extract fields
  $cuser=$row["username"];
  //compare usernames & passwords
  if(strcmp($cuser,$username) == 0)
   {
    $flag=1;
    break;
   }
     
  $num_rows--;
 
 }
 if($flag == 1){
  	echo "<font color='red'>Username already exists</font>";
 }else{
  echo "<font color='green'>successful</font>";

  $result=mysql_query("select username from login",$con)or die(mysql_error());
  $result = mysql_num_rows($result) + 1;
  mysql_query("insert into login values(" . $result . ",'".$username."', aes_encrypt('".$password."','6p1ar3R^w|q6JD{qirL6i5}1O7hq4}'))",$con)or die('Error: ' . mysql_error());

  mysql_query("insert into userinfo(id) values(" . $result . ")",$con)or die('Error: ' . mysql_error());

  header('Location: index.php');
 }
 mysql_close($con);
}
?>
</html>
