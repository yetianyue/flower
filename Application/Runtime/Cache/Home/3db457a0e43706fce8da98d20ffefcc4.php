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
            <!-- BEGIN BASIC PORTLET-->
            <div class="widget blue">
                <div class="widget-title">
                    <h4><i class="icon-reorder"></i> 用户列表</h4>
                <span class="tools">
                    <a href="<?php echo U('order/add');?>">添加订单</a>
                    <a href="javascript:;" class="icon-chevron-down"></a>                   
                </span>
                </div>
                <div class="widget-body">
                    <form action="<?php echo U('order/cancel');?>" class="form-vertical" method="get">
                        <div class="row-fluid">
                           <div class="span2">
                                <div class="control-group">
                                    <label class="control-label">下单日期</label>
                                    <div class="controls controls-row">
                                    <input type="text" class="input-block-level" placeholder="依据日期区间搜索" id="dateCtime" name="ctime" value="<?php if(!empty($getParam['ctime'])){ echo $getParam['ctime'];}?>">
                                    </div>
                                </div>
                            </div>
                            <div class="span2">
                                <div class="control-group">
                                    <label class="control-label">订单编号</label>
                                    <div class="controls controls-row">
                                        <input type="text" class="input-block-level" placeholder="依据订单编号搜索" name="oid" value="<?php if(!empty($getParam['oid'])){ echo $getParam['oid'];}?>">
                                    </div>
                                </div>
                            </div>
                            <div class="span2">
                                <div class="control-group">
                                    <label class="control-label">订单来源</label>
                                    <div class="controls controls-row">
                                        <select class="input-block-level" tabindex="1" name="sid">
                                            <option value="0" <?php if($getParam['sid'] == 0){ echo 'selected="selected"';}?> >请选择</option>
                                            <?php if(is_array($slists)): foreach($slists as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if($getParam['sid'] == $vo['id']){ echo 'selected="selected"';}?>><?php echo ($vo["sname"]); ?></option><?php endforeach; endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span2">
                                <div class="control-group">
                                    <label class="control-label">业务员</label>
                                    <div class="controls controls-row">
                                        <select class="input-block-level" tabindex="1" name="author">
                                            <option value="0" <?php if($getParam['author'] == 0){ echo 'selected="selected"';}?>>请选择</option>
                                            <?php if(is_array($mlists)): foreach($mlists as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if($getParam['author'] == $vo['id']){ echo 'selected="selected"';}?> ><?php echo ($vo["tname"]); ?></option><?php endforeach; endif; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span2">
                                <div class="control-group">
                                    <label class="control-label">姓名</label>
                                    <div class="controls controls-row">
                                        <input type="text" class="input-block-level" placeholder="依据买/收姓名搜索" name="name" value="<?php if(!empty($getParam['name'])){ echo $getParam['name'];}?>">
                                    </div>
                                </div>
                            </div>
                            <div class="span2">
                                <div class="control-group">
                                    <label class="control-label">联系电话</label>
                                    <div class="controls controls-row">
                                        <input type="text" class="input-block-level" placeholder="依据买/收联系电话搜索" name="phone" value="<?php if(!empty($getParam['phone'])){ echo $getParam['phone'];}?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <center><button type="submit" class="btn blue"><i class="icon-ok"></i> 搜索</button></center>
                        </div>
                    </form>
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <tr>
                            <th> 订单编号</th>
                            <th> 订单来源</th>
                            <th> 会员号</th>
                            <th> 姓名/电话</th>
                            <th> 地址</th>
                            <th> 下单时间</th>
                            <th> 业务员</th>
                            <th> 状态</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                            <td><?php echo ($vo["oid"]); ?></td>
                            <td><?php echo ($vo["sname"]); ?></td>
                            <td><?php echo ($vo["mid"]); ?></td>
                            <td><?php echo ($vo["receiver"]); ?>/<?php echo ($vo["rnumber"]); ?></td>
                            <td><?php echo ($vo["raddress"]); ?></td>
                            <td><?php echo (date("Y-m-d H:i:s",$vo["ctime"])); ?></td>
                            <td><?php echo ($vo["tname"]); ?></td>
                            <td>
                            	<?php switch($vo["status"]): case "1": ?><button class="btn btn-small btn-inverse" title="作废">作废</button><?php break;?>
									<?php default: ?>未知状态<?php endswitch;?>
							</td>
                        </tr><?php endforeach; endif; ?>
                        </tbody>
                    </table>
                    <center><?php echo ($page); ?></center>
                </div>
            </div>
            <!-- END BASIC PORTLET-->
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
   
   <!--   END MYSCRIPT  -->
</body>
<!-- END BODY -->
</html>