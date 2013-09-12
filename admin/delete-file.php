<?php
require_once('auth_admin.php');
require("../functions.php");
require_once('../header.html');

if($_SESSION['admin'] !=1)
{
    header("Location:index.php");
    exit;
}

?>


<div id="container">
<br />
<br />


<?php
$dbc = newDbc();
$subject =safePost('pathToD');
$fileName =safePost('fileToD');
$fileToDelete = "../upload/".$subject.'/'.$fileName;
unlink($fileToDelete);
echo "deleting ".$_POST['fileToD']." from ".$_POST['pathToD']." <br />";

$query = "select * from resource  WHERE subject ='".$subject."' and name = '".$fileName."';";
$result =mysqli_query($dbc,$query);
$row = mysqli_fetch_array($result);

echo $row['user'];
$num = -10;
$user =$row['user'];
$type="资源".$fileName."被删除";
$date =$row['date'];
coinChange($user,$num,$type);

$query = "DELETE FROM resource WHERE subject='".$subject."' and name = '".$fileName."';";
echo "<div class='well'><h1><div class='alert alert-success' style='TEXT-align:center;'>删除成功</div></h1></div>";
if(mysqli_query($dbc,$query)) echo "已从数据库删除";
echo "<h1 id='countdown' class='well' style='TEXT-align:center'>lalala</h1>";

$query ="delete from comment where subject='".$subject."' and file='".$fileName."'";
mysqli_query($dbc,$query) or die($query. "  delete comment failed!");
$query ="delete from info where subject='".$subject."' and date='".$date."'";
mysqli_query($dbc,$query) or die($query. "  delete info failed!");

?>


<script language="javascript">
//<!-- 倒计时5秒关闭页面
function clock(){
    i=i-1;
    document.title = "本窗口将在"+i+"秒后自动关闭!";
    document.getElementById("countdown").innerHTML =  "本窗口将在"+i+"秒后自动关闭!";
    if(i>0)setTimeout("clock();",1000);
//    else self.close();
    }
    var i=2;
    clock();
    //-->
    </script>
</div>
</body>
</html>
