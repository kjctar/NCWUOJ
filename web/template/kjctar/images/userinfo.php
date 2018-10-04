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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<script>
layui.use('layer', function(){ //独立版的layer无需执行这一句
  var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句
  $(document).on('click', '#modify', function() {
  //触发事件
           
                        var pid=$( this ).attr("name");
                        var index = layer.open({
                        
                        type: 2 //此处以iframe举例
                        ,title: $( this ).text()
                        ,area: ['750px', '420px']
                        ,shade: 0
                        ,maxmin: true
                        ,offset: '20px'
                        ,content: pid
                        ,anim: 2
                        ,zIndex: layer.zIndex //重点1
                        ,success: function(layero){
                          layer.setTop(layero); //重点2
                        }
                
                });
        });
});
</script>

<body>
<div class="layui-container">
<div class="layui-card">
  <div class="layui-card-body">
  

  </div>
</div>





 
 
   
         
        <div class="layui-row">
          <div class="layui-col-md2">
             <div class="layui-upload">
                  <div class="layui-upload-list">
                  
                    <img class="layui-circle" style="width:120px;height:120px ;border:1px solid black;"  <?php include('template/kjctar/api_head_dir.php'); ?>    id="head_broad2">
                    
                   </div>  
               
                </div>
              <div> <i class="fa fa-user-secret fa-5x"> &nbsp;Rank &nbsp; <?php echo $Rank?></i>   </div> 
          </div>
          <div class="layui-col-md3">
            <div class="list-group">
              <a class="list-group-item" href="#"><i class="fa fa-address-card-o fa-fw"></i>&nbsp;<?php echo $user?></a>
              <a class="list-group-item" href="#"><i class="fa fa-book fa-fw"></i>&nbsp;<?php echo $nick?></a>
              <a class="list-group-item" href="#"><i class="fa fa-envelope fa-fw"></i>&nbsp;<?php echo $email?></a>
              <a class="list-group-item" href="#"><i class="fa fa-institution fa-fw"></i>&nbsp;<?php echo $school?></a>
            </div>
          </div>
           <div class="layui-col-md1">
             &nbsp;
          </div>
           <div class="layui-col-md6">
             <div id=submission style="width:350px;height:200px" ></div>
          </div>
        </div>
             

      

      


   
   
    
  
    
 
<div class="layui-tab layui-tab-card">
  <ul class="layui-tab-title">
    <li class="layui-this">提交统计</li>
    <li>题目一览</li>
    <li>作业/比赛记录</li>
    <li>修改信息</li>
    <li>上传头像</li>
   
  </ul>
  <div class="layui-tab-content">
    <div class="layui-tab-item layui-show">
      <div class="layui-card">
        <div class="layui-row">
          <div class="layui-col-md5">
            <div class="layui-card"><div class="layui-card-body"><div id="tongji" style="height:300px"></div></div></div>
          </div>
          <div class="layui-col-md3">
         
          <table class='table table-striped'   >
              
              <tr>
                <td class="tit">提交</td>
                <td class="txt"><a href='status.php?user_id=<?php echo $user?>'><?php echo $Submit?></a></td>
              </tr>
              <tr>
                <td class="tit">解决</td>
                <td class="txt"><a href='status.php?user_id=<?php echo $user?>&jresult=4'><?php echo $AC?></td>
              </tr>
            <?php
                foreach($view_userstat as $row){
                    echo "<tr ><td class='tit'>".$jresult[$row[0]]."<td class='txt'><a href=status.php?user_id=$user&jresult=".$row[0]." >".$row[1]."</a></tr>";
                }
            ?>

          </table>
   
        </div>
        <div class="layui-col-md3">
         
           <img src="template/kjctar/images/3.gif">
        </div>
      </div>
    </div>
  </div>
    <div class="layui-tab-item">
        <div class="layui-card">
          <div class="layui-card-header" style='background-color:#F0E68C'><strong>
          <span class="layui-badge layui-bg-green">解决的题目</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span class="layui-badge layui-bg-danger">尝试但未成功的题目</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <span class="layui-badge layui-bg-gray">未尝试的题目</span></strong>
          </div>
          <div class="layui-card-body">
          
          <script language='javascript'>
              var ac=new Array(10000);
            function p(id,c){
              if(c==1)
              ac[id]=1;
              else ac[id]=2; 
              //document.write("<a class='layui-badge layui-bg-green' href=problem.php?id="+id+">"+id+" </a>");

            }
            function printr(id)
            {
              if(ac[id]==1)
              {
                document.write("<a class='layui-badge layui-bg-green' href=problem.php?id="+id+">"+id+" </a>&nbsp;");
              }
              else if(ac[id]==2)
                document.write("<a class='layui-badge layui-bg-danger' href=problem.php?id="+id+">"+id+" </a>&nbsp;");
              else document.write("<a class='layui-badge layui-bg-gray' href=problem.php?id="+id+">"+id+" </a>&nbsp;");
            }
            <?php 
            
              
            $sql="SELECT `problem_id`,count(1) FROM `solution` WHERE `user_id`=? 
                AND problem_id in (select distinct problem_id from solution where `user_id`=? and result!=4) group by `problem_id` ORDER BY `problem_id` ASC";
            if ($result=pdo_query($sql,$user,$user)){ 
              foreach($result as $row)
              echo "p($row[0],2);";
            }
            $sql="SELECT `problem_id`,count(1) FROM `solution` WHERE `user_id`=? 
                AND problem_id in (select distinct problem_id from solution where `user_id`=? and result=4) group by `problem_id` ORDER BY `problem_id` ASC";
            if ($result=pdo_query($sql,$user,$user)){ 
              foreach($result as $row)
              echo "p($row[0],1);";
            }
            
            $sql="SELECT count(1) FROM `problem`";
              $result=pdo_query($sql);
              $row=$result[0];
              $sum= $row[0]+999;
             for($i=1000;$i<=$sum;$i++)
             {
               echo"printr($i);";
             }

            ?>
          </script>
        </div>
      </div>

    </div>
 
   <div class="layui-tab-item">
        作业
       
   </div>
   <div class="layui-tab-item">
        修改
       
   </div>
    <div class="layui-tab-item">
        <div class="layui-upload">
          <div class="layui-upload-list">
           <div class="layui-anim" >
            <img style="width:240px;height:200px"  <?php include('template/kjctar/api_head_dir.php'); ?>  id="head_broad1">
             <button type="button" class="layui-btn layui-btn-danger  layui-btn-lg" id="upload_image">
                <i class="layui-icon">&#xe67c;</i>上传头像
             </button>
           </div>  
           <p id="up_image_success"></p>
          </div>
        </div> 
       
    </div>
  </div>
