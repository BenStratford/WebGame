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
  	$curActivity=$Userinfo["currentActivity"];
  	
  	$strength=$Userinfo["strength"];
  	$endurance=$Userinfo["endurance"];
  	$hacking=$Userinfo["hacking"];
  	$soe=$Userinfo["sleightOfHand"];
  	$marksmanship=$Userinfo["marksmanship"];
  	
  	$health=$Userinfo["health"];
  	$maxHealth=100+(10*$endurance);

  	$curWeapon=$Userinfo["curWeapon"];
?>
<!DOCTYPE html>
<html lang="en">
<style>
	body{
		background-color:white;
	}
</style>
<body>
<h1>Player Screen</h1>
<h4>Player Name: <?=$Username?></h4>
<h4>Health: <?=$health?>/<?=$maxHealth?></h4>
<h4>Funds: <?php 
	setlocale(LC_MONETARY, 'en_US'); 
    echo money_format ( '$%i' , $Money ); ?>
</h4>

<ul>
	<li>Strength: <?=$strength?></li>
	<li>Endurance: <?=$endurance?></li>
	<li>Marksmanship: <?=$marksmanship?></li>
	<li>Hacking: <?=$hacking?></li>
	<li>Sleight of Hand: <?=$soe?></li>
</ul>

<h4>Equipped Weapon: <?=$curWeapon?></h4>
<h4>Weapons: </h4>
<ul>
	<?php
		$weapons = mysql_query("select * from weapons inner join userWeapons using (weaponId) where userId=".$_SESSION['cuserid'],$con);
		$num_rows=mysql_num_rows($weapons);
		while($num_rows>0){
			$num_rows--;
			$row=mysql_fetch_array($weapons);
			echo "<li>" . $row['quantity'] . "x " . $row['Weapon'] . " <input type='button' value='Equip'></li>";
		}
	?>
</ul>
</body>