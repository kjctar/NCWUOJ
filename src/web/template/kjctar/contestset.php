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
     
    <div class="container" >
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
     <br><br>

<form method=post action=contest.php >
 
  <div class="layui-form-item">
    <label class="layui-form-label"> <?php echo $MSG_SEARCH;?></label>
    <div class="layui-input-inline">
      <input ame=keyword type=text required lay-verify="required"  autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">输入比赛名称 </div>
    <input class="layui-btn layui-btn-primary" type=submit>
  </div>

  
</form>




<script>

  function countdown( serverTime,startTime,endTime,id)
  {
    var cid=id;
    id='#'+id;
    serverTime=Number(serverTime)*1000;
    endTime=Number(endTime)*1000;
    startTime=Number(startTime)*1000;

    layui.use('util', function(){
      var util = layui.util;
      var flag=1;
        util.countdown(startTime, serverTime, function(date, serverTime, timer){
          var str = date[0] + '天' + date[1] + ':' +  date[2] + ':' + date[3];
          var timestamp = Date.parse(new Date());
          if(timestamp<startTime)
           {
            if(flag==1)
            {
              $(id+'b').html('<button class="layui-btn layui-btn-radius layui-btn-disabled" >&nbsp;未开始&nbsp;</button>'); 
              $flag=0;
            }
            $(id).html('距比赛:'+ str);
           }
           else if(timestamp>endTime){
             $(id+'b').html('<a target="main" href="contest.php?cid='+cid+' " class="layui-btn layui-btn-radius" >&nbsp;已结束&nbsp;</a>'); 
           }
           else{
             $(id+'b').html('<a  target="main" href="contest.php?cid='+cid+' " class="layui-btn layui-btn-radius layui-btn-warm" >&nbsp;正在进行&nbsp;</a>'); 
           }

        });
     
  }); 
}
</script>


<?php
$i=0;

foreach($view_contest as $row){
echo '<blockquote class="layui-elem-quote layui-row" style="position:relative;border:1px solid #d2d2d2; background-color:#FFFFFF; border-left:3px solid #009688"><div class="layui-col-md2"> <i class="fa fa-code fa-5x"></i></div>';
 echo '<div  class="layui-col-md10" style="padding:0px 0px">';
  echo '&nbsp;<strong style="color:#FF5722">'.$info_contest[$i][3].'</strong>&nbsp;&nbsp;&nbsp;&nbsp;';
  if($info_contest[$i][4]==0)
  {
    
   echo'<span class="layui-badge layui-bg-green">'.开放.'</span> ';
  }
 else{  echo'<span class="layui-badge layui-bg-orange">'.私人.'</span>';
    
 }


  echo '<br><br><font style="font-weight:blod;line-height:15px;font-size:small;color:gray"><i class=" fa fa-bell" ></i>&nbsp;比赛时间:'.$info_contest[$i][0].'&nbsp; 至 &nbsp;'.$info_contest[$i][1].'&nbsp;(时长:'.$info_contest[$i][2].')</font><br>';
  echo '<font style="font-weight:blod;line-height:15px;font-size:small;color:gray"> <i class=" fa fa-user"></i>&nbsp;创建者： '.$view_contest[$i][6].'</font>';

echo "</div>";


$start_time=strtotime($info_contest[$i][0]);
$end_time=strtotime($info_contest[$i][1]);

echo'<script> countdown('.time().','.$start_time.','.$end_time.','.$view_contest[$i][0].'); </script>';

echo '<div style="position:absolute;right:50px;top:40px;"> ';
        echo'<div id='.$view_contest[$i][0].'b ></div>';
       
    echo'</div>';
        echo'<div style="font-size:small;color:gray;position:absolute;right:45px;top:80px;" id='.$view_contest[$i][0].'></div>';
echo "</blockquote>";
$i++;
}
?>

<?php
$my=isset($_GET['my'])?"&my":"";
if(!isset($page)) $page=1;
$page=intval($page);
$section=8;
$start=$page>$section?$page-$section:1;
$end=$page+$section>$view_total_page?$view_total_page:$page+$section;
$end=$end*10;
?>
<center><div id="page" ></div></center>

<script>

layui.use('laypage', function(){
  var laypage = layui.laypage;
  
  //执行一个laypage实例
  laypage.render({
    elem: 'page' //注意，这里的 test1 是 ID，不用加 # 号
    ,count: <?php echo $end; ?> //数据总数，从服务端得到
     ,curr: <?php echo $page;?>
    ,jump: function(obj, first){
    //obj包含了当前分页的所有参数，比如：
    console.log(obj.curr); //得到当前页，以便向服务端请求对应页的数据。
    console.log(obj.limit); //得到每页显示的条数
    
    //首次不执行
    if(!first){
              window.location.href='contest.php?page='+obj.curr+'<?php echo $my;?>';
           /* $.ajax({url:"problemset.php?page="+obj.curr,success:function(result){
                        
                        $("#pa").html(result);
                }});    */  
     }
    }
  });

});

</script>

    

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
 
 </body>
</html>
