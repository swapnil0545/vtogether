<?php
include("config.php");
if (!$logged[username])
{
	if (!$_POST[login])
	{
		echo("<meta http-equiv=\"Refresh\" content=\"0; URL=index.php\"/>Thank You! You will be redirected");
	}
	if ($_POST[login]) {
		// the form has been submitted.  We continue...
		$username=$_POST['username'];
		$password = md5($_POST[password]);		
		//gets the username data from the members database 
		// the above lines set variables with the submitted information.  
		$info = mysql_query("SELECT * FROM users WHERE username = '$username'") or die(mysql_error());
		$data = mysql_fetch_array($info);
		if($data[password] != $password) {
			// the password was not the user's password!
			echo "Incorrect username or password!";
		}else{
			// the password was right!
			$query = mysql_query("SELECT * FROM users WHERE username = '$username'") or die(mysql_error());
			$user = mysql_fetch_array($query);
			// gets the user's information
			setcookie("id", $user[id],time()+(60*60*24*5), "/", "");
			setcookie("pass", $user[password],time()+(60*60*24*5), "/", "");
			// the above lines set 2 cookies. 1 with the user's id and another with his/her password.  
			echo ("<meta http-equiv=\"Refresh\" content=\"0; URL=home.php\"/>Thank You! You will be redirected");
			// modify the above line...add in your site url instead of yoursite.com
		}
	}
}else{
	$page_title='Home';
	// we now display the user controls.
	$new = mysql_query("select * from pmessages where unread = 'unread' and touser = '$logged[username]'");
	$new = mysql_num_rows($new);
	$newfr = mysql_query("select * from friend_requests where username = '$logged[username]'");
	$newfr = mysql_num_rows($newfr);
	echo ("<meta http-equiv=\"Refresh\" content=\"0; URL=home.php\"/>Thank You! You will be redirected");
}
?>
