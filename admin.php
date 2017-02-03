<?
include("config.php");
include("validate.php");
$page_title='Edit user profiles';
include("includes/header.php");
include("includes/menu.php");
?>
 <!-- B.1 MAIN CONTENT -->
<div class="main-content">
<!-- Pagetitle -->
<h1 class="pagetitle"> <?php echo "$page_title"; ?> </h1>
<?php
if($logged[username] && $logged[level] ==5)
{
//checks to see if the user is logged in, and if their user level
//is 5 (this is administrator)
if($_GET[user])
{
//checks to see if there is a ?user=username variable in the url.
if (!$_POST[update])
{
// the form hasn't been submitted.  We continue...
$profile = mysql_query("SELECT * from users where username = '$_GET[user]'");
$profile = mysql_fetch_array($profile);
//these lines get the user's information and put it in an array.
//we will display the information in the html form
echo("
<div class='contactform'>
	<fieldset><legend>&nbsp; $profile[username] PROFILE DETAILS&nbsp;</legend>
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
	<input type='submit' name='update' class='button' value='Update'>
	</form>
	</fieldset>
	<br/>
	</div>");
//displays the html form
}
else
{
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
// the above lines get rid of all html.
echo ("<p>$_GET[user]'s profile has been updated.</p>");
$update = mysql_query("Update users set abtme = '$abtme',lang = '$lang',scl = '$scl',
		col = '$col',dob = '$dob',rlgn = '$rlgn',add1 = '$add1',add2 = '$add2',ctry = '$ctry',gender = '$gender',rstats = '$rstats' where username = '$_GET[user]'");
// updates the information in the database.
}
}
else
{
$getusers = mysql_query("Select * from users order by username asc");
while($users = mysql_fetch_array($getusers))
{
//makes a list of all the users
echo("<p><a href='admin.php?user=$users[username]'>$users[username]</a><br /></p>");
//displays the user's names
}
}
}
else
{
//the user's level is not 5!  They cannot view this page
echo("Sorry, but you are not allowed to view this page!");
}
?>
</div>
<?include("includes/footer.php");?>
