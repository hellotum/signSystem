<?php 
function is_login(){
	if (!isset($_SESSION['user_id']))
	{
		session_start();
	}
	if (isset($_SESSION['user_id'])) {
		# code...
		//echo "ssssss";
		return TRUE;
	}else{
		//echo $_SESSION['user_id'];
		//echo "sssssssfdsg";
		return FALSE;
	}
}
 ?>