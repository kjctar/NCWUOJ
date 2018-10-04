<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="../../favicon.ico">
<?php include("template/$OJ_TEMPLATE/css.php");?>	    
<title><?php echo $OJ_NAME?></title>
<script>
function hint()
{
layui.use('layer', function(){
  var layer = layui.layer;
  layer.ready(function(){
layer.msg('复制成功！', {icon: 6, time:1000 }); 
}); 
});          
}
layui.use('layer', function(){ //独立版的layer无需执行这一句
  var $ = layui.jquery, layer = layui.layer; //独立版的layer无需执行这一句
  $(document).on('click', '#ssr', function() {
  //触发事件
   
           
                        var pid=$( this ).attr("name");
                        var index = layer.open({
                        
                         type: 2 //此处以iframe举例
                        ,title: '<font style="font-size:small">'+$( this ).text()+'</font>'
                        ,area: ['60%', '100%']
                        ,shade: false
                        ,maxmin: true
                        ,offset: 'rt'
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
<style>
.tits{
	border-bottom:1px solid #009688; 
	border-left:4px solid #009688; 
	
}
</style>
</head>
<body onload="ajaxs(<?php echo $row['problem_id'];?>)">
 
    <?php include("template/test/nav.php");?>	
      
	 <div class="container">
	 <br>
    	<div class="layui-card" style="border:1px solid #d2d2d2">
		  <div class="layui-card-body" >
		  <div class="layui-row">
		   <div class="layui-col-md6">
		   <br>
		    
			   <?php if ($pr_flag) {
					echo "<strong style='font-size:30px;'>$id: " . $row['title']."</strong>&nbsp;";
				}else {
					$PID = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
					$id = $row['problem_id'];
					echo "<title>$MSG_PROBLEM " . $PID[$pid] . ": " . $row['title'] . " </title>";
					echo "<i style='color:#5FB878;font-size:30px;'>".$MSG_PROBLEM  . $PID[$pid] . ": " . $row['title']."</i>&nbsp;";
				}
					?>
					
		
		    <br> <br>
				<?php
				#Limit
		       
				echo "<span  class='layui-badge layui-bg-black'><i class='fa fa-clock-o'></i>&nbsp;$MSG_Time_Limit: " . $row['time_limit'] . "</span>";
				echo "&nbsp;&nbsp;";
				echo "<span  class='layui-badge layui-bg-black'><i class='fa fa-database'></i>&nbsp; $MSG_Memory_Limit: " . $row['memory_limit'] . " MB</span>";
				if ($row['spj']) {
					echo "&nbsp;&nbsp;";
					echo "<span style='font-size:30px;background-color:#393D49'; class='layui-badge '>Special Judge</span>";
				}
		           
			  
				#submited and Accepted
echo' <span  class="layui-badge layui-bg-black">'.$MSG_SUBMIT.'&nbsp;&nbsp;'.$row['submit'].'</span>';
echo' <span  class="layui-badge layui-bg-black">'. $MSG_SOVLED.'&nbsp;&nbsp;'.$row['accepted'].'</span>';
            echo'</div>';
            echo'<div class="layui-col-md6">';
			
			 if (!$pr_flag) {
				 $row['source']="标签已被屏蔽";
			 }
			 else if(strlen($row['source'])==0)
			 {
			 	$row['source']="暂无标签";
			 }
            
				 echo'<div class="layui-card">
					  <div class="layui-card-header" ><span class="layui-badge layui-bg-orange">标签</span></div>
					  <div class="layui-card-body">'.$row['source'].'
						
					  </div>
					</div>';
             
			 
				
				echo "<div class='layui-btn-group' >";
				if ($pr_flag) {
					echo "<button id='ssr'  class='layui-btn layui-btn-danger ' name='submitpage.php?flag=1&id=".$id."'><i class='fa fa-code'></i>&nbsp;$MSG_SUBMIT</button>";
				} else {
					echo "<button id='ssr'  class='layui-btn layui-btn-danger  ' name='submitpage.php?flag=1&cid=".$cid."&pid=".$pid."&langmask=".$langmask."'><i class='fa fa-code'></i>&nbsp;$MSG_SUBMIT</button>";
				}
				echo "<a class='layui-btn ' href='problemstatus.php?id=".$row['problem_id']."'><i class='fa fa-legal'></i>&nbsp;$MSG_STATUS</a>";
				echo "<a class='layui-btn layui-btn-primary  ' href='bbs.php?pid=".$row['problem_id']."$ucid'><i class='fa fa-commenting'></i>&nbsp;$MSG_BBS</a>";
				if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])){
					require_once("include/set_get_key.php");
					?>
					[<button id='ssr' class='layui-btn layui-btn-primary  '  name="admin/problem_edit.php?id=<?php echo $id?>&getkey=<?php echo $_SESSION[$OJ_NAME.'_'.'getkey']?>" ><i class='fa fa-pencil'></i>&nbsp;Edit</button>]
					[<button id='ssr' class='layui-btn layui-btn-primary  '  name="admin/phpfm.php?frame=3&pid=<?php echo $id?>" ><i class='fa fa-server'></i>&nbsp;TestData</button>]
					<?php
					
					}
					

			?>
			</div>
			</div>
		   </div>
		  </div>
		</div>

      <div class="grid-demo grid-demo-bg1" style="padding:0px 0px;">  
    <?php
        echo '<div class="layui-card " style="border:1px solid #d2d2d2"><div class="layui-card-header tits"  >'.$MSG_Description.'</div><div class="layui-card-body">';
        echo "" . $row['description'] . "</div></div>";
     
       
        echo ' <div class="layui-card" style="border:1px solid #d2d2d2"><div class="layui-card-header tits" >'.$MSG_Input.'</div><div class="layui-card-body">';
        echo  $row['input'].'</div></div>';
   
        
        echo ' <div class="layui-card" style="border:1px solid #d2d2d2"><div class="layui-card-header tits" >'.$MSG_Output.'</div><div class="layui-card-body">';
        echo  $row['output'].'</div></div>';
 
        
        $sinput = str_replace("<", "&lt;", $row['sample_input']);
        $sinput = str_replace(">", "&gt;", $sinput);
        $soutput = str_replace("<", "&lt;", $row['sample_output']);
        $soutput = str_replace(">", "&gt;", $soutput);
        
        if (strlen($sinput)) {
            echo "<div class='layui-card' style='position:relative;border:1px solid #d2d2d2'><div class='layui-card-header tits' >  $MSG_Sample_Input </div>
			<div class='layui-card-body' >";
            
            echo "<pre   class='layui-elem-quote'>".($sinput)."</pre>
			</div><button style='position:absolute;right:5px;top:5px;' class='layui-btn layui-btn-sm layui-btn-normal' type='button' onClick='copy_in()' >
			复制</div>";
          
        }
        
        if (strlen($soutput)) {
            echo "<div class='layui-card'  style='position:relative;border:1px solid #d2d2d2'><div class='layui-card-header tits' >  $MSG_Sample_Output  </div>
			<div  class='layui-card-body'>";
            
            echo "<pre class='layui-elem-quote'>".($soutput)."</pre>
				
			</div> <button style='position:absolute;right:5px;top:5px;' class='layui-btn layui-btn-sm layui-btn-normal' type='button' onClick='copy_out()' >
			复制</div>";
            
              if ($pr_flag || true) { 
            echo "<div class='layui-card' style='border:1px solid #d2d2d2'><div class='layui-card-header 'style='background-color:#F0E68C' > $MSG_HINT  </div><div class='layui-card-body'>";

            echo nl2br($row['hint'])."</div></div>";

        }

        
        }
        echo"<center>";
		if ($pr_flag) {
					echo "<button id='ssr'  class='layui-btn layui-btn-danger ' name='submitpage.php?flag=1&id=".$id."'>$MSG_SUBMIT</button>";
				} else {
					echo "<button id='ssr'  class='layui-btn layui-btn-danger  ' name='submitpage.php?flag=1&cid=".$cid."&pid=".$pid."&langmask=".$langmask."'>$MSG_SUBMIT</button>";
				}
				echo"</center>"
    ?>

  </div>
  
 <br><br>
   

</div>
<!--<div id="rank"></div>-->

   

      <?php include("template/$OJ_TEMPLATE/js.php");?>
   
   <script type="text/javascript">
	function copy_in()
	{
	var Url2=document.getElementById("input");
	Url2.select(); // 选择对象
	document.execCommand("Copy"); // 执行浏览器复制命令
          hint();	
	}
	function copy_out()
	{
	var Url2=document.getElementById("output");
	Url2.select(); // 选择对象
	document.execCommand("Copy"); // 执行浏览器复制命令
	 hint();
	}
	</script>
    <script>
  
    </script>
</body>
<?php
echo"
<textarea style='position:fixed;z-index:-999' id='input'>".($sinput)."</textarea>
 <textarea style='position:fixed;z-index:-999' id='output'>".($soutput)."</textarea>";
 ?>
</html>
