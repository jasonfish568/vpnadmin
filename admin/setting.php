<?php
require_once('auth_admin.php');
require_once('../functions.php');
html_header("�����̨ - �û�����");

if($_SESSION['addInfo'] !=1)
{
    header("Location:index.php");
    exit;
}

?>
<script type="text/javascript">
function checkForm(){
   if(window.confirm("ɾ���󲻿ɻָ���ȷ��ɾ����")){
	   return true;
   }
return false;
}
</script>
</head>
<div style="padding: 0px 0px 50px; margin: 0px; border-width: 0px; height: 0px; display: block;" id="yass_top_edge_padding"></div>
  <div class="navbar  navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="../"><?php echo SITE_NAME ?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
<li> <a href="./">Home</a> </li>
<li> <a href="wadmin.php" >�ļ�����</a> </li>
<li > <a href="viewUsers.php">�û�����</a> </li>
<li class="active"> <a href="setting.php"> ��վ����</a> </li>
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
<!--
<h3>�޸�banner</h3>
<table class="table">
<?php
$dbc = newDbc();
mysql_select_db(DB_NAME, $dbc);
$query = "select * from banner ";
$result = mysql_query($query);
while($row =mysql_fetch_row($result))
{
?>
  <tr>
    <td><form style="margin:0 0 0" method="post" class="form-inline" action="action.php?type=banner">
    <input name="ID" type="hidden" value='<?php echo $row['ID'] ?>' />
<input  name="title" type="text" class="input" value='<?php echo $row['title'] ?>'/>
<input  name="content" type="text" class="input" value='<?php echo $row['content'] ?>'/>
<input  name="imgUrl" type="text" class="input-xlarge" value='<?php echo $row['imgUrl'] ?>'/>
<input type="submit" class='btn btn-primary' value="����" />
</form>
</td>
  </tr>

  <?php

}


?>
-->

</table>
<h3>�޸Ŀ�Ŀ��Ϣ</h3>
<table class="table">
<thead>
<tr><th>Ӣ����</th><th>������</th><th colspan="3">����</th></tr>
</thead>
<?php
$query = "select * from setting ";
$result = mysql_query($query);
while($row =mysql_fetch_row($result))
{
?>
  <tr>
    <td> <?php echo $row['0'] ?> </td>
    <form style="margin:0 0 0" method="post" class="form-inline" action="action.php?type=change">
    <input name="subject" type="hidden" value='<?php echo $row['0'] ?>' />
	<td width="150px"><input  name="name" type="text" class="input" value='<?php echo $row['1'] ?>'/></td>
	<td><input  name="remark" type="text" class="input-xxlarge" style="width:300px;" value='<?php echo $row['3'] ?>'/></td>
	<td><input type="submit" class='btn btn-primary' value="����" /></td>
    
</form>
<td>
                  <form style='margin:0 0 0; ' onsubmit='return checkForm()' action='delete-cat.php' method='post'>
                  <input name='deleteSub' type='hidden' value='<?php echo $row['0'] ?>' />
                  <input name='deleteName' type='hidden' value='<?php echo $row['1'] ?>' />
                  <input type='submit'class='btn btn-danger' value='delete' />
                  </form>
                  </td> 
  </tr>

  <?php

}


?>

</table>
<h3>���ӿ�Ŀ</h3>
<form method="post" class="form-inline" action="./action.php?type=add">
<p>Ӣ������</p>
<input  name="subject" type="text" />
<p>��������</p>
<input  name="name" type="text" />
<p>��ע</p>
<textarea  name="remark" rows="5" cols="50"></textarea>
<br />
<input class='btn btn-primary' type="submit" value="ADD" />


</form>


