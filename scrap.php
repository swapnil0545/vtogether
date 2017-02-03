<?
include("config.php");
$page_title='Comments';
include("includes/header.php");
include("includes/menu.php");
?>
     
<head>
    <link rel="stylesheet" type="text/css" href="css/redmon-jquery-ui.css">
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />
     <script type="text/javascript" src="js/jquery.min.js"></script>
     <script type="text/javascript" src="js/jquery_paginate.js"></script>
<script type="text/javascript" src="js/chat.js"></script>

     <script type="text/javascript">
          $(function(){
               $("#blocks").paginate({ limit: 5, content: 'DIV.block' });
               $("#images").paginate({ limit: 5, content: 'IMG.image' });
               $("#blogs").paginate({ limit: 5, content: 'DIV.blog' });
               $("TABLE#tableOne").paginate({ limit: 3, content: 'TBODY TR' });
          });
     </script><!-- javascript -->

</head><!-- HEAD -->
<body>


<!-- B.1 MAIN CONTENT -->
      <div class="main-content">
       <!-- Pagetitle -->
        <h1 class="pagetitle"> <?php echo "$page_title"; ?> </h1>
		<div class="column1-unit">
<?php
 $user = mysql_real_escape_string($_GET['user']);
 if(!$logged['id']){
	 echo("You need to be logged in to post a comment! <a href='index.php'>Login Here!</a>");
	}else{					
		if($_POST['deleteid']){//delete post	
		$del = $_POST['delid'];
		mysql_query("DELETE FROM `members_comments` Where id=$del");
		echo ("<meta http-equiv=\"Refresh\" content=\"0; URL=scrap.php?user=$logged[id]\"/>Thank You! You will be redirected");  
		}//delete post complete
		//check if the message is posted by a user and post a message
		if($_POST['message'] AND $_POST['user']){
			$message = mysql_real_escape_string($_POST['message']);
            $to = $_POST['user'];
            mysql_query("INSERT INTO `members_comments` VALUES ('','$to','$logged[id]','$message',unix_timestamp())");             
            echo ("<meta http-equiv='Refresh' content='0.5;'/>Comment posted");                   
        }else{
			$get_member = mysql_query("SELECT * FROM `users` WHERE `id` = '$_GET[user]'");
			$member = mysql_fetch_array($get_member);
			if(!mysql_num_rows($get_member)) {
				echo "This member does not exist! <a href='members.php?user=$_POST[user]'>Back</a>";
				}else{
					echo ("<form action='scrap.php?user=$member[id]' method='POST'>
				<input type='hidden' name='user' value='$_GET[user]'>		
				<span style='margin-bottom: 10px; font: bold 20px Arial;'>$member[username] Comments</span><br/>
				<textarea name='message' style='width: 99%; height: 50px;'></textarea>
				<input type='submit' value='Comment It' class='button'/>
				</form><br/>");
				}
			} //checking of message complete
	// Getting the comments
	$get_comments = mysql_query("SELECT * FROM `members_comments` WHERE `member_id` = '$member[id]' ORDER BY `id` DESC LIMIT 20"); 
    $row = mysql_num_rows($get_comments);
     if($row == "0"){// Checking if there is comments if not saying there are no comments. =]
		echo "<center>$member[username] has no comments at the moment! </center>";
        }else{// Displaying all the comments now.
	    ?> <div id="page">
			<div id="blogs" class="ui-widget-content ui-corner-all">
              
			  <?php
			while($comments = mysql_fetch_array($get_comments)){
				$get_member = mysql_query("SELECT * FROM `users` WHERE `id` = '$comments[from_id]'");
                $member = mysql_fetch_array($get_member);
				echo("<div class='blog ui-corner-all'><fieldset>                                         
					<a href=\"?user=$user[username]\">
					<img src='http://$member[picture]' height='80' width='80' /></a>
                     <a href=\"?user=$member[id]\">$member[username] </a> " );
                    // Showing how long the comment was posted!
	$time = time() - $comments['time'];
    $in = "seconds";
    if($time >= 60){
		$time = (int) ($time/60);
        $in = "minute(s)";
		}
    if($time >= 60){
		$time = (int) ($time/60);
		$in = "hours";
		if($time >= 24){
			$time = (int) ($time/24);
			$in = "days";
			}
        }
if($logged['id'] == $user){
?>
<script type="text/javascript">
// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=200,width=400,left=450,top=450,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no,status=yes')
}
</script>
<?// if not then dont dispay a reply link.
	echo("- $time $in ago - <a href=\"JavaScript:newPopup('comment_reply.php?user=$comments[from_id]')\">Reply!</a> <div align='right'>
	<form action='scrap.php?user=$member[id]' method='POST'>
	<input type='hidden' name='user' value='$_GET[user]'>
	<input type='hidden' name='delid' value='$comments[id]' />
	<input type='submit' name='deleteid' value='delete' class='button'/>
	</form> </div><br/>");
	} else{ echo (" - $time $in ago "); }
echo "<p> $comments[content] </p></fieldset><div></div></div>";
//custom
	}
}}
?>           

</body><!-- BODY -->
