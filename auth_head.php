<?php 
include("data/config.inc.php");
require('functions.php'); 
    session_start();
    // Call this function so your page
    // can access session variables
    $logout=@$_GET['logout'];
	$username=$_SESSION['username'];
	
    if($logout == 1)
    {
        if (isset($_COOKIE['sso']))
        {
        $dbc =newDbc();
        mysql_select_db(DB_NAME, $dbc);
        $query = "delete  from cookie where sso='".$_COOKIE['sso']."'";
        $result=mysql_query($query);
        }
        setcookie("sso", "", time()-3600);
        $_SESSION['loggedin']=0;
        $_SESSION['addInfo'] = 0;
    }
        
    $url=$_SERVER['PHP_SELF'];
        
    if ($_SESSION['loggedin'] != 1) {
        // If the 'loggedin' session variable
        // is not equal to 1, then you must
        // not let the user see the page.
        // So, we'll redirect them to the
        // login page (login.php).
 
        header("Location: ../login.php?url=".$url);
        exit;
    }
 
  ?>  
