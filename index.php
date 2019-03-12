<!DOCTYPE html>
<!-- saved from url=(0016)https://weui.io/ -->
<html lang="zh-cmn-Hans"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>松湖生态活动</title>
    <link rel="stylesheet" href="./WeUI_files/weui.css">
    <link rel="stylesheet" href="./WeUI_files/example.css">
    <link rel="stylesheet" href="css/wePublic.css">
    <script type="text/javascript" src="js/change.js"></script>
</head>
<body>
    <div class="container" id="container"><div class="page home js_show">
    <div class="page__hd padding0 marB15">
        <div class="imgbox" id="imgbox">
            <img  src="images/g1.png"  id="pic_change"/>
            <div class="buttonlist">
                <div id="b1" class="b2"></div>
                <div id="b2" class="b1"></div>
            </div>
        </div>
    </div>

    <div class="page__bd marB15">
        <div class="weui-panel weui-panel_access">
            <div class="weui-panel__hd titleGreen bigTitle"><i class="glyphicon glyphicon-grain titleGreen"></i>活动报名列表<i class="glyphicon glyphicon-grain titleGreen"></i></div>
        </div>
    </div>


    <div class="page__bd marB15">
        <div class="weui-panel weui-panel_access">
            
           <?php
           include_once "functions/database.php";

           $sql       = "select * from activities";
           get_Connection();
           $result = mysql_query($sql);
           $flage = 0;
           while($row = mysql_fetch_array($result))
           {

            if ($row["activityMark"] != 0) {
                continue;
            }
            $id = $row['activityId'];
            $sql2 = "select count(*)as number from participants where registerformId IN(select registerformId from registerForm where acticitieId =$id)";
            $result2 = mysql_query($sql2);
            $row2 =  mysql_fetch_array($result2);
                        //print_r($row2);
            $number = $row2['number'];
            $flage = 0;
            if(($row['activityMark']==0)&&(time()<@strtotime($row['deadlinetoRegister']))){
                $flage=1;

                if($number>=$row['totalParticipantLimit']){
                    $row['activityName']=$row['activityName']."(已报满)";

                }
                
                $sql3="select imageUrl from images where activityid=$id";
                $result3=mysql_query($sql3);
                $row3=mysql_fetch_array($result3);
                $imageUrl=$row3['imageUrl'];

                //echo $id;
                //echo "  ";

//($row['activityMark']==0)&&

           // }

                               /* $id = $row['activityId']; 
                                $h = "activityList.php?id= $id ";
                                $d = "../addtodatabase/delectActivict.php?id= $id ";*/
                            //}

                            ?> 


            <!-- 一个活动模块 BEGIN -->

            <a href="<?php echo "sign.php?id=$id"?>" class="aGreen">
            <div class="weui-cells">
                <div class="weui-cell weui-cell_access">
                    <div class="weui-cell__hd inBox" style="position: relative;margin-right: 10px;">
                        <img src="<?php echo $imageUrl?>" style="width: 50px;display: block"/>
                    </div>
                    <div class="weui-cell__bd">
                        <p><?php echo $row['activityName']?></p>
                        <p class="inTitle"><?php echo "报名截止时间：".$row['deadlinetoRegister']?></p>
                    </div>
                    <!-- <div class="weui-cell__ft">
                        <?php
                        if($number>=$row['totalParticipantLimit']){
                    echo "已报满！";
                }
                    ?></div> -->
                </div>
            </div>
            </a>
            <!-- 一个活动模块 END -->


<?php
}}


close_Connection();

?>
            <!-- 一个活动模块 BEGIN -->
            <!--
            <a href="sign.php" class="aGreen">
            <div class="weui-cells">
                <div class="weui-cell weui-cell_access">
                    <div class="weui-cell__hd inBox" style="position: relative;margin-right: 10px;">
                        <img src="images/g3.png" style="width: 50px;display: block"/>
                    </div>
                    <div class="weui-cell__bd">
                        <p>活动名称</p>
                        <p class="inTitle">报名截止时间</p>
                    </div>
                    <div class="weui-cell__ft">详情与报名</div>
                </div>
            </div>
            </a>
        -->
            <!-- 一个活动模块 END -->
        </div>
    </div><!--bd-->

<?php        
    if ($flage==0) {
        # code...
   
?>
<!-- 当没有活动可报名时用 begin-->
<div class="page__bd">
<!--     <div class="weui-loadmore">
        <i class="weui-loading"></i>
        <span class="weui-loadmore__tips">正在加载</span>
    </div> -->
    <div class="weui-loadmore weui-loadmore_line">
        <span class="weui-loadmore__tips">暂无活动可报名</span>
    </div>
</div>
<!-- 当没有活动可报名时用 end-->
<?php
 }
?>
    <!-- 页脚 begin-->
    <div class="page__bd page__bd_spacing"  style="margin-top:15px;">
        <div class="weui-footer">
            <p class="weui-footer__text">
                单位：东莞松山湖高新技术产业开发区<br>绿色低碳发展促进中心
            </p>
            <p class="weui-footer__text">地址：东莞市松山湖管委会b3栋</p>
        </div>
    </div>
    <!-- 页脚 end-->
</div>
</body></html>