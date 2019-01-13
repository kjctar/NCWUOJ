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

<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	 
  
 
  </head>
<head>
 
</head>
<body>
 




<body style="background-color:#FBFBFB">
<div  class="container" style="background-color:#FBFBFB" >
 <br>
           <div class="layui-card layui-anim layui-anim-scale"  style=" box-shadow: darkgrey 0px 0px 2px 1px;">
                <div class="layui-card-body" style="position:relative;">
				<?php if($user==$_SESSION[$OJ_NAME.'_'.'user_id']){?>
                   
				<div class="layui-btn-group" >
				
				  
				  <button id="mody" class="layui-btn layui-btn-primary layui-btn-sm">
					<i class="layui-icon">&#xe642;</i>
				  </button>
				  <button class="layui-btn layui-btn-primary layui-btn-sm" id="up" >
					<i  class="layui-icon">&#xe67c;</i>
				  </button>
				    <button class="layui-btn layui-btn-primary layui-btn-sm">
					  <a href="contest.php?my" ><i  class="fa fa-history"></i></a>
				  </button>
				</div>
				<?php } ?>

                  <div class="layui-row">
                    <div class="layui-col-md2" >
					<br>&nbsp;&nbsp;
				
        
                    <img  class="layui-circle" style=" width:100px;height:100px ;border:1px solid #dddddd;"
					src='<?php include('template/kjctar/api_head_dir.php'); ?>'    id="head_broad2">&nbsp;
                  
				   
				  
                    </div>
                <div class="layui-col-md10"  style=" font-size:small;">
               <br>
                <i class="fa fa-address-card-o fa-fw" style="color:gray;"></i><?php echo $user?>&nbsp;&nbsp;&nbsp;&nbsp;
				<i class="fa fa-bookmark  " style="color:#FFB800"></i> <font>排名 <?php echo $Rank?></font><br>
                <i class="fa fa-book fa-wheelchair"></i><?php echo $nick?>&nbsp;&nbsp;|&nbsp;
                <i class="fa fa-envelope fa-fw"  ></i>&nbsp;<?php echo $email?>&nbsp;&nbsp;|&nbsp;&nbsp;
                <i class="fa fa-institution fa-fw"></i>&nbsp;<?php echo $school?>
                
              <div style="width:100%; height:8px; border-top:1px solid #dddddd; clear:both;"></div>
                       <button  class="layui-btn layui-btn-xs layui-btn-normal"> 提交<span class="layui-badge layui-bg-gray"><a style='color:black' href='status.php?user_id=<?php echo $user?>'><?php echo $Submit?></a></span></button>
                   
                       <button  class="layui-btn layui-btn-xs"> 解决<span class="layui-badge layui-bg-gray"><a style='color:black' href='status.php?user_id=<?php echo $user?>&jresult=4'><?php echo $AC?></a></span></button>
                   
                   
                     
 
              
                  <?php
                  
                       
                      foreach($view_userstat as $row){
                        if($row[0]==4)
                        {
                            $colors='layui-btn-green';
                        }    
                        else if($row[0]==6)
                        {
                            $colors='layui-btn-danger';
                        }
                        else{
                            $colors='layui-bg-cyan';
                        }

                          echo "<button  class='layui-btn ".$colors." layui-btn-xs'>".$jresult[$row[0]]."<span class='layui-badge layui-bg-gray'><a style='color:black' href=status.php?user_id=$user&jresult=".$row[0]." >".$row[1]."</a></span></button>";
                        
                      }
                     
                  ?>
          
                </div>
                  
                </div>
             </div>
            <br>
            
         
        </div>
  
<div class="layui-card" style="box-shadow: darkgrey 0px 0px 2px 1px;">
<div class="layui-card-body">
   <div class="layui-row">
      <div class="layui-col-md8" >
       <div id="mystatus" class="layui-anim layui-anim-scale" style=" min-width: 300px;
        max-width: 800px;
        height: 250px;
        margin: 0 auto"> 
        </div>
      </div>
      <div class="layui-col-md4">
          <div  class="layui-anim layui-anim-scale" id="tongji" style="height:250px"></div>
      </div>
  </div>
</div>
</div>  
   <!-- <hr> 
      <div class="layui-card" >
          <div class="layui-card-header" style='background-color:#F0E68C'><strong>
          <span class="layui-badge layui-bg-green">Solved</span>&nbsp;&nbsp;
          <span class="layui-badge layui-bg-danger">Losed</span>&nbsp;&nbsp;
          <span class="layui-badge layui-bg-gray">No Submited</span></strong>
          </div>  
          <div class="layui-card-body" id="pro_list">
          
             <?php 
            $ac=array();
			
            function p($id,$c){
              if($c==1)
              $ac[$id]=1;
              else $ac[$id]=2; 
              //document.write("<a class='layui-badge layui-bg-green' href=problem.php?id="+id+">"+id+" </a>");

            }
            function printr($id)
            {                     
             
            }
            
             $sql="SELECT count(1) FROM `problem`";
              $result=pdo_query($sql);
              $row=$result[0];
              $sum= $row[0]+999;
              for($i=1000;$i<=$sum;$i++)
				{
					$ac[$i]=0;
				}
            $sql="SELECT `problem_id`,count(1) FROM `solution` WHERE `user_id`=? 
                AND problem_id in (select distinct problem_id from solution where `user_id`=? and result!=4) group by `problem_id` ORDER BY `problem_id` ASC";
            if ($result=pdo_query($sql,$user,$user)){ 
              foreach($result as $row)
                 $ac[$row[0]]=2;
            }
            $sql="SELECT `problem_id`,count(1) FROM `solution` WHERE `user_id`=? 
                AND problem_id in (select distinct problem_id from solution where `user_id`=? and result=4) group by `problem_id` ORDER BY `problem_id` ASC";
            if ($result=pdo_query($sql,$user,$user)){ 
              foreach($result as $row)
               $ac[$row[0]]=1;
            }
            
           
             for($i=1000;$i<=$sum;$i++)
             {
				 //echo $ac[$i]."  ";
                //printr($i);
				 /* if($ac[$i]=='1')
				  {
					echo"<a style='width:50px;' class='layui-badge layui-bg-green' href=problem.php?id=".$i.">".$i." </a>&nbsp;";
				  }
				  else if($ac[$id]==2)
					echo"<a style='width:50px;' class='layui-badge layui-bg-danger' href=problem.php?id=".$i.">".$i." </a>&nbsp;";
				  else echo"<a style='width:50px;' class='layui-badge layui-bg-gray' href=problem.php?id=".$i.">".$i." </a>&nbsp;";*/
             }
			
            ?>
         
        </div>
      </div>
