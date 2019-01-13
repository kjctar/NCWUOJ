 <?php
      require_once('../../include/db_info.inc.php'); 
      $sid=$_POST['sid'];
      	 $sql="select * from testpoint where solution_id=?";
      	 $result=pdo_query($sql,$sid);
         echo json_encode($result);
      
 ?>
