<?php include("config.php");
$page_title='List of Members';
include("includes/header.php");
include("includes/menu.php");
?>



 <!-- B.1 MAIN CONTENT -->
      <div class="main-content">
       
        <!-- Pagetitle -->
        <h1 class="pagetitle"> <?php echo "$page_title"; ?> </h1>
<?php if(!$logged['id']){
                    echo("<meta http-equiv=\"Refresh\" content=\"0; URL=index.php\"/>Thank You! You will be redirected");
                    }else{ // else if you are logged in then show the link
					
if (!$_GET[user])
{
	
	$getuser = mysql_query("SELECT * from users order by id asc");
	while ($user = mysql_fetch_array($getuser))
	{// gets all the users information.
	echo ("<p><a href=\"members.php?user=$user[id]\">$user[username]</a><br /></p>\n");
	}// links to a page to view the user's profile.
}
ELSE
{
	$getuser = mysql_query("SELECT * from users where id = '$_GET[user]'");
	$usernum = mysql_num_rows($getuser);
	if ($usernum == 0)
	{
		echo ("User Not Found");
	}
	else
	{
		$profile = mysql_fetch_array($getuser);	//blocklist thing
		$getfoe = mysql_query("SELECT * FROM `blocklist` WHERE `username` = '$profile[username]'");
		$en = mysql_fetch_array($getfoe); 
		$getfriend = mysql_query("SELECT * FROM `friends` WHERE `friendname` = '$profile[username]' and `username` = '$logged[username]' OR `friendname` = '$logged[username]' and `username` = '$profile[username]' ");
		$fa = mysql_fetch_array($getfriend);
		$chkfoe = mysql_query("SELECT * FROM `blocklist` WHERE `foe` = '$profile[username]'");
		$chk = mysql_fetch_array($chkfoe); 
		if ($logged[username] == $en[foe])
		{
			echo "<h1>$profile[username] has blocked you. </h1> <br />";
		}
		else{
			if($profile[online]>= $offline) echo"<h1><font color='green'>Online</font></h1>"; 
			else echo "<h1><font color='red'>Offline</font></h1>";
			echo 
			("<h1 align='center'> $profile[username]'s Profile</h1>
			<p class='center'>
			<IMG class='center' SRC='http://$profile[picture]' height='48' width='48'><br />
			<br /><p>
			About Me : $profile[abtme]<br />
			Relationship Status : $profile[rstats]<br />
			Birth Date : $profile[dob]<br /><br />
			Language : $profile[lang]<br />
			School: $profile[scl]<br />
			College : $profile[col]<br />
			Country : $profile[ctry]<br />
			");
			if ($logged[username] != $profile[username])// check wether he is watching his own profile
			{
			if ($profile[username] == $fa[friendname] || $profile[username] == $fa[username])
			{
			echo "Location -<br />
			Address 1 : $profile[add1]<br />
			Address 2 : $profile[add2]<br />
			Yahoo Messebger : $profile[yahoo]<br />
			Email: $profile[email]<br /> <br /><p>
			<a href='my_friends.php?page=delete&amp;user=$profile[username]'><img src='images/user_block.jpeg' border='0' title='Remove from friendlist' class='center'></a>";
			echo "<a href='messages.php?page=write&user=$profile[username]'><img src='images/Mail.png' border='0' title='Send Message' class='center'></a></td></tr></table>";
			echo "<a href='scrap.php?user=$profile[id]'><img src='images/Comment.png' border='0' title='Comments' class='center'></a></td></tr></table>";	
			echo "<a href='gallery.php?user=$profile[id]'><img src='images/Album.png' border='0' title='Album' class='center'></a></td></tr></table>";
			echo "<a href='report.php'><img src='images/report_user.png' border='0' title='Report User' class='center'></a></td></tr></table>";	
			}else
				{
				echo "<a href='friendrequest.php?user=$profile[username]'><img class='center' src='images/user_add.jpeg' border='0' title='Add as friend'></a>";
				echo "<a href='report.php'><img src='images/Mail.png' border='0' title='Report User' class='center'></a></td></tr></table>";	
				}
			if ($profile[username] == $chk[foe])
				{
				echo "<a href='blocklist.php?page=delete&amp;user=$profile[username]'><img src='images/user_add.jpeg' border='0' title='Unblock user' class='center'></a>";
				}else{
					 echo "<a href='blocklist.php?page=block&amp;user=$profile[username]'><img src='images/delete64.png' border='0' title='Block user' class='center'></a>";
					}// in the above code, we display the user's information.
			}} 
	}}}
 ?> </div>
<?include("includes/footer.php");?>

