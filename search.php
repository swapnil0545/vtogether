<?php
//the config file should connect to mysql.
require("config.php");
//select database
mysql_select_db("users");
$search = $_POST["search"];
//assigns the value of the entered search term in to the variable "search"
$result = mysql_query("SELECT * FROM users where username LIKE '%$search%'");
$num = mysql_num_rows($result);
//note "username" would be the field the search looks up, so if you searched for "Waffles" it would look up waffles username in the table users.
while($r=mysql_fetch_array($result))
//grabs all the content it found
{   
//then change this to match your mysql columns..this will be the information displayed. You could just have username.
  $id=$r["id"];
  $username=$r["username"];
  $email=$r["email"];
//and so on
// then just display the row
  echo "<p>The search found <a href=\"members.php?user=$id\">$username</a>
  <br/> Address : $r[add1]
   <br/> Email : $email</p><br>";
}
if($num==0)
{
echo("<font size='4' color='grey'>
No users having <font color='blue'>$search</font> in the username were found.
</font> ");
include 'members.php'; //if you want this one go ahead. I just put it so it helps the users searching. it will list the members.
}
?>

