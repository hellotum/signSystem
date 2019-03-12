<?php

	include_once "../functions/database.php";
    if (isset($_GET["id"])) {
    	$activityId = $_GET["id"];
    	
        get_Connection();
        $sql = "select *  from participants where registerFormId IN (select registerFormId from registerForm where acticitieId = $activityId)";
    	//echo $sql;
    	
        $result = mysql_query($sql);
        $rows = mysql_num_rows($result);
        if ($rows>0) {
        	//download
        	$sql = "select * from activities where activityId = $activityId";
       		$result = mysql_query($sql);
            $row =  mysql_fetch_array($result);
            $activityName = $row["activityName"];
            $time = time();
        	$filedir = "/var/lib/mysql-files/$time$activityName"."活动名单.xls";
                //delete $filedir first
            //echo $filedir;
            
            //echo is_writable($data["$filedir"])?'不':'可写';
            $deleR = [];
             //exec ($comand, $deleR);
            //unlink($filedir);
             //echo "    \n";
             //print_r($deleR);
             //echo "    \n";
             //echo "    \n";
             //echo "    \n";

           // $sql = "select * into outfile '$filedir' CHARACTER SET gbk FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' from participants where registerFormId IN (select registerFormId from registerForm where acticitieId = $activityId)";
             //$sql = "select * into outfile '$filedir' CHARACTER SET gbk from participants where registerFormId IN (select registerFormId from registerForm where acticitieId = $activityId)";
            //$sql = "select * into outfile '$filedir' CHARACTER SET gbk from (select * from participants union select 'id','姓名','姓名','姓名','姓名','姓名','姓名','姓名','姓名','姓名')participants where registerFormId IN (select registerFormId from registerForm where acticitieId = $activityId)";
             $sql = "
                    select '对象id','姓名','单位','地点','电话','备注','成人/儿童','学校','表单id','年龄'
                    union 
                    select * from participants
                    where registerFormId IN (select registerFormId from registerForm where acticitieId = $activityId)
                    into outfile '$filedir' CHARACTER SET gbk
                    ";
             
             //echo $sql;
             //$comand = "sudo chmod 777 $filedir";
            //exec ($comand, $deleR);
            //echo $sql;
            //print_r($deleR);
            $result = mysql_query($sql);
            if ($result==FALSE) {
                echo "结果失败";
                $comand = "sudo rm -rf $filedir";
                //exec ($comand, $deleR);
            }
            //echo "结果$result";
            //$rows = mysql_num_rows($result);

        	$name = $activityName."活动名单.xls";
        	include_once "../functions/file_system.php";
            //echo $filedir;
        	download($filedir,$name);
            close_Connection();
        }
        else
        {
        	//has activity but no participant
            close_Connection();
            header('Location:../adminPage/seeActivities.php');
        }


    }else
    {
    	//no activity here
        header('Location:../adminPage/seeActivities.php');
    }







?>