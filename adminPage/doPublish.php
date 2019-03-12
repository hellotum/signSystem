<?php

include_once "../functions/database.php";
echo "aaaa";
    if (isset($_GET["id"])) {
        
        get_Connection();
        $id = $_GET["id"];
        $sql    = "update activities set activityMark=0 where activityId =$id";
        $result = mysql_query($sql);

        header('Location:seeActivities.php');
    }

