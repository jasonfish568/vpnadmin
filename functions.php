<?php

error_reporting(E_ALL);
function get_user_ip() {
    if(isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'] !='unknown')
    { $ip = $_SERVER['HTTP_CLIENT_IP'];}
    elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']!='unknown')
    {$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];}
    else{
        $ip = $_SERVER['REMOTE_ADDR']; 
    }
    return $ip;
}
date_default_timezone_set('PRC');

function html_header($title="")
{
	if($title != "")
	{
		$title =" - ". $title;
	}
?>
<!DOCTYPE html>
<html lang="cn">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="gbk">
<title>EU VPN系统<?php echo $title ?></title>
<meta name="description" content="EU VPN系统">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Le styles -->
<script type="text/javascript" src="../../js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap.js?version=2.3.1"></script>
<script type="text/javascript" src="../../js/ajax.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css?version=2.3.1">
<link href="../../css/style.css" rel="stylesheet" type="text/css" media="screen" /> 
</head>


<?php    
}

function sizeformat($bytesize)

             {

                     $i=0;
					 

                     while(abs($bytesize) >= 1024)

                            {

                             $bytesize=$bytesize/1024;

                                  $i++;

                                 if($i==4) break;

                            }

 

                      $units = array("字节","KB","MB","GB","TB");

                      $newsize=round($bytesize,2);

                  return("$newsize $units[$i]");

       } 
  function actformat($value)

             {
              if ($value==1){
              return '活跃';
              }
              else{
              return '停用';
              }

       } 
	   
	function statusformat($value)

             {
              if ($value==1){
              return '在线';
              }
              else{
              return '离线';
              }

       } 

	   
function quota_price($quota){
    switch($quota){
    case 1:return 0;
    case 2:return 10;
    case 3:return 15;
    case 4:return 20;
    case 5:return 25;
    case 10:return 50;
    }
}

function quota_change($user,$quota){
	$dbc =newDbc();
    mysql_select_db(DB_NAME, $dbc);
    $query = "SELECT * FROM user where username ='".$user."'";
	$result=mysql_query($query);
	$row=mysql_fetch_row($result);
	$quota_bytes=$row[8];
	$used_quota=$row[10];
	$quota_left=$quota-$used_quota;
	if ($quota_left<0){
		return 3;
		exit;
	}
	if ($quota == $quota_bytes){
		return 4;
		exit;
	}
	$query = "UPDATE user SET `quota_bytes`='".$quota."',`left_quota`='".$quota_left."' where user.username = '".$user."'"  ;
	$sub = mysql_query($query);
	if($sub){
		return 1;
		exit;
	}
	else{
		return 2;
		exit;
	}
	mysql_close($dbc);
}

function setSession($user)
{
    $dbc =newDbc();
    mysql_select_db(DB_NAME, $dbc);
    $query1 = "SELECT * FROM admin where username ='".$user."'";
    $result1 = mysql_query($query1);
    $row1 = mysql_fetch_row($result1);
    $num = mysql_num_rows($result1);
    if($num==1){
      $_SESSION['addInfo'] = 1;
      }
    else{
      $_SESSION['addInfo'] = 0;
      }
    $_SESSION['loggedin']=1;
    $_SESSION['username']=$user;
    //$_SESSION['admin'] = intval($row['admin']);
}

function clearCookie($user)
{
    $dbc =newDbc();
    mysql_select_db(DB_NAME, $dbc);
    $query = "SELECT *  FROM cookie WHERE user='".$user."'";
    $result = mysql_query($query);
    if(mysql_num_rows($result)>0)
    {
       $query1 = "DELETE FROM cookie where user ='".$user."'";
       mysql_query($query1);
     }
}

function safePost($str)
{
    $val = !empty($_POST["$str"]) ? $_POST["$str"]:null;
   // $val = strip_tags($val);
    // 这个好像太严格了
    // $val =htmlentities($val);
    $val = htmlentities($val,ENT_QUOTES,"UTF-8");
    if(!get_magic_quotes_gpc())
    {
        $val = addslashes($val);
    }
    return $val;
}

function safeGet($str)
{
    $val = !empty($_GET["$str"]) ? $_GET["$str"]:null;
    if(!get_magic_quotes_gpc())
    {
        $val = addslashes($val);
    }
    return $val;
}

