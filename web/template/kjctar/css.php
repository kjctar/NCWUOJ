<?php 

	$dir=basename(getcwd());
	if($dir=="discuss3"||$dir=="admin") $path_fix="../";
	else $path_fix="";
?>
	<link rel="stylesheet" href="<?php echo $path_fix."template/$OJ_TEMPLATE/"?>layui/css/layui.css">
<script src="<?php echo $path_fix."template/$OJ_TEMPLATE/"?>layui/layui.js"></script> 
	<link rel="stylesheet" type="text/css" href="<?php echo $path_fix."template/$OJ_TEMPLATE/"?>css/default.css">
<!--	<link rel="stylesheet" href="<?php echo $path_fix."template/$OJ_TEMPLATE/"?>css/style.css"> 
	<script src="js/modernizr.js"></script> --><!-- Modernizr -->
<!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="<?php echo $path_fix."template/$OJ_TEMPLATE/"?>bootstrap.min.css">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<?php if(!isset($OJ_FLAT)||!$OJ_FLAT){?>
<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<link rel="stylesheet" href="<?php echo $path_fix."template/$OJ_TEMPLATE/"?>bootstrap-theme.min.css">
<?php }?>
<link rel="stylesheet" href="<?php echo $path_fix."template/$OJ_TEMPLATE/$OJ_CSS"?>">
	<link href="<?php echo"template/$OJ_TEMPLATE/";?>pop/spop.css" rel="stylesheet">
		<!-- Even better, SamallPop is made with scss,
		     @import to your style.scss -->
		<script src="<?php echo"template/$OJ_TEMPLATE/";?>pop/spop.js"></script>
<link rel="stylesheet" href="<?php echo $path_fix."template/$OJ_TEMPLATE/"?>katex.min.css">
<link rel="stylesheet" href="<?php echo $path_fix."template/$OJ_TEMPLATE/"?>mathjax.css">
<script src="<?php echo $path_fix."template/$OJ_TEMPLATE/"?>jquery.min.js"></script>
