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
	  document.getElementById(i).innerHTML = " - ���";
  }
  for(i=plan+1; i<=5;i++){
	  document.getElementById(i).style.display="";
	  document.getElementById(i).innerHTML = " - "+price[i]+"Ԫ";
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
		showTime.innerHTML = "��������:"��+ onHours +"/"+ allHours;
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
    <!--������-->
    <?php require("./header_in.php");?>
    <script type="text/javascript">
		set_active("nav_home");
	</script>
    <!--/������-->
    <!--һ�����-->
    <div class="container-fluid" style="margin-top:20px; padding-bottom:150px; height:auto; min-height:100%">
    <!--�������-->
		<div class="row-fluid">
        <div class="span1" style="width:3%;min-height:3px"></div>
        <div class="span2" >
          <div class=" sidebar-nav";>
            <ul class="nav nav-tabs nav-stacked">
              <li class="nav-li" style=" border-top-left-radius: 5px; border-top-right-radius: 5px;" id="index"> 
                <a href="?">
                  <i class="icon-home"></i>��ҳ
                </a> 
              </li>
              <li class="nav-li">
                <i class="icon-chevron-right" style="margin-top: 12px;"></i>
                  <a href="../doc/openvpn-2.2.1-install.exe">Openvpn��������</a>
              </li>
              <li class="nav-li">
                <i class="icon-chevron-right" style="margin-top: 12px;"></i>
                  <a href="../doc/vpn-noncert.zip">�ձ���·֤���ļ�����</a>
              </li>
              <li class="nav-li">
                <i class="icon-chevron-right" style="margin-top: 12px;"></i>
                  <a href="../doc/hkvpn-noncert.zip">�����·֤���ļ�����</a>
              </li>
              <li class="nav-li">
              <i class="icon-chevron-right" style="margin-top: 12px;"></i>
                  <a href="../doc/instru.php">openvpnʹ��˵��</a>
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
                <a href="#"  onclick='HttpRequest("ajax/changequota.php");checked_price();'>���������ƻ�</a> 
              </li>
          </ul>
         </div><!--/.sidebar-nav -->
       </div><!--/span2-->
       <!--�Ҳ������-->
       <div class="span9" id="more" style=" ">
       <div class="row" style="background:white;box-shadow:3px 3px #ddd;margin-left:0.1%;border-radius:5px;border:1px solid #d3d3d3;">
       <!-- �����-->
       <div class="span9" style="border-right:1px solid #d3d3d3;padding-bottom:20px;">
       <div style="margin:20px;">
       <!--���ݱ�-->
      <h3>VPN����</h3>
      <table   class='table table-hover ' >
      <tbody>
      <tr><td></td><td></td><td></td><td></td></tr>
      <tr  bgcolor="#808080">

        <td width="25%"><div align="left"> �û���</div></td>
        <td width="25%"><div align="left"> ��ʼʱ��</div></td>
        <td width="25%"><div align="left"> ͳ������</div></td>
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
        <td><?php echo $row[7] ?>��</td>
        <td>
            <!--div class="uInfo">
              <p id="level"><span id="le"></span></p>    
            </div>
            <div  class="getNum" >
              <P id="showTime" ></p>
              <!--input id="inputgetNum" type="button" value="��ʾ����" onclick="userInfo()">
            </div-->
       </td>
      </tr>     
      <tr  bgcolor="#808080">
        <td width="25%"><div align="left">�û�״̬</div></td>
        <td width="25%"><div align="left">������</div></td>
        <td width="25%"><div align="left">��ʹ����</div></td>
        <td width="25%"><div align="left">ʣ������</div></td>
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
      <!-- end ���ݱ� -->
      <h3>�����</h3>
      <?php show5info(); ?>
      </div>						
      </div>
      <!--��������-->
      <!--�Ҳ������ʼ-->
      <div class="span3 hidden-phone" style="margin-left:0px;width:25.5%">
          <div style="margin:16px">
              <div>
                <h3>VPN�˻����:
                    <code style='font-size:large'><?php echo $row[12] ?></code>Ԫ 
                </h3>
              </div>
              <a class='btn btn-large btn-primary' href="setting">��ֵ!</a><br />
              <!--�ұ���1�����-->
              <div class="uInfo" >
                <p id="level"><span id="le"></span></p>  
                <div  class="getNum" >
                  <P id="showTime" ></p>
                  <!--input id="inputgetNum" type="button" value="��ʾ����" onclick="userInfo()"-->
                </div>  
              </div>
              <!--�ұ�������������-->
              <hr />
              <!--ʱ��ģ�鿪ʼ-->
              <?php
              //time ,23�����ʾ
              if (date("H") >=0)
              {
              ?>
              <div style="margin-left:30%;">
                <p style='align:center;margin:9px;'>
                      <code id='tH'><?php echo date('H');?></code> :
                      <code id='ti'><?php echo date("i"); ?></code> :
                      <code id='ts'><?php if(date("i") == 59)
                                              echo "hehe��������";
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
            <!--ʱ��ģ�����-->
          </div>
      </div>
      <!--/�Ҳ��������-->
      <?php
        }
      ?>
      </div>
      </div>
      <!--�Ҳ������-->
		</div>
		<!--/�������-->
		</div>
		<!--һ�����--> 
    <div class="footer" >
      <p class="text-center">
        <strong>�������ӣ�</strong>
        <a href="http://www.euclan.com" target="_blank">EUս��</a>
        <p class="text-center muted">Copyright &copy; VPN.EUCLAN.COM 2012-2013</p>
      </p>
    </div> <!--footer-->   
    <div id="gotopbtn" title="�ص�����" style="display:none;">
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

