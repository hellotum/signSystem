<!DOCTYPE html>
<!-- saved from url=(0016)https://weui.io/ -->
<html lang="zh-cmn-Hans"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>松湖生态报名</title>
    <link rel="stylesheet" href="./WeUI_files/weui.css">
    <link rel="stylesheet" href="./WeUI_files/example.css">
    <link rel="stylesheet" href="css/wePublic.css">
    <script  src="js/submit.js" type="text/javascript"></script>
</head>
<body>

<?php

$id=$_GET['id'];
include_once "functions/database.php";
get_Connection();
$sql="select * from activities where activityId=$id";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

$activityName=$row['activityName'];
$totalParticipantLimit=$row['totalParticipantLimit'];
$activityAddress=$row['activityAddress'];
$activityStartTime=$row['activityStartTime'];
$activityEndTime=$row['activityEndTime'];
$deadlinetoRegister=$row['deadlinetoRegister'];
$describe=$row['describe'];
$tel = $row['activityPeople'];
$personName = $row['activityPeopleTel'];
$sql2="select imageUrl from images where activityid=$id";
$result2=mysql_query($sql2);
$row2=mysql_fetch_array($result2);
$imageUrl=$row2['imageUrl'];

$sql2 = "select count(*)as number from participants where registerformId IN(select registerformId from registerForm where acticitieId =$id)";
            $result2 = mysql_query($sql2);
            $row2 =  mysql_fetch_array($result2);
                        //print_r($row2);
            $number = $row2['number'];

?>

<form action="xiapi2.php"  role="form" method="post"  id="demoForm"  onsubmit="return Check()">
<fieldset>
    <div class="container" id="container"><div class="page home js_show">

    <div class="page__hd padding0 bgGreen topTitle ">
        <a href="javascript:history.back();" class="trangle">
            <div class="trangle1"></div>
            <div class="trangle2"></div>
        </a>
        <h4><?php echo "$activityName"?></h4>
    </div>

    <div class="page__hd padding0 marB15">
        <div class="imgbox" id="imgbox">
            <img  src="<?php echo "$imageUrl"?>"/>
            <div class="person">
                <!-- 隐藏已报名在class里面加hidden -->
                <p><a href="" class="weui-btn weui-btn_mini bgOrange btn">报名人数</a>&nbsp<span class="textGrey"><?php echo "$number"?></span><span class="textGreen"><?php echo "/"."$totalParticipantLimit"?></span></p>
            </div>
        </div>
    </div>

    <div class="page__bd marB15">
        <div class="weui-panel weui-panel_access">
            <div class="weui-article">
            <!-- 活动地点 -->
                <h2 class="title textGreen textWieght">活动地点&nbsp</h2>
                <h3  class="text7b"><?php echo "$activityAddress"?></h3>
                <div class="block10"></div>
            <!-- 活动时间 -->
                <h2 class="title textGreen textWieght">活动时间&nbsp</h2>
                <h3  class="text7b">
                    <?php echo "$activityStartTime"?>
                    <span class="text7b">——</span>
                    <?php echo "$activityEndTime"?>
                </h3>
            <!-- 活动时间 -->
                <h2 class="title textGreen textWieght">联系人及其联系方式&nbsp</h2>
                <h3  class="text7b">
                    <?php echo "$tel"?>
                    <span class="text7b">/</span>
                    <?php echo "$personName"?>
                </h3>
            <!-- 报名截止时间 -->
                <div class="block10"></div>
                <h2 class="title textGreen textWieght">报名截止时间&nbsp</h2>
                <h3  class="text7b"><?php echo "$deadlinetoRegister"?></h3>
            <!-- 活动详情 -->
                <div class="block10"></div>
                <h2 class="title textGreen textWieght">活动详情&nbsp</h2>
                <div  class="text7b"><?php echo "$describe"?><div>
            </div>
        </div>
    </div>
