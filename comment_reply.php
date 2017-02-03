<?php
include "config.php";// Check if logged in or not.
if(!$logged['id']){
	echo "You need to be logged in to post a comment! <a href='index.php'>Login Here!</a>";
}// Check if the comment was posted if not show the comment form.
elseif($_POST['message'] AND $_POST['user']){
	$message = mysql_real_escape_string($_POST['message']);
	$to = $_POST['user'];
	mysql_query("INSERT INTO `members_comments` VALUES ('','$to','$logged[id]','$message',unix_timestamp())");
	echo("<meta http-equiv='Refresh' content='1; URL=comment_reply.php?user=$to'/>Comment Posted.");
}else{                   
	$get_member = mysql_query("SELECT * FROM `users` WHERE `id` = '$_GET[user]'");
	$member = mysql_fetch_array($get_member);
	if(!mysql_num_rows($get_member)) {
		echo "This member does not exist! <a href='members.php?user=$_POST[user]'>Back</a>";
		}else{
		//  $member = mysql_fetch_array($get_member);
		echo ("<br />
		Adding a comment to $member[username]'s profile !
		<form action='comment_reply.php?user=$member[id]' method='POST'>
		<input type='hidden' name='user' value='$_GET[user]'>
		<textarea name='message' style='width: 99%; height: 70px;'></textarea>
		<input type='submit' value='Reply'>
		</form>");
		}
	}
?>
