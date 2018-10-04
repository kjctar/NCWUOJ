<?php
	require_once("oj-header.php");
	echo "<title>HUST Online Judge WebBoard</title>";
	$tid=intval($_REQUEST['tid']);
        if(isset($_GET['cid']))$cid=intval($_GET['cid']);	
	$sql="SELECT t.`title`, `cid`, `pid`, `status`, `top_level` FROM `topic` t left join contest_problem cp on cp.problem_id=t.pid   WHERE `tid` = ? AND `status` <= 1";
//	echo $sql;
	//exit();
	$result=pdo_query($sql,$tid) ;
	$rows_cnt = count($result) ;
	$row= $result[0];
	if($row['cid']>0) $cid=$row['cid'];
	if($row['pid']>0 && $row['cid'] >0 ) {
		$pid=pdo_query("select num from contest_problem where problem_id=? and contest_id=?",$row['pid'],$row['cid'])[0][0];
		$pid=$PID[$pid];
	}else{
		$pid=$row['pid'];
	}
	$isadmin = isset($_SESSION[$OJ_NAME.'_'.'administrator']);
?>

<div style="text-align:left;font-size:80%;float:left;">
 <a  class='layui-btn  layui-btn-sm' href="newpost.php<?php if ($cid) echo "?cid=$cid&pid=".$row['pid']; ?>"><i class="fa fa-comments-o"></i>&nbsp;我要发帖</a>
</div>
<?php if ($isadmin){
	?><div  class="layui-btn-group" style="float:right"> 
	<?php 
	   $adminurl = "threadadmin.php?target=thread&tid={$tid}&action=";
	  if ($row['top_level'] == 0) 
	  	 echo "<a class='layui-btn  layui-btn-sm' href=\"{$adminurl}sticky&level=3\">置顶</a> 
	  	       <a class='layui-btn  layui-btn-sm' href=\"{$adminurl}sticky&level=2\">置中</a> 
	  	       <a class='layui-btn  layui-btn-sm' href=\"{$adminurl}sticky&level=1\">置底</a> "; 
	  else 
	  	 echo "<a class='layui-btn  layui-btn-sm' href=\"{$adminurl}sticky&level=0\">归位</a> ";
	?> | 
	<?php 
	   if ($row['status'] != 1) 
	   	 echo (" <a class='layui-btn  layui-btn-sm' href=\"{$adminurl}lock\">锁帖</a> "); 
	   else 
	   	 echo("  <a class='layui-btn  layui-btn-sm' href=\"{$adminurl}resume\">解锁</a> ");
	?> | 
	<?php 
	     echo (" <a class='layui-btn  layui-btn-sm' href=\"{$adminurl}delete\">删除</a> ");
	?>
	</div>
	<?php }
?>
<br>
<br>


<div >
<blockquote class="layui-elem-quote">
	<a href="discuss.php<?php if ($row['pid']!=0 && $row['cid']!=null) echo "?pid=".$row['pid']."&cid=".$row['cid'];
	else if ($row['pid']!=0) echo"?pid=".$row['pid']; else if ($row['cid']!=null) echo"?cid=".$row['cid'];?>">
	<?php if ($row['pid']!=0) echo "Problem $pid"; else echo "主板页";?></a> //
	 <?php echo nl2br(htmlentities($row['title'],ENT_QUOTES,"UTF-8"));?>
