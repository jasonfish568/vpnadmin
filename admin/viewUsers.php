<?php
require_once('auth_admin.php');
require_once('../functions.php');
html_header("�����̨ - �û�����");

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
<li> <a href="wadmin.php" >�ļ�����</a> </li>
<li class="active"> <a href="viewUsers.php">�û�����</a> </li>
<li> <a href="setting.php"> ��վ����</a> </li>
<li> <a href="viewip.php" >����ͳ��</a> </li>
<li> <a href="todayCoin.php" >���ս��</a> </li>
<li> <a href="viewdown.php" >����ͳ��</a> </li>
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
     echo '�û��б�';
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
if($isSet) echo "<tr><th width='86px'>�˻���</th><th>״̬</th><th>�ǳ�</th></tr>";
else echo "<tr><th>�˻���</th><th>����</th><th>״̬</th><th>���</th></tr>";
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
		echo "<tr><th width='86px'>����</th><th>��ʼ����</th><th>Email</th></tr>";
		echo "<tr><td>".statusformat($r['2'])."</td><td>".$r['3']."</td><td>".$r['5']."</td></tr>";
		echo "<tr><th width='86px'>�����ƻ�</th><th>��������</th><th>ʣ������</th></tr>";
		echo "<tr><td>".sizeformat($r['8'])."</td><td>".sizeformat($r['10'])."</td><td>".sizeformat($r['11'])."</td></tr>";
		echo "<tr><th width='86px'>����</th><th colspan=2>ǩ����</th></tr>";
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
<h4>�û� Id:</h4>
 <input id='userId' name='userId' type="text" style='text-align:center' <?php if($isSet)echo"value='".$user."'";?> />
<h4>�˻�����޸�: </h4>
<div class='form-inline'>
<input type='radio' value='add' name='upOrDown' checked='checked'/>����
<input type='radio' value='dec' name='upOrDown'/>����
</div>
<input name='coin' style='margin-top:5px' type="number" /> 
<h4>���������ƻ�<small>: </h4>
<input type='radio' value='1' name='quota'/>1G
<input type='radio' value='2' name='quota'/>2G
<input type='radio' value='3' name='quota'/>3G
<input type='radio' value='4' name='quota'/>4G
<input type='radio' value='5' name='quota'/>5G
<input type='radio' value='6' name='quota'/>10G
<h4>��������<small>����Ϊ�գ�</small>: </h4>
<input name='descr' type='text' style="text-align:center" />
<a href="#" class='btn btn-primary' onclick ="sendform()">ִ��</a>
<a href="#" class='btn btn-primary' onclick="lockuser()">����</a>
<a href="#" class='btn btn-primary' onclick="unlockuser()">����</a>
</form>

<div><!-- end right span-->
</div><!-- end row -->
</div><!-- container -->



