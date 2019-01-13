<?php
include("../../include/db_info.inc.php");
$dir="user_upload/";
// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
//echo $_FILES["file"]["size"];
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 2004800)   // 小于 200 kb
&& in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
         //echo "6";
    }
    else
    {

//   $arr = array('code' => 0, 'msg' => '');
  // echo json_encode($arr);
     @session_start();
      if(!isset($_SESSION[$OJ_NAME.'_'.'user_id']))
        {

            //rename("upload/" . $_FILES["file"]["name"],"upload/gg.$extension");
        }
      else {
      	  $name=$dir.$_SESSION[$OJ_NAME.'_'.'user_id'];
          unlink($name.".jpg");
          unlink($name.".jpeg");
          unlink($name.".gif");
          unlink($name.".png");

          $name=$name.".$extension";

          move_uploaded_file($_FILES["file"]["tmp_name"],  $name);
          $arr = array('code' => 0, 'msg' => '');
          echo json_encode($arr);

    
         } 

    }
}
else
{
  //  echo "非法的文件格式------".$_FILES["file"]["name"];
}
?>
                                            