</blockquote>
  
     
		<?php
			$sql="SELECT `rid`, `author_id`, `time`, `content`, `status` FROM `reply` WHERE `topic_id` = ? AND `status` <=1 ORDER BY `rid` LIMIT 30";
			$result=pdo_query($sql,$tid) ;
			$rows_cnt = count($result);
			$cnt=0;
		
	for($i=0;$i<count($result);$i++){
				$row=$result[$i];
				$url = "threadadmin.php?target=reply&rid=".$row['rid']."&tid={$tid}&action=";
				if(isset($_SESSION[$OJ_NAME.'_'.'user_id'])) $isuser = strtolower($row['author_id'])==strtolower($_SESSION[$OJ_NAME.'_'.'user_id']);
				else $isuser=false;
		?>

		   <hr>
				
		     <div style=" margin:0px 2px">
		       <?php $user=$row['author_id']; $path="../"; ?>

		       <img  class="layui-circle" style=" width:60px;height:60px ;border:1px solid #dddddd;"  src="<?php include('../template/kjctar/api_head_dir.php');?>" >&nbsp;&nbsp;
		            <a id='<?php echo "post".$row['rid']; ?>' style="font-size:15px;"href="../userinfo.php?user=<?php echo $row['author_id']?>"><?php echo $row['author_id']; ?> </a>
		             &nbsp;&nbsp;  <font style="text-align:right;color:gray;font-size:xx-small;"><?php echo $row['time']; ?>&nbsp;&nbsp;&nbsp;<?php echo $i+1;?>楼</font>
                     
		     </div>
                      
		         
		



				<!---                            内容                              -->

				 <div  style="border:1px solid #eeeeee;text-align:left; clear:both; margin:0px 0px 0px 70px;" class="layui-card"   >
                    <div class="layui-card-body">
					<?php	if ($row['status'] == 0) echo "<font  style=' word-wrap:break-word;
    overflow:hidden;
    word-break:break-all;
'>".$row['content']."</font>";
							else {
								if (!$isuser || $isadmin)echo "<div style=\"border-left:10px solid gray\"><font color=red><i>Notice : <br>This reply is blocked by administrator.</i></font></div>";
								if ($isuser || $isadmin) echo nl2br(htmlentities($row['content'],ENT_QUOTES,"UTF-8"));
							}
					?>
				   </div>
				</div>
				<br>
			<div style="margin:0px 0px 0px 75px;" >
			  <a href='#reptext' onclick="reply(<?php echo $row['rid'];?>,<?php echo $i+1;?>);">
			  <i class="fa fa-commenting-o">&nbsp;回复</i></a> 
		  	   <?php if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])) {?>  
				<span>| <?php
				       if ($row['status']==0) 
				             echo "<a href='".$url."disable '><i class='fa fa-low-vision'></i>&nbsp;屏蔽此回复";
					    else echo "<a href='".$url."resume '><i class='fa fa-unlock-alt'></i>&nbsp;解锁次回复";?> </a> 
				</span>
				
				<?php } ?>
			  <?php if ($isuser || $isadmin) echo "| <a href=".$url."delete ><i class='fa fa-trash-o'></i>&nbsp;删除</a>";
					?>
			</div>
		

		<?php
		
			}
		?>
	
	


<hr>


    <?php if (isset($_SESSION[$OJ_NAME.'_'.'user_id'])){?>
	<form action="post.php?action=reply" method=post>
	
	<input  type=hidden name=tid value=<?php echo $tid;?>>
	<div><textarea   id="replyContent" name=content style="display:none;border:1px solid #00a381 ; width:60%; height:120px; font-size:75%;margin:0 10px; padding:10px"></textarea></div>
	 <div id="reptext" style="margin:0 60px;width:70%;"></div>
	<input  class="layui-btn layui-btn-primary"  type="submit" style="margin:5px 60px" value="Submit"></input>
	</form>
	<br><br>
	
    
   

    <script type="text/javascript" src="wang/wangEditor.min.js"></script>
    <script type="text/javascript">
        var E = window.wangEditor
        var editor = new E('#reptext')
          editor.customConfig.fontNames = [
			'宋体',
			'微软雅黑',
			'Arial',
			'Tahoma',
			'Verdana'
		]
        editor.customConfig.lang = {
            '设置标题': 'title',
            '正文': 'p',
            '链接文字': 'link text',
            '链接': 'link',
            '上传图片': 'upload image',
            '上传': 'upload',
            '创建': 'init'
        }
         editor.customConfig.menus = [
		     'foreColor',  // 文字颜色
			 'link',  // 插入链接
			'emoticon',  // 表情
			'image',  // 插入图片
			 'code',  // 插入代码
		   ]
		var $text1 = $('#replyContent')
        editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $text1.val(html)
        }
		 editor.customConfig.emotions = [
			{
				// tab 的标题
				title: '默认',
				// type -> 'emoji' / 'image'
				type: 'image',
				// content -> 数组
				content: [
					{
						alt: '[坏笑]',
						src: 'http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/50/pcmoren_huaixiao_org.png'
					},
					{
						alt: '[舔屏]',
						src: 'http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/40/pcmoren_tian_org.png'
					}
				]
			},
			{
				// tab 的标题
				title: 'emoji',
				// type -> 'emoji' / 'image'
				type: 'image',
				// content -> 数组
				content: [
					{
						alt: '[吃瓜]',
						src: 'http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/01/2018new_chigua_org.png'
					},
					{
						alt: '[舔屏]',
						src: 'http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/40/pcmoren_tian_org.png'
					}
				]
			}
		]
        editor.create();
	    $('div.w-e-text-container').css("height","200px");
    </script>
	<?php }
	?>



<script>
function reply(rid,floor){
   var origin=$("#post"+rid).text();
   console.log(origin);
   origin="回复 :"+floor+" 楼  "+origin+"\n\n";
   editor.txt.html(origin);
   //$("#reptext").text(origin);
 //  $("#rreplyContent").focus();
}
</script>

<?php require_once("../template/$OJ_TEMPLATE/discuss.php")?>
