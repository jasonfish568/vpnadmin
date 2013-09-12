<?php
require("./auth_head.php");
html_header("搜索");
$dbc = newDbc();
$username=$_SESSION['username'];
$nowip =get_user_ip();
mysql_select_db("openvpn", $dbc);
mysql_query("SET NAMES gbk");
?>
<!--[if lte IE 7]> 
<style type="text/css"> .icon-chevron-right { display:none; } </style>
<![endif]--> 
<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" href="css/bootstrap-ie6.css">
<link rel="stylesheet" type="text/css" href="css/ie.css?v=620">
<![endif]-->
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<![endif]-->
<script type="text/javascript">
function userInfo(){
	var allTime = document.getElementById("allTime").innerHTML;
	
	var onTime = document.getElementById("onTime").innerHTML;

	var level = document.getElementById("level");
	var le = document.getElementById("le");
	if(allTime == onTime){
		le.style.width = 100+"%";
	}
	else if(onTime == 0){
		le.style.width = 0;
	}
	else{
		countPercent(onTime,allTime,level,le);
	}
}
function countPercent(onHours,allHours,level,le){
	var floatNum = onHours/allHours;
	var percent = floatNum.toFixed("2");
	var toPercent;
	if(percent == 1.00){
		toPercent = 99;
	}
	else if(percent == 0.00){
		toPercent = 1;
	}
	else{
		toPercent = percent.substring(2);
	}
	le.style.width = toPercent+"%";
	var showTime = document.getElementById("showTime");
	//var inputgetNum = document.getElementById("inputgetNum");
	showTime.style.display = "block";
		//inputgetNum.style.display = "none";
		onHours = document.getElementById("usedsize").innerHTML;
		allHours = document.getElementById("totalsize").innerHTML;
		showTime.innerHTML = "已用流量:"　+ onHours +"/"+ allHours;
}
</script>
</head>
<body onLoad="userInfo()" style="background:url('img/dianbg.jpg')">
    <!--导航栏-->
    <?php require("./header_set.php");?>
    <!--/导航栏-->
<div style="padding: 0px 0px 0px; margin: 0px; border-width: 0px; height: 0px; display: block;" id="yass_top_edge_padding"></div>
<div class="container" >
<br />

<form class="form-search" >
  <input type="text" name="q" placeholder="搜索..." class="input-medium search-query">
  <button type="submit" class="btn">Search</button>

</form>
<?php
$q =safeGet("q");
$all = safeGet("all");
$num =safeGet("num");
if ($q ==NULL)
{
    echo "请输入查询关键词！";
    exit;
}
?>
<div class="alert alert-info">
下面是关于<i><?php echo $q ?> </i>的搜索结果.
</div>
<div class="row">
<div class="span7">
<?php
if($all ==true)
    $result =db_select("info"," subject='info' order by date desc");
else
    $result =db_select("info","content like '%".$q."%' and subject='info' order by date desc");
if(mysql_num_rows($result) ==0)
    echo "无相关通知！";
else
{
    $showNum = mysql_num_rows($result);
    echo "共".$showNum."条相关通知：";
    echo" <table class='table table-hover' > <tbody>";
    if ($num !=NULL)
    {
        if($num < $showNum)
            $showNum =$num;
    }
    for($i =0;$i<$showNum;$i++)
    {
        $row =mysql_fetch_row($result);
        echo "<tr >
            <td width='530px'><p>".date("m/d H:i",$row['3'])."</p>".nl2br(trim($row['0']))."</td>
            </tr>

            ";
    }
    echo " </tbody>
        </table>";
}

?>
</div>
<div class="span5">
<table class="table table-striped">
<?php 

$result =db_select("resource","name like '%".$q."%' order by date desc");
if(mysql_num_rows($result) ==0)
    echo "无相关资源！";
else
{
    echo "共".$result->num_rows."个相关资源";
    for($i =0;$i<$result->num_rows;$i++)
    {
        $row =mysqli_fetch_array($result);
        echo "<tr><td> <a href=\"download.php?subject=".$row['0']."&file=".$row['2']."\">".$row['1']."</a></td></tr>";
    }
}
?>
</table>
</div>
</div>
</div>
