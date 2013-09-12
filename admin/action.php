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
  	die("创建文件夹失败，请手动创建<code>".$structure."</code>,并更改权限为可写入！");
  }
  else{
	echo "创建文件夹成功，文件夹目录<code>".$structure."</code>";
  }
}

else if($type=="change")
{
  $subject = safePost('subject');
  $name = safePost('name');
  $remark = safePost('remark');
  $query = "update setting set name='".$name."',remark='".$remark."' where subject ='".$subject."'";
  mysql_query($query) or die ("update failed ");
  echo "更改成功！";
}
else if($type=="banner")
{
  $ID = safePost('ID');
  $imgUrl = safePost('imgUrl');
  $title = safePost('title');
  $content = safePost('content');
  $query = "update banner set title='".$title."',content='".$content."',imgUrl='".$imgUrl."' where ID ='".$ID."'";
  mysql_query($query) or die ("update failed ");
  echo "更改成功！";
}

else
{
  echo "无任何操作！";
  exit;
}
?>

</div>

<a class='btn' href="/">回到首页</a>
<a class='btn' href="setting.php">设置页面</a>



