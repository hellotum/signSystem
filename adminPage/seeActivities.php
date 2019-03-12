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

        <!-- fonts -->

        <!-- ace styles -->

        <link rel="stylesheet" href="assets/css/ace.min.css" />
        <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />

        <!--[if lte IE 8]>
          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->

        <script src="assets/js/ace-extra.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <!-- 删除该活动Modal begin-->
            <div class="modal fade" id="selected_modal" tabindex="-1" role="dialog" aria-labelledby="delete">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="delete">删除该活动</h4>
                  </div>
                  <div class="modal-body">
                   是否删除<b class="red">xxxx</b>这个未发布的活动？
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消删除</button>
                    <a type="button" class="btn btn-primary" id="selected_modal_delBtn" href="">确认删除该活动</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- 删除该活动Modal end-->
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
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3 class="header smaller lighter blue">查看活动</h3>
<!--                                         <div class="table-header">
                                            Results for "NewsHeadline"
                                        </div> -->

                                        <div class="table-responsive">
                                            <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="center hide">
                                                            <label>
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </th>
                                                        <th>ID</th>
                                                        <th>活动名称</th>
                                                        <th>活动人数</th>
                                                        <th>活动联系人及其电话</th>
                                                        <th>活动时间</th>
                                                        <th>报名截止时间</th>
                                                        <th>操作</th>
                                                    </tr>
                                                </thead>





                                                <tbody>
                                                    <?php
                                                    include_once "../functions/database.php";

                                                    $sql       = "select * from activities";
                                                        get_Connection();
                                                        $result = mysql_query($sql);
                                                            while($row = mysql_fetch_array($result))
                                                      {
                                                        
                                                            $id = $row['activityId'];
                                                            $sql2 = "select count(*)as number from participants where registerformId IN(select registerformId from registerForm where acticitieId =$id)";
                                                            $result2 = mysql_query($sql2);
                                                            $row2 =  mysql_fetch_array($result2);
                                                            //print_r($row2);
                                                            $number = $row2['number'];
                                                      
                                                                    $id = $row['activityId']; 
                                                                    $h = "activityList.php?id= $id ";
                                                                    $d = "../addtodatabase/delectActivict.php?id= $id ";
                                                                    $link = "/localhost/signSystem/sign.php?id=$id";
                                                                    $download = "../addtodatabase/downExcel.php?id= $id";
                                                                    $change = "changeActivity.php?id= $id ";
                                                                    
                                                      ?>





                                                    <!-- 表格一行 BEGIN-->
                                                    <tr>
                                                        <td class="center hide">
                                                            <label>
                                                                <input type="checkbox" class="ace" />
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </td>
                                                        
                                                        <!-- ID -->
                                                        <td><?php echo $row['activityId']; ?></td>
                                                        <!-- 活动名称 -->
                                                        
                                                        <td><?php echo $row['activityName']; ?></td>
                                                        <!-- 活动人数 -->
                                                        <td>
                                                            <span class="red"><?php echo $number; ?></span>
                                                            <b>/</b>
                                                            <i class="blue"><?php echo $row['totalParticipantLimit'] ?></i>
                                                        </td>
                                                        <!-- 活动人数 -->
                                                        <td>
                                                            <span><?php echo $row['activityPeople'];?></span>
                                                            <b>/</b>
                                                            <i class="blue"><?php echo $row['activityPeopleTel'];?></i>
                                                        </td>
                                                        <!-- 活动时间 -->
                                                        <td>
                                                            <!-- PC下  -->
                                                            <div   class="visible-md visible-lg hidden-sm hidden-xs"><?php echo $row['activityStartTime'] ?><b>——</b><?php echo $row['activityEndTime'] ?></div>
                                                            <!-- 移动下 -->
                                                            <div  class="visible-xs visible-sm hidden-md hidden-lg"><?php echo $row['activityStartTime'] ?><br>|<br><?php echo $row['activityEndTime'] ?></div>
                                                        </td>
                                                        
                                                        <!-- 报名截止时间 -->
                                                        <td><?php echo $row['deadlinetoRegister'] ?></td>
                                                        <!-- 操作 -->
                                                        <td>
                                                            <!-- PC端下 -->
                                                            <div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">

                                                                <a class="btn btn-primary" href="<?php echo $h;?>" title="查看报名人员">
                                                                    <i class="icon-eye-open bigger-130"></i>
                                                                </a>
                                                                <a class="btn btn-success" href="<?php echo $change;?>" title="修改活动信息">
                                                                    <i class="icon-edit bigger-130"></i>
                                                                </a>
                                                                <a class="btn btn-info" href="<?php echo $download;?>" title="下载该活动的报名名单">
                                                                    <i class="icon-download-alt bigger-130"></i>
                                                                </a>

                                                                <button type="button" class="btn btn-danger delBtn"  data-toggle="modal" data-target="#selected_modal" title="删除该活动"  clickurl="<?php echo $d;?>" clickname="<?php echo $row['activityName']; ?>">
                                                                    <i class="icon-trash bigger-130"></i>
                                                                </button>

                                                            </div>

                                                            <!-- 移动端下 -->
                                                            <div class="visible-xs visible-sm hidden-md hidden-lg">
                                                                <div class="inline position-relative">
                                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                                        <i class="icon-caret-down icon-only bigger-120"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="<?php echo $h;?>" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue"  title="查看报名人员">
                                                                                    <i class="icon-eye-open bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="<?php echo $change;?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green" title="修改活动信息">
                                                                                    <i class="icon-edit bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="<?php echo $download;?>" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="info" title="下载该活动的报名名单">
                                                                                    <i class="icon-download-alt bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a  onclick="return funD()" href="<?php echo $d;?>" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red" title="删除该活动">
                                                                                    <i class="icon-trash bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- 表格一行 END-->

                                                <?php
                                                 }
                                                 ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

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
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/jquery.dataTables.bootstrap.js"></script>
        <!-- ace scripts -->

        <script src="assets/js/ace-elements.min.js"></script>
        <script src="assets/js/ace.min.js"></script>

        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function($) {
                var oTable1 = $('#sample-table-2').dataTable( {
                "aoColumns": [
                  { "bSortable": false },
                  null, null,null, null, null,null,
                  { "bSortable": false }
                ] } );
                
                
                $('table th input:checkbox').on('click' , function(){
                    var that = this;
                    $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });
                        
                });
            
            
                $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
                function tooltip_placement(context, source) {
                    var $source = $(source);
                    var $parent = $source.closest('table')
                    var off1 = $parent.offset();
                    var w1 = $parent.width();
            
                    var off2 = $source.offset();
                    var w2 = $source.width();
            
                    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                    return 'left';
                }

                
                $(document).on('click','.delBtn',function(){
                    $("#selected_modal .modal-body b").html($(this).attr("clickname").trim());
                    $("#selected_modal_delBtn").attr("href",$(this).attr("clickurl").trim());

                    $("#selected_modal").modal("show");
                }); 
            })
        </script>

<!-- 公共部分数据 -->
<script type="text/javascript">
    $("#seeSign").addClass("active open");
    $("#seeSignUp").addClass("active");
    $("#firstLink").addClass("hidden");
    $("#secondLink").attr("href","seeActivities.php"); 
    // 二路径  
    var secondLink = document.getElementById("secondLink");  
    secondLink.innerText = "查看报名";  
    // 三路径  
    var thirdLink = document.getElementById("thirdLink");  
    thirdLink.innerText = "查看活动及其名单";    

        function funD(){
    if(confirm("确定删除？"))
    {
        return true;
    }else{
        return false;
   }
}   
</script>
</body>
</html>
