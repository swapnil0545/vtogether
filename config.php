<?
ob_start(); // allows you to use cookies
$conn = mysql_connect("localhost","Altaf","123123");
mysql_select_db(newsat) or die(mysql_error());
//fill in the above lines where there are capital letters.
$logged = MYSQL_QUERY("SELECT * from users WHERE id='$_COOKIE[id]'");
$logged = mysql_fetch_array($logged);
//the above lines get the user's information from the database.
$logout_time = 300; //mili seconds to stay logged in
$current = time(); //current time
$offline = ($current - $logout_time); //do the math for the logout time
//if they are logged in
$update = mysql_query("UPDATE `users` SET `online` = '$current' WHERE `username` = '$logged[username]';"); 
//update their status
//end the check and such 
?>
