<?php 
include ('config.php');
$page_title='Blocked Users';
include ('includes/header.php');
include ('includes/menu.php');
?>
 <!-- B.1 MAIN CONTENT -->
<div class="main-content">     
<!-- Pagetitle -->
<h1 class="pagetitle"> <?php echo "$page_title"; ?> </h1>
<?
 if(!$logged['id']){
     echo "You need to be logged in to post a comment! <a href='index.php'>Login Here!</a>";
     }             // else if you are logged in then show the link.
	 else{
	switch($_GET[page]){ //make some links ?page=case
	case 'deleteall': // delete page
	$delete = mysql_query( "DELETE FROM `blocklist` WHERE `username` = '$logged[username]' "); // deletes friend request
	echo ( "You have unblocked all your foes." ); // echos completion
	break; //ends delete page
	case 'block': // delete page
	if ($_GET[user]){ //gets username
		$thefoe = htmlspecialchars($_GET[user]); //friend
		$query = mysql_query("INSERT INTO `blocklist` ( `username` , `foe` ) VALUES ( '$logged[username]' , '$thefoe' )"); //inserts the request
		echo ( "You have blocked $thefoe. They cannot send you PMs anymore." ); // echos completion
		}
	break;
	case 'delete': // delete page
	if ($_GET[user]) { //get username
		$delete = mysql_query( "DELETE FROM `blocklist` WHERE `foe` = '$_GET[user]' "); // deletes friend request
		echo ( "$_GET[user] has been unblocked." ); // echos completion
		}
	break; //ends delete page
	default: //set up the default page upon going to inbox.php
	$afed = mysql_query("SELECT * FROM `blocklist` WHERE `username` = '$logged[username]' ORDER BY `id` ASC") or die(mysql_error()); 
	//loops there name out 
	echo "<h1>Blocklist</h1>
	<p><u><a href='?page=deleteall'>Delete All Foes</a></u></p><center>
	<table align=center>
	<tr align='center' id='top'>
	<th class='top' scope='col'>Username</th>
	<th class='top' scope='col' >Remove</th></tr>";
	$get = mysql_query("SELECT * FROM `blocklist` WHERE `username` = '" . $logged[username] . "'"); //get the private messages
	$enemys = mysql_query("SELECT * FROM `blocklist` WHERE `username` = '$logged[username]' ORDER BY `id` ASC") or die(mysql_error()); 
	if(mysql_num_rows($get) == "0"){
		echo "<tr align='center'><td colspan='2'>You Have No Enemies!</td></tr></table>";
		}else{
			while ($e = mysql_fetch_array($enemys)) { 
			$fid = mysql_query("SELECT * FROM `users` WHERE `username` = '$e[foe]'") or die(mysql_error()); 
			$fri = mysql_fetch_array($fid);
			echo "<tr align='center'><td><a href='members.php?user=$fri[id]'>$e[foe]</a></td><td><a href='?page=delete&amp;user=$e[foe]'><img src='images/delete64.png' border='0' title='Unblock User'></a></td></tr>";
				}
			echo "</table></center>";
			}
	break;
	}
}
?> 
</div>
<?include("includes/footer.php");?>

