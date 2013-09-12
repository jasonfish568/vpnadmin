<?php
require_once('auth_admin.php');
require_once('../functions.php');
html_header("管理后台 - 用户管理");

if($_SESSION['addInfo'] !=1)
{
    header("Location:index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>计科一班</title>
    <script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link href="../css/style.css" rel="stylesheet" type="text/css" media="screen" />   
    <style type="text/css">

      .center
      {
        margin-left:auto;
        margin-right:auto;
        float:none;
        text-align:center;
      }
      #gotopbtn{   
        position:fixed;
        top:550px;
        left:90%;
      }
    </style>
    <script type="text/javascript" src="js/scrolltop.js"></script>
<script type="text/javascript">
function reloadPage(){
  window.location.reload();
       }
       function checkForm(){
         if(window.confirm("确定删除？")){
           reloadPage();
           return true;
           }
        return false;
       }
    </script>
</head>

  <body>
<div style="padding: 0px 0px 50px; margin: 0px; border-width: 0px; height: 0px; display: block;" id="yass_top_edge_padding"></div>
  <div class="navbar  navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="../"><?php echo SITE_NAME ?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li> <a href="./">Home</a> </li>
              <li class="active"> <a href="wadmin.php" >文件管理</a> </li>
              <li> <a href="viewUsers.php">用户管理</a> </li>
              <li> <a href="setting.php"> 网站设置</a> </li>
              <li> <a href="viewip.php" >访问统计</a> </li>
              <li> <a href="todayCoin.php" >今日金币</a> </li>
              <li> <a href="viewdown.php" >下载统计</a> </li>
             </ul>
          </div><!--/.nav-collapse -->
          <a href="?logout=1" class="btn btn-danger pull-right">Log out</a>
        </div>
      </div>
    </div>

          <div class="container" style="width:970px">
            <div class="tabbable tabs-left">
              <ul class="nav nav-tabs" id="mainmenu">
                <li class="active"><a href="#1" data-toggle="tab">首页</a></li>
<?php

$dbc = newDbc();
mysql_select_db(DB_NAME, $dbc);
$query = "select * from setting ";
$result = mysql_query($query) or die ("query failed!");
$temp= array();
$i = 2;
while($row =mysql_fetch_row($result))
{

  $temp[$i][0]= $row['0'];
  $temp[$i][1]= $row['1'];
  echo '<li><a href="#'.$i.'" data-toggle="tab">'.$row['1'].'</a></li> ';
  $i++;
}
?>
              </ul>
              <div class="span10 tab-content pull-right">
                <div class="tab-pane active" id="1"> <h2>前方有怪兽！</h2> </div>

<?php
$j = 2;
while ($j <=$i)
{
  echo ' <div class="tab-pane" id="'.$j.'"><h3>';
  echo $temp[$j][1];
  echo '</h3> <hr /> ';
  ListFiles($temp[$j][0]);
  $j++;
  echo "</div> ";
}

?>
 </div>
</div>
</div>
</div>
<div class="span10 center">Copyright &copy 2012 sysucs.org</div>
</div>
  </body> </html>
<?php
function sortFileByDate($dir)
{
  if(is_dir($dir))
  {
    $scanArray=scandir($dir);
    $finalArray = array();
    for($i=0; $i<count($scanArray);$i++)
    {
      if($scanArray[$i]!="."&&$scanArray[$i]!="..")
      {
        $finalArray[$scanArray[$i]]=filectime($dir."/".$scanArray[$i]); 
      }
    }
    arsort($finalArray);
    return($finalArray);
    //返回数组，key为文件名，value为文件时间
  }
  else 
    echo "sorry,".$dir."is not a dir";

}


function ListFiles($Spath){
  $orginSpath =$Spath;
  $Spath = "../upload/".$Spath;
  echo' <table class="table table-striped table-bordered">
    <thead>
    <tr>
    <th style="text-align:center;">#</th>
    <th>名称(按上传时间排序)</th>
    <th style="width:80px;">文件大小</th>
    <th style="width:90px;">上传时间</th>
    <th style="width:45px;">操作</th>
    </tr>
    </thead>
    <tbody> '; 

  date_default_timezone_set("Asia/Shanghai");
  $sortedPath = sortFileByDate($Spath);
  $index = 0;
  while ($element =each($sortedPath))
  {
    $longPath = "./".$Spath."/".$element['key'];
    $size =filesize($longPath)/1024/1024;
    $size = number_format($size,2);
    //两位小数
    $filedownloadtime = $element['value']; 
    $downtime_fomat = date('m/d H:i',$filedownloadtime);
    //格式化显示
    $index++;

    echo '<tr>
      <td style="text-align:center;width:60px;">'.$index.'</td>
      <td><a target="_blank" title="点击下载" href=/'.$longPath.'>'.$element['key']."</a></td>
      <td>".$size."MB</td>
      <td>".$downtime_fomat."</td>
      ";
    echo "<td ><form action='delete-file.php' target='_blank' method='post' onsubmit='return checkForm()' style='margin:0 0 0px;'>";
    echo "<input type='hidden' name='pathToD' value='".$orginSpath."'/>";
    echo "<input type='hidden' name='fileToD' value='".$element['key']."'/>"; 
    echo "<input class='btn-danger' type='submit' style='padding:0 0 ;' name='submit' value='delete' style='margin:0 0 0px;'/>";
    echo "</td></form></tr>";
  }
  echo "</table>";

}

?>