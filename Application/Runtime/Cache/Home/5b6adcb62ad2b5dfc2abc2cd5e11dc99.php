<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="renderer" content="webkit">

    <title>登录_同城鲜花速递</title>

    <link href="/flower/Public/login/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="/flower/Public/login/font-awesome.css?v=4.3.0" rel="stylesheet">
    <link href="/flower/Public/login/animate.css" rel="stylesheet">
    <link href="/flower/Public/login/style.css?v=2.2.0" rel="stylesheet"> 
    <style type="text/css">
        .block {
          text-align: center;
        }
        .block:before {
          content: '';
          display: inline-block;
          height: 100%;
          vertical-align: middle;
          margin-right: -0.25em; 
        }
        .centered {
          display: inline-block;
          vertical-align: middle;
        }
    </style>
</head>

<body class="gray-bg block">
    <div class="middle-box text-center loginscreen  animated fadeInDown centered">
        <div>
            <div>
                <img class="logo-name" src="/flower/Public/img/flower.jpg"/>
            </div>
            <h3>欢迎使用 同城鲜花速递</h3>
            <form class="m-t" role="form" action="<?php echo U('login/check');?>" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="用户名" name="uname" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码" name="passwd" required="">
                </div>
                <button  class="btn btn-primary block full-width m-b" type="submit">登 录</button>
                <p class="text-muted text-center"> 
                    <a href="<?php echo U('login/register');?>">注册一个新账号</a>
                </p>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/flower/Public/login/jquery-2.1.1.min.js"></script>
    <script src="/flower/Public/login/bootstrap.min.js?v=3.4.0"></script>
</body>

</html>