<?php
//  require_once('../../include/db_info.inc.php');

$dir="template/kjctar/user_upload/";
$null="template/kjctar/images/404.jpg";

if(isset($path))
{
  $dir=$path.$dir;
  $null=$path.$null; 
}
//include("include/db_info.inc.php");
@session_start();
if(isset($_GET['ajax_dir']))
{
  $dir='../../'.$dir;
  $null='../../'.$null;
 $user=$_GET['ajax_dir'];
}
if(isset($user))
{
//  echo"gg";
   $arry=glob($dir.$user.".*");
  
                                if($arry!=FALSE)
                                {
                                        echo $arry[0].'?'.rand();
                                }
                                else
                                echo $null.'?'.rand();
}
else {
        if(isset($_SESSION[$OJ_NAME.'_'.'user_id']))
                        {
                                 $arry=glob($dir.$_SESSION[$OJ_NAME.'_'.'user_id'].".*");
                                if($arry!=FALSE)
                                {
                                        echo $arry[0].'?'.rand();
                                }
                                else 
                                  echo $null.'?'.rand();
                             }
                        else   echo $null.'?'.rand();
        }
?>


