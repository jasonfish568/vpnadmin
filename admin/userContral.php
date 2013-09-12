<?php
include("../data/config.inc.php");
session_start();
if($_SESSION['addInfo'] !=1)
{
    header("Location:login.php");
    exit;
}

require_once('../functions.php');
date_default_timezone_set("PRC");

$user = $_POST['userId'];
$num = $_POST['coin'];
$quota = $_POST['quota'];
if($quota==6){
	$quota=10;
}
$quota=$quota*1073741824;
if($_POST['upOrDown'] == 'dec'){
    $num = -$num;
}
$type = $_POST['descr'];
if($type == ''){
    $type = '管理员修改';
}
coinChange($user,$num,$type);
echo "<h5>";
if($num >0)
    echo $user."账户余额变更:".$type."<code>+".$num."</code>";
else
    echo $user."账户余额变更:".$type."<code>".$num."</code>";
echo "</h5>";
//echo "貌似可以了";
$result = quota_change($user,$quota);
echo "<h5>";
if($result==1){
	echo "流量计划更改成功<br\>";
	echo "新流量计划:".sizeformat($quota);
}
else if($result==2){
	echo "流量计划更改失败";
}
else if($result==3){
	echo "剩余流量不足";
}
else if($result==4){
	echo "流量计划没有更改";
}
echo "</h5>";
?>


