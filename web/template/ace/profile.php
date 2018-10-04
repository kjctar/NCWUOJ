<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header("content-type:appddcation/javascript");
	if(isset($_SERVER['HTTP_REFERER']))$dir=basename(dirname($_SERVER['HTTP_REFERER']));
	else $dir="";
	if($dir=="discuss3") $path_fix="../";
	else $path_fix="";
	require_once("../../include/db_info.inc.php");
	if(isset($OJ_LANG)){
		require_once("../../lang/$OJ_LANG.php");
	}else{
		require_once("../../lang/en.php");
	}
    function checkmail(){
		global $OJ_NAME;
			
		$sql="SELECT count(1) FROM `mail` WHERE 
				new_mail=1 AND `to_user`=?";
		$result=pdo_query($sql,$_SESSION[$OJ_NAME.'_'.'user_id']);
		if(!$result) return false;
		$row=$result[0];
		$retmsg="<span id=red>(".$row[0].")</span>";
		
		return $retmsg;
	}
	$profile='';
		if (isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
				$sid=htmlentities($_SESSION[$OJ_NAME.'_'.'user_id'],ENT_QUOTES ,"UTF-8");
				$profile.= "<dd><a href='".$path_fix."userinfo.php?user=$sid'>$sid</a></dd>";
				if(
					(isset($OJ_EXAM_CONTEST_ID)&&$OJ_EXAM_CONTEST_ID>0)||
					(isset($OJ_ON_SITE_CONTEST_ID)&&$OJ_ON_SITE_CONTEST_ID>0)||
					(isset($OJ_MAIL)&&!$OJ_MAIL)
			  	){}else{
				$profile.= "<dd><a href=".$path_fix."modifypage.php>$MSG_USERINFO</a></dd>";
						$mail=checkmail();
						if ($mail)
							$profile.= "&nbsp;<dd><a  class='glyphicon glyphicon-envelope' href=".$path_fix."mail.php>$mail</a></dd>";
				}
        			$profile.="&nbsp;<dd><a href='".$path_fix."contest.php?my'><span id=red>$MSG_MY_CONTESTS</span></a></dd>";
        			$profile.="&nbsp;<dd><a href='".$path_fix."status.php?user_id=$sid'><span id=red>$MSG_MY_SUBMISSIONS</span></a></dd>";
                                
                                
				$profile.= "&nbsp;<dd><a href=".$path_fix."logout.php>$MSG_LOGOUT</a></dd>&nbsp;";
			}else{
                if ($OJ_WEIBO_AUTH){
				    $profile.= "<dd><a href=".$path_fix."login_weibo.php>$MSG_LOGIN(WEIBO)</a></dd>&nbsp;";
                }
                if ($OJ_RR_AUTH){
				    $profile.= "<dd><a href=".$path_fix."login_renren.php>$MSG_LOGIN(RENREN)</a></dd>&nbsp;";
                }
                if ($OJ_QQ_AUTH){
            $profile.= "<dd><a href=".$path_fix."login_qq.php>$MSG_LOGIN(QQ)</a></dd>&nbsp;";
                }
				$profile.= "<dd><a href=".$path_fix."loginpage.php>$MSG_LOGIN</a></dd>&nbsp;";
				if($OJ_LOGIN_MOD=="hustoj"){
					if(isset($OJ_REGISTER)&&!$OJ_REGISTER){
					}else{
						$profile.= "<dd><a href=".$path_fix."registerpage.php>$MSG_REGISTER</a></dd>&nbsp;";
					}
				}
			}
			if (isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'contest_creator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){
           $profile.= "<dd><a href=".$path_fix."admin/>$MSG_ADMIN</a></dd>&nbsp;";
			
			}
			if (isset($_SESSION[$OJ_NAME.'_'.'balloon'])){
           $profile.= "<dd><a href='".$path_fix."balloon.php'>$MSG_BALLOON</a></dd>&nbsp;";
			}
	 
		?>
document.write("<?php echo ( $profile);?>");
document.getElementById("profile").innerHTML="<?php echo  isset($sid)?$sid:$MSG_LOGIN  ?>";
