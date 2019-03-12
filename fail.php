<!DOCTYPE html>
<!-- saved from url=(0016)https://weui.io/ -->
<html lang="zh-cmn-Hans"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>松湖生态报名</title>
    <link rel="stylesheet" href="./WeUI_files/weui.css">
    <link rel="stylesheet" href="./WeUI_files/example.css">
    <link rel="stylesheet" href="css/wePublic.css">
</head>
<body  onload="Load('index.php')">  <!--跳转链接！-->
<div class="container" id="container"><div class="page home js_show">


        <div class="weui-msg">
            <div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg"></i></div>
            <div class="weui-msg__text-area">
                <h2 class="weui-msg__title"><?php
                if (isset($_GET["message"])) {
                    echo $_GET["message"];
                }else
                {
                    echo "出错，请联系活动主办方";
                }

                ?></h2>
                <p class="weui-msg__desc"><span id="ShowDiv"></span><a href="javascript:void(0);">活动详情页</a></p>
            </div>
            <div class="weui-msg__opr-area">
                <p class="weui-btn-area">
                    <a href="javascript:history.back();" class="weui-btn weui-btn_warn">返回报名列表</a>
<!--                     <a href="javascript:history.back();" class="weui-btn weui-btn_default">辅助操作</a> -->
                </p>
            </div>

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
<script language="javascript">
var secs = 3; //倒计时的秒数 
var URL ;
function Load(url){
URL = url;
for(var i=secs;i>=0;i--) 
{ 
   window.setTimeout('doUpdate(' + i + ')', (secs-i) * 1000); 
} 
}
function doUpdate(num) 
{ 
document.getElementById('ShowDiv').innerHTML = '将在'+num+'秒后自动跳转到' ;
if(num == 0) { window.location = URL; }
}
</script>
</body></html>