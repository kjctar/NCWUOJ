<?php
    require_once('./include/db_info.inc.php');
    require_once('./include/const.inc.php');
    require_once('./include/memcache.php');
	require_once('./include/setlang.php');
	$view_title=$MSG_SUBMIT;
 if (!isset($_SESSION[$OJ_NAME.'_'.'user_id'])){

	$view_errors= "<a href=loginpage.php>$MSG_Login</a>";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
//	$_SESSION[$OJ_NAME.'_'.'user_id']="Guest";
 }
if ($_SERVER['REQUEST_METHOD']=="POST"){
	require_once("include/check_post_key.php");
}
if(isset($_SESSION[$OJ_NAME.'_'.'balloon'])){
	$school=pdo_query("select school from users where user_id=?",$_SESSION[$OJ_NAME."_user_id"])[0][0];
	$cid=intval($_GET['cid']);
	if($cid==0) $cid=1000;
	
		if(isset($_GET['id'])){
			$id=intval($_GET['id']);
			pdo_query("update balloon set status=1 where balloon_id=?",$id);
		}
		if(isset($_POST['clean'])){
			pdo_query("delete from balloon where cid=? and user_id like ?",$cid,"$school%");
		}
		
		$sql="select * from solution where result=4 and contest_id=? and user_id like ? and solution_id not in (select sid from balloon where cid=?) order by solution_id;";
		$result=pdo_query($sql,$cid,"$school%",$cid);
	        foreach($result as $row){
		     $user_id=$row['user_id'];
		     $sid=$row['solution_id'];
		     $pid=$row['num'];
		     $sql="select balloon_id from balloon where user_id=? and cid=? and pid=?";
			//echo $sql;
		     if(count(pdo_query($sql,$user_id,$cid,$pid))==0){
			$sql="insert into balloon(user_id,sid,cid,pid,status) value(?,?,?,?,0)";
//			echo $sql."<br>".$user_id." ".$sid." ".$cid." ".$pid;
			pdo_query($sql,$user_id,$sid,$cid,$pid);
		     }		     
		}	
		$view_balloon=Array();
		$result=pdo_query("select * from balloon where cid= ? and  user_id like ? order by status,balloon_id limit 50",$cid,"$school%");
		$i=0;
		foreach ($result as $row){
			$view_balloon[$i]=Array();
			$view_balloon[$i][0]=$row['balloon_id'];
			$view_balloon[$i][1]=$row['user_id'];
			$view_balloon[$i][2]= "<font color='".$ball_color[$row['pid']]."'>";
			 $view_balloon[$i][2].=$ball_name[$row['pid']];
			 $view_balloon[$i][2].="</font>";
			if($row['status']==1)$view_balloon[$i][3].="<span class='btn btn-success'>$MSG_BALLOON_DONE</span>";
			else $view_balloon[$i][3].="<span class='btn btn-danger'>$MSG_BALLOON_PENDING</span>";
			$view_balloon[$i][4]="<a class='btn btn-info' href='balloon_view.php?id=".$row['balloon_id']."' target='_self'>$MSG_PRINTER</a>";
			$view_balloon[$i][4].="<a class='btn btn-primary'  href='balloon.php?id=".$row['balloon_id']."&cid=$cid' target='_self'>$MSG_PRINT_DONE</a>";
			
			$i++;
		}
		require("template/".$OJ_TEMPLATE."/balloon_list.php");
		exit(0);

 }else{

	$view_errors= "$MSG_BALLOON not available!";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
 }
/////////////////////////Template
/////////////////////////Common foot
?>

