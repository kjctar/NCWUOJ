var i=0;
var interval=800;
function auto_refresh(){
	interval=800;
	var tb=window.document.getElementById('result-tab');
	var rows=tb.rows;
	for(var i=rows.length-1;i>0;i--){
		var result=$(rows[i].cells[3].children[0]).attr("result");
		rows[i].cells[3].className="td_result";
		var sid=rows[i].cells[0].innerHTML;
			if(result<4){
			   window.setTimeout("fresh_result("+sid+")",interval);
			   console.log("auto_refresh "+sid+" actived!");
			}
	}
}
function findRow(solution_id){
	var tb=window.document.getElementById('result-tab');
	var rows=tb.rows;
	for(var i=1;i<rows.length;i++){
		var cell=rows[i].cells[0];
		if(cell.innerHTML==solution_id) return rows[i];
	}
}

function fresh_result(solution_id){
	var xmlhttp;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var tb=window.document.getElementById('result-tab');
			var row=findRow(solution_id);
			//alert(row);
			var r=xmlhttp.responseText;
			var ra=r.split(",");
			// alert(r);
			// alert(judge_result[r]);
			var loader="<img width=18 src=image/loader.gif>";
			row.cells[3].innerHTML="<span class='btn btn-warning'>"+judge_result[ra[0]]+"</span>"+loader;
			row.cells[4].innerHTML=ra[1];
			row.cells[5].innerHTML=ra[2];
			row.cells[9].innerHTML=ra[3];
			if(ra[0]<4){
				window.setTimeout("fresh_result("+solution_id+")",interval);
				interval*=2;
			}else{
				//alert(ra[0]);
				switch(ra[0]){
				 case "6":
				 case "10":
					row.cells[3].innerHTML="<a href='reinfo.php?sid="+solution_id+"' class='"+judge_color[ra[0]]+"'>"+judge_result[ra[0]]+"</a>";
					break;
				 case "11":
					row.cells[3].innerHTML="<a href='ceinfo.php?sid="+solution_id+"' class='"+judge_color[ra[0]]+"'>"+judge_result[ra[0]]+"</a>";
					break;
				
				  default:
					row.cells[3].innerHTML="<span class='"+judge_color[ra[0]]+"'>"+judge_result[ra[0]]+"</span>";
				}
				 auto_refresh();
                
			}
		}
	}
	xmlhttp.open("GET","status-ajax.php?solution_id="+solution_id,true);
	xmlhttp.send();
}
var hj_ss="<select class='http_judge form-control' length='2' name='result'>";
	for(var i=4;i<10;i++){
   		hj_ss+="	<option value='"+i+"'>"+judge_result[i]+" </option>";
	}
   hj_ss+="</select>";
   hj_ss+="<input name='manual' type='hidden'>";
   hj_ss+="<input class='http_judge form-control' size=5 title='输入判定原因与提示' name='explain' type='text'>";
   hj_ss+="<input class='http_judge btn' name='manual' value='确定' type='submit'>";
$(".http_judge_form").append(hj_ss);
$(".http_judge_form").submit(function (){
   var sid=this.children[0].value;
   $.post("admin/problem_judge.php",$(this).serialize(),function(data,textStatus){
   		if(textStatus=="success")window.setTimeout("fresh_result("+sid+")",1000);
	})
   return false;
});
auto_refresh();
$(".td_result").mouseover(function (){
//   $(this).children(".btn").hide(300);
   var button=$(this);
   $(this).find("form").show(600);
   var sid=$(this).find("span[class=original]").attr("sid");
   $(this).find("span[class=original]").load("status-ajax.php?q=user_id&solution_id="+sid);
});
$(".http_judge_form").hide();

