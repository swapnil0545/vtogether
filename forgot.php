<?php
include("config.php");
$page_title='Forgot pass';
include("includes/header.php");
?>
<div class="main">
<link rel="stylesheet" type="text/css" media="screen,projection,print" href="./css/layout1_setup.css" />
 <!-- B.1 MAIN CONTENT -->
<div class="main-content">
<!-- Pagetitle -->
<h1 class="pagetitle"> <?php echo "$page_title"; ?> </h1>
<?
if (!$_POST['lost_pass']) {//the form hasn't been submitted, we make it
	echo ("<div class='contactform'>
	<p>In order to recover your password need the Secret Name Or Number your registered with.\n<br \>
	<form method=post><p>Secret Name Or Number <input type=text name=secret></p><br />
	<p>Email Adress <input type=text name=email></p><br />
	<p><input type=\"submit\" name=\"lost_pass\" value='Recover Password' class='button'></p>
	</form>");
	}else{
	$secret = $_POST['secret']; //this is making the $email the input into the email part in the form
	$sql = "SELECT * FROM users WHERE secret='$secret'"; //this is checking the emails in the database looking for the one posted in the form
	$checksecret = mysql_query($sql)
	or die(mysql_error());
	//the above lines look for the email address in the member table
	if (mysql_num_rows($checksecret) == "0") {
		exit("We can't find that Secret Nick in our member database,
		please make sure you entered the correct secret");
		}//if the email doesn't exist, tell the user it doesn't
	$checksecret = mysql_fetch_array($checksecret);
	$user = $checksecret['username'];
	// Random Password Generator
	$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	//shuffles the letters around to create a 16 long code
	$code = substr(str_shuffle($alphanum), 0, 7);
	$newpassword = md5($code);
	$update = "UPDATE `users` SET `password` = '" . $newpassword . "' WHERE `username` = '" . $user . "'";
	mysql_query($update) or die(mysql_error());
	//change the member's password to the new generated one
	$subject = "<h1>Password Recovery</h1>"; //here is the subject of the email
	$message = ("<p>Dear $user, The email was generated because it has come to our attention that you have forgot your password.<br/>
	Please find below your new password once you have logged into your account please go into your control panel and change your password.<br/>
	New Password: " . $code . "<br/>
	Thank you for using the password recovery service, have a nice day</p>"); //this is what is displayed in the email
	$sender = "<h3>altaf6509gmail.com</h3>"; //change this to your site
	//mail($email, $subject, $message, $sender)
	echo " $subject $message $sender";
	echo ("<hr><p>Password Reset Successful - Please login to your email account and find an email from our site with your new password.</p>");
	}
?>
</div> </div></div>
<?include("includes/footer.php");?>

