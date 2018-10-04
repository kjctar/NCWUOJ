<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

  <body>

<div class="container">
<?php include("template/$OJ_TEMPLATE/nav.php");?>	    
<table class="layui-table" lay-size="sm">
<form action="modify.php" method="post" id="modifyform" onsubmit='return sub()'>

<tr><td width=25%>用户 ID:
<td width=75%><?php echo $_SESSION[$OJ_NAME.'_'.'user_id']?>
<?php require_once('./include/set_post_key.php');?>
</tr>
<tr><td>昵称:
<td><input  name="nick" size=50 type=text value="<?php echo htmlentities($row['nick'],ENT_QUOTES,"UTF-8")?>" >
</tr>
<tr><td>新密码:
<td><input name="npassword" size=20 type=password>
</tr>
<tr><td>重复新密码:
<td><input name="rptpassword" size=20 type=password>
</tr>
<tr><td>学校:
<td><input name="school" size=30 type=text value="<?php echo htmlentities($row['school'],ENT_QUOTES,"UTF-8")?>" >
<?php if(isset($_SESSION[$OJ_NAME."_printer"])) echo "$MSG_HELP_BALLOON_SCHOOL";?>
</tr>
<tr><td>邮箱:
<td><input name="email" size=30 type=text value="<?php echo htmlentities($row['email'],ENT_QUOTES,"UTF-8")?>" >
</tr>
<tr><td>
<td><input value="Submit" name="submit" type="submit">
&nbsp; &nbsp;
<input value="Reset" name="reset" type="reset">
</tr>


</tr>
<tr><td>当前密码:
<td><input name="opassword" size=20 type=password>
<td style='color: red'>必填
</tr>
</form>
</table>

<script>


layui.use('layer', function(){ //独立版的layer无需执行这一句
  var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句
  $(document).on('click', '#up', function() {
  //触发事件
   
                        var index = layer.open({
                        
                         type: 1 //此处以iframe举例
                        ,title: '限制为400k'
                        ,area: ['350px', '280px']
                        ,shade: 0.5
                        ,offset: '-0px'
                        ,content: ' <div class="layui-form-item"><label class="layui-form-label">密码框</label><div class="layui-input-inline"><input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input"></div><div class="layui-form-mid layui-word-aux">辅助文字</div></div>'
                        ,anim: 2
                        ,zIndex: layer.zIndex //重点1
                        ,success: function(layero){
                          //layer.setTop(layero); //重点2
						   bind();
                        }
                
                });
                   
        });
});


  function sub(){
      	 
			$.ajax({
                type:'post',
                url:'modify.php',
                data:$("#modifyform").serialize(),
               
                success:function(result,status)
                { 
                    //alert(result);   
                    if(result=='1')
                    {
                    	spop({template:'<p class="spop-title" > <strong style="color:#5FB878"> &nbsp;&nbsp;Accept  修改成功！等待页面刷新</strong></p>',
                    		position:'top-center',
                    		style: 'success' ,
                        autoclose: 3000

                      });
                      setTimeout(function(){window.parent.fresh();},3000);
                      
                    	
                    }  
                    else {
                    	spop({template:'<p class="spop-title">'+result+'</p>',
                    		position:'top-left',
                    		style:'error',
                    	  autoclose: 2000
                      });
                    }     
                 

                }
             }); 
    return false;

  };
</script>
<!--
<br>
<a href=export_ac_code.php>Download All AC Source</a>
<br>
-->

</div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
  </body>
</html>
