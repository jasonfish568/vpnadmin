<?php
require_once('./auth_head.php');
require('./header.html');

?>
<body>
<div class="container">
<br />
<br />
<br />

<?php

$ip =get_user_ip();
$dbc = newDbc();
mysql_select_db(DB_NAME,$dbc);
mysql_query("set names gbk;");
date_default_timezone_set('PRC');
            
            $content=$_POST['quota']*1073741824;
            $price=quota_price($_POST['quota']);
            if ($content == NULL)
            {
                echo "NULL!";
                exit;
            }
            $user=$_SESSION['username'];
            $result=mysql_query("SELECT user.* FROM user WHERE user.username='".$user."' ");
            $row=mysql_fetch_row($result);
            $quota_bytes=$row[8];
            $used_quota=$row[10];
            $quota_left=$content-$used_quota;
            $formatcontent=sizeformat($content);
            $formatquota_left=sizeformat($quota_left);
            if ($quota_bytes == $content){
                echo "<div class=\"alert alert-info\"><h3>�����ƻ�û�б仯</h3></div>\n";
                echo "<div class=\"alert alert-error\">";
                echo "���������ƻ�û�иı�<br />";
                echo "�������ƻ���". $formatcontent."ÿ��<br />";
                echo "ʣ��������".$formatquota_left."<br />";
                echo "�۳���<code>0</code>Ԫ<br />";
                echo "�˻���<code>".$row[12]."</code>Ԫ</div>\n";
                echo "<a class='btn' href='/'>����</a>";
                exit;
            }
            //����ǽ�plan�����۷�
            if ($quota_bytes > $content){
                $price = 0;
            }
            $new_coin=$row[12] - $price;
            if($new_coin < 0){
                echo "<div class=\"alert alert-info\"><h3>�����ƻ�����ʧ��</h3></div>\n";
                echo "<div class=\"alert alert-error\">";
                echo "�������㣬�����ƻ�û�иı�<br />";
                echo "�������ƻ���". $formatcontent."ÿ��<br />";
                echo "ʣ��������".$formatquota_left."<br />";
                echo "�۳���<code>0</code>Ԫ<br />";
                echo "�˻���<code>".$row[12]."</code>Ԫ</div>\n";
                echo "<a class='btn' href='/'>����</a>";
                exit;
            }
            if ($content < 0)
            {
                echo "<div class=\"alert alert-info\"><h3>�����ƻ�����ʧ��</h3></div>\n";
                echo "<div class=\"alert alert-error\">";
                echo "����ʣ�಻�㣬�����ƻ�û�иı�<br />";
                echo "�������ƻ���". $formatcontent."ÿ��<br />";
                echo "ʣ��������".$formatquota_left."<br />";
                echo "�۳���<code>0</code>Ԫ<br />";
                echo "�˻���<code>".$row[12]."</code>Ԫ</div>\n";
                echo "<a class='btn' href='/'>����</a>";
                exit;
            }
            
            $query = "UPDATE user SET `quota_bytes`='".$content."',`left_quota`='".$quota_left."',`coin`='".$new_coin."' where user.username = '".$user."'"  ;
            $sub = mysql_query($query);
            
            if($sub){
                echo "<div class=\"alert alert-info\"><h3>�����ƻ��޸ĳɹ���</h3></div>\n";
                echo "<div class=\"alert alert-success\">";
                echo "�������ƻ���". $formatcontent."ÿ��<br />";
                echo "ʣ��������".$formatquota_left."<br />";
                echo "�۳���<code>".$price."</code>Ԫ<br />";
                echo "�˻���<code>".$new_coin."</code>Ԫ</div>\n";
                echo "<a class='btn' href='/'>����</a>";
            }else{
                echo "<div class=\"alert alert-info\"><h3>�����ƻ�����ʧ�ܣ�</h3></div>\n";
                echo "<div class=\"alert alert-error\">";
                echo "�����쳣���󣬿������������ݿ�����ʧ��<br />";
                echo "������Ϣ [".mysql_errno($dbc) . ": " . mysql_error($dbc) . "]<br />";
                echo "����ϵ����Ա</div>\n";
                echo "<a class='btn' href='/'>����</a>";
            }
            mysql_close($dbc);

?>
</div>
</body>