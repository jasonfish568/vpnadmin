<?php
require_once('auth_admin.php');
require("../header.html");
require("../functions.php");

if($_SESSION['addInfo'] !=1)
{
  header("Location: ./index.php");
  exit;
}

?>
<div class="container">
<br />
<br />
<br />

<div class="alert alert-info">

<?php
$type = safeGet('type');
$dbc = newDbc();
mysql_query("set names gbk;");
mysql_select_db(DB_NAME,$dbc);
if(!$dbc){    
    echo "failed";
}
date_default_timezone_set('PRC');
if($type == "add")
{
  $subject = safePost('subject');
  $name = safePost('name');
  $remark = safePost('remark');

  $query = "insert into setting (subject,name,remark) values('".$subject."','".$name."','".$remark."') ";
  mysql_query($query) or die ("add subject failed");
  $structure = "../upload/".$subject."/";
  if(!mkdir($structure,0766))
  {
  	die("�����ļ���ʧ�ܣ����ֶ�����<code>".$structure."</code>,������Ȩ��Ϊ��д�룡");
  }
  else{
	echo "�����ļ��гɹ����ļ���Ŀ¼<code>".$structure."</code>";
  }
}

else if($type=="change")
{
  $subject = safePost('subject');
  $name = safePost('name');
  $remark = safePost('remark');
  $query = "update setting set name='".$name."',remark='".$remark."' where subject ='".$subject."'";
  mysql_query($query) or die ("update failed ");
  echo "���ĳɹ���";
}
else if($type=="banner")
{
  $ID = safePost('ID');
  $imgUrl = safePost('imgUrl');
  $title = safePost('title');
  $content = safePost('content');
  $query = "update banner set title='".$title."',content='".$content."',imgUrl='".$imgUrl."' where ID ='".$ID."'";
  mysql_query($query) or die ("update failed ");
  echo "���ĳɹ���";
}

else
{
  echo "���κβ�����";
  exit;
}
?>

</div>

<a class='btn' href="/">�ص���ҳ</a>
<a class='btn' href="setting.php">����ҳ��</a>



