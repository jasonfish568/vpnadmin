<?php
  session_start();
    include("../data/config.inc.php");
  if($_SESSION['addInfo'] !=1)
  {
	  header("Location:login.php");
	  exit;
  }
  require_once('../functions.php');
	date_default_timezone_set("PRC");

	$user = $_POST['userId'];
	$num = $_POST['coin'];

  
  $user = $_POST['userId'];
  $dbc = newDbc();
  mysql_select_db(DB_NAME, $dbc);
  $query ="UPDATE user SET enabled = 1 WHERE user.username = '".$user."'";
  mysql_query($query);
  mysql_close($dbc);
  echo "活跃";

?>
<script type="text/javascript">
	$("#change").html("<h5><?php echo $user ?>用户已解锁</h5>");
 </script>