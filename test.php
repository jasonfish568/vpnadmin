<?php
header('Content-Type:text/html;charset=gbk');
require("data/config.inc.php");
require("functions.php");
$dbc = newDbc();
$user='txlife';
mysql_select_db(DB_NAME, $dbc);
$result=mysql_query("SELECT user.* FROM user WHERE user.username='".$user."' ");
$row=mysql_fetch_row($result);
$quota_bytes=$row[8];
$plan=$row[8]/1073741824;
$coin=$row[12];

//mysql_query("SET NAMES UTF-8");
?>

<style>

.align{
   height:30px;
   }
.align input{ display:block; float:left;margin-top:8px;}
.align span{ display:block; float:left; padding-top:3px; *padding-top:5px;}
</style>

<div class="well" >
<h2>VPN�����ƻ�����</h2>
<div class='alert alert-info' display="block">��ѡ������Ҫ�������ƻ�</div>

<form action="quota.php" method="post">
<div class="align"><input type="radio" id="quota1" name="quota" value="1" onclick="checked_price()"><span>ÿ��1G����<code id="0" style="display:none"></code></span></div>
<div class="align"><input type="radio" id="quota2" name="quota" value="2" onclick="checked_price()"><span>ÿ��2G����<code id="1" style="display:none">123</code></span></div>
<div class="align"><input type="radio" id="quota3" name="quota" value="3" onclick="checked_price()"><span>ÿ��3G����<code id="2" style="display:none"></code></span></div>
<div class="align"><input type="radio" id="quota4" name="quota" value="4" onclick="checked_price()"><span>ÿ��4G����<code id="3" style="display:none"></code></span></div>
<div class="align"><input type="radio" id="quota5" name="quota" value="5" onclick="checked_price()"><span>ÿ��5G����<code id="4" style="display:none"></code></span></div>
<div class="align"><input type="radio" id="quota6" name="quota" value="10" onclick="checked_price()"><span>ÿ��10G����<code id="5" style="display:none"></code></span></div>
<input class="btn btn-primary" type="submit"  name="submit" value="����" 
        style="width:100px;letter-spacing:35px;text-align:right;" />
</form>
</div>