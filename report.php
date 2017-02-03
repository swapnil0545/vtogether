<?
include("config.php");
include("validate.php");
$page_title='Report';
include("includes/header.php");
include("includes/menu.php");
?>
   <!-- B.1 MAIN CONTENT -->
      <div class="main-content">
        
        <!-- Pagetitle -->
        <h1 class="pagetitle"> <?php echo "$page_title"; ?> </h1>
<?php
if(!$logged['username']){//check for logged username
    echo "<h2>Error</h2>
    <p>
    You Are Not Logged In
    </p>"; //they aren't so give err
}else{ //or
    if(!$_POST['report']){ //form wasn't submitted
        echo "<div class='contactform'><h2>Report User</h2>
        <form method=\"post\" action=\"$_SERVER[PHP_SELF]\">
        <p>
        <label class='left'>Username</label>
        <input type=\"text\" name=\"user\" size=\"30\" /><br /><br />
        <label class='left'>Reason</label>
        <textarea cols=\"25\" rows=\"5\" name=\"reason\"></textarea><br/>
        <input type=\"submit\" name=\"report\" value=\"Report User\" class='button' />
        </p>
        </form>"; //give the form to report someone :)
    }else{ //or...
        $user = protect($_POST['user']); //protect the username being reported
        $reason = protect($_POST['reason']); //protect the text input again
        $date = date("d-m-y h:i A"); //today's date
        $from = $logged['username']; //logged user :)
		$checkuser = mysql_query("select * from`users` where `username`='$user'"); 
		$checkuser = mysql_fetch_array($checkuser);
		if(empty($user) || empty($reason)){ //something was empty!!!!
            echo "<h2>Error</h2>
            <p>
            You Must Fill Out The Form Completely
            </p>"; //haha you fail!
        }else{ //or not?
             if($checkuser>0){
			$insert = mysql_query("INSERT INTO `reps` (`username`,`reason`,`date`,`reportedby`) VALUES ( '$user','$reason','$date','$from');"); //insert the data
			 
                echo "<h2>Success</h2>
                <p>$from
                Report Sent!
                </p>"; //no error
             }else{echo "<h2>Enter a Valid Username</h2>
                <p>" . mysql_error() . "</p>"; }//echo the error
				//end error check
        } //end empty check
    }//end form check
} //end logged in check
?>       
</div> </div>
 
<?include("includes/footer.php");?>
