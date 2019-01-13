<?php 
  /*if (!isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
               header("Location:loginpage.php");
             }*/
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
	<title><?php echo $OJ_NAME;?></title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Access-Control-Allow-Origin" content="*">
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
		  $("li a i").click(function(){
		  	
		    hideifr();
		  });
		});
		function getIframeDom(){ 
		// 获取iframe的test元素 
		var test = $("#frame_1").contents().find("#test"); 
		alert(test.html()) 
		} 
		function hideifr () {
		//$("iframe").animate({ hidden:true});

		}
		function showifr () {
		//$("iframe").animate({ hidden:false});
		}
		function fresh()
		{
		  
		 
		   window.location.href('index.php?contest');

		  
		}
	</script>
	<style type="text/css">
      td.tips:hover{
         background-color:#5FB878;
         color:white;

      }
	</style>
<script language="JavaScript">
  window.onload = function(){
 
  var isad1 = document.getElementById("ad1");
  var isad2 = document.getElementById("ad2");
  if(/Android|webOS|iPhone|iPad|BlackBerry/i.test(navigator.userAgent)) {
 
      isad1.style.display="none";
       isad2.style.display="none";
  }
 
  }
  </script>

</head>


<body class="main_body">
	<div class="layui-layout layui-layout-admin" style='background-color:#eeeeee'>
		<!-- 顶部 -->
		<div class="layui-header header">
			<div class="layui-main">
				<a href="index.php?main"  target='main' class="logo"><?php echo$OJ_NAME;?></a>
				<!-- 显示/隐藏菜单 -->
				<i  class="iconfont hideMenu icon-menu1" style='background-color: #303030'></i>
				<!-- 搜索 -->
				
			
			    <!-- 顶部右侧菜单 -->
			     <ul class="layui-nav layui-layout-right">
			      	<?php if (!isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
		            echo'<li class="layui-nav-item lockcms" id="ad1">
						<a href="loginpage.php" target="main"><i class="layui-icon layui-icon-username"></i><cite>登录</cite></a>
					</li>
                    <li class="layui-nav-item lockcms" id="ad2">
						<a href="registerpage.php" target="main"><i class="layui-icon layui-icon-face-smile"></i><cite>注册</cite></a>
					</li>
			    	';
			    	 } ?>
		  


			    	<li class="layui-nav-item" >
						<a>  

                        
		            <img src='<?php include('template/kjctar/api_head_dir.php'); ?>'  id="head_broad3"   class="layui-circle" width="35" height="35">

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
							if($sid==htmlentities($_SESSION[$OJ_NAME.'_'.'user_id'],ENT_QUOTES ,"UTF-8"))
							{
								echo'
								<dl class="layui-nav-child">
									<dd><a href="userinfo.php?user='.$sid.'" target="main" ><i class="iconfont icon-zhanghu" data-icon="icon-zhanghu"><cite>个人资料</cite></i></a></dd>
									
									
									<dd><a href="logout.php"><i class="iconfont icon-loginout"><cite>退出</cite></i></a></dd>';
								if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'contest_creator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){
										  echo '<dd><a href=admin/><i class="layui-icon  layui-icon-console"><cite>OJ后台</cite></i></a></dd>';
										}

								
								echo'</dl>';
							}else{
								echo'
								<dl class="layui-nav-child">
									<dd><a href="loginpage.php" target="main"><i class="layui-icon layui-icon-username"></i><cite>登录</cite></a></dd>
									
									
									<dd><a href="registerpage.php" target="main"><i class="layui-icon layui-icon-face-smile"></i><cite>注册</cite></a></dd>
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
					   <li class="layui-nav-item"><a href="status.php" target='main'><i class="fa fa-refresh "> &nbsp;&nbsp;判题队列 </i></a></li>
					  <li class="layui-nav-item layui-nav-itemed">
					    <a href="javascript:;"><b class="layui-icon" >&#xe613; &nbsp;讨论区</b></a>
					    <dl class="layui-nav-child">
					      <dd><a href="javascript:;" target='main'><i  class="fa fa-file-code-o" >&nbsp;题解报告</i></a></dd>
					      <dd><a href="discuss3/discuss.php" target='main'><i class="layui-icon" >&#xe63a; &nbsp;OJ交流社区</i></a></dd>
					      <dd><a href="javascript:;" target='main'><i class="fa fa-coffee" > &nbsp;意见版块</a></i></dd>
					      
					    </dl>
					  </li>
					  <li class="layui-nav-item">
					   <a href="javascript:;"> <b class="fa fa-sitemap" > &nbsp;系统应用</b></a>
					    <dl class="layui-nav-child">
					      <dd><a href=""><i class="layui-icon" > &#xe60c; &nbsp;压扁小鸟</i></a></dd>
					      <dd><a href=""><i class="layui-icon" > &#xe642; &nbsp;在线画板</i></a></dd>
					 
					    </dl>
					  </li>
					 
					</ul>
				</div>
			
		</div>
		<div class='layui-body' style='height:30px;position:absolute;top:60px;background-color:	#F5F5DC;border:0px solid #dddddd;border-bottom:1px solid #dddddd'>
          <table class="layui-table" lay-size="sm" style='padding:0px 0px;margin:0px 0px; '>
          <tr >
              <td  onclick="refreshFrame();" style="padding-top:0px;" class="tips"><i class="layui-icon layui-icon-refresh-1 "></i></td>
              <td onclick="returnpage();" style="padding-top:0px;" class="tips" ><i  class="layui-icon layui-icon-return"></i></td>
              <td style='width:95%;padding-left:0px;padding-right:0px;'> <font id='msg'></font></td>
              
              </tr>
          </table>
			
  
				<script type="text/javascript">
				function refreshFrame(){
				    document.getElementById('ifrk').contentWindow.location.reload(true);
				}
				function returnpage(){
				    document.getElementById('ifrk').contentWindow.history.go(-1);
				}
				</script>
		</div>
		<!-- 右侧内容 -->
		<div  class='layui-body'     style='background-color: #ffffff;
								        
								            background-repeat:no-repeat;
						                    background-attachment:fixed;
						                    background-size: 70px;
					                        background-position:center; 
					                        position: absolute;
					                        bottom: 45px;
					                        top:90px;
					                        border-width: 0;
					                        padding:0px 0px 0px 0px;'>
         <?php
		    if(isset($_GET['contest']))
		      {
		      	?>
		       <iframe id="ifrk" class="layui-anim layui-anim-upbit" name="main"   style="width:100%;height:100%; border: 1px solid #FBFBFB"  src="contest.php"></iframe>
		 <?php    
		      }
		      else 
		      	?><iframe id="ifrk" class="layui-anim layui-anim-upbit" name="main" style="width:100%;height:100%; border: 1px solid #FBFBFB"  src="index.php?main=1"></iframe>
		
		</div>
		<!-- 底部 -->
		<div class="layui-footer footer" style="background-color:#393D49;color:white;">
		
			
			<p> NCWUOJ copyright @2018 kjctar　| &nbsp;&nbsp;&nbsp;QQ群: 631596342　<a id="donation" class="layui-btn layui-btn-sm layui-btn-danger">捐赠作者</a></p>
		</div>
	</div>
	

   
	<script type="text/javascript" src="template/kjctar/layui/layui.js"></script>
	
	<script>
	layui.use('layer', function(){ //独立版的layer无需执行这一句
	  var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句
	  $(document).on('click', '#donation', function() {
	  //触发事件
							var index = layer.open({
							
							 type: 1 //此处以iframe举例
							,title: '感谢捐赠'
							,area: ['300px', '350px']
							,shade: false
							,offset: '100px'
							,content: '<center><br><img id="head_broad1" style="width:200px;height:250px;border:1px solid #eeeeee" src="template/kjctar/kjctar.png" ></center>'
							,anim: 4
							,zIndex: layer.zIndex //重点1
							,success: function(layero){
							  //layer.setTop(layero); //重点2
							   
							}
					
					});
					   
			});
	});

	
	//注意：导航 依赖 element 模块，否则无法进行功能性操作
	layui.use('element', function(){
	  var element = layui.element;
	  
	  //…
	});
	</script>
	<script type="text/javascript" src="template/kjctar/js/index.js"></script>
</body>
</html>
