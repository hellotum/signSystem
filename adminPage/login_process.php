<?php

$result =['message'=>""];
if (!empty($_POST)) {
    # code...
    $first_password = "";
    $account        = "";

    if (isset($_COOKIE['no'] )&&isset($_COOKIE['password'])&&($_POST['account']==$_COOKIE['account'])) {
        # code...
        $first_password = ($_COOKIE['password']);
        $account        = addslashes($_COOKIE['account']);
       
    } else {
        $account        = addslashes($_POST['no']);
        $first_password = md5($_POST['password']);
     
    }

    if (empty($_POST['expire'])) {
        
        setcookie("account",$account,time()-1);
        setcookie("password",$first_password,time()-1);
        // setcookie("account", $account, time() - 1);
        // setcookie("password", $first_password, time() - 1);
    }
    include_once "../functions/database.php";
    get_Connection();
    $password    = md5($first_password);
    //echo $password;
    $sql         = "select * from user where account='$account' and password='$password' ";
    $result_user = mysql_query($sql);
    $num_user    = @mysql_num_rows($result_user);
    
    if ($num_user > 0) {
        # 账号密码正确
        if (!empty($_POST['expire'])) {
            # code...
            echo "csavd";
            $time=time()+3600*24*7;//保存一个星期
            setcookie("account", $account, $time);
            setcookie("password", $first_password, $time);
            
        }
        session_start();
        $row=mysql_fetch_array($result_user);
        $user_id=$row['user_id'];
        $user_name=$row['account'];
        $_SESSION['user_id']=$user_id;//session设置用户名字和ID
        //echo $_SESSION['user_id'];
        $_SESSION['user_name']=$user_name;
        $_SESSION['user_authority']="true";//$row['authority'];
        $result['message']="login_succeed";

        header('Location:seeActivities.php');
        //echo '登录成功，3s 后跳转';
                //登录成功时的操作
        // $row = mysql_fetch_array($result_user);
        // foreach ($row as $key => $value) {
        //     # code...
        //     $result[$key] = $value;
        // }


    } else {
        //密码错误
        if (isset($_COOKIE['account'] )&&isset($_COOKIE['password'])) {
            //如果cookie存在切账号密码错误则清除该cookie
            setcookie('account','',time()-360000,"/");
            setcookie('password','',time()-360000,"/");
        }
        $sql = "select * from user where account='$account' ";
        if (@mysql_num_rows(mysql_query($sql)) > 0) {
            # code...
            $result['message'] = '密码错误';
            echo "密码错误";

        } else {
            $result['message'] = '不存在该账号';
            echo "不存在该账号";
        }
    }
    close_Connection();
} else {
    $result['message'] = "提交表单值超过post_max_size的配置";
    echo "提交表单值超过post_max_size的配置";
}

//echo json_encode($result);
 //var_dump($result);
