<?php require_once("admin-header.php");
if ($_SERVER['REQUEST_METHOD']=="POST"){
        require_once("../include/check_post_key.php");
}else{
        require_once("../include/check_get_key.php");

}
if (!(isset($_SESSION[$OJ_NAME.'_'.'administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
?>
<?php 
$plist="";
           sort($_POST['pid']);
           foreach($_POST['pid'] as $i){
                        if ($plist)
                                $plist.=','.intval($i);
                        else
                                $plist=$i;
           }
//echo "===".$plist;
if(isset($_POST['enable'])&&$plist){
        $sql="update problem set defunct='N' where problem_id in ($plist)";           
	pdo_query($sql);
}else if(isset($_POST['disable'])&&$plist){
        $sql="update problem set defunct='Y' where problem_id in ($plist)";           
	pdo_query($sql);
}else{


	$id=intval($_GET['id']);
	$sql="SELECT `defunct` FROM `problem` WHERE `problem_id`=?";
	$result=pdo_query($sql,$id);
	$row=$result[0];
	$defunct=$row[0];
	echo $defunct;

	if ($defunct=='Y') $sql="update `problem` set `defunct`='N' where `problem_id`=?";
	else $sql="update `problem` set `defunct`='Y' where `problem_id`=?";
	pdo_query($sql,$id) ;


}
?>
<script language=javascript>
	history.go(-1);
</script>
