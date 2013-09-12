<?php
require("./auth_head.php");
html_header();
$dbc = newDbc();
$username=$_SESSION['username'];
$nowip =get_user_ip();
mysql_select_db(DB_NAME, $dbc);
mysql_query("SET NAMES gbk");
$result=mysql_query("SELECT user.* FROM user WHERE user.username='".$username."' ");
$row=mysql_fetch_row($result);
$quota_bytes=$row[8];
$plan=$row[8]/1073741824;
$coin=$row[12];
?>
<!--[if lte IE 7]> 
<style type="text/css"> .icon-chevron-right { display:none; } </style>
<![endif]--> 
<!--[if lte IE 6]>
<link rel="stylesheet" type="text/css" href="css/bootstrap-ie6.css">
<link rel="stylesheet" type="text/css" href="css/ie.css?v=620">
<![endif]-->
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<![endif]-->
<script type="text/javascript">
function checked_price(){
  plan=<?php echo $plan ?>;
  if(plan==10){
	  plan=6;
  }
  plan=plan-1;
  var price = [0,10,15,20,25,50]
  for(i=0; i<=plan; i++){
	  document.getElementById(i).style.display="";
	  document.getElementById(i).innerHTML = " - 免费";
  }
  for(i=plan+1; i<=5;i++){
	  document.getElementById(i).style.display="";
	  document.getElementById(i).innerHTML = " - "+price[i]+"元";
  }
  
}

