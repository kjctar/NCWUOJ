<?php
$view_news="";
	$sql=	"select * "
			."FROM `news` "
			."WHERE `defunct`!='Y'"
			."ORDER BY `importance` ASC,`time` DESC "
			."LIMIT 50";
	$result=pdo_query($sql);//mysql_escape_string($sql));
	if (!$result){
		$view_news= "<h3>No News Now!</h3>";
	}else{
		
		$index=1;
		$hidden="block";
		foreach ($result as $row){
			
			$view_news.= ' <li  class="layui-timeline-item">
							<i   id="n'.$index.'" style="color:#007bbb" class="layui-icon layui-icon-note"></i>
							<font style="font-size:15px;font-weight:bold;color:#8d6449" id="n'.$index.'"  class="layui-timeline-title">'.$row['title'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="color:gray;font-size:x-small">作者:'.$row['user_id'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['time'].'</font></font>
							<div class="layui-timeline-content layui-text">
							    
                                <p style="display:'.$hidden.'"  id="cn'.$index.'" > '.$row['content'].'  </p>
							</div>
						  </li>';
			$index++;
			$hidden="none";	 
		}
		
	}

$chart_data_all= array();
$chart_data_ac= array();
for($i=10;$i>=0;$i--){
        $j = $i-1;
        $b = date('Y-m-d',strtotime("-$i day"));
        $e = date('Y-m-d',strtotime("-$j day"));
      //  echo $b."<br>".$e."<br>";
        $sql=   "SELECT count(*)  FROM `solution`  where  `in_date`>=? and `in_date`< ? ";
       // echo $sql."<br>";
        $result=pdo_query($sql,$b,$e);//mysql_escape_string($sql));
      //  echo $result[0][0]."<br>";
        array_push($chart_data_all,array($result[0][0]));

        $sql=   "SELECT count(*)  FROM `solution`  where  `in_date`>=? and `in_date`< ? and `result`=4";
        $result=pdo_query($sql,$b,$e);//mysql_escape_string($sql));
       // echo $result[0][0]."<br>";
        array_push($chart_data_ac,array($result[0][0]));

}

?>

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
	<?php// include("template/$OJ_TEMPLATE/js.php");?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	

<style>
  .rad{
		border-radius:25px;
		-moz-border-radius:25px; /* 老的 Firefox */
		position:relative;
		border:1px solid #dddddd;
  }
</style>
  </head>
    
  <body>

<script language="javascript" type="text/javascript" src="topstyle.js"></script>
  <?php //include("template/$OJ_TEMPLATE/js.php");?>
    <div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
<div class="layui-row">
    <div class="layui-col-md8 layui-anim layui-anim-scale">
		
		 <br><strong style="color:#895b8a"><h4>OJ最近评测直观图</h4>  </strong>
	      <div style="height:0px;border:1px solid #895b8a"> </div><br>
		<?php include("template/kjctar/cs.php");?>
		
	
		
		<br><strong style="color:#009688"><h4>新闻大事件</h4>  </strong>
	      <div style="height:0px;border:1px solid #009688"> </div><br>
		  <div style="padding:10px 10px;background-color:white">
				<ul  id="news" class="  layui-anim layui-anim-scale" layui-timeline">
				   <?php echo $view_news; ?>
				</ul>
		  </div>
	 
    </div>
    <div  class="layui-col-md4">
 
	  <div style="margin-left:20px">
	  <br>
	      <strong style="color:#FFB800"><h4>封神榜  </h4></strong>
	      <div   style="height:0px;border:1px solid #FFB800"> </div>
		       <br>
		  <div id="r1"  style="margin-left:10px" ></div>
		   
		  <br><strong style="color:#FFB800"><h4>月榜</h4>  </strong>
	      <div style="height:0px;border:1px solid #FFB800"> </div>
		       <br>
	      <div id="r2"  style="margin-left:10px" > </div>
		  
		  <br><strong style="color:#FFB800"><h4>周榜 </h4> </strong>
	      <div style="height:0px;border:1px solid #FFB800"> </div>
		     <br>
		  <div id="r3"  style="margin-left:10px"></div>
		   <br><a href="ranklist.php"><center style="color:#FFB800">更多排名>> </center></a>
     </div>
	 
    </div>
  </div>
   
<br>






 
		 
		




<script>
$(document).ready(function(){
	$("#news li font").click(function(){
		
		var index="#c"+$(this).attr('id');
		$(index).slideToggle("slow");
		
	});
});
$(document).ready(function(){
	$("#news li i").click(function(){
		
		var index="#c"+$(this).attr('id');
			$(index).slideToggle();
		
	});
});
</script>
<script>

layui.use('element', function(){
  var element = layui.element;
  

});
function get_rank(scope,rid)
{
	
var rank_url="ranklist.php?ajax_data=1";
if(scope!='')
{
	rank_url='ranklist.php?ajax_data=1'+'&scope='+scope;
}	

$.ajax({
	  type:'get',
	  url:rank_url,
	  dataType: 'json',
	  success:function(rank,status)
	  {
		  
			 if(status == 'success')
			 {
				count=rank.length;
			   var i=0;
			   colors=Array('#FFB800','#c0c0c0','#DD7907','#2F4056');
				while(i<4)
				{
					 
					  var src='template/kjctar/api_head_dir.php?ajax_dir='+rank[i][0];
					  $.ajax({
						  type:'get',
						  url:'template/kjctar/api_head_dir.php?ajax_dir='+rank[i][0],
						  async: false,
						  success:function(msg,status)
						  {
							    
								 if(status == 'success')
								 {
								    
								    document.getElementById(rid).innerHTML+="<div class='layui-anim layui-anim-scale layui-card rad'><img  class='layui-circle' style='width:50px;height:50px ;border:1px solid #dddddd;' src='"+msg+"'>&nbsp;<a style='font-weight:bold;' href='userinfo.php?user="+rank[i][0]+"'>"+
									rank[i][0]+"</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font  style='font-weight:bold;font-size:x-small; color:green'>Accept:&nbsp;"+rank[i][2]+
									"题</font><i class='layui-icon layui-icon-code-circle' style='font-weight:bold;position:absolute;top:5px;right:10px; font-size: 30px; color:"+colors[i]+";'></i>  </div>";
									
								 }
						  }
					}); 

				  i++;
				 //alert(rank[i].filename+"--"+rank[i].time+rank[i].memory+rank[i].rank); 
               
				}
			 }
	  }
}); 
}
get_rank('','r1');    
get_rank('m','r2'); 
get_rank('w','r3');                                                 
</script>
	
    </div> <!-- /container -->

<?php include("template/$OJ_TEMPLATE/js.php");?>


  </body>
</html>