function coinChange($user,$num,$type)
{
    $dbc =newDbc();
	mysql_select_db(DB_NAME, $dbc);
	$result=mysql_query("SELECT coin FROM user WHERE username ='".$user."'");
	$row=mysql_fetch_row($result);
	$new_coin = $row['0']+$num;
    $query ="update user set coin = $new_coin where username ='".$user."'";
    mysql_query($query) or die("failed");
    //$timestamp = microtime(true);
	/**
    if($num >0)
        $query ="insert into coin values('".$user."','".$type."','".$timestamp."','+".$num."') ";
    else
        $query ="insert into coin values('".$user."','".$type."','".$timestamp."','".$num."') ";
	**/
    mysql_query($query) or die ("failed insert");
    mysql_close($dbc);

}

function addMessage($user,$content,$from="system")
{
    $dbc =newDbc();
    $content =addslashes($content);
    $query ="insert into message values('".$user."','".time()."','".$content."','0','".$from."') ";
    mysqli_query($dbc,$query) or die ($query." add message failed ");
    $dbc->close();
}


function newDbc()
{
    $dbc = mysql_connect('localhost',DB_USER,DB_PASSWORD);
    if (!$dbc)
    {
      die('Could not connect: ' . mysql_error());
     }
    mysql_query("SET NAMES gbk"); 
    
    return $dbc;

}
function db_select($table,$condition ="1")
{
    $dbc =newDbc();
    mysql_select_db(DB_NAME, $dbc);
    $query = "select * from ".$table." where ".$condition;
    $result =mysql_query($query) or die ($query."failed!");
    return $result;


}
function show5info()
{
    echo " <table class='table table-hover '> <tbody> ";
    $dbc =newDbc();
    mysql_select_db(DB_NAME, $dbc);
    $query = "SELECT * FROM info where type ='通知' ORDER BY date DESC;";
    $result =mysql_query($query);
    $num_results = mysql_num_rows($result);
    $total_results = $num_results;
    //只显示最近五条
    if($num_results >10)  $num_results =10;
    $i = 0;
    while($i<$num_results)
    {
        $row = mysql_fetch_array($result);
        $i++;
        echo "<tr><td><p>".date("Y-m-d H:i 星期",$row['date']).trans($row['date'])."</p>"
                .nl2br($row['content']).
                "</td></tr>";
    }
    echo " </tbody> </table> ";
    echo ' <a href="search.php?all=true&q=+" class="btn">查看全部通知</a> ';


}

function trans($timeString){
    switch(date('w',$timeString)){
    case 0:return '日';
    case 1:return '一';
    case 2:return '二';
    case 3:return '三';
    case 4:return '四';
    case 5:return '五';
    case 6:return '六';
    }
}
function writelist($parent,$dbc,$showUser =false){
    $root =$_SERVER['DOCUMENT_ROOT'];
    $query = "SELECT * FROM resource where subject ='".$parent."'ORDER BY date DESC;";
    echo' <table style="background:white" class="table table-striped table-bordered">
        <thead>
        <tr>
        <th style="width:30px;text-align:center;">#</th>
        <th style="width:420px;">名称</th>
        <th style="width:70px;">文件大小</th>';
    if($showUser == true) echo ' <th style="width:70px;">上传者</th>';
    echo' <th style="width:70px;">上传时间</th>
        <th style="width:30px;">热度</th>';
if($showUser == true) echo ' <th style="width:30px;">评论</th>';
        echo'
        </tr>
        </thead>
        <tbody>
        '; 
     mysql_select_db(DB_NAME, $dbc);
    if($r = mysql_query($query)){  
        $index = 1;  
        while($row = mysql_fetch_array($r)){
          //  if(is_file($root.'/upload/'.$parent.'/'.$row['name']))
          //  {
                $size = filesize($root.'/upload/'.$parent.'/'.$row['name'])/1024/1024;
                $size = number_format($size,2);
                //两位小数
                $description = $row['description'];
                $commentNum =$row['comment'];
                echo "<tr>
                    <td style='text-align:center;'>".$index."</td>
                    <td>
                    <a href='download.php?subject=".$parent."&file=".$row['date']."'>".$row['name']."</a>
                    </td>
                    <td>".$size."MB</td>";

                if($showUser == true)
                    echo" <td>".$row['user']."</td>";

                echo"
                    <td>".date("Y/m/d",$row['date'])."</td>
                    <td>".$row['downloadtimes']."</td>";
                if($showUser == true) echo "
                    <td> <a href=\"#fileinfo\" onclick='loadComment(\"fileinfo.php?subject=".$parent."&file=".$row['date']."\")' role=\"button\" data-toggle=\"modal\">".$commentNum."</a> </td>";
                echo " </tr> ";
                $index++;
          //  }
           // else
            //    echo $row['name']."not a file";


        }
    }else{
        echo mysql_error($dbc);
    }
    echo " </tbody> </table> ";
}



?>
