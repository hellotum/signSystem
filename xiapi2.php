<?php
$result = [];

//print_r($_POST);

include_once "functions/database.php";
get_Connection();
$activityId="";
$time=time();

//判断是否超过报名人数
if(isset($_POST['activityId'])){

    //获得用户所要报名人数
    $n=0;
    $number=0;
    if(isset($_POST['name'])){
        $n++;
    }
    $i = 1;
    while (True){
        $name = "name".$i;
        if(isset($_POST["$name"])){
            $n++;
        }else
        {
            break;
        }
        $i++;
    }
    $y = 1;
    while (True){
        $childName = "childName".$y;
        if(isset($_POST["$childName"])){
            $n++;
        }else
        {
            break;
        }
        $y++;
    }

    //n++;
    $activityId=addslashes($_POST["activityId"]);
    //获取活动报名人数上限
    $sql="select * from activities where activityId=$activityId";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $totalParticipantLimit=$row['totalParticipantLimit'];

    //n++;
    //获得活动已报名人数
    $sql2 = "select count(*)as number from participants where registerformId IN(select registerformId from registerForm where acticitieId =$activityId)";
    $result2 = mysql_query($sql2);
    $row2 =  mysql_fetch_array($result2);
    $number = $row2['number'];
    $url = "";
    if(($n+$number)>$totalParticipantLimit){
        //$result['message'] = '添加失败';
        if ($number<$totalParticipantLimit) {
            $url = "Location:fail.php?message=超过报名人数";
        }
        else
        {
            $url = "Location:fail.php?message=名额已满。";
        }
        close_Connection();
        header($url);
        exit();
        
    }





/*if(1){
    $n++;
    echo $n;
}*/
//不给重复报名
    else {
            if(isset($_POST['tel'])){
                $tel = $_POST['tel'];
                //不给重复报名
                $sql = "select tel from participants where registerformId IN (select registerformId from registerForm where acticitieId=$activityId)";
                //echo $sql;
                $result = mysql_query($sql);
                while($row = mysql_fetch_array($result))
                {
                    //echo "1   ";
                    //echo $row["tel"];
                    if ($row["tel"] == $tel) {
                        $url = "Location:fail.php?message=$tel"."号码已经报过名";
                        header($url);
                        exit();
                    }
                    //close_Connection();
                    
                }
        }
        $i = 1;
        while (True){
            $tel = "tel".$i;
            if(isset($_POST["$tel"])){
                $tel = $_POST["$tel"];
                //不给重复报名
                $sql = "select tel from participants where registerformId IN (select registerformId from registerForm where acticitieId=$activityId)";
                $result = mysql_query($sql);
                while($row = mysql_fetch_array($result))
                {
                    //echo "1   ";
                    //echo $row["tel"];
                    if ($row["tel"] == $tel) {
                        $url = "Location:fail.php?message=$tel"."号码已经报过名";
                        header($url);
                        exit();
                    }
                }
            }else
            {
                break;
            }
            $i++;
        }
        $y = 1;
        while (True){
            $childTel = "childTel".$y;
            if(isset($_POST["$childTel"])){
                $tel = $_POST["$childTel"];
                //不给重复报名
                $sql = "select tel from participants where registerformId IN (select registerformId from registerForm where acticitieId=$activityId)";
                $result = mysql_query($sql);
                while($row = mysql_fetch_array($result))
                {
                    //echo "1   ";
                    //echo $row["tel"];
                    if ($row["tel"] == $tel) {
                        $url = "Location:fail.php?message=$tel"."号码已经报过名";
                        header($url);
                        exit();
                    }
                }
            }else
            {
                break;
            }
            $y++;
        }



//if(isset($_POST['activityId'])){
    //echo 1;
    $activityId=addslashes($_POST["activityId"]);
	$sql = "insert into registerForm values(null,'$time','$activityId')";
//echo $sql;
	mysql_query($sql);
	if (isset($_POST['name'])) {
        //echo 2;
		if (isset($_POST["unit"])) {
            //echo 3 ;
			if (isset($_POST['tel'])) {
				$formId="";
				$sql = "select registerformId from registerForm where mark='$time'";
        	
				$result1=mysql_query($sql);
				$row = mysql_fetch_array($result1);
				$formId = $row['registerformId'];
                
                $name   = addslashes($_POST['name']);
                $unit  = addslashes($_POST['unit']);
                $job = addslashes($_POST['job']);
                $tel = addslashes($_POST['tel']);
                $text     = addslashes($_POST['text']);
                
                $sql = "insert into participants values(null,'$name','$unit','$job','$tel','$text','成人',null,'$formId',null)";
                mysql_query($sql);

                $i = 1;
                while (True)
                {
                	$name = "name".$i;
                	$unit = "unit".$i;
                	$job = "job".$i;
                	$tel = "tel".$i;
                	$text = "text".$i;
                	if(isset($_POST["$name"]))
                	{
                		if(isset($_POST["$unit"]))
                		{
                			if(isset($_POST["$job"]))
                			{
                				if(isset($_POST["$tel"]))
                				{
                					if(isset($_POST["$text"]))
                					{
                						
                						$name   = addslashes($_POST["$name"]);
                						$unit   = addslashes($_POST["$unit"]);
                						$job   = addslashes($_POST["$job"]);
                						$tel   = addslashes($_POST["$tel"]);
                						$text   = addslashes($_POST["$text"]);
                						//echo $name;

                						$sql = "insert into participants values(null,'$name','$unit','$job','$tel','$text','成人',null,'$formId',null)";

                						mysql_query($sql);

                					}
                				}
                			}
                		}
                	}
                	else 
                	{
                		break;
                	}
                	$i++;
                }

                $y = 1;
                while (True)
                {
                	$childName = "childName".$y;
                	$school = "school".$y;
                	$age = "age".$y;
                	$childTel = "childTel".$y;
                	if(isset($_POST["$childName"]))
                	{
                		if(isset($_POST["$school"]))
                		{
                			if(isset($_POST["$age"]))
                			{
                				if(isset($_POST["$childTel"]))
                				{
                					$childName   = addslashes($_POST["$childName"]);
                					$school   = addslashes($_POST["$school"]);
                					$age   = addslashes($_POST["$age"]);
                					$childTel   = addslashes($_POST["$childTel"]);
                					//echo $childName;
                					$sql = "insert into participants values(null,'$childName',null,null,'$childTel',null,'儿童','$school','$formId','$age')";
                					mysql_query($sql);
                				}
                			}
                		}
                	}
                	else 
                	{
                		break;
                	}
                	$y++;
                }
                //$result['message'] = '添加成功';
                //echo "sassss";
                close_Connection();

                $url = "Location:success.php?id=$activityId";
                header($url);
                //echo "123";
                //echo '添加成功，3s 后跳转';
                /*else{
                    $result['message'] = '数据库错误';
                    //echo $sql;
                }*/
            }else   $result['message'] = '电话';
        }else  $result['message'] = '单位';
    }else  $result['message'] = '姓名';
}
}else  $result['message'] = '活动';


//echo json_encode($result);
//print_r($result) ;