-->

  
<?php

$chart_data_all= array();
$chart_data_ac= array();
for($i=6;$i>=0;$i--){
        $j = $i-1;
        $b = date('Y-m-d',strtotime("-$i day"));
        $e = date('Y-m-d',strtotime("-$j day"));
      //  echo $b."<br>".$e."<br>";
        $sql=   "SELECT count(*)  FROM `solution`  where `user_id`=? and `in_date`>=? and `in_date`< ? ";
       
        $result=pdo_query($sql,$user,$b,$e);//mysql_escape_string($sql));
        //echo $result[0][0]."<br>";
        $chart_data_all[]=$result[0][0];

        $sql=   "SELECT count(*)  FROM `solution`  where  `user_id`=? and `in_date`>=? and `in_date`< ? and `result`=4";
        $result=pdo_query($sql,$user,$b,$e);//mysql_escape_string($sql));
        $chart_data_ac[]=$result[0][0];
}
// $flag=0; for($i=0;$i<10;$i++){ if($flag==1) echo ","; echo $chart_data_all[$i]."gg"; $flag=1;}
?>

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
function bind()
{	
$('#head_broad1').attr('src', $('#head_broad2').attr('src'));
layui.use('upload', function(){
  var upload = layui.upload;
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
      spop({template:'<p class="spop-title">上传成功！</p>',
                        position:'top-left',
                        style:'success',
                        autoclose: 5000
                      });
      //上传成功
    }
    ,error: function(){
      //失败状态，并实现重传
      
    }
    ,size:400
  });
});
}
</script>
<script>

layui.use('layer', function(){ //独立版的layer无需执行这一句
  var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句
  $(document).on('click', '#mody', function() {
  //触发事件
 
                        var index = layer.open({
                        
                         type: 2 //此处以iframe举例
                        ,title: '<font style="font-size:small">'+$( this ).text()+'</font>'
                        ,area: ['60%', '80%']
                        ,shade: 0.6
                        ,maxmin: true
                        ,offset: '40px'
                        ,content: 'modifypage.php'
                        ,anim: 1
                        ,zIndex: layer.zIndex //重点1
                        ,success: function(layero){
                          layer.setTop(layero); //重点2
                        }
                
                });
                   
        });
});


layui.use('layer', function(){ //独立版的layer无需执行这一句
  var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句
  $(document).on('click', '#up', function() {
  //触发事件
   
                        var index = layer.open({
                        
                         type: 1 //此处以iframe举例
                        ,title: '限制为400k'
                        ,area: ['250px', '280px']
                        ,shade: false
                        ,offset: '-0px'
                        ,content: '<center><br><img id="head_broad1" style="width:150px;height:150px;border:1px solid #eeeeee" src="#" > <br> <br><button type="button" class="layui-btn layui-btn-danger  layui-btn-xs" id="upload_image"><i class="layui-icon">&#xe67c;</i>上传头像</button></center>'
                        ,anim: 2
                        ,zIndex: layer.zIndex //重点1
                        ,success: function(layero){
                          //layer.setTop(layero); //重点2
						   bind();
                        }
                
                });
                   
        });
});

function fresh()
{
  window.parent.hideifr();       
  location.reload();
  
}
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
    <?php  include("template/$OJ_TEMPLATE/js.php");?>	    



<script type="text/javascript">


Highcharts.chart('mystatus', {

    title: {
        text: '近期活动'
    },

    subtitle: {
        text: 'Source: kjctar'
    },
     xAxis: {
        categories: [<?php
                    for($i=6;$i>=0;$i--)
                    {
                      $d=strtotime("-".$i." days");
                      echo "'".date(" m-d ", $d)."'" ;
                      if($i>0) echo',';
                    }
                    ?>]
        

    },
    yAxis: {
        title: {
            text: '数量'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },
    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
          
        }
    },

    series: [{
        name: 'Submit',
        data: [<?php $flag=0; for($i=0;$i<7;$i++){ if($flag==1) echo ","; echo $chart_data_all[$i]; $flag=1;}?>]
    }, {
        name: 'Other',
        data: [<?php $flag=0; for($i=0;$i<7;$i++){ if($flag==1) echo ","; echo $chart_data_all[$i]-$chart_data_ac[$i]; $flag=1;}?>]
    }, {
        name: 'Accepted',
        data: [<?php $flag=0; for($i=0;$i<7;$i++){ if($flag==1) echo ","; echo $chart_data_ac[$i]; $flag=1;}?>]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>

</div>
 </body>
</html>
