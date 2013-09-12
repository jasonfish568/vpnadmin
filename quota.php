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
                echo "<div class=\"alert alert-info\"><h3>流量计划没有变化</h3></div>\n";
                echo "<div class=\"alert alert-error\">";
                echo "您的流量计划没有改变<br />";
                echo "现流量计划：". $formatcontent."每月<br />";
                echo "剩余流量：".$formatquota_left."<br />";
                echo "扣除金额：<code>0</code>元<br />";
                echo "账户余额：<code>".$row[12]."</code>元</div>\n";
                echo "<a class='btn' href='/'>返回</a>";
                exit;
            }
            //如果是降plan，不扣费
            if ($quota_bytes > $content){
                $price = 0;
            }
            $new_coin=$row[12] - $price;
            if($new_coin < 0){
                echo "<div class=\"alert alert-info\"><h3>流量计划更改失败</h3></div>\n";
                echo "<div class=\"alert alert-error\">";
                echo "您的余额不足，流量计划没有改变<br />";
                echo "现流量计划：". $formatcontent."每月<br />";
                echo "剩余流量：".$formatquota_left."<br />";
                echo "扣除金额：<code>0</code>元<br />";
                echo "账户余额：<code>".$row[12]."</code>元</div>\n";
                echo "<a class='btn' href='/'>返回</a>";
                exit;
            }
            if ($content < 0)
            {
                echo "<div class=\"alert alert-info\"><h3>流量计划更改失败</h3></div>\n";
                echo "<div class=\"alert alert-error\">";
                echo "您的剩余不足，流量计划没有改变<br />";
                echo "现流量计划：". $formatcontent."每月<br />";
                echo "剩余流量：".$formatquota_left."<br />";
                echo "扣除金额：<code>0</code>元<br />";
                echo "账户余额：<code>".$row[12]."</code>元</div>\n";
                echo "<a class='btn' href='/'>返回</a>";
                exit;
            }
            
            $query = "UPDATE user SET `quota_bytes`='".$content."',`left_quota`='".$quota_left."',`coin`='".$new_coin."' where user.username = '".$user."'"  ;
            $sub = mysql_query($query);
            
            if($sub){
                echo "<div class=\"alert alert-info\"><h3>流量计划修改成功！</h3></div>\n";
                echo "<div class=\"alert alert-success\">";
                echo "新流量计划：". $formatcontent."每月<br />";
                echo "剩余流量：".$formatquota_left."<br />";
                echo "扣除金额：<code>".$price."</code>元<br />";
                echo "账户余额：<code>".$new_coin."</code>元</div>\n";
                echo "<a class='btn' href='/'>返回</a>";
            }else{
                echo "<div class=\"alert alert-info\"><h3>流量计划更改失败！</h3></div>\n";
                echo "<div class=\"alert alert-error\">";
                echo "发生异常错误，可能是由于数据库链接失败<br />";
                echo "错误信息 [".mysql_errno($dbc) . ": " . mysql_error($dbc) . "]<br />";
                echo "请联系管理员</div>\n";
                echo "<a class='btn' href='/'>返回</a>";
            }
            mysql_close($dbc);

?>
</div>
</body>