</div>

   


<script>
Highcharts.chart('tongji', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: '总体统计'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: '占比',
        data: [
         <?php
           $flag=0;
        foreach($view_userstat as $row){
            if($flag==0)
            {
             $flag=1;
              echo "['".$jresult[$row[0]]."',".$row[1]."]";
            } 
            else 
            echo ",['".$jresult[$row[0]]."',".$row[1]."]";
        }
        if($flag==0)
        {
          echo"['还没有提交',100]";
        }
      ?>
            
        ]
    }]
});
</script>

<script>
layui.use('upload', function(){
  var $ = layui.jquery
  ,upload = layui.upload;
  
  //普通图片上传
  var uploadInst = upload.render({
    elem: '#upload_image'
    ,url: 'template/kjctar/api_upimg.php'
    ,before: function(obj){
      //预读本地文件示例，不支持ie8
      obj.preview(function(index, file, result){
        $('#head_broad1').attr('src', result); //图片链接（base64）
        $('#head_broad2').attr('src', result); //图片链接（base64）
        $(window.parent.$('#head_broad3').attr('src', result)); //图片链接（base64）
        
      });
    }
    ,done: function(res){
      //如果上传失败
      if(res.code > 0){
        return layer.msg('上传失败');
      }
       $('#up_image_success').html('&nbsp;&nbsp;上传成功');
      //上传成功
    }
    ,error: function(){
      //失败状态，并实现重传
      var demoText = $('#up_image_success');
      demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
      demoText.find('.demo-reload').on('click', function(){
        uploadInst.upload();
      });
    }
  ,size: 400
  });
});
</script>


<?php
//if(isset($_SESSION[$OJ_NAME.'_'.'administrator']))
if(false)
{
?><table border=1><tr class=toprow><td>UserID<td>Password<td>IP<td>Time</tr>
<tbody>
<?php
$cnt=0;
foreach($view_userinfo as $row){
  if ($cnt)
    echo "<tr class='oddrow'>";
  else
    echo "<tr class='evenrow'>";
  for($i=0;$i<count($row)/2;$i++){
    echo "<td>";
    echo "\t".$row[$i];
    echo "</td>";
  }
  echo "</tr>";
  $cnt=1-$cnt;
}
?>
</tbody>
</table>
<?php
}
?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    

<script language="javascript" type="text/javascript" src="include/jquery.flot.js"></script>
<script type="text/javascript">
$(function () {
var d1 = [];
var d2 = [];
<?php
foreach($chart_data_all as $k=>$d){
?>
d1.push([<?php echo $k?>, <?php echo $d?>]);
<?php }?>
<?php
foreach($chart_data_ac as $k=>$d){
?>
d2.push([<?php echo $k?>, <?php echo $d?>]);
<?php }?>
//var d2 = [[0, 3], [4, 8], [8, 5], [9, 13]];
// a null signifies separate line segments
var d3 = [[0, 12], [7, 12], null, [7, 2.5], [12, 2.5]];
$.plot($("#submission"), [
{label:"<?php echo $MSG_SUBMIT?>",data:d1,lines: { show: true }},
{label:"<?php echo $MSG_AC?>",data:d2,bars:{show:true}} ],{
xaxis: {
mode: "time"
//, max:(new Date()).getTime()
//,min:(new Date()).getTime()-100*24*3600*1000
},
grid: {
backgroundColor: { colors: ["#fff", "#333"] }
}
});
});
//alert((new Date()).getTime());
</script>
</div>
 </body>
</html>
