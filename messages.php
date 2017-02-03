<?
include("config.php");
include("validate.php");
$page_title='Private Messages';
include("includes/header.php");
include("includes/menu.php");
?>
<div class="main-content">
<!-- Pagetitle -->
<h1 class="pagetitle"> <?php echo "$page_title"; ?> </h1>
<div class="column1-unit">
<!-- Content unit - One column -->
<div class='column1-unit'>
<?php
if ($logged[username]){//checks to see if they are logged in
	$getfoe = mysql_query("SELECT * FROM `blocklist` WHERE `foe` = '$logged[username]'");
	$en = mysql_fetch_array($getfoe); 
	switch($_GET[page])
	{
	//this allows us to use one page for the entire thing
	default:
	echo"
	<meta http-equiv='refresh' content='0;URL=messages.php?page=inbox'>
	";
	break;
	case 'write':
	if (!$_POST[send]){
	if ($_POST[send] && $_POST[to] == $en[username]){
		echo "<b>Error:</b> This user has blocked you from sending any PMs to you.";
		}else{//the form hasnt been submitted yet....
			echo("
				<a href='messages.php'>Go Back</a><br><br>
				<form method=\"post\" action=\"\">
				<h2>To User :</h2>"); //echo some of the form and whatnot
				if(isset($_GET[user])){ //check if there is a user in the address bar
					echo "<input type=\"text\" name=\"to\" value=\"$_GET[user]\" size=\"15\">"; //if there is
				}
else{ //or not..
				      echo "<input type=\"text\" name=\"to\" size=\"15\">"; //input box without value of user!
						}//end user check in address bar
				echo ("
					<p><br/>Message Subject<br/>
					<input type=\"text\" name=\"subject\" size=\"20\"></p>
					<p><br/>Message<br/>
			<textarea rows=\"7\" name=\"message\" cols=\"35\"></textarea><br/>
			<input type=\"submit\" value=\"Submit\" name=\"send\" class='button'>
					</form></p>
					");
				}//close line 33 else
		}//close if line 30 ching send or not
		if ($_POST[to]){
		//the form has been submitted.  Now we have to make it secure and insert it into the database
			if ($_POST[send] && $_POST[to] == $en[username]){
			echo "<b>Error:</b> This user has blocked you from sending any PMs to you.";
			}else{
				$subject = protect(("$_POST[subject]"));
				$message = protect(("$_POST[message]"));
				$to = protect(("$_POST[to]"));
				//the above lines remove html and add \ before all "
				$send = mysql_query("INSERT INTO `pmessages` ( `title` , `message` ,  
				`touser` , `from` , `unread` ,  `date` ) VALUES ('$subject', '$message', '$to', 
				'$logged[username]', 'unread', NOW())");
				echo ("
				<a href='messages.php?page=inbox'>Go Back</a><br><br>
				Your message has been sent.");
				}
		}
	break;
	case 'delete':
	if (!$_GET[msgid]){
		echo ("
		<a href='messages.php?page=inbox'>Go Back</a><br><br>
		Sorry, but this is an invalid message.
		");
	}else{
		$getmsg = mysql_query("SELECT * from pmessages where id = '$_GET[msgid]'");
		$msg = mysql_fetch_array($getmsg);
		//hmm..someones trying to delete someone elses messages!  This keeps them from doing it
		if ($msg[touser] != $logged[username])
		{
		echo ("
		<a href='messages.php?page=inbox'>Go Back</a><br><br>
		This message was not sent to you!
		");
		}else{
$delete  = mysql_query("delete from pmessages where id = '$_GET[msgid]'");
			echo ("<a href='messages.php?page=inbox'>Go Back</a><br><br>
			Message Deleted!");
		}}
	break;
	case 'deleteall':
	$delete  = mysql_query("delete from pmessages where touser = '$logged[username]'");
	echo ("<a href='messages.php?page=inbox'>Go Back</a><br><br>
	All Message Deleted!");
	break;
	case 'inbox':
$get = mysql_query("SELECT * from pmessages where touser = '$logged[username]' order by id desc");
	echo("
	<p><a href='messages.php?page=inbox'>Go Back</a><br><br>
	<a href='messages.php?page=write'>Create New Message</a><br><br>
	<a href='messages.php?page=deleteall'>Delete All Messages</a><br><br>
	</p>");
	$nummessages = mysql_num_rows($get);
	if ($nummessages == 0){
		echo ("<h1>You have 0 messages!</h1>");
		}else{
			echo("<table border='0' width='100%' cellspacing='0'>
			<tr>
			<th class='top' scope='col'>Subject</th>
			<th class='top' scope='col'>From</th>
			<th class='top' scope='col'>Date</th>
			<th class='top' scope='col'>Delete</th>
			</tr>
			</table>
			<hr class='clear-contentunit' /> 
			<table border='0' width='100%' cellspacing='1'>");
			while ($messages = mysql_fetch_array($get)){
				//the above lines gets all the messages sent to you, and displays them with the newest ones on top
				echo ("<tr><th scope='row'>
				<a href='messages.php?page=view&msgid=$messages[id]'>");
				if ($messages[reply] == yes){
					echo ("Reply to: ");
				}
				echo ("$messages[title]</a></th>
				<th scope='row'>$messages[from]</th>
				<th scope='row'>$messages[date]</th>
				<th scope='row'><a href=\"messages.php?page=delete&msgid=$messages[id]\">Delete</a></th>
				</tr>");
			}//close while
			echo ("</table>");
			}//close else
	break;
	case 'view':
	//the url now should look like ?page=view&msgid=#
	if (!$_GET[msgid]){//there isnt a &msgid=# in the url
		echo ("
		<a href='messages.php?page=inbox'>Go Back</a><br><br>
		Invalid message!");
	}else{//the url is fine..so we continue...
		$getmsg= mysql_query("SELECT * from pmessages where id = '$_GET[msgid]'");
		$msg = mysql_fetch_array($getmsg);
		//the above lines get the message, and put the details into an array.
		if ($msg[touser] == $logged[username]){
			//makes sure that this message was sent to the logged in member
			if (!$_POST[message])
{//the form has not been submitted, so we display the message and the form
$markread = mysql_query("Update pmessages set unread = 'read' where id = '$_GET[msgid]'");
				//this line marks the message as read.
				$msg[message] = nl2br(stripslashes("$msg[message]"));
				echo ("
				<form method=\"POST\" style=\"margin: 0px;\">
				<h1>Title-$msg[title]</h1> <h3>From $msg[from]</h3>
				<hr><p>$msg[message]</p>
				<hr><p>Reply back</p>
<p><textarea rows=\"6\" name=\"message\" cols=\"45\"></textarea></p>
<input type=\"submit\" value=\"Submit\" name=\"send\" class='button'>
				</form>");
			}
			if ($_POST[message]){//This will send the Message to the database
				$message = protect(("$_POST[message]"));
				$do = mysql_query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` ,  
				`date`, `reply`) VALUES
				('$msg[title]', '$message', '$msg[from]', '$logged[username]',
				'unread', NOW(), 'yes')");
				echo ("
				<a href='messages.php?page=inbox'>Go Back</a><br><br>
				Your message has been sent");
			}// close 161 if
		}else{//If of line 145 This keeps users from veiwing other users comments
			echo("
			<a href='messages.php?page=inbox'>Go Back</a><br><br>
			<b>Error</b><br />");
			echo ("This message was not sent to you!");
			}
	}
	echo("</td></tr></table>");
	break;
	}
	}else{echo("LOGIN");}
?>
</div></div></div>
<?include("includes/footer.php");?>
