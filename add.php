

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



        <td width="20%" style="padding:0px;"><div align="center"><a href="./doc/openvpn-2.2.1-install.exe">openvpn��������</a></div></td>

        <td width="25%" style="padding:0px;"><div align="center"><a href="./doc/vpn-noncert.zip">openvpn֤���ļ�����</a></div></td>

        <td width="20%" style="padding:0px;"><div align="center"><a href="./doc/instru.php">openvpnʹ��˵��</a></div></td>

        <td width="15%" style="padding:0px;"><div align="center"><a href="add.php">����û�</a></div></td>

        <td width="10%" style="padding:0px;"><div align="center"><a href="?logout=1">�˳�</a></div></td>

        <td width="auto"><div align="center"></div></td>

      </tr>
      </table>
<form method="post">
<TABLE  cellSpacing=0 cellPadding=0 width=760 align=center bgColor=#558bba border=0 style="margin-top:20px; padding-top:10px;">
<TR >
     <TD class = "lable">�û���: </TD>
     <TD class = "inputbox"><input type="char" maxLength=20 size=15 id="newusername" name="newusername" /></TD>
</TR>
<TR>
     <TD class = "lable">�趨����:</TD>
     <TD class = "inputbox"> <input type=password maxLength=20 size=15 id="newpassword" name="newpassword" /></TD>
</TR>
<TR>
      <TD class = "lable">״̬:</TD>
      <TD class = "inputbox"> <input type="int" maxLength=1 name="active" value="1"/></TD>
</TR>
<TR>
      <TD class = "lable">����: </TD>
      <TD class = "inputbox"><input type="int" maxLength=3 name="quota_cycle" value=<?php echo date('t'); ?>></TD>
</TR>
<TR>      
      <TD class = "lable">����: </TD>
      <TD class = "inputbox"><input type="bigint" maxLength=20 name="quota_bytes"  value="1073741824"/>�ֽ�<br>Ĭ��Ϊ1G��1073741824�ֽڣ�</TD>
</TR>
<TR>      
      <TD class = "lable">����:</TD> 
      <TD class = "inputbox"><input type="varchar" maxLength=32 name="name" /></TD>
</TR>
<TR>      
      <TD class = "lable">Email:</TD>
      <TD class = "inputbox"><input type="char" maxLength=128 name="email" /></TD>
</TR>
<TR>      
      <TD class = "lable">��ע: </TD>
      <TD class = "inputbox"><input type="text" name="note" /></TD>
</TR>
<TR>      
<!--�����˺ţ�<input type="char" name="adminuser" /><br>-->
      <TD class = "lable">�������룺</TD>
      <TD class = "inputbox"><input type="password" id="password" name="password" /></TD>
</TR>
<TR >
      <input name="add_1" value="1" type="hidden" />
      <TD class = "button"><input type="submit" value="����û�"  /></TD>
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
        echo "���ݲ�������";
        exit;
        }
    if(!$result)
    {
        echo "���ݲ�ѯʧ�ܣ�";
        exit;
    }
    $row = mysql_fetch_row($result);
    $count = $row[0];
    //���ݿ��в�Ӧ��ʹ�ö����ͬ���û����������ﷵ�ص�ֻ���� 0����1
    if($count >0 )
    {
        $insert_result=mysql_query("INSERT INTO user (username, password, active, quota_cycle, quota_bytes, name, email, note)
VALUES ('$_POST[newusername]',PASSWORD('$_POST[newpassword]'),'$_POST[active]','$_POST[quota_cycle]','$_POST[quota_bytes]','$_POST[name]','$_POST[email]','$_POST[note]')");

        if (!$insert_result)
          {
            die('Error: ' . mysql_error());
          }
        
        echo "�ɹ����$_POST[newusername]��VPN�˺�<br>
      �û����룺'$_POST[newpassword]'<br>
	  �������ڣ�'$_POST[quota_cycle]'<br>
	  ʣ��������'$_POST[quota_bytes]'<br>
	  ";
        
    }
    else
    {
        //��ʾ������Ϣ
        echo" <script > document.getElementById(\"info\").style.display='block';
              document.getElementById(\"info\").innerHTML='����������� ';
                                         </script > ";
    }
}

?>
</body>
</html>

