<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <!--<title><?php echo $OJ_NAME?></title>  -->
    <?php //include("template/$OJ_TEMPLATE/css.php");?>	    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style type="text/css">
   .rank1{
    background-color:#FFB800;
    color: #ffffff;
    margin: 2px 2px;
    padding: 4px 8px;
    border-radius:20px;
   
   }
  .rank2{
    background-color:#c0c0c0;
    color: #ffffff;
    margin: 2px 2px;
    padding: 4px 8px;
    border-radius:20px;
   
   }
   .rank3{
    background-color:#DD7907;
    color: #ffffff;
    margin: 2px 2px;
    padding: 4px 8px;
    border-radius:20px;
   
   }
  </style>
  </head>

  <body>

    <div>
    <?php// include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
      <div>
<?php
$rank=1;
?>
<center><!--<h3>Contest RankList -- <?php echo $title?></h3>-->
<a class="layui-btn layui-btn-sm  layui-btn-normal"  href="contestrank.xls.php?cid=<?php echo $cid?>" ><i class="layui-icon layui-icon-download-circle "></i> Download</a>
<?php
if($OJ_MEMCACHE){
  ?>
<a  class="layui-btn layui-btn-sm  layui-btn-warm"  href="contestrank2.php?cid=<?php echo $cid?>" ><i class="layui-icon layui-icon-video "></i>  Replay</a>

<?php
}
 ?>
</center>
<div style="overflow: auto">
<table id=rank class='layui-table ' align=center lay-size="sm"  ><thead><tr><td class="{sorter:'false'}">Rank<th>User</th><th>Nick</th><th >Solved</th><th>Penalty</th>
<?php
for ($i=0;$i<$pid_cnt;$i++)
echo "<td><a href=problem.php?cid=$cid&pid=$i>$PID[$i]</a></td>";
echo "</tr></thead>\n<tbody>";
for ($i=0;$i<$user_cnt;$i++){
if ($i&1) echo "<tr class=oddrow align=center>\n";
else echo "<tr class=evenrow align=center>\n";
echo "<td >";
$uuid=$U[$i]->user_id;
$nick=$U[$i]->nick;
if($nick[0]!="*")
{
  echo "<i class='rank2' >".$rank."</i>";
  $rank++;
}
else
echo "*";
$usolved=$U[$i]->solved;
if(isset($_GET['user_id'])&&$uuid==$_GET['user_id']) echo "<td bgcolor=#ffff77>";
else echo"<td>";
echo "<a name=\"$uuid\" href=userinfo.php?user=$uuid>$uuid</a>";
echo "<td><a href=userinfo.php?user=$uuid>".htmlentities($U[$i]->nick,ENT_QUOTES,"UTF-8")."</a>";
echo "<td>";
if($usolved==$pid_cnt)
{
  echo'<i class="fa fa-trophy" style="color:#FFB800">AK</i>';
}
else echo $usolved;
echo "<td>".sec2str($U[$i]->time);
for ($j=0;$j<$pid_cnt;$j++){
$bg_color="eeeeee";
if (isset($U[$i]->p_ac_sec[$j])&&$U[$i]->p_ac_sec[$j]>0){
$aa=0x33+$U[$i]->p_wa_num[$j]*32;
$aa=$aa>0xaa?0xaa:$aa;
$aa=dechex($aa);
$bg_color="$aa"."ff"."$aa";
//$bg_color="aaffaa";
if($uuid==$first_blood[$j]){
$bg_color="aaaaff";
}
}else if(isset($U[$i]->p_wa_num[$j])&&$U[$i]->p_wa_num[$j]>0) {
$aa=0xaa-$U[$i]->p_wa_num[$j]*10;
$aa=$aa>16?$aa:16;
$aa=dechex($aa);
$bg_color="ff$aa$aa";
}
echo "<td class=well style='background-color:#$bg_color'>";
if(isset($U[$i])){
if (isset($U[$i]->p_ac_sec[$j])&&$U[$i]->p_ac_sec[$j]>0)
echo sec2str($U[$i]->p_ac_sec[$j]);
if (isset($U[$i]->p_wa_num[$j])&&$U[$i]->p_wa_num[$j]>0)
echo "(-".$U[$i]->p_wa_num[$j].")";
}
}
echo "</tr>\n";
}
echo "</tbody></table>";
?>
</div>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php //include("template/$OJ_TEMPLATE/js.php");?>	    
<script type="text/javascript" src="include/jquery.tablesorter.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
        $.tablesorter.addParser({
              // set a unique id
              id: 'punish',
              is: function(s) {
              // return false so this parser is not auto detected
              return false;
              },
              format: function(s) {
              // format your data for normalization
              var v=s.toLowerCase().replace(/\:/,'').replace(/\:/,'').replace(/\(-/,'.').replace(/\)/,'');
              //alert(v);
              v=parseFloat('0'+v);
              return v>1?v:v+Number.MAX_VALUE-1;
              },
              // set type, either numeric or text
              type: 'numeric'
              });
              $("#rank").tablesorter({
              headers: {
              4: {
              sorter:'punish'
              }
              <?php
              for ($i=0;$i<$pid_cnt;$i++){
              echo ",".($i+5).": { ";
              echo " sorter:'punish' ";
              echo "}";
              }
              ?>
              }
        });
  metal();
}
);
</script>
<script>
function getTotal(rows){
var total=0;
for(var i=0;i<rows.length&&total==0;i++){
try{
total=parseInt(rows[rows.length-i].cells[0].childNodes[0].innerHTML);
if(isNaN(total)) total=0;
}catch(e){
}
}
return total;
}
function metal(){
var tb=window.document.getElementById('rank');
var rows=tb.rows;
try{
var total=getTotal(rows);
//alert(total);
for(var i=1;i<rows.length;i++){
var cell=rows[i].cells[0];
/*
var num=rows[i].cells[0].innerHTML.split('>');
num=num[1]+'>';
alert(num);*/
var acc=rows[i].cells[3];
var flag=0;
if(acc.innerHTML=='<i class="fa fa-trophy" style="color:#FFB800">AK</i>')
{
  flag=1;
}
var ac=parseInt(acc.innerText);
if (isNaN(ac)) ac=parseInt(acc.textContent);
if(cell.innerHTML!="*"&&ac>0||cell.innerHTML!="*"&&flag==1){
var r=parseInt(cell.childNodes[0].innerHTML);

if(r==1){
   
cell.innerHTML="<span class='rank1' >1</span>";
//cell.style.cssText="background-color:gold;color:red";
}
if(r>1&&r<=total*.05+1)
{
  cell.innerHTML="<span class='rank1' >"+r+"</span>";
}
if(r>total*.05+1&&r<=total*.20+1)
{
  cell.innerHTML="<span class='rank2' >"+r+"</span>";
}
if(r>total*.20+1&&r<=total*.45+1)
{
  cell.innerHTML="<span class='rank2' >"+r+"</span>";
}
if(r>total*.45+1&&ac>0)
{
  cell.innerHTML="<span class='rank3' >"+r+"</span>";
}

}
}
}catch(e){
//alert(e);
}
}

</script>
<style>
.well{
   background-image:none;
   padding:1px;
}
td{
   white-space:nowrap;

}
</style>
  </body>
</html>
