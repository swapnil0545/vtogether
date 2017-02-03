<? 
include("validate.php");
if ($logged["username"]) { //checks user is logged in
if ($_POST["submit"]) { //check if forum was submitted
	//This function separates the extension from the rest of the file name and returns it 
	function findexts ($filename)
	{
		$filename = strtolower($filename) ;
		$exts = split("[/\\.]", $filename) ;
		$n = count($exts)-1;
		$exts = $exts[$n];
		return $exts;
	}
	$ext = findexts ($_FILES['image']['name']);//This applies the function to our file
	$ran = rand () ;
	$ran2 = $ran.".";
	$target = "images/"; //destination
	$target = $target . $ran2.$ext;			
	if(move_uploaded_file($_FILES['image']['tmp_name'], $target))
	{
		$image = $target;
		$userid= protect(($logged["id"])); //username
		$username = protect(($logged["username"])); //username
		$desc = protect(($_POST["desc"])); // orignal url
		$do = mysql_query( "INSERT INTO `album` ( `userid` ,`username` , `desc` , `image` ) VALUES ( '$userid' ,'$username' , '$desc' , '$image' ) ");
		echo ("<meta http-equiv=\"Refresh\" content=\"1; URL=gallery.php?user=$logged[id]\"/>Thank You! Image submitted");	}
	else{ 
		echo ("There was a problem uploading your file"); 
	}//else error
}else{
	echo "<form enctype='multipart/form-data' method='POST'>
	<p>Image : <input type='file' size='30' name='image' ></p>
	<p>Description : <input type='text' size='30' name='desc'></p>
	<input type='submit' name='submit' value='Upload' class='button'>
	</form>"; //echos form
	}
}else{ echo ("you need to be logged in"); }
?> 