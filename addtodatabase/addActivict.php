<?php
$result = array();

print_r($_POST);
print_r($_FILES);

if (isset($_GET['id'])) {
    //来自于页面修改，先删后加
    $id = $_GET['id'];
    include_once "../functions/database.php";
    get_Connection();
    $sql = "delete from images where activityId=$id";
    mysql_query($sql);

    $sql    = "delete from codePic where activityId =$id";
    echo "$sql";
    $result = mysql_query($sql);

    $sql = "delete from participants where registerformId In(select registerformId from registerForm where acticitieId=$id)";
    mysql_query($sql);
    $sql = "delete from registerForm where acticitieId=$id";
    mysql_query($sql);
    $sql = "delete from activities where activityId=$id";
    mysql_query($sql);

}


if (isset($_POST['name'])) {
    if (isset($_POST["address"])) {
        if (isset($_POST["person"])) {
            if (isset($_POST["tel"])) {
                if (isset($_POST['timeBegin'])) {
                    if (isset($_POST['timeEnd'])) {
                        if (isset($_POST['signTime'])) {
                            if (isset($_POST['text'])) {
                                if (isset($_POST['number'])) {

                                    $file = "";
                                    $wholePath = "";
                                    $flag="";


                                    include_once "../functions/database.php";
                                    get_Connection();

                                    $name   = addslashes($_POST["name"]);
                                        //$img= "";//addslashes($_POST['img']);
                                    $address  = addslashes($_POST['address']);
                                    $person  = addslashes($_POST['person']);
                                    $tel  = addslashes($_POST['tel']);
                                    $timeBegin = addslashes($_POST['timeBegin']);
                                    $timeBegin2 = addslashes($_POST['timeBegin2']);
                                    $timeEnd     = addslashes($_POST['timeEnd']);
                                    $timeEnd2     = addslashes($_POST['timeEnd2']);
                                    $signTime = addslashes($_POST['signTime']);
                                    $signTime2 = addslashes($_POST['signTime2']);
                                    $describe =addslashes($_POST['text']);
                                    $number     = addslashes($_POST['number']);

                                    /*$timeBegin=@mktime($timeBegin);
                                    $timeBegin = date("Y-m-d h:i:s", $timeBegin);
                                    $timeEnd=@mktime($timeEnd);
                                    $timeEnd = date("Y-m-d h:i:s", $timeEnd);
                                    $signTime=@mktime($signTime);
                                    $signTime = date("Y-m-d h:i:s", $signTime);*/

                                    $timeBegin=$timeBegin." ".$timeBegin2;
                                    $timeEnd=$timeEnd." ".$timeEnd2;
                                    $signTime=$signTime." ".$signTime2;
                                    //$describe = "";

                                    /*
                                    //拿到活动id
                                    $sql = "select activityId from activities where activityName='$name'";
                                    //echo $sql;
                                    $result2=mysql_query($sql);
                                    $row2 =  mysql_fetch_array($result2);
                                    $id = $row2['activityId'];
                                    */


                                    /*if(isset($_FILES['img']))
                                    {
                                        //echo $_FILES['img'];
                                                    include_once "../functions/file_system.php";
                                                    $file=$_FILES['img'];
                                                    $upload_path = "../upload/";
                                                    upload($file,$upload_path,'activityShowPic');
                                                    $save_path = "upload/";
                                        //move_uploaded_file($file['tmp_name'],$upload_path.$file['name']);
                                                    $wholePath = $destination = iconv("UTF-8", "GB2312", $save_path . "/" . time() . '_' . 'activityShowPic' . '.' . extension_name($file['name']));
                                                    
                                    //var_dump($file);
                                                    if ($wholePath != "") {
                                            /*$sql = "select activityId from activities where activityName='$name'";
                                            //echo $sql;
                                            $result2=mysql_query($sql);

                                            $row2 =  mysql_fetch_array($result2);
                                            $id = $row2['activityId'];

                                            $sql = "insert into images values('$id','$wholePath')";
                                            echo $sql;
                                            mysql_query($sql);

                                        }
                                    }else {
                                        $img=$_POST['defaultImg'];
                                        $sql = "insert into images values('$id','$img')";
                                        echo $sql;
                                        mysql_query($sql);
                                    }*/

                                    if(isset($_POST['save'])){
                                        $flag=1;
                                    }else $flag=0;
                                    


                                    $sql = "insert into activities values(null,'$name','$timeBegin','$address','$signTime','$number','$timeEnd', '$describe','$person','$tel','$flag')";
                                    //echo "$sql";

                                    if (mysql_query($sql)!=false) 
                                    {
                                        //数据库插入活动成功
                                        $sql = "select activityId from activities where activityName='$name'";
                                        //echo $sql;
                                        $result2=mysql_query($sql);
                                        $row2 =  mysql_fetch_array($result2);
                                        $id = $row2['activityId'];



                                        if($_FILES['code']['name']!='')
                                        {
                                            //有上传二维码
                                            //print_r($_FILES['img']) ;
                                            //echo "FILES['code'];";
                                            print_r($_FILES['code']) ;
                                            include_once "../functions/file_system.php";
                                            $file=$_FILES['code'];
                                            $upload_path = "../upload/";


                                            $result = upload($file,$upload_path,'codePic');
                                            $wholePath = $result["destination"];

                                            $wholePath=str_replace('../','',$wholePath);

                                            //upload($file,$upload_path,'codePic');
                                            //$save_path = "upload/";


                                            //$wholePath = $destination = iconv("UTF-8", "GB2312", $save_path . "/" . time() . '_' . 'codePic' . '.' . extension_name($file['name']));

                                            $sql = "insert into codePic values('$id','$wholePath')";
                                            //echo "codePic save successfully";
                                            //echo $sql;
                                            mysql_query($sql);
                                        }else{
                                            $sql = "insert into codePic values('$id','')";
                                            mysql_query($sql);
                                        }

                                        if($_FILES['img']['name']!='')
                                        {
                                            //有上传图片
                                            //print_r($_FILES['img']) ;
                                            //echo "FILES['img'];";
                                            print_r($_FILES['img']) ;
                                            include_once "../functions/file_system.php";
                                            $file=$_FILES['img'];
                                            $upload_path = "../upload/";
                                            $result = upload($file,$upload_path,'activityShowPic');
                                            //$save_path = "upload/";
                                            //$wholePath = $destination = iconv("UTF-8", "GB2312", $save_path . "/" . time() . '_' . 'activityShowPic' . '.' . extension_name($file['name']));
                                            $wholePath = $result["destination"];
                                            
                                            $wholePath=str_replace('../','',$wholePath);
                                            $sql = "insert into images values('$id','$wholePath')";
                                            //echo "string";
                                            //echo $sql;
                                            mysql_query($sql);

                                        }
                                        else if(isset($_POST['defaultImg']))
                                        {
                                            //选择默认图片
                                            $img=$_POST['defaultImg'];
                                            $sql = "insert into images values('$id','$img')";
                                            //echo $sql;
                                            mysql_query($sql);
                                        }else
                                        {
                                            $img = "images/g1.png";
                                            $sql = "insert into images values('$id','$img')";
                                            //echo $sql;
                                            mysql_query($sql);

                                        }
                                        $result['message'] = '添加成功';
                                             //header('Refresh:3,Url=../adminPage/seeActivities.php');

                                        if (isset($_POST['save'])) {
                                            header('Location:../adminPage/publish.php');
                                        }else
                                        {

                                            header('Location:../adminPage/seeActivities.php');
                                        }
                                        
                                             //echo '添加成功，3s 后跳转';
                                    }
                                    else{
                                        $result['message'] = '数据库错误';
                                            //echo $sql;
                                        print_r($result['message']) ;
                                    }
                                    close_Connection();

                                }else $result['message'] = '报名人数上限';
                            }else $result['message'] = '活动简介';
                        }else  $result['message'] = '报名截止时间';
                    }else  $result['message'] = '结束时间';
                }else   $result['message'] = '开始时间';
            }else  $result['message'] = '活动联系人电话';
        }else  $result['message'] = '活动联系人';
    }else  $result['message'] = '地址';
}else  $result['message'] = '姓名';

//echo json_encode($result);
//print_r($result) ;