<?php

require("../auth_head.php");

$name = safePost('at_name');
$result =db_select("user","`name` like '%".$name."%' limit 0,5");
echo " <div class=\"alert alert-info\">你是不是要提到这些人: ";
while ($row =mysqli_fetch_array($result))
{
    echo"
       <a href='#' onclick=\"set_remind('".$row['name']."')\">".$row['name']."</a> 
";
}

echo " </div>";
