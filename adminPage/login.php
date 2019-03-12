<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sign_Interface</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/public.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>
<!-- 背景效果滤镜与毛玻璃begin -->
      <div class="bgFilter"></div>
      <div class="bgFrostedGlass"></div>
<!-- 背景效果滤镜与毛玻璃end -->

<!-- 登录模块begin -->
    <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <div class="loginBox center">

              <form  role="form" method="post" action="login_process.php" enctype="multipart/form-data">

              <h1>WELCOME</h1>
              <h5>欢迎登陆松湖生态微信公众号的报名管理系统！</h5>
              <div class="block25"></div>
              <!-- 账号输入 -->
              <div class="form-group relative">
                <input class="form-control borCircle input" type="text" name="no" placeholder="请输入账号">
              </div>
              <!-- 密码输入 -->
              <div class="form-group relative">
                <input class="form-control borCircle input" type="password"  name="password" placeholder="请输入密码">
              </div>
              <!-- 单选身份begin -->
              <label class="radio-inline pull-right">
                <input type="checkbox" name="remenber" id="remenber" value="remenber"> 记住密码
              </label>
              <!-- 单选身份end -->
              <button class="borCircle btnChange" type="submit">登录</button>  

              </form>

            </div>
          </div>
        </div>
    </div> <!-- /container -->
<!-- 登录模块end -->

</body></html>
