<?
include("config.php");
$page_title='Home';
include("includes/header.php");
include("includes/menu.php");
?>
 <!-- B.1 MAIN CONTENT -->
<div class="main-content">
<!-- Pagetitle -->
<h1 class="pagetitle"> <?php echo "$page_title"; ?> </h1>
<?php
if ($logged[username]){// User is logged in
	$profile = mysql_query("SELECT * from users where username = '$logged[username]'");
	$profile = mysql_fetch_array($profile);
	// Above lines get info of logged user
	echo("
		<p><a href='editprofile.php'>Edit Profile?</a></p>
		<h1 align='center'> My Profile</h1>
		<p class='center'>
		<IMG class='center' SRC='http://$profile[picture]' height='128' width='128'>
<br /><br /></p>
		<hr class='clear-contentunit' />
		<div class='column2-unit-left'><p>
		About me : $profile[abtme]<br />
		Language : $profile[lang]<br />
		School : $profile[scl]<br />
		College : $profile[col]<br />
		Relationship status: $profile[rstats]<br />
		DOB : $profile[dob]<br />
		Religion : $profile[rlgn]<br />
		Phone no.: $profile[pno]<br />
		Yahoo Messebger: $profile[yahoo]<br />
		</p></div>
		<div class='column2-unit-right'><p>
		Location-<br />
		Address 1 : $profile[add1]<br />
		Address 2 : $profile[add2]<br />
		Zip code : $profile[zipc]<br />
		Country : $profile[ctry]<br />
		Email: $profile[email]<br />
		</p></div>
		");
	}else{// They aren't logged in!
		echo ("<a href='login.php'>You must login</a>");
		}
?>  </div>     <?include("includes/footer.php");?>
