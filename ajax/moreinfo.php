<?php

require_once("../auth_head.php");
//sleep(0.5);
$dbc =newDbc();
$key ='';
if (isset($_GET['key']) &&$_GET['key'] !='')
{
    $key = $_GET['key'];
    echo "<div class ='alert alert-success '>下面是<code>".$key."</code>搜索结果</div>";
}


$query = "SELECT * FROM info where content like '%".$key."%' and type='通知' ORDER BY date DESC;";
$result =mysqli_query($dbc,$query);
$num_results = $result->num_rows;
$total_results = $num_results;

    echo " <table  style='word-break:break-all; word-wrap:break-word' class='table table-hover '> <tbody> ";
    //只显示最近五条
    $i = 0;
    while($i<$num_results)
    {
        $i++;
        if($i <5)
            continue;
        $row = mysqli_fetch_array($result);
        echo "<tr><td><p>".date("Y-m-d H:i 星期",$row['date']).trans($row['date'])."</p><p>" .$row['content'].  "</p></td></tr>";
    }
    echo " </tbody> </table> ";

