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
    <style type="text/css">
   

    </style>
  </head>
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
        util.countdown(endTime, serverTime, function(date, serverTime, timer){
          if( date[0]>0)
            var str = date[0] + '天';
          else str='';
            str = str + date[1] + ':' +  date[2] + ':' + date[3];
          var timestamp = Date.parse(new Date());
          if(timestamp>=endTime){
             $(id+'b').html('<button class="layui-btn layui-btn-sm layui-btn-radius" >&nbsp;已结束&nbsp;</button>'); 
           }
           else{
             $(id+'b').html('<button   class="layui-btn layui-btn-sm layui-btn-radius layui-btn-warm" >&nbsp;正在进行&nbsp;</button>'); 
              $(id).html('比赛还剩:'+ str);
           }
                $(id).html('比赛还剩:'+ str);
        });
     
  }); 
}


countdown('<?php echo time();?>','<?php echo strtotime($view_start_time);?>','<?php echo strtotime(date( $view_end_time));?>','freetime');
</script>
<script type="text/javascript">
function showcode(code)
{
 
  layui.use('layer', function(){ //独立版的layer无需执行这一句
  var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句
  //触发事件
                        var index = layer.open({
                        
                         type: 2 //此处以iframe举例
                        ,title: '<font style="font-size:small">code</font>'
                        ,area: ['60%', '100%']
                        ,shade: false
                        ,maxmin: true
                        ,offset: '0px'
                        ,content: code
                        ,anim: 2
                        ,zIndex: layer.zIndex //重点1
                        ,success: function(layero){
                          layer.setTop(layero); //重点2
                        }
                
                });
                   
        });

}
function showpm(code)
{
 
  layui.use('layer', function(){ //独立版的layer无需执行这一句
  var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句
  //触发事件
                        var index = layer.open({
                        
                         type: 2 //此处以iframe举例
                        ,title: '<font style="font-size:small">题目</font>'
                        ,area: ['100%', '100%']
                        ,shade: false
                        ,offset: '0px'
                        ,content: code
                        ,anim: 2
                        ,zIndex: layer.zIndex //重点1
                        ,success: function(layero){
                          layer.setTop(layero); //重点2
                        }
                
                });
                   
        });

}


function search()
{
  var ajax_url = "status.php"; //表单目标 
　var ajax_type = $("#simform").attr('method'); //提交方法 
　var ajax_data = $("#simform").serialize(); //表单数据 
 
 
　$.ajax({ 

　 type:ajax_type, //表单提交类型 
　 url:ajax_url, //表单提交目标 
　 data:ajax_data, //表单数据
　 success:function(msg,status){  
    if(status == 'success'){//msg 是后台调用action时，你传过来的参数
         $('#p2').html(msg);
         
       }
     }
   })        　　
}
var j=0;
function skippage(ajax_url)
{
  j=j+1;
 
  $.ajax({ 
    
  　　type:'get', //表单提交类型 
  　　url:ajax_url, //表单提交目标 
  　　success:function(msg,status){
      if(status == 'success'){//msg 是后台调用action时，你传过来的参数
           $('#p2').html(msg);
         //
         
         }
       }
     }) 　　
}
function getpage(url,id)
{
 
      $.get(url,function(data,status){
        //alert("数据: " + data + "\n状态: " + status);
         id='#'+id;
         $(id).html(data);
      });
}




window.onhashchange=function(){
      var hash = window.location.hash;  
     
      for(var i=0;i<5;i++)
      {
        $('#t'+i).removeClass("layui-this");
        $('#p'+i).removeClass("layui-tab-item layui-show");
        $('#p'+i).removeClass("layui-tab-item");
        if("#"+i==hash)
        {
           $('#t'+i).addClass("layui-this");
           $('#p'+i).addClass("layui-tab-item layui-show");
            if(i==2)
           {
            //alert("异步状态");
            setTimeout('getpage("status.php?cid=<?php echo $view_cid?>","p2")',500);
             
           }
           if(i==3)
           {
             setTimeout('getpage("contestrank.php?cid=<?php echo $view_cid?>","p3")',500);
        
           }
        }
        else{
           $('#p'+i).addClass("layui-tab-item");
        }
      }
     }
</script>


  <body>

    <div class="container" >
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
<br>
<div class="layui-card" style="border:1px solid #dddddd">
  <div class="layui-card-header"> Contest<?php echo $view_cid?></div>
  <div class="layui-card-body">
      
    <div class="layui-row" >
    <div class="layui-col-md8"><h1 class="press"><i class="fa fa-trophy" style="color:#FFB800"></i> - <?php echo $view_title ?></h1>
     </div>
    <div class="layui-col-md4">
    <br>
    <i id='freetimeb' > </i>&nbsp;&nbsp;&nbsp;
    <font id='freetime' > </font>
    </div></div>
  </div>
