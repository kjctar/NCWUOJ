<?php 
  if (!isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
               header("Location:loginpage.php");
             }
    if(isset($_GET['main']))
      {
        include('template/kjctar/main.php');
         exit(0);
      }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Online Judge</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Access-Control-Allow-Origin" content="*">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="icon" href="favicon.ico">
	<link rel="stylesheet" href="template/kjctar/layui/css/layui.css" media="all" />
	<link rel="stylesheet" href="//at.alicdn.com/t/font_tnyc012u2rlwstt9.css" media="all" />
	<link rel="stylesheet" href="template/kjctar/css/main.css" media="all" />
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="https://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript">

$(document).ready(function(){
  $("a").click(function(){
  	
     $("iframe").animate({top:'50px', hidden:true});
      $("iframe").animate({top:'10px', hidden:false});
  });
});
</script>
</head>

<body class="main_body">
	<div class="layui-layout layui-layout-admin" style='background-color:#eeeeee'>
		<!-- 顶部 -->
		<div class="layui-header header">
			<div class="layui-main">
				<a href="#" class="logo">Online Judge</a>
				<!-- 显示/隐藏菜单 -->
				<a href="javascript:;" class="iconfont hideMenu icon-menu1" style='background-color: #303030'></a>
				<!-- 搜索 -->
				<div class="layui-form component">
			        <select name="modules" lay-verify="required" lay-search="">
						<option value="">题目直达</option>
						<option value="1">layer</option>
						<option value="2">form</option>
						<option value="3">layim</option>
						<option value="4">element</option>
						<option value="5">laytpl</option>
						<option value="6">upload</option>
						<option value="7">laydate</option>
						<option value="8">laypage</option>
						<option value="9">flow</option>
						<option value="10">util</option>
						<option value="11">code</option>
						<option value="12">tree</option>
						<option value="13">layedit</option>
						<option value="14">nav</option>
						<option value="15">tab</option>
						<option value="16">table</option>
						<option value="17">select</option>
						<option value="18">checkbox</option>
						<option value="19">switch</option>
						<option value="20">radio</option>
			        </select>
			        <i class="layui-icon">&#xe615;</i>
			    </div>
			    <!-- 天气信息 -->
			    <div class="weather" pc>
			    	<div id="tp-weather-widget"></div>
					<script>(function(T,h,i,n,k,P,a,g,e){g=function(){P=h.createElement(i);a=h.getElementsByTagName(i)[0];P.src=k;P.charset="utf-8";P.async=1;a.parentNode.insertBefore(P,a)};T["ThinkPageWeatherWidgetObject"]=n;T[n]||(T[n]=function(){(T[n].q=T[n].q||[]).push(arguments)});T[n].l=+new Date();if(T.attachEvent){T.attachEvent("onload",g)}else{T.addEventListener("load",g,false)}}(window,document,"script","tpwidget","//widget.seniverse.com/widget/chameleon.js"))</script>
					<script>tpwidget("init", {
					    "flavor": "slim",
					    "location": "WX4FBXXFKE4F",
					    "geolocation": "enabled",
					    "language": "zh-chs",
					    "unit": "c",
					    "theme": "chameleon",
					    "container": "tp-weather-widget",
					    "bubble": "disabled",
					    "alarmType": "badge",
					    "color": "#FFFFFF",
					    "uid": "U9EC08A15F",
					    "hash": "039da28f5581f4bcb5c799fb4cdfb673"
					});
					tpwidget("show");</script>
			    </div>
			    <!-- 顶部右侧菜单 -->
			    <ul class="layui-nav top_menu">
			    	<li class="layui-nav-item showNotice" id="showNotice" >
						<a href="javascript:;"><i class="iconfont icon-gonggao"></i><cite>系统公告</cite></a>
					</li>
			    	
					<li class="layui-nav-item lockcms" pc>
						<a href="javascript:;"><i class="iconfont icon-lock1"></i><cite>锁屏</cite></a>
					</li>
					<li class="layui-nav-item" >
						<a href="javascript:;">
							<img src="images/face.jpg" class="layui-circle" width="35" height="35">
							<?php if (isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
                                $sid=htmlentities($_SESSION[$OJ_NAME.'_'.'user_id'],ENT_QUOTES ,"UTF-8");
								echo "<cite>$sid</cite>";
							}
							else {
								echo"<cite>未登陆</cite>";
							}		
							?>
						</a>
						<?php 
							if(isset($sid))
							{
								echo'
								<dl class="layui-nav-child">
									<dd><a href="userinfo.php?user='.$sid.'" target="main" ><i class="iconfont icon-zhanghu" data-icon="icon-zhanghu"></i><cite>个人资料</cite></a></dd>
									<dd><a href="modifypage.php" target="main"><i class="iconfont icon-shezhi1" data-icon="icon-shezhi1"></i><cite>修改密码</cite></a></dd>
									
									<dd><a href="logout.php"><i class="iconfont icon-loginout"></i><cite>退出</cite></a></dd>
								</dl>';
							}
							else{
								echo'
								<dl class="layui-nav-child">
									<dd><a href="javascript:;" data-url="page/web/loginpage.php"><i class="iconfont icon-zhanghu" data-icon="icon-zhanghu"></i><cite>登陆</cite></a></dd>
									<dd><a href="javascript:;" data-url="page/web/registerpage.php"><i class="iconfont icon-shezhi1" data-icon="icon-shezhi1"></i><cite>注册</cite></a></dd>
								
								</dl>';
							}
						?>
					</li>
				</ul>
			</div>
		</div>
		<!-- 左侧导航 -->
		<div class="layui-side layui-bg-black">
			
			
				<div class="navBar layui-side-scroll">
                 <ul class="layui-nav layui-nav-tree" lay-filter="test">
					<!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
					  <li class="layui-nav-item"><a href="problemset.php" target='main'><i class="layui-icon" > &#xe609; &nbsp; oj题库</i>  </a></li>
					  <li class="layui-nav-item"><a href="contest.php" target='main'><i class="fa fa-free-code-camp" > &nbsp;比赛/作业</i></a></li>
					   <li class="layui-nav-item"><a href="status.php" target='main'><i class="fa fa-refresh fa-spin"> </i>&nbsp;&nbsp;判题队列 </a></li>
					  <li class="layui-nav-item layui-nav-itemed">
					    <a href="javascript:;"><i class="layui-icon" >&#xe613; &nbsp;讨论区</i></a>
					    <dl class="layui-nav-child">
					      <dd><a href="javascript:;" target='main'><i  class="fa fa-file-code-o" >&nbsp;题解报告</a></i></dd>
					      <dd><a href="discuss3/discuss.php" target='main'><i class="layui-icon" >&#xe63a; &nbsp;OJ交流社区</a></i></dd>
					      <dd><a href="javascript:;" target='main'><i class="fa fa-coffee" > &nbsp;意见版块</a></i></dd>
					      
					    </dl>
					  </li>
					  <li class="layui-nav-item">
					    <a href="javascript:;"><i class="fa fa-sitemap" > &nbsp;系统应用</a></i>
					    <dl class="layui-nav-child">
					      <dd><a href=""><i class="layui-icon" > &#xe60c; &nbsp;压扁小鸟</a></i></dd>
					      <dd><a href=""><i class="layui-icon" > &#xe642; &nbsp;在线画板</a></i></dd>
					 
					    </dl>
					  </li>
					 
					</ul>
				</div>
			
		</div>
		<div class='layui-body' style='height:20px;position:absolute;bottom: 0px;top:60px;border-width: 0;background-color:#F0E68C;'>
			<i class="fa fa-volume-up"></i> <font> copyright @2018 kjctar　　</font>
		</div>
		<!-- 右侧内容 -->
		<div  class='layui-body'     style='background-color: #eeeeee;
								            background-image:url("template/kjctar/images/yy.jpg");
								            background-repeat:no-repeat;
						                    background-attachment:fixed;
					                        background-position:center; 
					                        position: absolute;
					                        bottom: 0px;
					                        top:80px;
					                        border-width: 0;
					                        padding:0px 0px 0px 0px;'>
			<!--<iframe id="ifrk" class="layui-anim layui-anim-upbit" name='main' style='
            line-height: 200px;
            text-align: center;
            background: burlywood;
            border:0px solid #eeeeee;
            box-shadow: darkgrey 0px 0px 10px 5px ;
            border-radius:5px;width:200px;height:100px;
            position:absolute;left:10px;bottom: 10px;top:10px; width:100%;height:98%;position: relative;z-index: 9999' src="index.php?main=1"></iframe>-->
		</div>
		<!-- 底部 --><!--
		<div class="layui-footer footer">
			<p>copyright @2018 kjctar　　<a onclick="donation()" class="layui-btn layui-btn-danger layui-btn-small">捐赠作者</a></p>
		</div>-->
	</div>
	
	<!-- 移动导航 -->
	<div class="site-tree-mobile layui-hide"><i class="layui-icon">&#xe602;</i></div>
	<div class="site-mobile-shade"></div>

	<script type="text/javascript" src="template/kjctar/layui/layui.js"></script>
	
	<script type="text/javascript" src="template/kjctar/js/index.js"></script>
</body>
</html>
