<?php
require_once('auth_admin.php');
require("../header.html");
require("../functions.php");
?>
<body>
<div class="container">



<?php
$dbc =newDbc();
mysql_query("set names gbk;");
mysql_select_db(DB_NAME,$dbc);
if(!$dbc){    
    echo "failed";
}
date_default_timezone_set('PRC');
$deleteInfo = $_POST['deleteInfo'];
$deleteContent = $_POST['deleteContent'];
echo "<div class='well'><h2>ɾ������</h2><div class='alert alert-info'> ".$deleteContent." </div>";
$query = "DELETE FROM info WHERE date = '".$deleteInfo."'";
$res=mysql_query($query);
mysql_close($dbc);
if($res) 
    {
                echo "<div class=\"alert alert-success\"><h3>";
                echo "�����ݿ�ɾ���ɹ���<br />";
                echo "</h3></div>\n";
                echo "<a class='btn' href='/admin'>����</a>";
    }
else{
    echo "ʧ��";
    echo "<a class='btn' href='/admin'>����</a>";
}
//echo "<h1 id='countdown' class='well' style='TEXT-align:center'></h1>";
?>

<script language="javascript">
var i = 5;
//<!-- ����ʱ5��ر�ҳ��
function clock(){
    i=i-1;
    document.title = "�����ڽ���"+i+"����Զ��ر�!";
    document.getElementById("countdown").innerHTML =  "�����ڽ���"+i+"����Զ��ر�!";
    if(i>0)setTimeout("clock();",1000);
    else self.close();
    }
    var i=1;
    clock();
    //-->
    </script>

</body>
</html>