</div>




<!--
<br>Start Time: <font color=#993399><?php echo $view_start_time?></font>
End Time: <font color=#993399><?php echo $view_end_time?></font><br>
Current Time: <font color=#993399><span id=nowdate > <?php echo date("Y-m-d H:i:s")?></span></font>-->

<script>

layui.use('element', function(){
  var element = layui.element;
    
   element.on('tab(docDemoTabBrief)', function(data){
   window.location.hash=data.index; 
  });
});

</script>

<div class="layui-card" style="border:1px solid #dddddd">
  <div class="layui-card-body">

      <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
        <ul class="layui-tab-title">
          <li id='t0' >描述</li>
          <li id='t1' >题目</li>
          <li id='t2'   >状态</li>
          <li id='t3' >排名</li>
          <li id='t4'>统计</li>
        </ul>
        <div class="layui-tab-content" >
              <div class="layui-tab-item" id="p0"><?php echo $view_description?></div>
              <div class="layui-tab-item" id="p1">
                 <table id='problemset' class="layui-table" lay-skin="line" style="border-width:0px" >
                  <thead>
                  <tr>
                  <td >我的状态
                  <td style="cursor:hand"  ><?php echo $MSG_PROBLEM_ID?>
                  <td ><?php echo $MSG_TITLE?></td>
                  <td > 通过率</td>
                  
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  
                  foreach($view_problemset as $row){
                  echo "<tr>";
                  if(strlen($row[0])<4){
                    $row[0]="未提交";
                  }
                  for($i=0;$i<3;$i++)
                  {
                    echo "<td>";
                    echo $row[$i];
                    echo "</td>";
                  }
                  if(count($row[4])==0)
                  {
                    $row[4]=0;
                  }
                   if(count($row[5])==0)
                  {
                    $row[5]=0;
                  }
                  $rat=100.0*$row[4]/$row[5];
                  $rat=round($rat,2);
                  if($row[5]==0)
                    $rat=0;
                  echo "<td>".$rat."%(".$row[4]."/".$row[5].")</td>";
                  echo "</tr>";
                 
                  }
                  ?>
                  </tbody>
                  </table>
              </div>
              <div class="layui-tab-item" id='p2' ><center  style="padding:150px 150px;"> <i class="fa fa-2x fa-spinner fa-pulse"></i></center></div>
              <div class="layui-tab-item" id='p3' ><center  style="padding:150px 150px;"> <i class="fa fa-2x fa-spinner fa-pulse"></i></center></div>
              <div class="layui-tab-item" id='p4' ><center  style="padding:150px 150px;"> <i class="fa fa-2x fa-spinner fa-pulse"></i></center></div>

       </div>
      </div> 

  </div>
</div>

<!--
[<a href='status.php?cid=<?php echo $view_cid?>'>Status</a>]
[<a href='contestrank.php?cid=<?php echo $view_cid?>'>Standing</a>]
[<a href='conteststatistics.php?cid=<?php echo $view_cid?>'>Statistics</a>]-->



    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	 


<script>
if(window.location.hash=="")
{
  window.location.hash=1;
}
else{


   var hash = window.location.hash;  
   
      for(var i=0;i<5;i++)
      {
        if("#"+i==hash)
        { 

           $('#t'+i).addClass("layui-this");
           $('#p'+i).addClass("layui-show");
            if(i==2)
           {
            //alert("异步状态");
            setTimeout('getpage("status.php?cid=<?php echo $view_cid?>","p2")',500);
           }
           if(i==3)
           {
              setTimeout('getpage("contestrank.php?cid=<?php echo $view_cid?>","p3")',500);
           }
        }
      }
      
      
     

}
</script>       
<script src="include/sortTable.js"></script>
<script>
var diff=new Date("<?php echo date("Y/m/d H:i:s")?>").getTime()-new Date().getTime();
//alert(diff);
function clock()
{
var x,h,m,s,n,xingqi,y,mon,d;
var x = new Date(new Date().getTime()+diff);
y = x.getYear()+1900;
if (y>3000) y-=1900;
mon = x.getMonth()+1;
d = x.getDate();
xingqi = x.getDay();
h=x.getHours();
m=x.getMinutes();
s=x.getSeconds();
n=y+"-"+mon+"-"+d+" "+(h>=10?h:"0"+h)+":"+(m>=10?m:"0"+m)+":"+(s>=10?s:"0"+s);
//alert(n);
document.getElementById('nowdate').innerHTML=n;
setTimeout("clock()",1000);
}
clock();
</script>
  </body>
</html>
