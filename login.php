
<?php 
require("header.html");
require("functions.php");
include("data/config.inc.php");
  //session start
  session_start();
  //check ip
  $ip =get_user_ip();
  
  //connect to mysql
  $dbc = newDbc();
  mysql_select_db(DB_NAME, $dbc);
  //check remember
  if (isset($_COOKIE['sso']))
    {
      $sso = addslashes($_COOKIE['sso']);
      $query = "SELECT * FROM cookie  where sso ='".$sso."'";
      $result = mysql_query($query);
      if(!$result)
        {
          echo "���ݲ�ѯʧ�ܣ�";
          exit;
        }
      $row = mysql_fetch_row($result);
      $count = $row[0];
      if($count == $sso )
        {
          $user = $row['1'];
          setSession($user);

          header("Location:index.php");
          exit;
        }


     }
     
  if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==1&&$_SESSION['username']!=NULL)
{
   header("Location:index.php");
    exit;
}
?>

<body style="background:url(./img/login/1.jpg);background-size:100%;background-repeat: no-repeat; ">
<div class="container" style="height:auto;min-height:100%;padding-bottom:100px;" >
<div class="auth_form">
<FORM  METHOD="POST"> 
    <h3>EU VPN ��Աϵͳ</h3>
    <div class="alert" id="info" style="display:none"></div>
    <input name="login" value="1" type="hidden" />
    <INPUT maxLength=20 size=15 id="username" name="username" placeholder="Username" type="text">
    <br />
    <INPUT type=password maxLength=20 size=15 id="password" placeholder="Password" name="password">
    <br />
    <label class="checkbox">
          <input type="checkbox"  name="remember"> Remember me 
    </label>

    
    <span><a class="btn" alt="δ����ע�ᣡ" href="#"  >ע��</a></span>
    <INPUT type="submit" style="float:right;" class="btn btn-primary"  value="��¼" >

    
    
</FORM>
             
</div>
</div>


<?php

if(isset($_POST['login']))
{
    $user =safePost('username');
    $password = safePost('password');
    $remember = safePost('remember');
    
    //connect to mysql
    
    $password1 = "*".sha1(sha1($password,true));
    echo $password1;
    $query = "SELECT count(*) FROM user where username ='".$user."' and password = '".$password1."'";
    //ʹ�� sha1��������������˼���
    $result = mysql_query($query);
    if(!$result)
    {
        echo "������Ϣ [".mysql_errno($dbc) . ": " . mysql_error($dbc) . "]<br />";
        echo "���ݲ�ѯʧ�ܣ�";
        exit;
    }
    $row = mysql_fetch_row($result);
    $count = $row[0];
    //���ݿ��в�Ӧ��ʹ�ö����ͬ���û����������ﷵ�ص�ֻ���� 0����1
    if($count >0 )
    {
        
        if($remember=="on")
        {
            clearCookie($user);
            $seed = $user.time().mt_rand(10,500);
            $sso = base64_encode(md5($seed));
            $query = "insert into cookie (sso,user,ip,time) values('".$sso."','".$user."','".$ip."','".time()."')";
            mysql_query($query);
            setcookie("sso",$sso,time()+30*24*60*60);
        }
        setSession($user);

        header("Location:index.php");
        exit;
    }
    else
    {
        //��ʾ������Ϣ
        echo" <script > document.getElementById(\"info\").style.display='block';
              document.getElementById(\"info\").innerHTML='��������û������˻���������ˣ� ';
                                         </script > ";
    }
}
?>
<div class="footer">
<p class="text-center">
<?php
echo $ip;

?>
</p>
</div>
</body>
</html>

