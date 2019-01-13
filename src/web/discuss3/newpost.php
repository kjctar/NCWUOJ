<?php
	require_once("oj-header.php");

	echo "<title>HUST Online Judge WebBoard >> New Thread</title>";
	if (!isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
		echo "<a href=../loginpage.php>Please Login First</a>";
		require_once("../template/$OJ_TEMPLATE/discuss.php");
		exit(0);
	}
	if(isset($_GET['pid']))
		$pid=intval($_GET['pid']);
	else	
		$pid="";
	if(isset($_GET['cid'])){
		$cid=intval($_GET['cid']);
		if($pid>0){
		  $pid=pdo_query("select num from contest_problem where problem_id=? and contest_id=?",$pid,$cid)[0][0];
		  $pid=$PID[$pid];
		}
	}else{
		$cid=0;
	}

	
?>

<br><br>
<h2 style="margin:0px 10px"><?php if (array_key_exists('cid',$_REQUEST) && $_REQUEST['cid']!='') echo ' For Contest '.intval($_REQUEST['cid']);?></h2>
<form action="post.php?action=new" method=post>
<input type=hidden name=cid value="<?php if (array_key_exists('cid',$_REQUEST)) echo intval($_REQUEST['cid']);?>">
<div class="layui-form-item">
    <label class="layui-form-label">题目</label>
    <div class="layui-input-inline">
      <input  name=pid type="text"   placeholder="题目ID" autocomplete="off" class="layui-input" value="<?php echo $pid;?>">
    </div>
<div class="layui-form-mid layui-word-aux">请输入合法题目ID，若无关讨论可不填</div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">标题</label>
    <div class="layui-input-inline">
      <input   name=title type="text"  required lay-verify="required" placeholder="" autocomplete="off" class="layui-input" >
    </div>
<div class="layui-form-mid layui-word-aux"></div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">内容</label>
   <div class="layui-input-block" style="margin-left: 80px;">
    <div id="reptext" ></div>
     <textarea id="Content"  required lay-verify="required" name=content style="display:none;border:1px solid #dddddd; width:700px; height:400px; font-size:75%; margin:0 0px; padding:10px"></textarea>
  </div>
<div class="layui-form-mid layui-word-aux"></div>
</div>
<center><input class="layui-btn" type="submit" style="margin:5px 10px" value="Submit"></input></center>

</form>


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
			 'code'  // 插入代码
		   ]
		var $text1 = $('#Content')
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
	    $('div.w-e-text-container').css("height","300px");
    </script>
	



<script>
function reply(rid,floor){
   var origin=$("#post"+rid).text();
   console.log(origin);
   origin="回复 :"+floor+" 楼  "+origin+"\n\n";
  // $("#reptext").text(origin);
   $("#reptext").focus();
}
</script>

<?php require_once("../template/$OJ_TEMPLATE/discuss.php")?>
