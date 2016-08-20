<?php 
	session_start();
	 //establish connection with MySQL 
	$con = mysql_connect("localhost","root","classic1") or die('Could not connect: ' . mysql_error());
	 //Select The required Database
	mysql_select_db("webgamedb",$con) or die('Could not select database: ' . mysql_error());
	$Username = mysql_query("select username from login where id=".$_SESSION["cuserid"],$con);
	$Username=mysql_fetch_array($Username);
	$Username=$Username["username"];

	$Userinfo = mysql_query("select * from userinfo where userId=".$_SESSION["cuserid"],$con);
	$Userinfo=mysql_fetch_array($Userinfo);
	
	$Money=$Userinfo["money"];
  	$shop=$_GET["shop"];
  	$buying=$_GET["buy"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<style>
		body{
			background-color: white;
		}
	</style>
</head>
<body>
<?php if (strcmp($shop,"Supermarket")==0): ?>
	<h1>You're in the Supermarket!</h1>
	<?php if (strcmp($buying,"yes")==0): ?>
		<h3>You are buying!</h3>
	<?php else: ?>
		<h3>You are selling!</h3>
	<?php endif; ?>


<?php elseif(strcmp($shop,"Hardware")==0): ?>
	<h1>You're in the Hardware Store!</h1>
	<?php if (strcmp($buying,"yes")==0): ?>
		<h3>You are buying!</h3>
	<?php else: ?>
		<h3>You are selling!</h3>
	<?php endif; ?>
	<ul>
	<?php
		$weapons = mysql_query("select * from weapons where weaponId<6 or weaponId=7 or weaponId=8",$con);
		$num_rows=mysql_num_rows($weapons);
		while($num_rows>0){
			$num_rows--;
			$row=mysql_fetch_array($weapons);

			echo "<li>" . $row['Weapon'] . ": Price: " . $row["Price"] . " <input type='button' value='Add'></li>";
		}
	?>
	</ul>
<?php elseif(strcmp($shop,"Electronics")==0): ?>
	<h1>You're in the Electronics Store!</h1>
<?php endif; ?>
</body>