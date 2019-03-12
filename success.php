<!DOCTYPE html>
<!-- saved from url=(0016)https://weui.io/ -->
<html lang="zh-cmn-Hans"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>松湖生态报名</title>
    <link rel="stylesheet" href="./WeUI_files/weui.css">
    <link rel="stylesheet" href="./WeUI_files/example.css">
    <link rel="stylesheet" href="css/wePublic.css">
</head>
<body>  <!--跳转链接！-->
<div class="container" id="container"><div class="page home js_show">
    <div class="weui-msg">
        <?php 
         if (isset($_GET["id"])) {
                //echo $_GET["id"];
                $id = $_GET["id"];
                include_once "functions/database.php";
                get_Connection();
                $sql="select * from codePic where activityId=$id";
                $result = mysql_query($sql);
                $row = mysql_fetch_array($result);

                if (isset($row["codeUrl"])) {
                    $url = $row["codeUrl"];
                    ?>
                    <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
                    <div class="weui-msg__text-area">
                    <h2 class="weui-msg__title">报名成功！长按二维码进入活动群！</h2>

                    <img src="<?php echo $url;?>" style="width: 80%;height: auto; margin: 0 10%; text-align: center;border: #000 1px solid;">
                    </div>

                    <?php 
                }

            }else
            {
                ?>
                <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
                    <div class="weui-msg__text-area">
                    <h2 class="weui-msg__title">报名成功！</h2>
                    </div>
                 <?php 

            }

        ?>

        
            
            <div class="weui-msg__opr-area">
                <p class="weui-btn-area">
                    <a href="javascript:history.back();" class="weui-btn weui-btn_primary">返回活动详情页</a>
<!--                     <a href="javascript:history.back();" class="weui-btn weui-btn_default">辅助操作</a> -->
                </p>
            </div>
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

</div>
</div>
</body></html>