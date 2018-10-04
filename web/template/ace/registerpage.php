<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $OJ_NAME?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<body style="
			opacity:0.9;
			background-color:black;
			background-image:url('image/reg.png');
			background-repeat:no-repeat;
			background-attachment:fixed;
			background-size: 100% 100%;">


    <?php //include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->

		<div class="layui-row" >

		<div class="layui-col-xs4">
		<div class="grid-demo" >
			<div class="layui-card" style="width:90%;background-color:#393D49;color:white">
			  <div class="layui-card-header"  style="width:90%;background-color:#393D49;color:white">Hint</div>
			  <div class="layui-card-body">
			   邮箱最好填上,
			   学校也最好填上<br>
			   因为你不填，无法注册
			  </div>
			</div>
		</div>
		</div>
		<div class="layui-col-xs3">&nbsp;</div>
		<div class="layui-col-xs5">
		<div class="grid-demo grid-demo-bg1">
		<br><br><br><br><br>
		<div class="layui-card layui-anim  layui-anim-scale" style="width:80%;" >
		  <div class="layui-card-body">
		  <i class='fa fa-1x fa-windows'></i>&nbsp;
		  <a style="color:#393D49;" href="<?php echo $path_fix.$OJ_HOME?>"><?php echo $OJ_NAME?></a>
		<form action="register.php" method="post" role="form" class="layui-form layui-form-pane" onSubmit="return jsMd5();" >
                <br><center><h3><i style='color:gray; font:45px ;'>Register In to your account</i></h3></center><br>
				<div class="layui-form-item">
				<label class="layui-form-label"><?php echo $MSG_USER_ID?></label>
				<div class="layui-input-inline">
				 <input name="user_id" lay-verify="required"  class="layui-input" type="text">
				</div>
			  </div>
				<div class="layui-form-item">
				<label class="layui-form-label"><?php echo $MSG_NICK?>:</label>
				<div class="layui-input-inline">
				 <input name="nick" lay-verify="required"  class="layui-input"  type="text">
				</div>
			  </div>
			  <div class="layui-form-item">
				<label class="layui-form-label"><?php echo $MSG_PASSWORD?>:</label>
				<div class="layui-input-inline">
				<input name="password"  lay-verify="required"   class="layui-input"  type="password">
				</div>
			  </div>
			  <div class="layui-form-item">
				<label class="layui-form-label"><?php echo $MSG_REPEAT_PASSWORD?>:</label>
				<div class="layui-input-inline">
				<input  name="rptpassword"  lay-verify="required"   class="layui-input"  type="password">
				</div>
			  </div>
			  <div class="layui-form-item">
				<label class="layui-form-label"><?php echo $MSG_SCHOOL?>:</label>
				<div class="layui-input-inline">
				<input name="school"  lay-verify="required"   class="layui-input"  type="text">
				</div>
			  </div>
			  <div class="layui-form-item">
				<label class="layui-form-label"><?php echo $MSG_EMAIL?>:</label>
				<div class="layui-input-inline">
				<input name="email"  lay-verify="required"   class="layui-input"  type="text">
				</div>
			  </div>




		<?php if($OJ_VCODE){?>
		<?php echo $MSG_VCODE?>:
		<input name="vcode" size=4 type=text><img alt="click to change" src="vcode.php" onclick="this.src='vcode.php?'+Math.random()">*

		<?php }?>
		<div class="layui-form-item">
				<div class="layui-input-inline">
				  <button class="layui-btn" lay-submit="" lay-filter="demo1">提交</button>
				  <button type="reset" type="reset" class="layui-btn layui-btn-primary">重置</button>
				</div>
		</div>

		</form>
		</div>
		<div class="layui-card-header" style="background-color:#e2e2e2;"  >
				  <i style='position:absolute;right:10px;color:gray; font: 15px ;'>
					   已注册？&nbsp;<i class='fa fa-hand-o-right'></i>
					<a  class="layui-btn layui-btn-radius layui-btn layui-btn-sm" href="loginpage.php">
					<i class='fa fa-user'></i></a>
				</i>
		</div>
		</div>
		</div>
		</div>

		
		</div>
 

      
<?php //include("template/$OJ_TEMPLATE/js.php");?>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php //include("template/$OJ_TEMPLATE/js.php");?>	    
   <script>
   layui.use('element', function(){
  var element = layui.element;
  
});

    //监听提交
  layui.use('form', function(){
  var form = layui.form;
  
  //监听提交
  form.on('submit(formDemo)', function(data){
    layer.msg(JSON.stringify(data.field));
    return false;
  });
});

        // $("input").attr("class","form-control");
   </script>
  </body>
</html>
