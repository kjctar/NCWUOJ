<html>
<head>
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  <meta http-equiv="Content-Language" content="zh-cn">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Contest Add</title>
</head>
<hr>

<?php 
  require_once("../include/db_info.inc.php");
  require_once("../lang/$OJ_LANG.php");
  require_once("../include/const.inc.php");
  require_once("admin-header.php");
  if(!(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'contest_creator']))){
    echo "<a href='../loginpage.php'>Please Login First!</a>";
    exit(1);
  }
  echo "<center><h3>$MSG_ADD"."$MSG_CONTEST</h3></center>";
  include_once("kindeditor.php") ;
?>

<body leftmargin="30" >
<?php
$description = "";
if(isset($_POST['startdate'])){
  require_once("../include/check_post_key.php");

  $starttime = $_POST['startdate']." ".intval($_POST['shour']).":".intval($_POST['sminute']).":00";
  $endtime = $_POST['enddate']." ".intval($_POST['ehour']).":".intval($_POST['eminute']).":00";
  //echo $starttime;
  //echo $endtime;

  $title = $_POST['title'];
  $private = $_POST['private'];
  $password = $_POST['password'];
  $description = $_POST['description'];
  
  if(get_magic_quotes_gpc()){
    $title = stripslashes($title);
    $private = stripslashes($private);
    $password = stripslashes($password);
    $description = stripslashes($description);
  }

  $lang = $_POST['lang'];
  $langmask = 0;
  foreach($lang as $t){
    $langmask += 1<<$t;
  } 

  $langmask = ((1<<count($language_ext))-1)&(~$langmask);
  //echo $langmask; 

  $sql = "INSERT INTO `contest`(`title`,`start_time`,`end_time`,`private`,`langmask`,`description`,`password`)
          VALUES(?,?,?,?,?,?,?)";

  $description = str_replace("<p>", "", $description); 
  $description = str_replace("</p>", "<br />", $description);
  $description = str_replace(",", "&#44;", $description);

  echo $sql.$title.$starttime.$endtime.$private.$langmask.$description.$password;
  $cid = pdo_query($sql,$title,$starttime,$endtime,$private,$langmask,$description,$password) ;
  echo "Add Contest ".$cid;

  $sql = "DELETE FROM `contest_problem` WHERE `contest_id`=$cid";
  $plist = trim($_POST['cproblem']);
  $pieces = explode(",",$plist );

  if(count($pieces)>0 && intval($pieces[0])>0){
    $sql_1 = "INSERT INTO `contest_problem`(`contest_id`,`problem_id`,`num`) VALUES (?,?,?)";
    $plist="";
    for($i=0; $i<count($pieces); $i++){
      if($plist)$plist.=",";
      $plist.=$pieces[$i];
      pdo_query($sql_1,$cid,$pieces[$i],$i);
    }
    //echo $sql_1;
    $sql = "UPDATE `problem` SET defunct='N' WHERE `problem_id` IN ($plist)";
    pdo_query($sql) ;
  }

  $sql = "DELETE FROM `privilege` WHERE `rightstr`=?";
  pdo_query($sql,"c$cid");

  $sql = "INSERT INTO `privilege` (`user_id`,`rightstr`) VALUES(?,?)";
  pdo_query($sql,$_SESSION[$OJ_NAME.'_'.'user_id'],"m$cid");

  $_SESSION[$OJ_NAME.'_'."m$cid"] = true;
  $pieces = explode("\n", trim($_POST['ulist']));

  if(count($pieces)>0 && strlen($pieces[0])>0){
    $sql_1 = "INSERT INTO `privilege`(`user_id`,`rightstr`) VALUES (?,?)";
    for($i=0; $i<count($pieces); $i++){
      pdo_query($sql_1,trim($pieces[$i]),"c$cid") ;
    }
  }
  echo "<script>window.location.href=\"contest_list.php\";</script>";
}
else{
  if(isset($_GET['cid'])){
    $cid = intval($_GET['cid']);
    $sql = "SELECT * FROM contest WHERE `contest_id`=?";
    $result = pdo_query($sql,$cid);
    $row = $result[0];
    $title = $row['title'];

    $plist = "";
    $sql = "SELECT `problem_id` FROM `contest_problem` WHERE `contest_id`=? ORDER BY `num`";
    $result = pdo_query($sql,$cid);
    foreach($result as $row){
      if($plist) $plist = $plist.',';
      $plist = $plist.$row[0];
    }
  }
  else if(isset($_POST['problem2contest'])){
    $plist = "";
    //echo $_POST['pid'];
    sort($_POST['pid']);
    foreach($_POST['pid'] as $i){       
      if($plist)
      $plist.=','.intval($i);
      else
        $plist=$i;
    }
  }else if(isset($_GET['spid'])){
    require_once("../include/check_get_key.php");
    $spid = intval($_GET['spid']);

    $plist = "";
    $sql = "SELECT `problem_id` FROM `problem` WHERE `problem_id`>=? ";
    $result = pdo_query($sql,$spid);
    foreach($result as $row){
      if($plist) $plist.=',';
      $plist.=$row[0];
    }
  }

  include_once("kindeditor.php") ;
?>

  <div class="container">
    <form method=POST>
    <p align=left>
      <?php echo "<h3>".$MSG_CONTEST."-".$MSG_TITLE."</h3>"?>
      <input class="input input-xxlarge" style="width:100%;" type=text name=title value="<?php echo isset($title)?$title:""?>"><br><br>
    </p>
    <p align=left>
      <?php echo $MSG_CONTEST.$MSG_Start?>:
      <input class=input-large type=date name='startdate' value='<?php echo date('Y').'-'. date('m').'-'.date('d')?>' size=4 >
      Hour: <input class=input-mini type=text name=shour size=2 value=<?php echo date('H')?>>&nbsp;
      Minute: <input class=input-mini type=text name=sminute value=00 size=2 >
    </p>
    <p align=left>
      <?php echo $MSG_CONTEST.$MSG_End?>:
      <input class=input-large type=date name='enddate' value='<?php echo date('Y').'-'. date('m').'-'.date('d')?>' size=4 >
      Hour: <input class=input-mini type=text name=ehour size=2 value=<?php echo (date('H')+4)%24?>>&nbsp;
      Minute: <input class=input-mini type=text name=eminute value=00 size=2 >
    </p>
    <br>
    <p align=left>
      <?php echo $MSG_CONTEST."-".$MSG_PROBLEM_ID?>
      <?php echo "( Add problemIDs with coma , )"?><br>
      <input class=input-xxlarge placeholder="Example:1000,1001,1002" type=text style="width:100%" name=cproblem value="<?php echo isset($plist)?$plist:""?>">
    </p>
    <br>
    <p align=left>
      <?php echo "<h4>".$MSG_CONTEST."-".$MSG_Description."</h4>"?>
      <textarea class=kindeditor rows=13 name=description cols=80></textarea>
      <br>
      <table width="100%">
        <tr>
          <td rowspan=2>
            <p aligh=left>
              <?php echo $MSG_CONTEST."-".$MSG_LANG?>
              <?php echo "( Add PLs with Ctrl+click )"?><br>
              <select name="lang[]" multiple="multiple" style="height:220px">
              <?php
              $lang_count = count($language_ext);
              $langmask = $OJ_LANGMASK;
              for($i=0; $i<$lang_count; $i++){
                echo "<option value=$i selected>".$language_name[$i]."</option>";
              }
              ?>
              </select>
            </p>
          </td>
          <td height="10px">
            <p align=left>
              <?php echo $MSG_CONTEST."-".$MSG_Public?>:
              <select name=private style="width:150px;">
                <option value=0><?php echo $MSG_Public?></option>
                <option value=1><?php echo $MSG_Private?></option>
              </select>
              <?php echo $MSG_CONTEST."-".$MSG_PASSWORD?>:
              <input type=text name=password style="width:150px;" value="">
            </p>
          </td>
        </tr>
        <tr>
          <td height="*">
            <p align=left>
              <?php echo $MSG_CONTEST."-".$MSG_USER?>
              <?php echo "( Add private contest's userIDs with newline &#47;n )"?>
              <br>
              <textarea name="ulist" rows="10"style="width:100%;" placeholder="user1<?php echo "\n"?>user2<?php echo "\n"?>user3<?php echo "\n"?>*可以将学生学号从Excel整列复制过来，然后要求他们用学号做UserID注册,就能进入Private的比赛作为作业和测验。"></textarea>
            </p>
          </td>
        </tr>
      </table>

      <div align=center>
        <?php require_once("../include/set_post_key.php");?>
        <input type=submit value=Submit name=submit>
      </div>
    </p>
  </form>
</div>

<?php }
require_once("../oj-footer.php");
?>
</body>
</html>
