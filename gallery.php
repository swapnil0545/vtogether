<?
include("config.php");
include("includes/header.php");
$counter=1;
?>
<link rel="stylesheet" type="text/css" media="screen,projection,print" href="./css/layout1_setup.css" />
<!-- B.1 MAIN CONTENT -->
<div class="main-content"><!-- Pagetitle -->
<h1 class="pagetitle">Image Gallery</h1>
<? 
if($logged['username']){//delete post	
	if($_POST['deleteid']){
		$del = $_POST['delid'];
		mysql_query("DELETE FROM `album` Where id=$del");
		echo ("<meta http-equiv='Refresh' content='1; URL=gallery.php?user=$logged[id]'/>T
		hank You! You will be redirected");
		}			
	if($_GET[user]){
		$userid = $_GET[user];
		}else{
				$userid = $logged[id];
			}
	$display = mysql_query( "SELECT * FROM `album` WHERE userid=$userid ORDER BY `id` ASC" ); // get values
	echo (" <a href='index.php'>Back</a>");
	if($logged['id']==$userid){
	include("submitimage.php");
	}
	echo "<table width='900' class='album'> <tr>";
	while ($imgs = mysql_fetch_array($display))
	{
		echo "<td>$counter
		<a href='$imgs[image]' target='_BLANK'>
		<img src='$imgs[image]' height='250' width='250' >
		</a><a href='members.php?user=$imgs[userid]'><br/>$imgs[desc]</a>
		<form action='gallery.php?user=$member[id]' method='POST'>
		<input type='hidden' name='delid' value='$imgs[id]' />
		<input type='submit' name='deleteid' value='delete' class='button'/>
		</form>
		</td>
		"; //echos the image
		if($counter%3==0){
			echo "<tr>";
			}
		$counter++;
	}
echo ("</tr></table> ");
}else echo ("login");
?>       
</div>
<?include("includes/footer.php");?>
