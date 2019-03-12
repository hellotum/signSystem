 <?php
    include_once "../functions/database.php";

    if (isset($_GET["id"])) {
        //先删除图片
        get_Connection();
        $id = $_GET["id"];
        $sql    = "delete from images where activityId =$id";
        //echo "$sql";
        $result = mysql_query($sql);

        $sql    = "delete from codePic where activityId =$id";
        //echo "$sql";
        $result = mysql_query($sql);

        //$sql    = "delete from activities where activityId =$id";
        //$result = mysql_query($sql);
        $sql = "delete from participants where registerformId In(select registerformId from registerForm where acticitieId=$id)";
        //echo "$sql";
        mysql_query($sql);
        $sql = "delete from registerForm where acticitieId=$id";
        //echo "$sql";
        mysql_query($sql);
        $sql = "delete from activities where activityId=$id";
        //echo "$sql";
        mysql_query($sql);
        //echo "删除成功，3秒后跳转";
        if (isset($_GET["toP"])) {
            header('Location:../adminPage/publish.php');

        }
        else{
            header('Location:../adminPage/seeActivities.php');
        }
        
    }
                    
      ?>