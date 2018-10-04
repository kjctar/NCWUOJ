</div>

<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<!--<script src="<?php echo $path_fix."template/$OJ_TEMPLATE/"?>jquery.min.js"></script>-->
<script type="text/javascript">
$(document).ready(function(){
  $("a").click(function(){
//   alert("gg");
   window.parent.hideifr();       
     
  });
});
 window.parent.showifr();     
</script>


<script>

layui.use('util', function(){
  var util = layui.util;
  
  //执行
  util.fixbar({
//    bar1: true
  //  ,bar2:true
     click: function(type){
      console.log(type);
      if(type === 'bar1'){
        alert('点击了bar1')
      }
    }
  });
});

//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});
layui.use('code', function(){ //加载code模块
  layui.code(); //引用code方法
});

layui.use('form', function(){
  var form = layui.form;
  
  //监听提交
  form.on('submit(formDemo)', function(data){
    layer.msg(JSON.stringify(data.field));
    return false;
  });
});
</script>
<!--
<script src="<?php echo $path_fix."template/$OJ_TEMPLATE/"?>layui/layui.js"></script>-->
<!--<script>window.jQuery || document.write('<script src="<?php echo $path_fix."template/$OJ_TEMPLATE/"?>js/jquery-2.1.1.min.js"><\/script>')</script>-->
<!--<script src="<?php echo $path_fix."template/$OJ_TEMPLATE/"?>js/jquery.menu-aim.js"></script>
	<script src="<?php echo $path_fix."template/$OJ_TEMPLATE/"?>js/main.js"></script> Resource jQuery -->
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<!--<script src="<?php echo $path_fix."template/$OJ_TEMPLATE/"?>bootstrap.min.js"></script>
-->
<?php
if(file_exists("./admin/msg.txt"))
$view_marquee_msg=file_get_contents($OJ_SAE?"saestor://web/msg.txt":"./admin/msg.txt");
if(file_exists("../admin/msg.txt"))
$view_marquee_msg=file_get_contents($OJ_SAE?"saestor://web/msg.txt":"../admin/msg.txt");


?>
<!--<script type="text/javascript"
  src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
-->
<script>
$(document).ready(function(){
  var msg="<marquee style='margin-top:0px' id=broadcast direction='left' scrollamount=3    scrolldelay=50 onMouseOver='this.stop()'"+
      " onMouseOut='this.start()' class=toprow>"+<?php echo json_encode($view_marquee_msg); ?>+"</marquee>";
//   $(window.parent.$("#msg").html('hhhh'));
   $(window.parent.$("#msg").html(msg));
/*  $("form").append("<div id='csrf' />");
  $("#csrf").load("<?php echo $path_fix?>csrf.php");
  $("body").append("<div id=footer class=center >GPLv2 licensed by <a href='https://github.com/zhblue/hustoj' >HUSTOJ</a> "+(new Date()).getFullYear()+" </div>");
  $("body").append("<div class=center > <img src='http://hustoj.com/wx.jpg' width='96px'><br> 欢迎关注微信公众号onlinejudge</div>");*/
});
//  console.log("If you want to change the appearance of the web pages, make a copy of bs3 under template directory.\nRename it to whatever you like, and change the $OJ_TEMPLATE value in db_info.inc.php\nAfter that modify files under your own directory .\n");


</script>
<!--
<div style="height:80px;background-color:#393D49;color:white;position:relative;bottom:0px;">
 <center><br> <p> 基于HUSTOJ@zhblue开发的 NCWUOJ   ( HUSTOJ的web端优化方案 )</p>
  <p>  QQ群: 631596342 </p> 
</center></div>-->
