 <?php
      require_once('../../include/db_info.inc.php');
      $sid=$_POST['sid'];
      $data = array();
      $count=0;

         $sql="select result from solution where solution_id=?";
         $result=pdo_query($sql,$sid);
         $row=$result[0];
         echo $row['result'];
 ?>

