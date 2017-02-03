<?
include "config.php"; //include config.
include "validate.php";
if ($logged[username])
{ //checks user is logged in
	if ($_GET[user])
	{ //gets username
		$username = protect($_GET[user]); //friend
		$by = $logged[username]; //you
		$checkname = mysql_query("SELECT username,friendname FROM friends WHERE username='$by' AND friendname='$username'");
		$check= mysql_num_rows($checkname);
		if ($check>0) {
			echo ("The friend is already added");
			echo ("<meta http-equiv=\"Refresh\" content=\"1; URL=my_friends.php\"/>");
			}else{
				$query = mysql_query("INSERT INTO `friend_requests` ( `username` , `by` ) VALUES ( '$username' , '$by' )"); //inserts the request
				echo("<p>$username has been sent a request you must now wait for it to be accepted</p>"); 
				$id=mysql_query("SELECT * FROM users WHERE username='$username'");
				$id=mysql_fetch_array($id);
				echo ("<meta http-equiv=\"Refresh\" content=\"1; URL=members.php?user=$id[id]\"/>");
				}
	}else{ echo("<p>No request was made</p>"); }
}
else {
echo ("<p>You need to be logged in</p>"); 
}
?>  
