
   <!-- B.1 MAIN NAVIGATION -->
      <div class="main-navigation">
        <!-- Navigation Level 3 -->
        <div class="round-border-topright"></div>   
	   <h2>Welcome</h2>
	   <?
	// we now display the user controls.
$newms = mysql_query("select * from pmessages where unread = 'unread' and touser = '$logged[username]'");
$newms = mysql_num_rows($newms);
$newfr = mysql_query("select * from friend_requests where username = '$logged[username]'");
$newfr = mysql_num_rows($newfr);
$newsc = mysql_query("select * from members_comments where member_id = '$logged[id]'");
$newsc = mysql_num_rows($newsc);	

	echo ("<p>$logged[username]</p><p><img src='http://$logged[picture]' height='50px' width='50px'></p>"); ?> 
<h1>Navigation</h1>
<dl class="nav3-grid">
<?echo"
<dt><a href='scrap.php?user=$logged[id]'>Comments ($newsc)</a></dt>
<dt><a href='my_friends.php'>My friends</a></dt>
<dt><a href='gallery.php'>My Album</a></dt>
<dt><a href=\"messages.php\">Inbox ($newms New)</a></dt></dt>
<dt><a href=\"members.php\">Member List</a></dt>
<dt><a href='newfriends.php'>Friend Requests ($newfr New)</a></dt>
<dt><a href='blocklist.php'>Blocked friends</a></dt>
<dt><a href=\"editprofile.php\">Edit Profile</a></dt>
";

 if($logged[level]==5){
 echo "<hr><dt><a href='repcp.php'>Reports</a></dt> ";
 echo "<hr><dt><a href='admin.php'>Edit User Profile</a></dt> <hr>";
 }
 echo "<dt><a href=\"logout.php\">Logout</a></dt> ";
?>
</dl>
</div>
