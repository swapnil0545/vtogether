<?
include"config.php";
$sql = " UPDATE users set online = 0 WHERE id = $logged[id]";
MYSQL_QUERY($sql);
setcookie("id", 2132421,time()+(60*60*24*5), "/", "");
setcookie("pass", loggedout,time()+(60*60*24*5), "/", "");
echo ("<meta http-equiv=\"Refresh\" content=\"0; URL=index.php\"/>Thank You! You will be redirected");
?>
