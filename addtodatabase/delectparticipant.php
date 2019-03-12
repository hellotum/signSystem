 <?php
    include_once "../functions/database.php";
    if (isset($_GET["tel"])) {
        //删除志愿者
        get_Connection();
        $tel = $_GET["tel"];
        $sql    = "delete from participants where tel =$tel";
        //echo $sql;
        $result = mysql_query($sql);
        header("Location:../adminPage/seeVolunteers.php");
        //$result = mysql_query($sql);
        //echo "删除成功，3秒后跳转";

        //header('Location:../adminPage/seeVolunteers.php');
    }
    if (isset($_GET["pid"])) {
        if (isset($_GET["aid"])) {
            //删除活动人员
            get_Connection();
            $pid = $_GET["pid"];
            $aid = $_GET["aid"];
            $sql    = "delete from participants where participantId =$pid";
            $result = mysql_query($sql);
            //echo "删除成功，3秒后跳转";
            //echo $sql;
            header("Location:../adminPage/activityList.php?id=$aid");
            # code...
        }
        
    }
                    
      ?>