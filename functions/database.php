<?php 
$databaseConnection =null;
function get_Connection(){
	$hostname="118.89.21.50";
	$database="register";
	$userName="register";
	$password="register";
	
	global $databaseConnection;
	$databaseConnection=@mysql_connect($hostname,$userName,$password) or die(mysql_error());
	mysql_query("set names 'utf8'");
	@mysql_select_db($database,$databaseConnection) or die(mysql_error());

}
function close_Connection(){
global $databaseConnection;
if ($databaseConnection) {
	# code...
	mysql_close($databaseConnection) or die (mysql_error());
}
}
 ?>