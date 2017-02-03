<?
include("config.php");
$page_title='Change you password';
include("includes/header.php");
include("includes/menu.php");
?>
<!-- B.1 MAIN CONTENT -->
<div class="main-content">
<!-- Pagetitle -->
<h1 class="pagetitle"> <?php echo "$page_title"; ?> </h1>
<?php
//checks see if there logged in
if($logged[id]){ 
	if(isset($_GET['update'])) {
	//posts the passwords
	$oldpassword = md5($_POST[oldpassword]); 
	$newpassword = md5($_POST[newpassword]);
	$cnewpassword = md5($_POST[cnewpassword]);
	//get the users old info from the database
	$info = mysql_query("SELECT * FROM `users` WHERE `username` = '$logged[username]'"); 
	$info = mysql_fetch_array($info);
	//if the old password matches the password in the database we continue
		if($info[password] == $oldpassword) {
		//if the new password and conformation password are the same continue
			if($newpassword == $cnewpassword) {
			$update = mysql_query("UPDATE `users` SET `password` = '$newpassword' WHERE `username` = '$logged[username]'");
			echo "Password Updated, You will need to relogin with your new password.";
			unset($_SESSION['id']);
			unset($_SESSION['password']);
			}else{ echo ("Your new password and conformation password do not match!");	}
		}else{echo ("Your old password does not match the database password!");	}
	}else{		//shows the form if not already updated
		echo ("<div class='contactform'><form action='changepassword.php?update' method='post'>
		<p>Old Password: <input type='password' name='oldpassword' size='30' maxlength='50'></p><br>
		<p>New Password: <input type='password' name='newpassword' size='30' maxlength='50'></p><br>
		<p>Confirm Password: <input type='password' name='cnewpassword' size='30' maxlength='50'></p><br>
		<p><input type='submit' value='Change' class='button'></p>
		</form</div>");
		}
}else{echo("You are not logged in.");}
?>
</div>
<?include("includes/footer.php");?> 
    