<?php
close_Connection();
?>

    <div class="page__bd marB15">
        <div class="weui-panel weui-panel_access">
            <div class="weui-cells weui-cells_form">
                <div class="weui-panel weui-panel_acces borderBGreen">
                    <div class="weui-panel__hd titleGreen  bigTitle">&nbsp&nbsp填写报名&nbsp&nbsp</div>

                </div>
                <div class="weui-cell">
                <!-- 报错则class加一个weui-cell_warn -->
                    <div class="weui-cell__hd">
                        <label class="weui-label"><i style="color:red;">* </i>姓名</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text"  placeholder="请输入姓名" name="name" id="name" onfocus="onf_name();" onblur="onb_name();"/>
                    </div>
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__hd">
                        <label class="weui-label"><i style="color:red;">* </i>工作单位</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text" placeholder="请输入工作单位" name="unit" id="unit" onfocus="onf_unit();" onblur="onb_unit();"/>
                    </div>
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__hd">
                        <label class="weui-label">职务/职称</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="text" placeholder="请输入职务/职称（选填）" name="job"/>
                    </div>
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                </div>
                <div class="weui-cell">
                    <div class="weui-cell__hd">
                        <label class="weui-label"><i style="color:red;">* </i>联系电话</label>
                    </div>
                    <div class="weui-cell__bd">
                        <input class="weui-input" type="tel" placeholder="请输入联系电话" size="15"  pattern="^1[34578]{1}[0-9]{9}$" name="tel"  id="tel"  onfocus="onf_tel();" onblur="onb_tel();"/>
                    </div>
                    <div class="weui-cell__ft">
                        <i class="weui-icon-warn"></i>
                    </div>
                </div>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <textarea class="weui-textarea" placeholder="请输入备注" rows="3"  name="text"></textarea>
                            <div class="weui-textarea-counter"><span>0</span>/200</div>
                        </div>
                    </div>
                </div>
<!--                 <div class="weui-cell weui-cell_switch">
                    <div class="weui-cell__bd">单独的儿童报名</div>
                    <div class="weui-cell__ft">
                        <button onclick="addChildS()" type="button" id="addChildBtn" class="weui-btn weui-btn_mini weui-btn_primary">只是儿童报名</button>
                    </div>
                </div> -->
                <div class="weui-cell weui-cell_switch">
                    <div class="weui-cell__bd">添加家庭成员报名信息</div>
                    <div class="weui-cell__ft">
                        <button onclick="checkboxOnclick()" type="button" id="addPerson" class="weui-btn weui-btn_mini weui-btn_primary">添加</button>
                    </div>
                </div>
                <div class="weui-cell" id="add"></div>
                <div class="" id="men"></div>
                <div class="" id="child"></div>

            </div>
            <div class="weui-btn-area">
                <input type="hidden" name="activityId" value=<?php echo $id?>>
                <button type="submit" class="weui-btn weui-btn_primary bgGreen" id="showTooltips">确定</button>
            </div>
        </div>
    </div><!--bd-->
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
</fieldset>
</form>

<script>
var n=0;
var famliy=0;
var men=0;
var child=0;
var g=0;

var addMenForm = document.getElementById("men");
var addChildForm = document.getElementById("child");
function menAdd(){
    men++;
    addMenForm.insertAdjacentHTML('beforeEnd','<div id="men'+men+'"><div class="weui-cell weui-cell_switch"><div class="weui-cell__bd textGreen">成人*'+men+'&nbsp</div></div><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label"><i style="color:red;">* </i>姓名</label></div><div class="weui-cell__bd"><input class="weui-input" type="text"  placeholder="请输入姓名" name="name'+men+'" id="name'+men+'" onfocus="onf_name'+men+'();" onblur="onb_name'+men+'();"/></div></div><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label"><i style="color:red;">* </i>工作单位</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" placeholder="请输入工作单位" name="unit'+men+'" id="unit'+men+'" onfocus="onf_unit'+men+'();" onblur="onb_unit'+men+'();"/></div></div><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label">职务/职称（选填）</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" placeholder="请输入职务/职称（选填）" name="job'+men+'"/></div></div><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label"><i style="color:red;">* </i>联系电话</label></div><div class="weui-cell__bd"><input class="weui-input" type="tel" placeholder="请输入联系电话" size="15" name="tel'+men+'" id="tel'+men+'" onfocus="onf_tel'+men+'();" onblur="onb_tel'+men+'();"/></div></div><div class="weui-cells weui-cells_form"><div class="weui-cell"><div class="weui-cell__bd"><textarea class="weui-textarea" placeholder="请输入备注" rows="3" name="text'+men+'"></textarea><div class="weui-textarea-counter"><span>0</span>/200</div></div></div></div></div>');
    if(men==5){
        document.getElementById("btnAddmen").disabled = "disabled";
        document.getElementById("btnAddmen").style.backgroundColor="#7b7b7b";
        alert("一次最多可添加5个成人！");
    }
}
function menSub(){
    if(men==0){
        alert("已无法再减");
    }else{
        if(men==5){
            document.getElementById("btnAddmen").style.backgroundColor="#1AAD19";
        }
        var Child1 = document.getElementById("men"+men);
        addMenForm.removeChild(Child1);
        if(men>=0){
            men--;
        }
    }
}