function set_active(banner){
	document.getElementById(banner).className="active";
}
function userInfo(){
	var allTime = document.getElementById("allTime").innerHTML;
	
	var onTime = document.getElementById("onTime").innerHTML;

	var level = document.getElementById("level");
	var le = document.getElementById("le");
	if(allTime == onTime){
		le.style.width = 100+"%";
	}
	else if(onTime == 0){
		le.style.width = 0;
	}
	else{
		countPercent(onTime,allTime,level,le);
	}
}
function countPercent(onHours,allHours,level,le){
	var floatNum = onHours/allHours;
	var percent = floatNum.toFixed("2");
	var toPercent;
	if(percent == 1.00){
		toPercent = 99;
	}
	else if(percent == 0.00){
		toPercent = 1;
	}
	else{
		toPercent = percent.substring(2);
	}
	le.style.width = toPercent+"%";
	var showTime = document.getElementById("showTime");
	//var inputgetNum = document.getElementById("inputgetNum");
	showTime.style.display = "block";
		//inputgetNum.style.display = "none";
		onHours = document.getElementById("usedsize").innerHTML;
		allHours = document.getElementById("totalsize").innerHTML;
		showTime.innerHTML = "已用流量:"　+ onHours +"/"+ allHours;
}
</script>
<!-- Le styles -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="js/scrolltop.js?v=6.2"></script>
<link media="all" rel="stylesheet" href="css/index_new.css?v=6" type="text/css" />
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<script type="text/javascript" src="js/ajax.js"></script>
</head>
<body onLoad="userInfo()" style="background:url('img/dianbg.jpg')">
    <!--导航栏-->
    <?php require("./header_in.php");?>
    <script type="text/javascript">
		set_active("nav_home");
	</script>
    <!--/导航栏-->
    <!--一级框架-->
    <div class="container-fluid" style="margin-top:20px; padding-bottom:150px; height:auto; min-height:100%">
    <!--二级框架-->
		<div class="row-fluid">
        <div class="span1" style="width:3%;min-height:3px"></div>
        <div class="span2" >
          <div class=" sidebar-nav";>
            <ul class="nav nav-tabs nav-stacked">
              <li class="nav-li" style=" border-top-left-radius: 5px; border-top-right-radius: 5px;" id="index"> 
                <a href="?">
                  <i class="icon-home"></i>首页
                </a> 
              </li>
              <li class="nav-li">
                <i class="icon-chevron-right" style="margin-top: 12px;"></i>
                  <a href="../doc/openvpn-2.2.1-install.exe">Openvpn程序下载</a>
              </li>
              <li class="nav-li">
                <i class="icon-chevron-right" style="margin-top: 12px;"></i>
                  <a href="../doc/vpn-noncert.zip">日本线路证书文件下载</a>
              </li>
              <li class="nav-li">
                <i class="icon-chevron-right" style="margin-top: 12px;"></i>
                  <a href="../doc/hkvpn-noncert.zip">香港线路证书文件下载</a>
              </li>
              <li class="nav-li">
              <i class="icon-chevron-right" style="margin-top: 12px;"></i>
                  <a href="../doc/instru.php">openvpn使用说明</a>
              </li>
              <?php
                $query = "select * from setting where `show`=1";
                $result = mysql_query($query);
                while($row = mysql_fetch_row($result))
                  {
              ?>
              <li class="nav-li" id="<?php echo $row['0']?>">
                <i class="icon-chevron-right" style="margin-top: 12px;"></i>
                  <a href="#"  onclick='loadXML("ajax/ls-inner.php","<?php echo $row['0'] ?>")'><?php echo $row['1'] ?></a>
              </li>
             <?php } ?>
              <li class="nav-li" style=" border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; " id="upload"> 
                <i class="icon-chevron-right" style="margin-top: 12px;"></i>
                <a href="#"  onclick='HttpRequest("ajax/changequota.php");checked_price();'>更改流量计划</a> 
              </li>
          </ul>
         </div><!--/.sidebar-nav -->
       </div><!--/span2-->
       <!--右侧主框架-->
       <div class="span9" id="more" style=" ">
       <div class="row" style="background:white;box-shadow:3px 3px #ddd;margin-left:0.1%;border-radius:5px;border:1px solid #d3d3d3;">
       <!-- 公告板-->
       <div class="span9" style="border-right:1px solid #d3d3d3;padding-bottom:20px;">
       <div style="margin:20px;">
       <!--数据表-->
      <h3>VPN数据</h3>
      <table   class='table table-hover ' >
      <tbody>
      <tr><td></td><td></td><td></td><td></td></tr>
      <tr  bgcolor="#808080">

        <td width="25%"><div align="left"> 用户名</div></td>
        <td width="25%"><div align="left"> 开始时间</div></td>
        <td width="25%"><div align="left"> 统计周期</div></td>
        <td width="25%"><div align="left"></div></td>
         <?php
            $result=mysql_query("SELECT user.* FROM user WHERE user.username='".$username."' ");
            //$row=mysql_fetch_row($result);
           while($row=mysql_fetch_row($result))
                {      				
                //print($row);
         ?>
      </tr>
      <tr bgcolor="#C0C0C0">
        <td><?php echo $row[0] ?></td>
        <td><?php echo $row[3] ?></td>
        <td><?php echo $row[7] ?>天</td>
        <td>
            <!--div class="uInfo">
              <p id="level"><span id="le"></span></p>    
            </div>
            <div  class="getNum" >
              <P id="showTime" ></p>
              <!--input id="inputgetNum" type="button" value="显示流量" onclick="userInfo()">
            </div-->
       </td>
      </tr>     
      <tr  bgcolor="#808080">
        <td width="25%"><div align="left">用户状态</div></td>
        <td width="25%"><div align="left">总流量</div></td>
        <td width="25%"><div align="left">总使用量</div></td>
        <td width="25%"><div align="left">剩余流量</div></td>
      </tr>
      <tr bgcolor="#C0C0C0" >
        <td><?php echo actformat($row[2]) ?></td>
        <td id="totalsize"><?php echo sizeformat($row[8]) ?></td>
        <td id="usedsize"><?php echo  sizeformat($row[10]) ?></td>
        <td><?php echo  sizeformat($row[11]) ?></td>
      </tr>      
      <tr  class="Content_style1" style="display:none">
        <div id="allTime" style="display:none"><?php echo $row[8] ?></div>
        <div id="onTime" style="display:none"><?php echo  $row[10] ?></div>
      </tr>      
      </tbody>
      </table>
      <!-- end 数据表 -->
      <h3>公告板</h3>
      <?php show5info(); ?>
      </div>						
      </div>
      <!--公告板结束-->
      <!--右侧边栏开始-->
      <div class="span3 hidden-phone" style="margin-left:0px;width:25.5%">
          <div style="margin:16px">
              <div>
                <h3>VPN账户余额:
                    <code style='font-size:large'><?php echo $row[12] ?></code>元 
                </h3>
              </div>
              <a class='btn btn-large btn-primary' href="setting">充值!</a><br />
              <!--右边栏1层结束-->
              <div class="uInfo" >
                <p id="level"><span id="le"></span></p>  
                <div  class="getNum" >
                  <P id="showTime" ></p>
                  <!--input id="inputgetNum" type="button" value="显示流量" onclick="userInfo()"-->
                </div>  
              </div>
              <!--右边栏流量条结束-->
              <hr />
              <!--时间模块开始-->
              <?php
              //time ,23点后显示
              if (date("H") >=0)
              {
              ?>
              <div style="margin-left:30%;">
                <p style='align:center;margin:9px;'>
                      <code id='tH'><?php echo date('H');?></code> :
                      <code id='ti'><?php echo date("i"); ?></code> :
                      <code id='ts'><?php if(date("i") == 59)
                                              echo "hehe不告诉你";
                                           else 
                                              echo date('s');
                                    ?>
                      </code>
                </p>
                <script type='text/javascript'>
                    setTimeout(setTime,600);
                </script>
              </div>
             <?php
             }
              ?>
            <!--时间模块结束-->
          </div>
      </div>
      <!--/右侧边栏结束-->
      <?php
        }
      ?>
      </div>
      </div>
      <!--右侧主框架-->
		</div>
		<!--/二级框架-->
		</div>
		<!--一级框架--> 
    <div class="footer" >
      <p class="text-center">
        <strong>友情链接：</strong>
        <a href="http://www.euclan.com" target="_blank">EU战队</a>
        <p class="text-center muted">Copyright &copy; VPN.EUCLAN.COM 2012-2013</p>
      </p>
    </div> <!--footer-->   
    <div id="gotopbtn" title="回到顶部" style="display:none;">
      <img src="../img/gototop.png">
    </div>
    <script src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/unslider.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/keyEvents.js"></script>
    <script type="text/javascript" src="js/jquery.pin.js"></script>
    <script type="text/javascript">
    $(".sidebar-nav").pin({ minWidth: 1000});
    
    $('.banner').unslider({
        arrows: false,
            fluid: true,
            key:false,
            dots: true
    });
    
    goTopEx();
    </script>


<!--[if lte IE 6]>
  <script type="text/javascript" src="js/bootstrap-ie.js"></script>
  <![endif]-->
</body>
<html>

