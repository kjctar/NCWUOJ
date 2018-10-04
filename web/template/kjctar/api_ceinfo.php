<?php
  require_once('../../include/db_info.inc.php');
function is_valid($str2){
    $n=strlen($str2);
    $str=str_split($str2);
    $m=1;
    for($i=0;$i<$n;$i++){
        if(is_numeric($str[$i])) $m++;
    }
    return $n/$m>3;
}

      $sid=$_POST['sid'];
   $sql="SELECT `error` FROM `compileinfo` WHERE `solution_id`=?";
        $result=pdo_query($sql,$sid);
         $row=$result[0];
        if($row&&is_valid($row['error']))
                $view_reinfo= htmlentities(str_replace("\n\r","\n",$row['error']),ENT_QUOTES,"UTF-8");
                echo $view_reinfo;
?>
