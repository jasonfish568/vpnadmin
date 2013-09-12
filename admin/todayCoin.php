<?php

require_once('auth_admin.php');


require_once('../functions.php');
require_once('../header.html');
?>
<div style="padding: 0px 0px 50px; margin: 0px; border-width: 0px; height: 0px; display: block;" id="yass_top_edge_padding"></div>
  <div class="navbar  navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="../"><?php echo SITE_NAME ?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
<li> <a href="./">Home</a> </li>
<li> <a href="wadmin.php" >文件管理</a> </li>
<li> <a href="viewUsers.php">用户管理</a> </li>
<li> <a href="setting.php"> 网站设置</a> </li>
<li> <a href="viewip.php" >访问统计</a> </li>
<li class="active"> <a href="todayCoin.php" >今日金币</a> </li>
<li> <a href="viewdown.php" >下载统计</a> </li>
            </ul>
          </div><!--/.nav-collapse -->

<a href="?logout=1" class="btn btn-danger pull-right">Log out</a>
        </div>
      </div>
    </div>


<div class="container">
<br />
<br />

<table class="table table-bordered">
<tbody>
<?php
$dbc =newDbc();
$today = date("Y/m/d");
$date_second = strtotime($today);

$query = "SELECT * FROM coin WHERE date >=".$date_second." ORDER BY date DESC ";
$checkedUser = mysqli_query($dbc,$query);

$n = $checkedUser->num_rows; 
for($i=0;$i<$n;$i++)
{
    echo "<tr>";
    $row =mysqli_fetch_array($checkedUser);
    echo "<td>".date("H:i:s",$row['date'])."
        </td><td><a href='viewUsers.php?user=".$row['user']."'>".$row['user']."</a></td><td>"
        .$row['type']."</td><td> <code>"
        .$row['num']."</code></td></tr>\n";
}
?>

</tbody>
</table>



