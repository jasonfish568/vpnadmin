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
            echo "�㲻�ܰ��ǳƸĵúͱ��˵ĵ�¼��һ����==<br />";
        }
        $query = "select * from user where name='".$nickname."'";
        $result=mysql_query($query);
        if(mysql_num_rows($result) >0)
        {
            $nicknameOK =false;
            echo "����ǳ��Ѿ�����������<br />";
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
        echo "ǩ�����ĳɹ���";
    else 
        echo "ǩ������ʧ�ܣ�";

    if($old != null )
    {
        if ($new2 != $new1)
        {
            echo "�������벻һ�£�";
            exit;
        }
        $query = "select * from user where username ='".$user."'";
        $result = mysql_query($query);
        $row = mysql_fetch_array($result);
        if($row['1'] == "*"+sha1(sha1($old,true)))
        {
            //ƥ��172.18�ֶ�ip
            /*
            $pattern ='/^172.18(\.((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]\d)|\d)){2}$/';
            if(!preg_match($pattern,$ip,$match))
            {
                echo "ip��ʽ���󣡣�";
                exit;
            }
             */

            if($new1 =='')
                $query = "update user set email ='".$email."' where username ='".$user."'";
            else
                $query = "update user set password = password('$new1')  where username ='".$user."'";
            $result = mysql_query($query);
            if($result)
                echo "<br\>������ĳɹ���";
            else
                echo  "����ʧ��!";
        }
        else
        {
            echo "ԭ�������";
            exit;
        }


    }

}
?>
</div>
<a href="./" class="btn">����</a>

</div>