<?php

require_once('../auth_head.php');
$user = $_SESSION['user'];
$messageTime =safeGet('time');

$dbc =newDbc();
if ($messageTime =='all')
    $query ="UPDATE `message` SET `read` = '1' WHERE `user` = '".$user."'";
else
    $query ="UPDATE `message` SET `read` = '1' WHERE `user` = '".$user."' AND `time` = '".$messageTime."'";
mysqli_query($dbc,$query) or die ("标记失败");

if($messageTime =='all')
    echo "所有已读";
else
    echo "已读";

