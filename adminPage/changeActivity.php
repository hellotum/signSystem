<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>松湖生态微信公众号报名管理系统</title>
        <meta name="keywords" content="松湖生态微信公众号报名管理系统" />
        <meta name="description" content="松湖生态" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- basic styles -->

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />

        <!--[if IE 7]>
          <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
        <![endif]-->

        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="../css/public.css">
        <link rel="stylesheet" href="assets/css/datepicker.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-timepicker.css" />
        <!-- fonts -->

        <!-- ace styles -->
<link rel="stylesheet" href="assets/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="assets/css/daterangepicker.css" />

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->

        <script src="assets/js/ace-extra.min.js"></script>
        <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="assets/js/submit.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
    <?php   
        include("../functions/is_login.php");
            
        if(!is_login())
        {
            //echo "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
            header('Location:login.php');
        }
    ?>
    <!-- 导入顶部导航栏 -->
    <?php include("public/topNav.html");?>

        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>

            <div class="main-container-inner">
                <a class="menu-toggler" id="menu-toggler" href="#">
                    <span class="menu-text"></span>
                </a>

                <!-- 导入左侧导航栏 -->
                <?php include("public/leftNav.html");?>

                <div class="main-content">
                    <!-- 导入路径 -->
                    <?php include("public/link.html");?>

                    <div class="page-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                    <!-- title -->
                                    <div class="page-header">
                                        <h1>
                                            关于活动信息
                                            <small>
                                                <i class="icon-double-angle-right"></i>
                                                活动详情信息的修改
                                            </small>
                                        </h1>
                                    </div>

                                    <form class="form-horizontal form-signin" role="form" method="post" action="../addtodatabase/doChangeActivict.php" enctype="multipart/form-data"  onsubmit="return Check()">


                                    	<?php 

                                    	if (isset($_GET["id"])) {
                                    		
                                    		$id = $_GET["id"];
                                    		include_once "../functions/database.php";
                                    		get_Connection();
                                            $sql    = "select * from activities where activityId =$id";
                                            $result = mysql_query($sql);
                                            $row = mysql_fetch_array($result);
                                            $activityName = $row['activityName'];
                                            $activityAddress = $row['activityAddress'];
                                            $totalParticipantLimit = $row['totalParticipantLimit'];
                                            $describe = $row['describe'];
                                            $activiPeople = $row['activityPeople'];
                                            $activiPeopleTel = $row['activityPeopleTel'];
                                            $activityStartTime = $row['activityStartTime'];
                                            //echo "$activityStartTime";
                                            @$activityStartTimed=strtotime($activityStartTime);
                                            //echo "$activityStartTimed";
                                            @$activityStartTimedate = date("Y-m-d", $activityStartTimed);
                                            //echo "$activityStartTimedate";
                                            @$activityStartTimetime = date("G:i:s", $activityStartTimed);

                                            $activityEndTime = $row['activityEndTime'];
                                            //echo "$activityStartTime";
                                            @$activityEndTimed=strtotime($activityEndTime);
                                            //echo "$activityStartTimed";
                                            @$activityEndTimedate = date("Y-m-d", $activityEndTimed);
                                            //echo "$activityStartTimedate";
                                            @$activityEndTimetime = date("G:i:s", $activityEndTimed);

                                            $deadlinetoRegister = $row['deadlinetoRegister'];
                                            //echo "$activityStartTime";
                                            @$deadlinetoRegisterd=strtotime($deadlinetoRegister);
                                            //echo "$activityStartTimed";
                                            @$deadlinetoRegisterddate = date("Y-m-d", $deadlinetoRegisterd);
                                            //echo "$activityStartTimedate";
                                            @$deadlinetoRegisterdtime = date("G:i:s", $deadlinetoRegisterd);

                                            $totalLimit = $row['totalParticipantLimit'];

                                            $sql = "select * from images where activityId =$id";
                                            $result = mysql_query($sql);
                                            $row = mysql_fetch_array($result);
                                            $img = "../".$row['imageUrl'];

                                            $sql = "select * from codePic where activityId =$id";
                                            $result = mysql_query($sql);
                                            $row = mysql_fetch_array($result);
                                            $codeUrl = "../".$row['codeUrl'];

                                    	}




                                    	?>








                                        <input type="hidden" name="id" value="<?php echo $id;?>" />



                                        <!-- 活动名称 BEGIN-->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <i class="icon-asterisk red"></i>活动名称 </label>

                                            <div class="col-sm-9">
                                                <input type="text" name="name" id="name" placeholder="请输入活动名称" class="col-xs-12 col-sm-5" value = "<?php echo $activityName;?>"/>
                                            </div>
                                        </div>
                                        <!-- 活动名称 END-->



                                        <div class="space-4"></div>
                                        <!-- 标题展览大图 BEGIN-->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"  style="margin-top:80px;"> 更改图片(可单选默认图)： </label>

                                            <div class="col-sm-4 col-xs-12"  style="margin-top:80px;">
                                                <input type="file" name="img" id="id-input-file-2"  onchange="loadImage(this)"/>
                                                <input type="hidden" name="postImg" value="noimg" />
                                            </div>
                                            <div  class="col-sm-3 col-xs-12" style="border:double 6px #3399ff;text-align:center;">
                                                        <label>
                                                            <span class="lbl blue"> 原上传图片</span>
                                                            <img src="<?php echo "$img"?>" alt="" style="width:200px;height:100px;">
                                                        </label>
                                            </div>
                                            <div class="col-sm-3 col-sm-offset-3 col-xs-12" style="border:double 3px #e3e3e3;text-align:center;">
                                                    <label>
                                                        <input name="defaultImg" type="radio" class="ace" value="images/g1.png" />
                                                        <span class="lbl blue"> 系统推荐默认背景图1</span>
                                                        <img src="../images/g1.png" alt="" style="width:200px;height:100px;">
                                                    </label>
                                            </div>
                                            <div  class="col-sm-3 col-xs-12" style="border:double 3px #e3e3e3;text-align:center;">
                                                    <label>
                                                        <input name="defaultImg" type="radio" class="ace" value="images/default1.png" />
                                                        <span class="lbl blue"> 系统推荐默认背景图2</span>
                                                        <img src="../images/default1.png" alt="" style="width:200px;height:100px;">
                                                    </label>
                                            </div>
                                            <div  class="col-sm-3 col-xs-12" style="border:double 3px #e3e3e3;text-align:center;">
                                                    <label>
                                                        <input name="defaultImg" type="radio" class="ace" value="images/default2.jpg" />
                                                        <span class="lbl blue"> 系统推荐默认背景图3</span>
                                                        <img src="../images/default2.jpg" alt="" style="width:200px;height:100px;">
                                                    </label>
                                            </div>

                                        </div>
                                        <!-- 标题展览大图 END-->



                                        <div class="space-4"></div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"  style="margin-top:180px;"> 修改临时群二维码 </label>

                                            <div class="col-sm-4 col-xs-12" style="margin-top:180px;">
                                                <input type="file" name="code" id="id-input-file-3"  onchange="loadImage(this)" value="" />
                                                <input type="hidden" name="postCode" value="" />
                                            </div>
                                            <div  class="col-sm-3 col-xs-10 " style="border:double 6px #3399ff;text-align:center;">
                                                <label>
                                                    <span class="lbl blue"> 原二维码图片</span>
                                                    <img src="<?php echo "$codeUrl"?>" alt="" style="width:200px;height:200px;">
                                                </label>
                                            </div>
                                        </div>




                                        <div class="space-4"></div>
                                        <!-- 活动地点 BEGIN-->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <i class="icon-asterisk red"></i>活动地点 </label>

                                            <div class="col-sm-9">
                                                <input type="text" name="address" id="address" placeholder="请输入活动地点" class="col-xs-12 col-sm-5" value = "<?php echo $activityAddress;?>"/>
                                            </div>
                                        </div>
                                        <!-- 活动地点 END-->

                                        <div class="space-4"></div>
                                        <!-- 活动联系人 BEGIN-->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <i class="icon-asterisk red"></i>活动联系人 </label>

                                            <div class="col-sm-9">
                                                <input type="text" name="person" id="person" placeholder="请输入活动联系人" class="col-xs-12 col-sm-5" value = "<?php echo $activiPeople;?>"/>
                                            </div>
                                        </div>
                                        <!-- 活动联系人 END-->


                                        <div class="space-4"></div>
                                        <!-- 活动联系人电话 BEGIN-->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <i class="icon-asterisk red"></i>活动联系人电话 </label>

                                            <div class="col-sm-9">
                                                <input type="tel" name="tel" id="tel" placeholder="请输入活动联系人电话"  pattern="^1[3458]{1}[0-9]{9}$" class="col-xs-12 col-sm-5" value = "<?php echo $activiPeopleTel;?>"/>
                                            </div>
                                        </div>
                                        <!-- 活动联系人电话 END-->

                


                                        <div class="space-4"></div>
                                        <!-- 活动时间 BEGIN-->
                                        <div class="form-group">
                                            <label for="dtp_input1" class="col-sm-3 control-label no-padding-right"><i class="icon-asterisk red"></i>活动初始时间 </label>
                                            <!-- 日期选择器 -->
                                            <div class="input-group col-md-2 col-xs-12">
                                                <input class="form-control date-picker" id="id-date-picker-1" type="text" name="timeBegin" data-date-format="yyyy-mm-dd" placeholder="请选择初始日期" value="<?php echo $activityStartTimedate ;?>"/>
                                                <span class="input-group-addon">
                                                    <i class="icon-calendar bigger-110"></i>
                                                </span>
                                            </div>
                                            <!-- 时间选择器 -->
                                            <div class="input-group col-md-2 col-xs-12 bootstrap-timepicker">
                                                <input id="timepicker1" type="text" class="form-control" name="timeBegin2" placeholder="请选择初始时间" value="<?php echo $activityStartTimetime ;?>"/>
                                                <span class="input-group-addon">
                                                    <i class="icon-time bigger-110"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="space-4"></div>
                                        <div class="form-group">
                                            <!-- 日期选择器 -->
                                            <label for="dtp_input1" class="col-sm-3 control-label no-padding-right"><i class="icon-asterisk red"></i>活动结束时间 </label>
                                            <div class="input-group col-md-2 col-xs-12">
                                                <input class="form-control date-picker" id="id-date-picker-2" type="text" name="timeEnd" data-date-format="yyyy-mm-dd" placeholder="请选择结束日期" value="<?php echo $activityEndTimedate ;?>"/>
                                                <span class="input-group-addon">
                                                    <i<i class="icon-calendar bigger-110"></i>
                                                </span>
                                            </div>
                                            <!-- 时间选择器 -->
                                            <div class="input-group col-md-2 col-xs-12 bootstrap-timepicker">
                                                <input id="timepicker2" type="text" class="form-control" name="timeEnd2" placeholder="请选择初始时间" value="<?php echo $activityEndTimetime ;?>"/>
                                                <span class="input-group-addon">
                                                    <i class="icon-time bigger-110"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- 活动时间 END-->



                                        <div class="space-4"></div>
                                        <!-- 报名截止时间 BEGIN-->
                                        <div class="form-group">
                                            <label for="dtp_input1" class="col-sm-3 control-label no-padding-right"><i class="icon-asterisk red"></i>报名截止时间 </label>
                                            <!-- 日期选择器 -->
                                            <div class="input-group col-md-2 col-xs-12">
                                                <input class="form-control date-picker" id="id-date-picker-3" type="text" name="signTime" data-date-format="yyyy-mm-dd" placeholder="请选择报名截止时间" value="<?php echo $deadlinetoRegisterddate ;?>"/>
                                                <span class="input-group-addon">
                                                    <i class="icon-calendar bigger-110"></i>
                                                </span>
                                            </div>
                                            <!-- 时间选择器 -->
                                            <div class="input-group col-md-2 bootstrap-timepicker col-xs-12">
                                                <input id="timepicker3" type="text" class="form-control" name="signTime2" placeholder="请选择初始时间" value="<?php echo $deadlinetoRegisterdtime ;?>"/>
                                                <span class="input-group-addon">
                                                    <i class="icon-time bigger-110"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <!-- 报名截止时间 END-->



                                        <div class="space-4"></div>
                                        <div class="form-group">
                                            <!-- 活动简介 -->
                                            <label for="dtp_input1" class="col-sm-3 control-label no-padding-right"><i class="icon-asterisk red"></i>活动简介 </label>
                                            <div class="col-sm-9"> 
                                                  <textarea class="form-control" rows="20" name="text" id="text"><?php echo $describe;?></textarea>
                                                  <script type="text/javascript">CKEDITOR.replace('text');</script>
                                            </div>
                                        </div>
                        
                                        <div class="space-4"></div>
                                        <!-- 报名上限 BEGIN-->
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">报名上限 </label>

                                            <div class="col-sm-1">
                                                <input type="number" name="number" id="number" placeholder="默认无限" class="col-xs-12 col-sm-12" size="4" min="1" max="9999" value="<?php echo $totalLimit ;?>" />
                                            </div>
                                        </div>
                                        <!-- 报名上限 END-->



                                        <!-- 按钮区块 BEGIN-->
                                        <div class="clearfix form-actions">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button class="btn btn-info" type="button"  data-toggle="modal" data-target="#myModal">
                                                    <i class="icon-ok bigger-110"></i>
                                                    直接发布
                                                </button>
                                                <!-- 关于保存我也不清楚怎么实现好、。。 -->
                                                <!-- 那就保存save是 1，发布是0 -->
                                                <button class="btn btn-success" type="submit" name="save" value="1">
                                                    <i class=" icon-inbox bigger-110"></i>
                                                    保存
                                                </button>


                                                &nbsp; &nbsp; &nbsp;
                                                <button class="btn" type="reset">
                                                    <i class="icon-undo bigger-110"></i>
                                                    重置
                                                </button>
                                            </div>
                                        </div>
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">确认发布活动框</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    是否确定发布该活动？
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">再检查检查</button>
                                                    <button type="submit" class="btn btn-primary"  name="submit">确认发布</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div><!-- Modal -->
                                        <!-- 按钮区块 END-->
                                    </form>
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div><!-- /.main-content -->
            </div><!-- /.main-container-inner -->

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="icon-double-angle-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <!-- basic scripts -->



        <!--[if !IE]> -->

        <script type="text/javascript">
            window.jQuery || document.write("<script src='assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

        <script type="text/javascript">
            if("ontouchend" in document) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/typeahead-bs2.min.js"></script>

        <!-- page specific plugin scripts -->
            <script src="assets/js/jquery-ui-1.10.3.custom.min.js"></script>
            <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
            <script src="assets/js/chosen.jquery.min.js"></script>
            <!-- 图片input BEGIN-->
            <script src="assets/js/jquery.autosize.min.js"></script>
            <script src="assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
            <script src="assets/js/jquery.maskedinput.min.js"></script>
            <!-- 图片input END-->
            <!-- date picker begin -->
            <script src="assets/js/date-time/bootstrap-datepicker.min.js"></script>
            <script src="assets/js/date-time/bootstrap-timepicker.min.js"></script>
            <script src="assets/js/date-time/moment.min.js"></script>
            <script src="assets/js/date-time/daterangepicker.min.js"></script>
            <!-- date picker end -->
        <script src="assets/js/markdown/markdown.min.js"></script>
        <script src="assets/js/markdown/bootstrap-markdown.min.js"></script>
        <script src="assets/js/jquery.hotkeys.min.js"></script>
        <script src="assets/js/bootstrap-wysiwyg.min.js"></script>
        <script src="assets/js/bootbox.min.js"></script>

                <!-- ace scripts -->

        <script src="assets/js/ace-elements.min.js"></script>
        <script src="assets/js/ace.min.js"></script>

            <script type="text/javascript">
            jQuery(function($) {    
                $('[data-rel=tooltip]').tooltip({container:'body'});
                $('[data-rel=popover]').popover({container:'body'});
                
                $('textarea[class*=autosize]').autosize({append: "\n"});
                $('textarea.limited').inputlimiter({
                    remText: '%n character%s remaining...',
                    limitText: 'max allowed : %n.'
                });
            
                $.mask.definitions['~']='[+-]';
                $('.input-mask-date').mask('99/99/9999');
                $('.input-mask-phone').mask('(999) 999-9999');
                $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
                $(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
                $( "#eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
                    // read initial values from markup and remove that
                    var value = parseInt( $( this ).text(), 10 );
                    $( this ).empty().slider({
                        value: value,
                        range: "min",
                        animate: true
                        
                    });
                });
                $('.date-picker').datepicker({autoclose:true}).next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });
                $('input[name=date-range-picker]').daterangepicker().prev().on(ace.click_event, function(){
                    $(this).next().focus();
                });
                
                $('#timepicker1').timepicker({
                    minuteStep: 1,
                    showSeconds: false,
                    showMeridian: false
                }).next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });
                $('#timepicker2').timepicker({
                    minuteStep: 2,
                    showSeconds: false,
                    showMeridian: false
                }).next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });
                $('#timepicker3').timepicker({
                    minuteStep: 2,
                    showSeconds: false,
                    showMeridian: false
                }).next().on(ace.click_event, function(){
                    $(this).prev().focus();
                });
                $('#id-input-file-1 , #id-input-file-2, #id-input-file-3').ace_file_input({
                    no_file:'No File ...',
                    btn_choose:'Choose',
                    btn_change:'Change',
                    droppable:false,
                    onchange:null,
                    thumbnail:false, //| true | large
                    whitelist:'gif|png|jpg|jpeg'
                    //blacklist:'exe|php'
                    //onchange:''
                    //
                });

    function showErrorAlert (reason, detail) {
        var msg='';
        if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
        else {
            console.log("error uploading file", reason, detail);
        }
        $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
         '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
    }

    //$('#editor1').ace_wysiwyg();//this will create the default editor will all buttons

    //but we want to change a few buttons colors for the third style
    $('#editor1').ace_wysiwyg({
        toolbar:
        [
            'font',
            null,
            'fontSize',
            null,
            {name:'bold', className:'btn-info'},
            {name:'italic', className:'btn-info'},
            {name:'strikethrough', className:'btn-info'},
            {name:'underline', className:'btn-info'},
            null,
            {name:'insertunorderedlist', className:'btn-success'},
            {name:'insertorderedlist', className:'btn-success'},
            {name:'outdent', className:'btn-purple'},
            {name:'indent', className:'btn-purple'},
            null,
            {name:'justifyleft', className:'btn-primary'},
            {name:'justifycenter', className:'btn-primary'},
            {name:'justifyright', className:'btn-primary'},
            {name:'justifyfull', className:'btn-inverse'},
            null,
            {name:'createLink', className:'btn-pink'},
            {name:'unlink', className:'btn-pink'},
            null,
            {name:'insertImage', className:'btn-success'},
            null,
            'foreColor',
            null,
            {name:'undo', className:'btn-grey'},
            {name:'redo', className:'btn-grey'}
        ],
        'wysiwyg': {
            fileUploadError: showErrorAlert
        }
    }).prev().addClass('wysiwyg-style2');


    $('[data-toggle="buttons"] .btn').on('click', function(e){
        var target = $(this).find('input[type=radio]');
        var which = parseInt(target.val());
        var toolbar = $('#editor1').prev().get(0);
        if(which == 1 || which == 2 || which == 3) {
            toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g , '');
            if(which == 1) $(toolbar).addClass('wysiwyg-style1');
            else if(which == 2) $(toolbar).addClass('wysiwyg-style2');
        }
    });


    

    //Add Image Resize Functionality to Chrome and Safari
    //webkit browsers don't have image resize functionality when content is editable
    //so let's add something using jQuery UI resizable
    //another option would be opening a dialog for user to enter dimensions.
    if ( typeof jQuery.ui !== 'undefined' && /applewebkit/.test(navigator.userAgent.toLowerCase()) ) {
        
        var lastResizableImg = null;
        function destroyResizable() {
            if(lastResizableImg == null) return;
            lastResizableImg.resizable( "destroy" );
            lastResizableImg.removeData('resizable');
            lastResizableImg = null;
        }

        var enableImageResize = function() {
            $('.wysiwyg-editor')
            .on('mousedown', function(e) {
                var target = $(e.target);
                if( e.target instanceof HTMLImageElement ) {
                    if( !target.data('resizable') ) {
                        target.resizable({
                            aspectRatio: e.target.width / e.target.height,
                        });
                        target.data('resizable', true);
                        
                        if( lastResizableImg != null ) {//disable previous resizable image
                            lastResizableImg.resizable( "destroy" );
                            lastResizableImg.removeData('resizable');
                        }
                        lastResizableImg = target;
                    }
                }
            })
            .on('click', function(e) {
                if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
                    destroyResizable();
                }
            })
            .on('keydown', function() {
                destroyResizable();
            });
        }
        
        enableImageResize();
    }
            });
        </script>

        <!-- inline scripts related to this page -->
        <!-- public data begin -->
        <script type="text/javascript">
            $("#thirdLink").addClass("hide");
            // 二路径  路径
            var secondLink = document.getElementById("secondLink");  
            secondLink.innerText = "修改活动";     

            // 关于图
            function loadImage(img) {
            var filePath = img.value;

            var fileExt = filePath.substring(filePath.lastIndexOf("."))
                .toLowerCase();
 
            if (!checkFileExt(fileExt)) {
                alert("您上传的文件不是图片,请重新上传！");
                img.value = "";
                return;
            }


            console.log(filePath);

            console.log(img);

            console.log(fileExt);

            if (img.files && img.files[0]) {
//              
            } else {
                img.select();
                var url = document.selection.createRange().text;
                try {
                    var fso = new ActiveXObject("Scripting.FileSystemObject");
                } catch (e) {
                    alert('如果你用的是ie8以下 请将安全级别调低！');
                }
            }
        } 
        function checkFileExt(ext) {
            if (!ext.match(/.jpg|.gif|.png|.bmp/i)) {
                return false;
            }
            return true;
        }  

        var c = document.getElementById("editor1");
        var d = document.getElementsByName("text");
        d.value = c.innerHTML;
        </script>
        <!-- public data end -->
</body>
</html>
