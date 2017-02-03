<?
include("config.php");
$page_title='My Warns';
include("includes/header.php");
include("includes/menu.php");
?>
 <!-- B.1 MAIN CONTENT -->
<div class="main-content">
<!-- Pagetitle -->
<h1 class="pagetitle"> <?php echo "$page_title"; ?> </h1>
<?php
if(!$logged['username']){ //not logged in
echo ("<h2>Error</h2><p>You Are not Logged In</p>"); //lol error
}else{ //or they are
	echo ("<h2>Your Warnings</h2>
	<table width=\"400\">
	<tr>
	<td align=\"left\" valign=\"middle\">
	<b>Warned By</b>
	</td>
	<td align=\"left\" valign=\"middle\">
	<b>Reason</b>
	</td>
	<td align=\"left\" valign=\"middle\">
	<b>Date Warned</b>
	</td>
	</tr>"); //table headers
	$get_warns = mysql_query("SELECT * FROM `warnings` WHERE `user` = '$logged[username]';"); //get the users warns
	while($warns = mysql_fetch_array($get_warns)){ //loop them
		echo ("<tr>
		<td align=\"left\" valign=\"middle\">
		$warns[from]
		</td>
		<td align=\"left\" valign=\"middle\">
		$warns[reason]
		</td>
		<td align=\"left\" valign=\"middle\">
		$warns[date]
		</td>
		</tr>"); //display their warns
		} //end loop
echo ("</table>"); //end table
}
?>           </div>    <?include("includes/footer.php");?>
