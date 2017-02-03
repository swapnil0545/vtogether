
<?
include("config.php");
$page_title='Login';
include("includes/header.php");
?>
 <link rel="stylesheet" type="text/css" media="screen,projection,print" href="./css/layout1_setup.css" />
    <!-- B. MAIN -->
    <div class="main">
<?php
if ($logged[username]){
	echo("<meta http-equiv=\"Refresh\" content=\"0; URL=home.php\"/>Thank You! You will be redirected");
	}
	else{
	?> 
      <!-- B.1 MAIN CONTENT -->
      <div class="main-content"> 
        <!-- Pagetitle -->
        <h1 class="pagetitle"><a href="register.php">Click Here</a> and Sign up now</h1>
        <!-- Content unit - Two columns -->
		<h1 class="block">Welcome Guest</h1>   
        <div class="column2-unit-right">
           <h1>Login form</h1>
          <div class="loginform">
            <form method="post" action="login.php"> 
              <fieldset>
                <p>User:<br />
                  <input type="text" name="username" id="username" tabindex="1" class="field"" /></p>
    	        <p>Password:<br />
                  <input type="password" name="password" id="password" tabindex="2" class="field" /></p>
    	        <p><input type="submit" name="login" class="button" value="Login"  /></p>
	            <p><a href="forgot.php" id="forgotpsswd">Password forgotten?</a></p>
  	        </fieldset>
            </form>
          </div>
        </div>
        <div class="column2-unit-left"> <br/> <br/> <br/>
         <p>Connect with friends and family using scraps and instant messaging</p>
          <p>Discover new people through friends of friends and communities </p>
      <p> stay in touch with all your friends while on-the-go.    </p>                          
    </div>
  <!-- Content unit - One column -->
 </div>
 </div>
<? }?>   
<?include("includes/footer.php");?>
