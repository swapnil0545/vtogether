<?
include("config.php");
include("validate.php");
$page_title='Registration Page';
include("includes/header.php");
?>
<div class="main">
<link rel="stylesheet" type="text/css" media="screen,projection,print" href="./css/layout1_setup.css" />
	<!-- B.1 MAIN CONTENT -->
	<div class="main-content" align="center">
	<!-- Content unit - One column -->
		<h1 class="block"><?php echo ("<h1>$page_title</h1>"); ?>
		<div class="column1-unit">
			<div class="contactform">           
<?php
//gets the config page
if ($_POST[register]) {
	// the above line checks to see if the html form has been submitted
	$username = $_POST[username];
	$password = $_POST[pass];
	$cpassword = $_POST[cpass];
	$email = $_POST[emai1];
	$dob = $_POST[dob];
	$secret = $_POST[secret];
	//the above lines set variables with the user submitted information
	if($username==NULL|$password==NULL|$cpassword==NULL|$email==NULL|$secret==NULL) {
		//checks to make sure no fields were left blank
		echo "A field was left blank.";
		}elseif(strlen($password) <= 5 || strlen($password) >= 20 ){
		echo "password must be over 6 and under 20";
		}elseif (strlen($password) > 5 || strlen($password) < 20){
		if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) {  
		echo "Pls enter valid email";}
		elseif (ereg('[^A-Za-z0-9]', $rusername)) { 
		echo "Your username can only contain letters and numbers.";
		}elseif (!ereg('[^A-Za-z0-9]', $username)) {
		/// This line basically checks if your using certain characters in your username and doesnt allow them.
			if (strlen($username) <= 3 || strlen($username) >= 20 ){
			echo "Username must be over 3 and under 20";
			}elseif (strlen($username) > 3 || strlen($username) < 20){
		/// This checks if your username is below 20 characters or above 3 characters and allows only that unless you change it.
		//none were left blank!  We continue...
		if($password != $cpassword) {
		// the passwords are not the same!  
		echo "Passwords do not match";
		}else{
		// the passwords are the same!  we continue...
		$password = md5($password);
		// encrypts the password
		$checkname = mysql_query("SELECT username FROM users WHERE username='$username'");
		$checkname= mysql_num_rows($checkname);
		$checkemail = mysql_query("SELECT email FROM users WHERE email='$email'");
		$checkemail = mysql_num_rows($checkemail);
		if ($checkemail>0|$checkname>0) {
		// oops...someone has already registered with that username or email!
		echo "<meta http-equiv=\"Refresh\" content=\"0; URL=register.php\"/>The username or email is already in use";
		}else{
		// noone is using that email or username!  We continue...
		$username = protect($username);
		$password = protect($password);
		$email = protect($email);
		$dob = protect($dob);
		$secret= protect($secret);
		// the above lines make it so that there is no html in the user submitted information.
		//Everything seems good, lets insert.
		$Agediff=GetAge($dob);
		If($Agediff>=9 && $Agediff<101){

		$query = mysql_query("INSERT INTO users (username, password, email,dob,secret) VALUES('$username','$password','$email','$dob','$secret')");
		echo ("<meta http-equiv=\"Refresh\" content=\"2; URL=index.php\"/>You have successfully registered! ");
		}else{
		echo "<h1>Enter a Valid Date Of Birth.</h1>";
		}
}}}}}}
// inserts the information into the database.
	else{// the form has not been submitted...so now we display it.
	echo ("               
	<form method=\"POST\">
	<fieldset>
	<legend>&nbsp;CONTACT DETAILS&nbsp;</legend>
	<p><label class='left'>Username:*</label><input type=\"text\" size=\"15\" maxlength=\"25\" name=\"username\" class='field'></p><br />
	<p><label class='left'>Password:*</label><input type=\"password\" size=\"15\" maxlength=\"25\" name=\"pass\" class='field'></p><br />
	<p><label class='left'>Confirm Pass:*</label><input type=\"password\" size=\"15\" maxlength=\"25\" name=\"cpass\" class='field'></p><br />
	<p><label class='left'>Email:*</label><input type=\"text\" size=\"40\" maxlength=\"40\" name=\"emai1\" class='field'></p><br />
	<p><label class='left'>DOB:*</label><input type=\"text\" size=\"15\" maxlength=\"25\" name=\"dob\" class='field'>eg.2010-02-28</p><br />
	<p><label class='left'>Secret Name or Number.*</label><input type=\"password\" size=\"20\" maxlength=\"25\" name=\"secret\" class='field'>Incase u forget your pass</p><br />
	<input name=\"register\" type=\"submit\" value=\"Register\" class='button'>
	Note : * stand for required fields
	</fieldset></form>
	");
}
?>
</div></div></div></div>
<?include("includes/footer.php");?>

