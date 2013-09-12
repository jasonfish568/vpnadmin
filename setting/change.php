<?php
require("../header.html");
require("../auth_head.php");
$user = $_SESSION['username'];
$nowip =get_user_ip();
?>
<div class="container">
<br />
<br />
<div class="alert alert-info">
<h4>
<?php
if(isset($_POST['old']))
{
    //  $newuser = $_POST['name'];
    $email = safePost('email');
    $old = safePost('old');
    $signature = $_POST['signature'];
    $signature = substr($signature,0,180);
    $new1 = safePost('new1');
    $new2 = safePost('new2');
    $nickname =$_POST['nickname'];

    
    

    $dbc =newDbc();
    mysql_select_db(DB_NAME, $dbc);
    $nicknameOK =true;
    //$query ="select name from user where username='".$user."'";
    $rrrrr=mysql_query("SELECT name FROM user WHERE username='".$user."'");
    $row=mysql_fetch_row($rrrrr);
    $nowNickname=$row[0];

    if (strtolower($nickname) != strtolower($user)&& strtolower($nickname)!= strtolower($nowNickname))
    {
        $query = "select * from user where name='".$nickname."'";
        $result=mysql_query($query);
        if(mysql_num_rows($result) >0)
        {
            $nicknameOK =false;
            echo "你不能把昵称改得和别人的登录名一样啊==<br />";
        }
        $query = "select * from user where name='".$nickname."'";
        $result=mysql_query($query);
        if(mysql_num_rows($result) >0)
        {
            $nicknameOK =false;
            echo "这个昵称已经有人在用了<br />";
        }
    }

    if($nickname =='')
            $nicknameOK =false;

    if(!$nicknameOK)
    {
        $nickname =$user;
    }

    $query = "update user set note ='".$signature."',name='".$nickname."' where username ='".$user."'";
    $result = mysql_query($query);
    if($result)
        echo "签名更改成功！";
    else 
        echo "签名更改失败！";

    if($old != null )
    {
        if ($new2 != $new1)
        {
            echo "两次输入不一致！";
            exit;
        }
        $query = "select * from user where username ='".$user."'";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        if($row['1'] == "*"+sha1(sha1($old,true)))
        {
            //匹配172.18字段ip
            /*
            $pattern ='/^172.18(\.((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]\d)|\d)){2}$/';
            if(!preg_match($pattern,$ip,$match))
            {
                echo "ip格式错误！！";
                exit;
            }
             */

            if($new1 =='')
                $query = "update user set email ='".$email."' where username ='".$user."'";
            else
                $query = "update user set password = password('$new1')  where username ='".$user."'";
            $result = mysql_query($query);
            if($result)
                echo "<br\>密码更改成功！";
            else
                echo  "更改失败!";
        }
        else
        {
            echo "原密码错误";
            exit;
        }


    }

}
?>
</div>
<a href="./" class="btn">返回</a>

</div>