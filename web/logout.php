<?php session_start();
unset($_SESSION[$OJ_NAME.'_'.'user_id']);
session_destroy();
echo'<script> parent.location.href="index.php?'.rand().'"   </script>';
//header("Location:../../index.php");
?>
