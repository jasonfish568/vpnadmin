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
    $type = '����Ա�޸�';
}
coinChange($user,$num,$type);
echo "<h5>";
if($num >0)
    echo $user."�˻������:".$type."<code>+".$num."</code>";
else
    echo $user."�˻������:".$type."<code>".$num."</code>";
echo "</h5>";
//echo "ò�ƿ�����";
$result = quota_change($user,$quota);
echo "<h5>";
if($result==1){
	echo "�����ƻ����ĳɹ�<br\>";
	echo "�������ƻ�:".sizeformat($quota);
}
else if($result==2){
	echo "�����ƻ�����ʧ��";
}
else if($result==3){
	echo "ʣ����������";
}
else if($result==4){
	echo "�����ƻ�û�и���";
}
echo "</h5>";
?>


