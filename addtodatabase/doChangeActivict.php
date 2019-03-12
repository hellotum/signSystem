<?php
$result = [];
//print_r($_POST);
//print_r($_FILES);


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
                                    $id = addslashes($_POST['id']);

                                    $timeBegin=$timeBegin." ".$timeBegin2;
                                    $timeEnd=$timeEnd." ".$timeEnd2;
                                    $signTime=$signTime." ".$signTime2;

                                   

                                    if(isset($_POST['save'])){
                                        $flag=1;
                                    }else $flag=0;
                                    

                                    $sql = "update activities set activityName='$name',activityStartTime='$timeBegin',activityAddress='$address',deadlinetoRegister='$signTime',totalParticipantLimit='$number',activityEndTime='$timeEnd',activityPeople='$person',activityPeopleTel='$tel',activityMark='$flag' where activityId=$id";
                                    //echo "string";
                                    //echo "$sql";

                                    if (mysql_query($sql)!=false) 
                                    {
                                        //活动表更新活动成功
                                        //更新描述
                                        
                                        //$sql = "update activities set describe = cast('$describe' as text)";
                                        $sql = "update activities set`describe` = concat ('$describe') where activityId=$id";
                                        mysql_query($sql);
                                        //echo $sql;


                                        if($_FILES['code']['name']!='')
                                        {
                                            //有上传二维码
                                            //echo "FILES['code'];";
                                            print_r($_FILES['code']) ;
                                            include_once "../functions/file_system.php";
                                            $file=$_FILES['code'];
                                            $upload_path = "../upload/";
                                            $result = upload($file,$upload_path,'codePic');
                                            $wholePath = $result["destination"];
                                            $wholePath=str_replace('../','',$wholePath);
                                            $sql = "update codePic set codeUrl='$wholePath' where activityId=$id";


                                            //echo "codePic save successfully";
                                            
                                            mysql_query($sql);
                                            $sql = "insert into codePic values('$id','$wholePath')"; 
                                            mysql_query($sql);
                                            

                                        }

                                        if (isset($_POST['sourceImg'])) {
                                            //图片不改
                                            //echo "bugai";
                                        }
                                        else if($_FILES['img']['name']!='')
                                        {
                                            //有上传图片
                                            //print_r($_FILES['img']) ;
                                            //echo "FILES['img'];";
                                            print_r($_FILES['img']) ;
                                            include_once "../functions/file_system.php";
                                            $file=$_FILES['img'];
                                            $upload_path = "../upload/";
                                            /*upload($file,$upload_path,'activityShowPic');
                                            $save_path = "upload/";
                                            $wholePath = $destination = iconv("UTF-8", "GB2312", $save_path . "/" . time() . '_' . 'activityShowPic' . '.' . extension_name($file['name']));
*/                                           

                                            $result = upload($file,$upload_path,'activityShowPic');
                                            //$save_path = "upload/";
                                            //$wholePath = $destination = iconv("UTF-8", "GB2312", $save_path . "/" . time() . '_' . 'activityShowPic' . '.' . extension_name($file['name']));
                                            $wholePath = $result["destination"];
                                            
                                            $wholePath=str_replace('../','',$wholePath);
                                            $sql = "update images set imageUrl='$wholePath' where activityId=$id";
                                           // echo "更新图片";
                                            //echo $sql;
                                            mysql_query($sql);

                                        }
                                        else if(isset($_POST['defaultImg']))
                                        {
                                            //选择默认图片
                                            $img=$_POST['defaultImg'];
                                            $sql = "update images set imageUrl='$img' where activityId=$id";
                                            //echo $sql;
                                            mysql_query($sql);
                                        }else
                                        {
                                            $img = "images/g1.png";
                                            $sql = "update images set imageUrl='$img' where activityId=$id";
                                            //echo $sql;
                                            mysql_query($sql);

                                        }
                                        $result['message'] = '修改成功';
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