<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
   <meta charset="utf-8" />
   <title><?php echo ($cname); ?>_同城鲜花速递</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <link href="/flower/Public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="/flower/Public/assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="/flower/Public/assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" />
   <!-- <link href="/flower/Public/assets/font-awesome/css/font-awesome.css" rel="stylesheet" /> -->
   <link href="/flower/Public/css/style.css" rel="stylesheet" />
   <link href="/flower/Public/css/style-responsive.css" rel="stylesheet" />
   <link href="/flower/Public/css/style-default.css" rel="stylesheet" id="style_color" />  
   
	<link rel="stylesheet" href="/flower/Public/datetimer/bootstrap-datetimepicker.css">

</head>
<!-- BEGIN BODY -->
<body class="fixed-top">
    
   <!-- BEGIN HEADER -->
   <div id="header" class="navbar navbar-inverse navbar-fixed-top">
       <!-- BEGIN TOP NAVIGATION BAR -->
       <div class="navbar-inner">
           <div class="container-fluid">
               <!--BEGIN SIDEBAR TOGGLE-->
               <div class="sidebar-toggle-box hidden-phone">
                   <div class="icon-reorder tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
               </div>
               <!--END SIDEBAR TOGGLE-->
               <!-- BEGIN LOGO -->
               <a class="brand" href="/flower">
                   <img src="/flower/Public/img/logo.png" alt="Metro Lab" />
               </a>
               <!-- END LOGO -->
               <!-- BEGIN RESPONSIVE MENU TOGGLER -->
               <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="arrow"></span>
               </a>
               <!-- END RESPONSIVE MENU TOGGLER -->
               <div class="top-nav ">
                   <ul class="nav pull-right top-menu" >
                       <!-- BEGIN USER LOGIN DROPDOWN -->
                       <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <img src="/flower/Public/img/avatar1_small.jpg" alt="">
                               <span class="username"><?php echo ($userinfo["tname"]); ?></span>
                               <b class="caret"></b>
                           </a>
                           <ul class="dropdown-menu extended logout">
                               <li><a href="<?php echo U('base/logout');?>"><i class="icon-key"></i>退出</a></li>
                           </ul>
                       </li>
                       <!-- END USER LOGIN DROPDOWN -->
                   </ul>
                   <!-- END TOP NAVIGATION MENU -->
               </div>
           </div>
       </div>
       <!-- END TOP NAVIGATION BAR -->
   </div>
   <!-- END HEADER -->
    <!-- BEGIN CONTAINER -->
   <div id="container" class="row-fluid">
      <!-- BEGIN SIDEBAR -->
      <div class="sidebar-scroll">
        <div id="sidebar" class="nav-collapse collapse">

         <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
         <div class="navbar-inverse">
            <form class="navbar-search visible-phone">
               <input type="text" class="search-query" placeholder="Search" />
            </form>
         </div>
         <!-- END RESPONSIVE QUICK SEARCH FORM -->
         <!-- BEGIN SIDEBAR MENU -->
          <ul class="sidebar-menu">
             <li class="<?php if(strtolower($requestInfo['c'])=='memeber' || strtolower($requestInfo['c'])=='source' || strtolower($requestInfo['c'])=='money'){ echo 'sub-menu active';}else{ echo 'sub-menu';}?>">
                  <a href="javascript:;" class="">
                      <i class="icon-dashboard"></i>
                      <span>系统管理</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <?php if($userinfo["roleid"] == 1): ?><li <?php if(strtolower($requestInfo['c'])=='source'){ echo 'class = "active"';}?> ><a class="" href="<?php echo U('source/lists');?>">基础信息</a></li>
                      <li <?php if(strtolower($requestInfo['c'])=='memeber'&&in_array(strtolower($requestInfo['a']),array('lists','add','edit','del'))){ echo 'class = "active"';}?>><a class="" href="<?php echo U('memeber/lists');?>">用户管理</a></li>
                      <li <?php if(strtolower($requestInfo['c'])=='memeber'&&strtolower($requestInfo['a'])=='role'){ echo 'class = "active"';}?>><a class="" href="<?php echo U('memeber/role');?>">权限管理</a></li>
                      <li <?php if(strtolower($requestInfo['c'])=='money'&&strtolower($requestInfo['a'])=='account'){ echo 'class = "active"';}?>><a class="" href="<?php echo U('money/account');?>">结算</a></li><?php endif; ?>
                      <li <?php if(strtolower($requestInfo['c'])=='money'&&strtolower($requestInfo['a'])=='lists'){ echo 'class = "active"';}?> ><a class="" href="<?php echo U('money/lists');?>">流水</a></li>
                  </ul>
              </li>
              <li class="<?php if(strtolower($requestInfo['c'])=='order'){ echo 'sub-menu active';}else{ echo 'sub-menu';}?>">
                  <a href="javascript:;" class="">
                      <i class="icon-tasks"></i>
                      <span>订单管理</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li <?php if(strtolower($requestInfo['c'])=='order'&&strtolower($requestInfo['a'])=='add'){ echo 'class = "active"';}?>><a class="" href="<?php echo U('order/add');?>">添加订单</a></li>
                      <li <?php if(strtolower($requestInfo['c'])=='order'&&strtolower($requestInfo['a'])=='lists'){ echo 'class = "active"';}?>><a class="" href="<?php echo U('order/lists');?>">订单列表</a></li>
                      <li <?php if(strtolower($requestInfo['c'])=='order'&&strtolower($requestInfo['a'])=='cancel'){ echo 'class = "active"';}?>><a class="" href="<?php echo U('order/cancel');?>">作废订单</a></li>
                      <li <?php if(strtolower($requestInfo['c'])=='order'&&strtolower($requestInfo['a'])=='templists'){ echo 'class = "active"';}?>><a class="" href="<?php echo U('order/templists');?>">临时订单</a></li>
                  </ul>
              </li>
              <li class="<?php if(strtolower($requestInfo['c'])=='jorder' || strtolower($requestInfo['c'])=='cash' ){ echo 'sub-menu active';}else{ echo 'sub-menu';}?>">
                  <a href="javascript:;" class="">
                      <i class="icon-bar-chart"></i>
                      <span>交接管理</span>
                      <span class="arrow"></span>
                  </a>
                  <ul class="sub">
                      <li <?php if(strtolower($requestInfo['c'])=='jorder'){ echo 'class = "active"';}?>><a class="" href="<?php echo U('jorder/lists');?>">交接单</a></li>
                      <li <?php if(strtolower($requestInfo['c'])=='cash'){ echo 'class = "active"';}?>><a class="" href="<?php echo U('cash/lists');?>">返现</a></li>
                  </ul>
              </li>
              <li class="<?php if(strtolower($requestInfo['c'])=='logout'){ echo 'sub-menu active';}else{ echo 'sub-menu';}?>">
                  <a class="" href="<?php echo U('base/logout');?>">
                    <i class="icon-user"></i>
                    <span>退出</span>
                  </a>
              </li>
          </ul>
         <!-- END SIDEBAR MENU -->
      </div>
      </div>
      <!-- END SIDEBAR -->

      <!-- BEGIN PAGE -->  
      <div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                  <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                   <h3 class="page-title">
                     <?php echo ($cname); ?>
                   </h3>
                   <ul class="breadcrumb">
                       <li>
                           <a href="<?php echo U('order/lists');?>">首页</a>
                           <span class="divider">/</span>
                       </li>                      
                       <li class="active"><?php echo ($cname); ?></li>
                   </ul>
                   <!-- END PAGE TITLE & BREADCRUMB-->
               </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            
  <div class="row-fluid">
    <div class="span12">
        <!-- BEGIN SAMPLE FORMPORTLET-->
        <div class="widget blue">
            <div class="widget-title">
                <h4>
                    <i class="icon-reorder"></i> 添加订单
                </h4>
                <span class="tools">
                <a href="javascript:;" class="icon-chevron-down"></a>
                </span>
            </div>
            <div class="widget-body">
                <!-- BEGIN FORM-->
                <form class="form-vertical" method="post" action="<?php echo U('order/add');?>">
                    <div class="row-fluid">
                    	<div class="span2">
                    		<div class="control-group">
                                <label class="control-label">订单来源</label>
                                <div class="controls controls-row">
                                     <select class="input-block-level" tabindex="1" name="sid">
                                     	<option value="0">请选择</option>
                                     	<?php if(is_array($slists)): foreach($slists as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["sname"]); ?></option><?php endforeach; endif; ?>
		                            </select>
                                </div>
                            </div>
                    	</div>
                    	<div class="span5">
                    		<div class="control-group">
                                <label class="control-label">订单编号</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="请输入订单编号" name="oid">
                                </div>
                            </div>
                    	</div>
                    	<div class="span5">
                    		<div class="control-group">
                                <label class="control-label">会员号</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="请输入会员号" name="mid">
                                </div>
                            </div>
                    	</div>
                    </div>
                    <div class="row-fluid">
                    	<div class="span3">
                    		<div class="control-group">
                                <label class="control-label">买花人姓名</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="请输入买花人姓名" name="buyer">
                                </div>
                            </div>
                    	</div>
                    	<div class="span3">
                    		<div class="control-group">
                                <label class="control-label">买花人联系电话</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="请输入买花人联系电话" name="bnumber">
                                </div>
                            </div>
                    	</div>
                    	<div class="span3">
                    		<div class="control-group">
                                <label class="control-label">收货人姓名</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="请输入收货人姓名" name="receiver">
                                </div>
                            </div>
                    	</div>
                    	<div class="span3">
                    		<div class="control-group">
                                <label class="control-label">收货人联系电话</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="请输入收货人联系电话" name="rnumber">
                                </div>
                            </div>
                    	</div>
                    </div>
                    <div class="row-fluid">
                    	<div class="span9">
                    		<div class="control-group">
                                <label class="control-label">收货人地址</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="请输入收货人地址" name="raddress">
                                </div>
                            </div>
                    	</div>
                    	<div class="span3">
                    		<div class="control-group">
                                <label class="control-label">送花日期</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level"  name="stime" id="datetimepicker">
                                </div>
                            </div>
                    	</div>
                    </div>
                    <div class="row-fluid">
                    	<div class="span9">
                    		<div class="control-group">
                                <label class="control-label">产品列表</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="请输入产品列表" name="producelist">
                                </div>
                            </div>
                    	</div>
                    	<div class="span2">
                    		<div class="control-group">
                                    <label class="control-label">订单状态</label>
                                    <div class="controls">
                                    	<select class="input-block-level" tabindex="1" name="status">
                                    		<option value="0">请选择</option>
		                                	<option value="4">完成</option>
		                                	<option value="3">预定</option>
		                                	<option value="2">故障</option>
		                                	<option value="1">作废</option>		                           
		                            	</select>
                                    </div>
                                </div>
                    	</div>
                    </div>
                    <div class="row-fluid">
                    	<div class="span2">
                    		<div class="control-group">
                                <label class="control-label">订单总价</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="请输入订单总价，如99.99" name="osprice">
                                </div>
                            </div>
                    	</div>
                    	<div class="span1">
                    		<div class="control-group">
                                <label class="control-label">成本</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="如99.99" name="oscost">
                                </div>
                            </div>
                    	</div>
                        <div class="span1">
                            <div class="control-group">
                                <label class="control-label">运费</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="如99.99" name="freight">
                                </div>
                            </div>
                        </div>
                    	<div class="span2">
                    		<div class="control-group">
                                <label class="control-label">花店QQ</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="请输入花店QQ" name="flowerqq">
                                </div>
                            </div>
                    	</div>
                    	<div class="span2">
                    		<div class="control-group">
                                <label class="control-label">花店名称</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="请输入花店名称" name="fshopname">
                                </div>
                            </div>
                    	</div>
                        <div class="span2">
                            <div class="control-group">
                                <label class="control-label">花店电话</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="请输入花店电话" name="flowerphone">
                                </div>
                            </div>
                        </div>
                    	<div class="span2">
                    		<div class="control-group">
                                <label class="control-label">花集订单</label>
                                <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="请输入花集订单" name="flowerorder">
                                </div>
                            </div>
                    	</div>
                    </div>
                    <div class="row-fluid" >
                    	<div class="span12">
                    		<div class="control-group">
                                <label class="control-label">备注</label>
                                <div class="controls controls-row">                                    
                                    <textarea class="input-block-level" rows="10" name="remarks" style="resize: none;"></textarea>
                                </div>
                            </div>
                    	</div>
                    </div>
                    <div class="form-actions">
                        <center><button type="submit" class="btn blue"><i class="icon-ok"></i> 提交</button></center>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>

            <!-- END PAGE CONTENT-->
         </div>
         <!-- END PAGE CONTAINER-->
      </div>
      <!-- END PAGE -->  
   </div>
   <!-- END CONTAINER -->
       <!-- BEGIN FOOTER -->
   <div id="footer">
       2016 &copy; 同城鲜花速递
   </div>
   <!-- END FOOTER -->

    <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <script src="/flower/Public/js/jquery-1.8.3.min.js"></script>
   <script src="/flower/Public/js/jquery.nicescroll.js" type="text/javascript"></script>
   <script type="text/javascript" src="/flower/Public/assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>
   <script type="text/javascript" src="/flower/Public/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
   <script src="/flower/Public/assets/bootstrap/js/bootstrap.min.js"></script>
   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->
   <script src="/flower/Public/js/jquery.scrollTo.min.js"></script>
   <!--common script for all pages-->
   <script src="/flower/Public/js/common-scripts.js"></script>
   <!--   BEGIN MYSCRIPT  -->
   
	<script type="text/javascript" src="/flower/Public/datetimer/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="/flower/Public/datetimer/bootstrap-datetimepicker.zh-CN.js"></script>
	<script type="text/javascript">
		$('#datetimepicker').datetimepicker({
			startDate:new Date(),
			language: 'zh-CN',
            autoclose: true,
            todayHighlight: true,
		    format: 'yyyy-mm-dd hh:ii',
		});
	</script>

   <!--   END MYSCRIPT  -->
</body>
<!-- END BODY -->
</html>