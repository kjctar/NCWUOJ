<!DOCTYPE HTML> 
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title><?php echo $OJ_NAME;?></title>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="favicon.ico"/>
        <link rel="bookmark" href="favicon.ico"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
		<link rel="stylesheet" href="template/kjctar/assets/css/main.css"/>
		<link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
		<link href="<?php echo"template/$OJ_TEMPLATE/";?>pop/spop.css" rel="stylesheet">
		<!-- Even better, SamallPop is made with scss,
		     @import to your style.scss -->
		<script src="<?php echo"template/$OJ_TEMPLATE/";?>pop/spop.js"></script>
  </head>
  
       <body>
			<div id="wrapper">
              <!--首页开始-->
					<header id="header">
						<div class="logo">
						<span class="icon fa fa-code"></span>
                      </div>
                                                     <div class="content">
							<div class="inner">
								<h1><?php echo $OJ_NAME;?></h1>
								<!--
								如果想自定义文本请删除下面这段script代码,格式为
								<p>自定义文本</p>
								-->
								<script type="text/javascript" src="https://api.lwl12.com/hitokoto/main/get?encode=js&charset=utf-8"></script><div id="lwlhitokoto"><script>lwlhitokoto()</script></div>
                          </div>
                      </div>	
                              <nav>
							<ul>
                               <li><a href="#1">简介</a></li>
								<li><a href="#login">登录</a></li>
								<li><a href="#register">注册</a></li>
                              	<li><a href="#5">下载</a></li>
                              
                           </ul>
						</nav>
                              
              </header> 
              <!--首页结束-->
					<div id="main">
                      <!--标签1开始-->
                      <article id="1">
                      <h2 class="major">简介</h2>
                      <p>ACM国际大学生程序设计竞赛（英文全称：ACM International Collegiate Programming Contest（简称ACM-ICPC或ICPC））是由国际计算机协会（ACM）主办的，一项旨在展示大学生创新能力、团队精神和在压力下编写程序、分析和解决问题能力的年度竞赛。经过近40年的发展，ACM国际大学生程序设计竞赛已经发展成为全球最具影响力的大学生程序设计竞赛。赛事目前由IBM公司赞助。</p>

                      </article>
					  
					 
					 
                     <!--标签4开始-->
                      <article id="4">
								<h2 class="major">联系我们</h2>
								<ul class="icons">
                                   <p>此处填写联系方式</p>
                                    <li>
                                      <a target="_blank" href="#" class="icon fa-facebook">
									 <!-- 请在fontawesome.com寻找替换图标 href替换链接 -->
                                      <span class="label">Facebook</span>
                                      </a>
                                    </li>
                                  </ul>
                      </article>
                      <!--标签5开始-->
	                    <article id="5">
							<h2 class="major">软件下载</h2>
							<ul>
							  <li><a href="/ssr-download/ssr-win.7z" class="icon fa-windows"><span class="label"></span> Windows</a></li>
							  <li><a href="/ssr-download/ssr-mac.dmg" class="icon fa-apple"><span class="label">Mac</span> Mac</a></li>
							  <li><a href="/ssr-download/ssr-android.apk" class="icon fa-android"><span class="label">Android</span> Android</a></li>
							  <li><a href="#ios" class="icon fa-apple"><span class="label">iOS</span> iOS</a></li>
                              <li><a href="/ssr-download/SSTap.7z" class="icon fa-gamepad"><span class="label">Win游戏专用</span> Win游戏专用</a></li>
                            
	                         </ul>
                             </article>
                            <!--标签5开始-->
                      	<article id="login">  

		
								<h2 class="major">登录</h2>
								<form method="post" action="#" id='loginform'  onsubmit='return sub()'>
									<div class="field half first">
										<label for="email2">用户名</label>
										<input type="text" name="user_id" id="email2" />
									</div>
									<div class="field half">
										<label for="passwd">密码</label>
										<input type="password" name="password" id="passwd" />
									</div>
									
									<ul class="actions">
										<li><input  type="submit" value="验证" class="special"  /></li>
										<li><input type="reset" value="清空" /></li>
									</ul>
								</form>
						         <script type="text/javascript">
						          
						         function sub(){
						         	
						         	 
						         	$.ajax({
                                          type:'post',
                                          url:'login.php',
                                          data:$("#loginform").serialize(),
                            
                                          success:function(result,status)
                                          {
                                              //alert(result);   
                                              if(result=='1')
                                              {
                                              	spop({template:'<p class="spop-title" > <strong style="color:#5FB878"> &nbsp;&nbsp;Accept！My Acmer</strong></p>',
                                              		position:'top-center',
                                              		style: 'success' });
                                              	document.getElementById("login").innerHTML='<img src="template/kjctar/images/acmer.png">'
                                              }  
                                              else {
                                              	spop({template:'<p class="spop-title">'+result+'</p>',
                                              		position:'top-left',
                                              		style:'error',
                                              	    autoclose: 2000});
                                              }     
                                           
       
                                          }
                                       }); 
						         	return false;

						         };
						          
						         </script>

                             	<div class="field half">
											<input value="week" id="remember_me" name="remember_me" type="checkbox" checked>
											<label for="remember_me">记住我</label>
								</div>


								<br>

								<div id="result" role="dialog" >
													<p color class="h5 margin-top-sm text-black-hint" id="msg"></p>
								</div>
					  </article> 
                      <!--全部标签结束-->
                      
                              </div>
                     <!-- 版权底部 -->
                      <footer id="footer">
                   <p class="copyright">&copy;2018 NCWUOJ</p>
                      </footer>
              <!-- 版权结束 -->
			 </div>
                <!-- BG -->
			<div id="bg"></div>
	        	<!-- Scripts -->
			<script src="template/kjctar/assets/js/jquery.min.js"></script>
			<script src="template/kjctar/assets/js/skel.min.js"></script>
			<script src="template/kjctar/assets/js/util.js"></script>
         <script src="template/kjctar/assets/js/main.js"></script>
	</body>
</html>

