<?
include("config.php");
$page_title='My friends';
include("includes/header.php");
include("includes/menu.php");
?>
<!-- B.1 MAIN CONTENT -->
<div class="main-content">
<!-- Pagetitle -->
<h1 class="pagetitle"> <?php echo "$page_title"; ?> </h1>
<?
//check user is logged in or not
if (!$logged["username"]) {
echo ("<meta http-equiv=\"Refresh\" content=\"1; URL=login.php\"/>Thank You! You will be redirected");
exit;
} 
switch($_GET[page]){ //make some links ?page=case
case 'deleteall': // delete page
$delete = mysql_query( "DELETE FROM `friends` WHERE `username` = '$logged[username]'  "); // deletes friend request
echo ( "You have deleted all your friends." ); // echos completion
break; //ends delete page
case 'delete': // delete page
if ($_GET[user]) { //get username
$delete = mysql_query( "DELETE FROM `friends` WHERE `friendname` = '$_GET[user]' "); // deletes friend request
echo ( "$_GET[user] has been deleted from your friendlist." ); // echos completion
}
break; //ends delete page
default: //set up the default page upon going to inbox.php
$afed = mysql_query("SELECT * FROM `friends` WHERE `username` = '$logged[username]' OR 'friendname' = '$logged[username]' ORDER BY `id` ASC") or die(mysql_error()); 
//loops there name out 
echo "<p>
<a href='?page=deleteall'><u>Delete All Friends</u></a></p><center>
<table align=center>
<tr align='center' id='top'>
<th class='top' scope='col'>Status</th>
<th class='top' scope='col'>Username</th>
<th class='top' scope='col'>Send Message</th>
<th class='top' scope='col'>Remove</th></tr>";
while ($fr = mysql_fetch_array($afed)) { 
$fid = mysql_query("SELECT * FROM `users` WHERE `username` = '$fr[friendname]' ") or die(mysql_error()); 
$fri = mysql_fetch_array($fid);
echo "<tr align='center'>
<td> "; if($fri[online]>= $offline) echo"<font color='green'>Online</font>"; 
else echo "<font color='red'>Offline</font>";
echo "</td>
<td><a href='members.php?user=$fri[id]'>$fr[friendname]</a></td>
<td><a href='messages.php?page=write&;page=msgto&amp;user=$fri[username]'>
<img src='images/Mail.png' border='0' title='Send Message'></a></td>
<td><a href='?page=delete&amp;user=$fr[friendname]'>
<img src='images/delete64.png' border='0' title='Remove Friend?'></a></td>
</tr>";
}
echo "</table></center>";
break;
}
?> 
</div>
<?include("includes/footer.php");?> 

