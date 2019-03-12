<?php

//header('Content-type: application/json');
$result=[];
if (isset($_POST)) {
    # code...
    session_start();
    session_unset();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), session_id(), time() - 10);
    }
    session_destroy();
    $result['message']='退出成功，您现在可以放心的关闭浏览器';

}
else{
	$result['message']='logout_defeated';
}
 //echo json_encode($result);
echo $result['message'];