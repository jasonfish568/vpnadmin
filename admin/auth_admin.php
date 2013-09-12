<?php 
include("../data/config.inc.php");
session_start();
@$logout=$_GET['logout'];
if($logout ==1)
{
    $_SESSION['loggedin']=0;
    //$_SESSION['admin'] =0;
    $_SESSION['addInfo'] =0;
}

$url=$_SERVER['PHP_SELF'];

if(@$_SESSION['loggedin']!=1 )
{
    header("Location:../../login.php?url=".$url);
    exit;

}
else if($_SESSION['addInfo'] !=1)
{
  echo "PERMISSION DENIED!! GO BACK!";
  exit;
}
?>
