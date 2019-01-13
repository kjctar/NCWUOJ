<?php 
    require_once("./include/db_info.inc.php");
    require_once('./include/setlang.php');
/*    $vcode="";
    if(isset($_POST['vcode']))	$vcode=trim($_POST['vcode']);
    if($OJ_VCODE&&($vcode!= $_SESSION[$OJ_NAME.'_'."vcode"]||$vcode==""||$vcode==null) ){
		echo "<script language='javascript'>\n";
		echo "alert('Verify Code Wrong!');\n";
		echo "history.go(-1);\n";
		echo "</script>";
		exit(0);
    }*/
    $view_errors="";
	require_once("./include/login-".$OJ_LOGIN_MOD.".php");
    $user_id=$_POST['user_id'];
	$password=$_POST['password'];
   if (get_magic_quotes_gpc ()) {
        $user_id= stripslashes ( $user_id);
        $password= stripslashes ( $password);
   }
    $sql="SELECT `rightstr` FROM `privilege` WHERE `user_id`=?";
    $login=check_login($user_id,$password);
    if ($login)
    {
                
		$_SESSION[$OJ_NAME.'_'.'user_id']=$login;
		$result=pdo_query($sql,$login);
		foreach ($result as $row){
			$_SESSION[$OJ_NAME.'_'.$row['rightstr']]=true;
                    }
                 echo '1';
		//echo "<script language='javascript'>\n";
		//if($OJ_NEED_LOGIN)  echo "history.go(-1);\n"; //echo'no';
		//else  echo "history.go(-1);\n";
		 //header("Location:../../index.php");
                //	echo 'ok';
		//echo "</script>";
	}else{
		if($view_errors){
                        echo $view_errors;
		       	//require("template/".$OJ_TEMPLATE."/error.php");
		}else{	
                        echo 'UserName or Password Wrong!';
			//echo "<script language='javascript'>\n";
	//		echo "alert('UserName or Password Wrong!');\n";
	//		echo "history.go(-1);\n";
			//echo "</script>";
		}
	}
?>
