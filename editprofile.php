<?
include("config.php");
include("validate.php");
$page_title='Edit profile';
include("includes/header.php");
include("includes/menu.php");
?>
<!-- B.1 MAIN CONTENT -->
<div class="main-content">
<!-- Pagetitle -->
<h1 class="pagetitle"> <?php echo "$page_title"; ?> </h1>
<?php
if ($logged[username]){
	if($_POST['deleteid']){
		$del = $_POST['delid'];
		$del= MYSQL_QUERY("SELECT * from users WHERE id='$del'");
		$del = mysql_fetch_array($del);
		echo ("<h1>Warning! your account will be deleted</h1>");
		echo ("Are you sure! You want to delete your account.<br>All your details will be deleted");
		echo ("<form action='editprofile.php?user=$del[id]' method='POST'>
		<input type='hidden' name='delid' value='$del[id]' />
		<select name='confirm'>
		<option value='yes'> YES</option>
		<option value='no'> No </option></select>
		<input type='submit' name='deleteid' value='confirm' class='button'/>
		</form>	");
		$conf = $_POST['confirm'];
		if($conf=='yes'){
		echo (" $del[id] $del[username] $del ");
		$update=mysql_query("DELETE FROM `users` Where id=$del[id]");
		$update=mysql_query("DELETE FROM `pmessages` Where touser=$del[username]");
		$update=mysql_query("DELETE FROM `members_comments` Where member_id=$del[id]");
		$update=mysql_query("DELETE FROM `friend_requests` Where username=$del[username]");
		$update=mysql_query("DELETE FROM `friends` Where username='$del[username]' OR friendname='$del[username]'");
		$update=mysql_query("DELETE FROM `blocklist` Where username=$del[username]");
		$update=mysql_query("DELETE FROM `album` Where userid=$del[id]");
		echo ("<meta http-equiv=\"Refresh\" content='4; url=index.php'/>Account deleted	");}
		}//delete post complete	
	if (!$_POST[update])
	{// the form hasn't been submitted.  We continue...
	$profile = mysql_query("SELECT * from users where username = '$logged[username]'");
	$profile = mysql_fetch_array($profile);
	// the above lines get the information so that it can be displayed in the html form.
	echo("<p>
	<a href='changepassword.php' title='Changepass'>Change password?</a></p>
	<div class='contactform'>
	<fieldset><legend>&nbsp;PROFILE DETAILS&nbsp;</legend>
	<form method=\"POST\">
	<p><label class='left'>Display Pic: (do not add http:// before) </label>
	<input type='text' size=\"25\" class='field' name=\"picture\" value=\"$profile[picture]\" /></p>
	<p><label class='left'>About me:</label>
	<textarea size=\"25\" class='field' name=\"abtme\" value='$profile[abtme]'>$profile[abtme]</textarea></p>
	<p><label class='left'>Language:</label>
	<input type='text' size=\"25\" class='field' name=\"lang\" value=\"$profile[lang]\" /></p>
	<p><label class='left'>School:</label>
	<input type='text' size=\"25\" class='field' name=\"scl\" value=\"$profile[scl]\" /></p>
	<p><label class='left'>College:</label>
	<input type='text' size=\"25\" class='field' name=\"col\" value=\"$profile[col]\" /></p>
	<p><label class='left'>BirthDate: *</label>
	<input type='text' size=\"25\" class='field' name=\"dob\" value=\"$profile[dob]\" /></p>
	<p><label class='left'>Religion:</label>
	<input type='text' size=\"25\" class='field' name=\"rlgn\" value=\"$profile[rlgn]\"/></p>
	<p><label class='left'>Phone no:</label>
	<input type='text' size=\"25\" class='field' name=\"pno\" value=\"$profile[pno]\" /></p>
	<p><label class='left'>Yahoo Messenger:</label>
	<input type='text' size=\"25\" class='field' name=\"yahoo\" value=\"$profile[yahoo]\" /></p>
	<p><label class='left'>Email Addr :*</label>
	<input type='text' size=\"25\" class='field' name=\"email\" value=\"$profile[email]\" /></p>
	<p><label class='left'>Address 1:</label>
	<input type='text' size=\"25\" class='field' name=\"add1\" value=\"$profile[add1]\" /></p>
	<p><label class='left'>Address 2:</label>
	<input type='text' size=\"25\" class='field' name=\"add2\" value=\"$profile[add2]\" /></p>
	<p><label class='left'>Zip Code:</label>
	<input type='text' size=\"25\" class='field' name=\"zipc\" value=\"$profile[zipc]\" /></p>
	<p><label class='left'>Country :*</label>
	<input type='text' size=\"25\" class='field' name=\"ctry\" value=\"$profile[ctry]\" /></p>
	<p>
	<label for='gender' class='left'>I am :</label> ");
	switch($profile[gender]){
	case Male:
	echo"<input type='radio' name='gender' value='Male' checked='checked'/> Male<br />
	<input type='radio' name='rstats' value='Female' /> Female<br />";
	break;
	case Female:
	echo"<input type='radio' name='gender' value='Male'/> Male<br />
	<input type='radio' name='rstats' value='Female'  checked='checked'/> Female<br />";
	break;
	default:
	echo"<input type='radio' name='gender' value='Male'/> Male<br />
	<input type='radio' name='rstats' value='Female'/> Female<br />";
	}
	echo("
	</p>
	<p>
	<label for='rstats' class='left'>Relationship status :</label> ");
	switch($profile[rstats]){
	case Single:
	echo"<input type='radio' name='rstats' value='Single' checked='checked'/> Single<br />
	<input type='radio' name='rstats' value='Committed' /> Commited<br />
	<input type='radio' name='rstats' value='Married' /> Married<br />";
	break;
	case Committed:
	echo"<input type='radio' name='rstats' value='Single' /> Single<br /><input type='radio' name='rstats' value='Committed' checked='checked'/> Committed<br /><input type='radio' name='rstats' value='Married' /> Married<br />";
	break;
	case Married:
	echo"<input type='radio' name='rstats' value='Single' /> Single<br />
	<input type='radio' name='rstats' value='Committed' /> Commited<br /><input type='radio' name='rstats' value='Married' checked='checked'/> Married<br />";
	break;
	default:
	echo"<input type='radio' name='rstats' value='Single' /> Single<br />
	<input type='radio' name='rstats' value='Committed' /> Commited<br /><input type='radio' name='rstats' value='Married'/> Married<br />";
	break;
	}
	echo("
	</p>
	<input type=\"submit\" name=\"update\" class='button' value=\"Update\">
	</form>
	<br/><br/><br/>
	<p>&nbsp;Delete Account&nbsp;</p>
	<form action='editprofile.php?user=$profile[id]' method='POST'>
	<input type='hidden' name='delid' value='$profile[id]' />
	<input type='submit' name='deleteid' value='Delete Account' class='button'/>
	</form>
	</fieldset>
	<br/>
	</div>");
	}
	else
	{
		$picture = protect($_POST[picture]);
		$abtme = protect($_POST[abtme]);
		$lang = protect($_POST[lang]);
		$scl = protect($_POST[scl]);
		$col = protect($_POST[col]);
		$dob = protect($_POST[dob]);
		$rlgn= protect($_POST[rlgn]);
		$pno = protect($_POST[pno]);
		$yahoo = protect($_POST[yahoo]);
		$email = protect($_POST[email]);
		$add1 = protect($_POST[add1]);
		$add2 = protect($_POST[add2]);
		$zipc = protect($_POST[zipc]);
		$ctry = protect($_POST[ctry]);
		$gender= protect($_POST[gender]);
		$rstats = protect($_POST[rstats]);
		if($picture!=NULL){
		if(validateUrl($picture)){
		$update = mysql_query("Update users set picture = '$picture' where username = '$logged[username]'");
		}else echo "Enter a Valid URL eg. - google.com/image.jpg";}
		if($yahoo=NULL){
		if(validateyahoo($yahoo)){
		$update = mysql_query("Update users set yahoo = '$yahoo' where username = '$logged[username]'");
		}else echo "1Enter Proper email address eg.abc@domain.com";}
		if(validateEmail($email)){
		$update = mysql_query("Update users set email = '$email' where username = '$logged[username]'");
		}else echo "2Enter Proper email address eg.abc@domain.com";
		if($pno!=NULL){
		if(validatephone($pno)){
		$update = mysql_query("Update users set pno = '$pno' where username = '$logged[username]'");
		}else echo "<h1>Enter a Valid Phone. It can contain only numbers.</h1>";}
		if($zipc!=NULL){
		if(validatezipc($zipc)){
		$update = mysql_query("Update users set zipc = '$zipc' where username = '$logged[username]'");
		}else echo "<h1>Invalid Zip Code. </h1>";}
		$Agediff=GetAge($dob);
		If($Agediff>8 && $Agediff<101){
		$update = mysql_query("Update users set dob = '$dob' where username = '$logged[username]'");
		}else
		{
		echo "<h1>Enter a Valid Date Of Birth.</h1>";
		}
	if($dob==NULL|$email==NULL|$ctry==NULL)
	{
	echo ("<meta http-equiv='Refresh' content='2; url=editprofile.php'/>
	<h1>Date of Birth,Email Address and Country cannot be nulled</h1>");
	}
	else{
		// the above lines get rid of all html.
		$update = mysql_query("Update users set abtme = '$abtme',lang = '$lang',scl = '$scl',
		col = '$col',dob = '$dob',rlgn = '$rlgn',add1 = '$add1',add2 = '$add2',ctry = '$ctry',gender = '$gender',rstats = '$rstats' where username = '$logged[username]'");
		echo ("<meta http-equiv=\"Refresh\" content='2; url=editprofile.php'/><h1>Your profile has been updated!</h1>");
		// updates the information in the database.
		}
	}
}else{ echo("<a href=\"login.php\">You must login</a>");
}
?>
</div>
<?include("includes/footer.php");?>  