function childAdd(){
    child++;
    addChildForm.insertAdjacentHTML('beforeEnd','<div id="child'+child+'"><div class="weui-cell weui-cell_switch"><div class="weui-cell__bd textGreen">儿童*'+child+'</div></div><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label"><i style="color:red;">* </i>姓名</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" placeholder="请输入姓名" name="childName'+child+'" id="childName'+child+'" /></div><div class="weui-cell__ft"><i class="weui-icon-warn"></i></div></div><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label"><i style="color:red;">* </i>就读学校</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" placeholder="请输入就读学校" name="school'+child+'" id="school'+child+'" /></div><div class="weui-cell__ft"><i class="weui-icon-warn"></i></div></div><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label"><i style="color:red;">* </i>儿童年龄</label></div><div class="weui-cell__bd"><input class="weui-input" type="number" placeholder="请输入儿童年龄" name="age'+child+'" id="age'+child+'" /></div><div class="weui-cell__ft"><i class="weui-icon-warn"></i></div></div><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label"><i style="color:red;">* </i>家长联系电话</label></div><div class="weui-cell__bd"><input class="weui-input" type="tel" placeholder="请输入家长联系电话" name="childTel'+child+'" id="childTel'+child+'" /></div><div class="weui-cell__ft"><i class="weui-icon-warn"></i></div></div></div>');
    if(child==5){
        document.getElementById("btnChildmen").disabled = "disabled";
        document.getElementById("btnChildmen").style.backgroundColor="#7b7b7b";
        alert("一次最多可添加5个儿童！");
    }
}

function childSub(){
    if(child==0){
        alert("已无法再减");
    }else{
        if(child==5){
            document.getElementById("btnChildmen").style.backgroundColor="#1AAD19";
        }
        var Child2 = document.getElementById("child"+child);
        addChildForm.removeChild(Child2);
        if(child>0){
            child--;
        }
    }
}



function checkboxOnclick(){
    var addPerson = document.getElementById("addPerson");
    var add = document.getElementById("add");
    var addChild1 = document.getElementById("addChild1");
    var addChild2 = document.getElementById("addChild2");
    console.log(n);
    console.log(n%2);
    n++;
    if(n%2 == 1){
        add.insertAdjacentHTML('beforeEnd','<div class=\"weui-cell__hd\" id=\"addChild1\"><button href=\"\" class=\"weui-btn weui-btn_mini weui-btn_primary\" type="button" id="btnAddmen" onclick="menAdd()">成人&nbsp+</button><button href=\"\" class=\"weui-btn weui-btn_mini bgOrange\" type="button" onclick="menSub()">成人&nbsp-</button></div><div class=\"weui-cell__bd\" id=\"addChild2\"><button href=\"\" class=\"weui-btn weui-btn_mini weui-btn_primary\"  type="button" id="btnChildmen" onclick="childAdd()">儿童&nbsp+</button><button href=\"\" class=\"weui-btn weui-btn_mini bgOrange\"  type="button"  onclick="childSub()">儿童&nbsp-</button></div>');
        addPerson.innerText="取消添加";
        addPerson.className="weui-btn weui-btn_mini bgOrange";
        console.log(n);
        console.log(n%2);
    }else{
        add.removeChild(addChild1);
        add.removeChild(addChild2);
                addPerson.innerText="添加";
                addPerson.className="weui-btn weui-btn_mini weui-btn_primary";
    }
}

// function addChildS(){
//     g++;
//     addChildForm.insertAdjacentHTML('beforeEnd','<div id="child"><div class="weui-cell weui-cell_switch"><div class="weui-cell__bd textGreen">单独的儿童报名</div></div><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label"><i style="color:red;">* </i>姓名</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" placeholder="请输入姓名" name="childName6" id="childName6" /></div><div class="weui-cell__ft"><i class="weui-icon-warn"></i></div></div><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label"><i style="color:red;">* </i>就读学校</label></div><div class="weui-cell__bd"><input class="weui-input" type="text" placeholder="请输入就读学校" name="school6" id="school6" /></div><div class="weui-cell__ft"><i class="weui-icon-warn"></i></div></div><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label"><i style="color:red;">* </i>儿童年龄</label></div><div class="weui-cell__bd"><input class="weui-input" type="number" placeholder="请输入儿童年龄" name="age6" id="age6" /></div><div class="weui-cell__ft"><i class="weui-icon-warn"></i></div></div><div class="weui-cell"><div class="weui-cell__hd"><label class="weui-label"><i style="color:red;">* </i>家长联系电话</label></div><div class="weui-cell__bd"><input class="weui-input" type="tel" placeholder="请输入家长联系电话" name="childTel6" id="childTel6" /></div><div class="weui-cell__ft"><i class="weui-icon-warn"></i></div></div></div>');
//     if(g%2==1){
//         document.getElementById("addChildBtn").disabled = "disabled";
//         document.getElementById("addChildBtn").style.backgroundColor="#7b7b7b";
//         document.getElementById("addChildBtn").innerText="无法再操作";
//     }
// }
</script>

</body></html>














