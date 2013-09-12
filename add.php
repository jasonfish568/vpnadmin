

<html>
<head>
<style>
.inputbox{
        width:75%;
        
        }
.lable{
        width:25%;
        padding-left:10px;
        font-family: MingLiU;
        font-weight:bold;
        font-color:#ffffff;
        }
.button{
        margin-top:10px;
        padding-left:50px;
        }
a:link { 
color:#585858; 
text-decoration:none; 
} 
a:visited { 
color:#585858; 
text-decoration:none; 
}        
</style>
<?php
include("./data/config.inc.php");
 
    session_start();
    // Call this function so your page
    // can access session variables
    $logout=@$_GET['logout'];
    if($logout == 1)
        $_SESSION['loggedin']=0;
        
    if ($_SESSION['loggedin'] != 1) {
        // If the 'loggedin' session variable
        // is not equal to 1, then you must
        // not let the user see the page.
        // So, we'll redirect them to the
        // login page (login.php).
 
        header("Location: admin.php");
        exit;
    }


?>
</head>
<body>
<div align="center" style="margin-top:150px;">
<table width="762px"  border="1" cellpadding="1" cellspacing="0" >
      <tr>
                       <TH align=left height=60 colspan=4><a href="./adindex.php"><IMG height=60
                   src="logo.png"></a></TH>
      </tr>
      <table width="762px" colspan=4 cellpadding="1" cellspacing="1" >      
      <tr class="Title_style2" bgcolor="#92ccfd">



        <td width="20%" style="padding:0px;"><div align="center"><a href="./doc/openvpn-2.2.1-install.exe">openvpn程序下载</a></div></td>

        <td width="25%" style="padding:0px;"><div align="center"><a href="./doc/vpn-noncert.zip">openvpn证书文件下载</a></div></td>

        <td width="20%" style="padding:0px;"><div align="center"><a href="./doc/instru.php">openvpn使用说明</a></div></td>

        <td width="15%" style="padding:0px;"><div align="center"><a href="add.php">添加用户</a></div></td>

        <td width="10%" style="padding:0px;"><div align="center"><a href="?logout=1">退出</a></div></td>

        <td width="auto"><div align="center"></div></td>

      </tr>
      </table>
<form method="post">
<TABLE  cellSpacing=0 cellPadding=0 width=760 align=center bgColor=#558bba border=0 style="margin-top:20px; padding-top:10px;">
<TR >
     <TD class = "lable">用户名: </TD>
     <TD class = "inputbox"><input type="char" maxLength=20 size=15 id="newusername" name="newusername" /></TD>
</TR>
<TR>
     <TD class = "lable">设定密码:</TD>
     <TD class = "inputbox"> <input type=password maxLength=20 size=15 id="newpassword" name="newpassword" /></TD>
</TR>
<TR>
      <TD class = "lable">状态:</TD>
      <TD class = "inputbox"> <input type="int" maxLength=1 name="active" value="1"/></TD>
</TR>
<TR>
      <TD class = "lable">周期: </TD>
      <TD class = "inputbox"><input type="int" maxLength=3 name="quota_cycle" value=<?php echo date('t'); ?>></TD>
</TR>
<TR>      
      <TD class = "lable">流量: </TD>
      <TD class = "inputbox"><input type="bigint" maxLength=20 name="quota_bytes"  value="1073741824"/>字节<br>默认为1G（1073741824字节）</TD>
</TR>
<TR>      
      <TD class = "lable">姓名:</TD> 
      <TD class = "inputbox"><input type="varchar" maxLength=32 name="name" /></TD>
</TR>
<TR>      
      <TD class = "lable">Email:</TD>
      <TD class = "inputbox"><input type="char" maxLength=128 name="email" /></TD>
</TR>
<TR>      
      <TD class = "lable">备注: </TD>
      <TD class = "inputbox"><input type="text" name="note" /></TD>
</TR>
<TR>      
<!--管理账号：<input type="char" name="adminuser" /><br>-->
      <TD class = "lable">管理密码：</TD>
      <TD class = "inputbox"><input type="password" id="password" name="password" /></TD>
</TR>
<TR >
      <input name="add_1" value="1" type="hidden" />
      <TD class = "button"><input type="submit" value="添加用户"  /></TD>
</TR>
</TABLE>
</form>
<div>
<div id="info" style="display:none"></div>
<div id="info1" style="display:none"></div>

<?php
if(isset($_POST['add_1']))
{
    $user =$_POST['newusername'];
    
    $adpass=$_POST['password'];
    //connect to mysql
    $dbc = mysql_connect('localhost','openvpn','wangjiangYU93');
    mysql_select_db("openvpn", $dbc);
    $query = "SELECT count(*) FROM user where  (user.username ='".txlife."' or user.username ='".kokpin."')and
        password = PASSWORD(".$adpass.")";
    $result=mysql_query($query);
    
    if($user=="" or $_POST['newpassword']=="" or $_POST['active']=="" or $_POST['quota_cycle'] =="" or $_POST['quota_bytes'] ==""){
        echo "数据不完整！";
        exit;
        }
    if(!$result)
    {
        echo "数据查询失败！";
        exit;
    }
    $row = mysql_fetch_row($result);
    $count = $row[0];
    //数据库中不应该使用多个相同的用户，所以这里返回的只能是 0或者1
    if($count >0 )
    {
        $insert_result=mysql_query("INSERT INTO user (username, password, active, quota_cycle, quota_bytes, name, email, note)
VALUES ('$_POST[newusername]',PASSWORD('$_POST[newpassword]'),'$_POST[active]','$_POST[quota_cycle]','$_POST[quota_bytes]','$_POST[name]','$_POST[email]','$_POST[note]')");

        if (!$insert_result)
          {
            die('Error: ' . mysql_error());
          }
        
        echo "成功添加$_POST[newusername]的VPN账号<br>
      用户密码：'$_POST[newpassword]'<br>
	  服务周期：'$_POST[quota_cycle]'<br>
	  剩余流量：'$_POST[quota_bytes]'<br>
	  ";
        
    }
    else
    {
        //显示错误信息
        echo" <script > document.getElementById(\"info\").style.display='block';
              document.getElementById(\"info\").innerHTML='管理密码错误 ';
                                         </script > ";
    }
}

?>
</body>
</html>

