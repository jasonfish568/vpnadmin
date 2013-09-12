<?php
require_once('auth_admin.php');
require_once('../functions.php');
html_header("管理后台 - 用户管理");

if($_SESSION['addInfo'] !=1)
{
    header("Location:index.php");
    exit;
}

$user = 'ALL_USERS_LIST';
$theCoin = 0;
$dbc = newDbc();
mysql_select_db(DB_NAME, $dbc);
$isSet = isset($_GET['user']);
if($isSet){
    $user = $_GET['user'];
    $query = "SELECT * FROM user WHERE username='".$user."'";
}else{
    $query = "SELECT * FROM user ORDER BY username";
}

$result = mysql_query($query);
?>


<div style="padding: 0px 0px 50px; margin: 0px; border-width: 0px; height: 0px; display: block;" id="yass_top_edge_padding"></div>
  <div class="navbar  navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="../"><?php echo SITE_NAME ?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
<li> <a href="./">Home</a> </li>
<li> <a href="wadmin.php" >文件管理</a> </li>
<li class="active"> <a href="viewUsers.php">用户管理</a> </li>
<li> <a href="setting.php"> 网站设置</a> </li>
<li> <a href="viewip.php" >访问统计</a> </li>
<li> <a href="todayCoin.php" >今日金币</a> </li>
<li> <a href="viewdown.php" >下载统计</a> </li>
            </ul>
          </div><!--/.nav-collapse -->

<a href="?logout=1" class="btn btn-danger pull-right">Log out</a>
        </div>
      </div>
    </div>


<div class="container">

<h2>
<?php 
if($user == 'ALL_USERS_LIST')
     echo '用户列表';
else
{
    echo $user;
	mysql_select_db(DB_NAME, $dbc);
    $query ="select * from user where username ='".$user."'";
    $user_info= mysql_query($query);
    $r = mysql_fetch_row($user_info);
    echo "(".$r['12'].")";

}
?>
</h2>
<h3 id="change"></h3>
<div class='row'>
<div class='span7'>
<table class='table table-bordered table-striped'>
<thead>
<?php
if($isSet) echo "<tr><th width='86px'>账户名</th><th>状态</th><th>昵称</th></tr>";
else echo "<tr><th>账户名</th><th>在线</th><th>状态</th><th>余额</th></tr>";
?>
</thead>
<tbody>
<?php
if($isSet){
	mysql_select_db(DB_NAME, $dbc);
	$query ="select * from user where username ='".$user."'";
    $user_info= mysql_query($query);
    while($r = mysql_fetch_row($user_info)){
        echo "<tr><td>".$r['0']."</td><td id='status'>".actformat($r['9'])."</td><td>".$r['4']."</td></tr>";
		echo "<tr><th width='86px'>在线</th><th>起始日期</th><th>Email</th></tr>";
		echo "<tr><td>".statusformat($r['2'])."</td><td>".$r['3']."</td><td>".$r['5']."</td></tr>";
		echo "<tr><th width='86px'>流量计划</th><th>已用流量</th><th>剩余流量</th></tr>";
		echo "<tr><td>".sizeformat($r['8'])."</td><td>".sizeformat($r['10'])."</td><td>".sizeformat($r['11'])."</td></tr>";
		echo "<tr><th width='86px'>周期</th><th colspan=2>签名档</th></tr>";
		echo "<tr><td>".$r['7']."</td><td colspan=2>".$r['6']."</td></tr>";
    }
}else{
    while($row = mysql_fetch_row($result)){

		$status = $row['2'];
    	if($status==1){
			$color="#66FF00";
		}
		else{
			$color="";
		}
    
		
        echo "<tr><td><a href='./viewUsers.php?user=".$row['0']."'>".$row['0']."</a></td><td><font color=".$color.">".statusformat($status)."</font></td><td>".actformat($row['9'])."</td><td>".$row['12']."</td></tr>";
    }
}
?>
</tbody>
</table>
</div><!-- end left span -->
<script type="text/javascript">
function sendform()
{
    $.post("userContral.php", $("#send").serialize(), function(data) {
        $("#change").html(data);
 }); 
}
function lockuser()
{
    $.post("lockuser.php", $("#send").serialize(), function(data) {
        $("#status").html(data);
		$("#change").html(data);
 }); 
}
function unlockuser()
{
    $.post("unlockuser.php", $("#send").serialize(), function(data) {
        $("#status").html(data);
		$("#change").html(data);
 }); 
}
</script>

<div class='span4'>
<form class='well' id='send'  >
<h4>用户 Id:</h4>
 <input id='userId' name='userId' type="text" style='text-align:center' <?php if($isSet)echo"value='".$user."'";?> />
<h4>账户余额修改: </h4>
<div class='form-inline'>
<input type='radio' value='add' name='upOrDown' checked='checked'/>增加
<input type='radio' value='dec' name='upOrDown'/>减少
</div>
<input name='coin' style='margin-top:5px' type="number" /> 
<h4>更改流量计划<small>: </h4>
<input type='radio' value='1' name='quota'/>1G
<input type='radio' value='2' name='quota'/>2G
<input type='radio' value='3' name='quota'/>3G
<input type='radio' value='4' name='quota'/>4G
<input type='radio' value='5' name='quota'/>5G
<input type='radio' value='6' name='quota'/>10G
<h4>操作描述<small>（可为空）</small>: </h4>
<input name='descr' type='text' style="text-align:center" />
<a href="#" class='btn btn-primary' onclick ="sendform()">执行</a>
<a href="#" class='btn btn-primary' onclick="lockuser()">锁定</a>
<a href="#" class='btn btn-primary' onclick="unlockuser()">解锁</a>
</form>

<div><!-- end right span-->
</div><!-- end row -->
</div><!-- container -->



