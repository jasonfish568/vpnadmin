<?php
header('Content-Type:text/html;charset=gbk');
require("../auth_head.php");
$dbc = newDbc();
mysql_select_db(DB_NAME, $dbc);
//mysql_query("SET NAMES UTF-8");

if(isset($_GET['s']))
{
        $subject = $_GET['s'];
        if($subject == "upload")
        {
?>
<div class="well">
  <form action="upload.php" id="upload-form" target="_blank" method="post" onsubmit="return check()" enctype="multipart/form-data" >
    <div>
      <select  name="subject" id="subject" style="width:240px;">
        <option value="none">请选择栏目</option>
        <?php
$query = "select * from setting where `show`='1'";
$result = mysql_query($query);
while($row = mysql_fetch_row($result))
{
echo ' <option value='.$row['0'].'>'.$row['1'].'</option>';
}
?>
      </select>
      <br />
      <input type="hidden" name="<?php echo ini_get("session.upload_progress.name"); ?>" value="test" />
      <input  type="file" name="file" id="file" style="width:240px;height:40px;border:1px dotted grey;" /> 
      <br />
<p>描述下你上传的资源吧XD</p>
<textarea  name="description" rows="3" style="width:228px">我很懒，所以我什么描述都没写</textarea>
<!--
      <br />
      <input id="notInsertToInfo" name="notInsertToInfo" type="checkbox" /><span for="notInsertToInfo"> 不插入到首页消息提示</span>
      <br />
-->
<br />
      <input class="btn btn-primary" type="submit"  name="submit" 
      value="上传" style="width:150px;letter-spacing:35px;text-align:right;" />
    </form>
       <script type="text/javascript">
            function check(){
                var chosensub = document.getElementById("subject").value;
                if(chosensub == 'none'){
                    alert("明洋说：未选择正确科目！！");
                    return false;
        }
        return true;
        }
        </script>
  </div>
</div>



<?php
        }
        else
        {
            $subjectInfo = db_select("setting","subject='".$subject."'");
            $row = mysql_fetch_row($subjectInfo);
            echo "<h2>".$row['1']."</h2>";
            if($row['3'] !='')
                echo "<div class='alert alert-info'>".$row['3']."</div>";
            writelist($subject,$dbc,true);
        }

}

?>