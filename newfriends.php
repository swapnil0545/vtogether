<?
include "config.php"; // inlcudes config
$page_title='Friend Requests';
include("includes/header.php");
include("includes/menu.php");
?>
<!-- B.1 MAIN CONTENT -->
<div class="main-content">       
<!-- Pagetitle -->
<h1 class="pagetitle"> <?php echo "$page_title"; ?> </h1>
	<div class="column1-unit">
<?php
if ($logged[username]) { //checks user is logged in 
switch ($_GET[friends]) { //allows multiple pages
default:
$get = mysql_query( "SELECT * FROM `friend_requests` WHERE `username` = '$logged[username]' "); //gets requests
if ($reqs = mysql_fetch_array($get)){
	echo ( "<h2>$reqs[by] wants to be friends with you.</h2>
	<p><a href='newfriends.php?friends=accept&user=$reqs[by]'>Accept</a></p>
	<p><a href='newfriends.php?friends=delete&user=$reqs[by]'>Delete</a></p>" ); //displays requests and shows accept delete links
	}else echo ("You have no New friend requests");
break;
case 'accept': //accept page
	if ($_GET[user]) { //get username
		$add = mysql_query( "INSERT INTO `friends` (`friendname` , `username`) VALUES ('$_GET[user]' , '$logged[username]') "); 
		$add = mysql_query( "INSERT INTO `friends` (`username` , `friendname`) VALUES ('$_GET[user]' , '$logged[username]') ");// add to your friends list
		$delete = mysql_query( "DELETE FROM `friend_requests` WHERE `by` = '$_GET[user]' "); // deletes friend request
		echo ( "$_GET[user] has been added as a friend and the request has been deleted" ); // echos the completion
	}
break; //ends accept page
case 'delete': // delete page
	if ($_GET[user]) { //gets username
		$delete = mysql_query( "DELETE FROM `friend_requests` WHERE `by` = '$_GET[user]' "); // deletes friend request
		echo ( "$_GET[user]'s request has been deleted" ); // echos completion
	}
break; //ends delete page
} // ends switch
}else{
echo ( "You need to be logged in" ); // not logged in
}
?> 
</div></div>
<?include("includes/footer.php");?> 
