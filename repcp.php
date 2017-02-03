<?
include("config.php");
include("validate.php");
$page_title='Reports panel';
include("includes/header.php");
include("includes/menu.php");
?>
 <!-- B.1 MAIN CONTENT -->
<div class="main-content">
<!-- Pagetitle -->
<h1 class="pagetitle"> <?php echo "$page_title"; ?> </h1>
<?php
if(!$logged['username']){ //check logged user
    echo("<h2>Error</h2>  <p> You Are Not Logged In! </p>"); //nope
}elseif($logged['username'] && $logged['level'] < '5'){ //not an admin or mod
    echo("<h2>Error</h2> <p>You Do Not Have Access to this Function. </p>"); //give error >:|
}else{ //or they are :D
    switch($_GET['x']){ //make multiple pages
        default: //default
            $get_reps = mysql_query("SELECT * FROM `reps` ORDER BY `id` DESC"); //get all reports
            if(mysql_num_rows($get_reps) == 0){ //none >:(
                echo("<h2>No Reports</h2> <p>   There are No Reports in the Database.  </p>"); //woohoo error!!
            }else{ //or not >)
                echo("<table width='00'>
                <tr>
                <td align='left' valign='middle'>
                <b>User</b>
                </td>
                <td align='left' valign='middle'>
                <b>Reported By</b>
                </td>
                <td align='left'valign='middle'>
                <b>Reason</b>
                </td>
                <td align='left' valign='middle'>
                <b>Date Sent</b>
                </td>
                <td align='center' valign='middle'>
                <b>Options</b>
                </td>
                </tr>"); //table headers
                while($reps = mysql_fetch_array($get_reps)){ //make a loop for the reports to be shown
                    echo("<tr>
                    <td align='left' valign='middle'>
                    $reps[username]
                    </td>
                    <td align='left' valign='middle'>
                    $reps[reportedby]
                    </td>
                    <td align='left' valign='middle'>
                    $reps[reason]
                    </td>
                    <td align='left' valign='middle'>
                    $reps[date]
                    </td>
                    <td align='left' valign='middle'>
                    <a href=\"repcp.php?x=delete&id=$reps[id]\">Delete Report</a>
                    </td>
                    </tr>"); //yay for data to be shown :)
                } //end the loop :(
            } //end the reports check
            break; //end the default page
        case 'warn': //haha i get to warn the dude >:)
            $id = (int) addslashes($_GET['id']); //make the ID Safe
            if(!$id){ //no id sucker!
               echo("<h2>Error</h2>
                <p>
                No ID Selected
                </p>"); //haha you got an error
            }else{ //or not :(
                $check = mysql_query("SELECT * FROM `reps` WHERE `id` = '$id';"); //check to make sure
                if(mysql_num_rows($check) == 0){ //lol you still got an error >:)
                    echo("<h2>Error</h2>
                    <p>
                    Invalid ID Selected.
                    </p>"); //give him/her what they came for!
                }else{ //or not...
                    $array = mysql_fetch_array($check); //array the data
                    if(!$_POST['warn']){ //warn form wasn't submitted
                        echo("<h2>Warn $array[username]</h2>
                        <form method='post' action='$_SERVER[PHP_SELF]?x=warn&id=$id'>
                        <p>
                        <label>Reason</label>
                        <textarea rows='5' cols='25' name='reason'></textarea>
                        <input type=\"submit\" name=\"warn\" value=\"Warn $array[username]\">
                        </p>
                        </form>"); //give the reasoning form :)
                    }else{ //chyea the form was submitted
                        $reason = protect($_POST['reason']); //make the reason safe
                        $date = date("m-d-y h:i A"); //the date
                        $from = $logged['username']; //who warned
                        if(empty($reason)){ //reason was empty
                            echo("<h2>Error</h2>   <p>    You Must Give A Reason
                            </p>"); //lol you got an error
                        }else{ //darn. your not.
                            $insert = mysql_query("INSERT INTO `warnings` (`user`,`reason`,`from`,`date`) VALUES ('$array[username]','$reason','$from','$date');"); //warn the user
                            $delete = mysql_query("DELETE FROM `warnings` WHERE `id` = '$id';"); //delete the report
                            if(!mysql_error()){ //no mySQL Error
                                echo("<h2>Success</h2> <p>  $array[user] Has Been Warned! </p>"); //yay they were warned!
                            }else{ //or not
                                echo("<h2>Error</h2>   <p>  ".mysql_error()." </p>"); //HAHA YOU GOT AN ERROR
                            } //end error check
                        } //end empty form check
                    } //end the form submit check
                } //end the verification check
            } //end the final check if id is there or not xD
            break;
        case 'delete': //the delete report page >:)
            $id = (int) addslashes($_GET['id']); //make the ID safe
            if(!$id){ //no id HAHA
               echo("<h2>Error</h2> <p>No ID Selected </p>"); //lol you got an error
            }else{ //there was an id D:
                $check = mysql_query("SELECT * FROM `reps` WHERE `id` = '$id';"); //check DB for ID
                if(mysql_num_rows($check) == 0){ //haha not found
                    echo("<h2>Error</h2>
                    <p>
                    Invalid ID Selected
                    </p>"); //invalid ID
                }else{ //its found :) :(
                    $delete = mysql_query("DELETE FROM `reps` WHERE `id` = '$id';"); //delete it 
                    if(!mysql_error()){ //no error
                        echo("<h2>Success</h2>
                        <p>
                        Report Deleted
                        </p>"); //yay!!
                    }else{ //or not....
                        echo("<h2>Error</h2>
                        <p>
                        ".mysql_error()."
                        </p>"); //you got an error
                    } //end error check
                } //end verification check
            } //end first id check
            break; //end the page
    }//end the switch function
} //end logged username check
?>
