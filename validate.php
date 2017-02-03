<?
function protect($content){
$content = mysql_real_escape_string($content);
$content = strip_tags($content);
$content = addslashes($content);
return $content;
}
function validateyahoo($value) {
	if(ereg("^([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}$", $value, $regs)) {
		return true;
	}
}
function validateEmail($value) {
	if(ereg("^([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}$", $value, $regs)) {
		return true;
	}
}
function GetAge($Birthdate){
        list($BirthYear,$BirthMonth,$BirthDay) = explode("-", $Birthdate);
        $YearDiff = date("Y") - $BirthYear;
        $MonthDiff = date("m") - $BirthMonth;
        $DayDiff = date("d") - $BirthDay;
        if ($DayDiff < 0 || $MonthDiff < 0)
          $YearDiff--;
        return $YearDiff;
}
// Validation of an URL
function validateUrl($value) {
	if(ereg("[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(:[a-zA-Z0-9]*)?/?([a-zA-Z0-9\-\._\?\,\'/\\\+&amp;%\$#\=~])*[^\.\,\)\(\s]$", $value, $regs)) {
return true;
		} 
}
// Validation of characters
function validateAlpha($value) {
	if(ereg("^[a-zA-Z]+$", $value, $regs)) {
		echo "true";
$value=true;
		return $value;
	} else {
		$value=false;
		return $value;
		}
}
// Validation of numbers
function validatephone($value) {
	if(strlen($value)>9){
	if(ereg("^[0-9]+$", $value, $regs)) {
		return true;
		} }
}

// Validation of numbers
function validatezipc($value) {
	if(strlen($value)>3){
	if(ereg("^[0-9]+$", $value, $regs)) {
		return true;
		} 
	}
}

?>
