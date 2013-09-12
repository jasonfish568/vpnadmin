<?php
require("../auth_head.php");
html_header("个人中心");

?>

<script type="text/javascript">
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
</head>
<body>
    <!--导航栏-->
    <?php include("../header_set.php");?>
    <script type="text/javascript">
    	set_active("nav_setting");
	</script>
    <!--/导航栏-->
	<div class="container" >
	<?php
    $dbc = newDbc();
    $username=$_SESSION['username'];
    $nowip =get_user_ip();
    $result=db_select("user","user.username='".$username."' ");
    $row=mysql_fetch_row($result);
    echo "<div class='alert alert-info'>".$username." 您好！,当前ip为<code>".$nowip."</code>,";
    echo "如需要自动登录请在登录时勾选 remerber</div>";
    ?>
	<div class="row">
  		<div class="span6">
    		<h4><?php echo $username ?>资料更改</h4> 
    		<form action="change.php" method="post" class="form-horizontal">
 			<div class="control-group">
       			<label class="control-label" >登录名</label>
        		<div class="controls">
            		<input name="name" type="text" disabled value="<?php echo $username ?>" />
            		<!-- 改这里的disabled是没有用的 -->
        		</div>
  			</div>
			<div class="control-group">
                <label class="control-label" >昵称</label>
                <div class="controls">
                    <input name="nickname" type="text"  value="<?php echo $row['4']?>" />
                </div>
      		</div>
  			<div class="control-group">
                <label class="control-label" >签名档</label>
                <div class="controls">
                    <textarea id="signature" name="signature" rows="2" cols="30"><?php echo $row['6'];?></textarea>
                </div>
      		</div>
			<div class="control-group">
                <label class="control-label" >Email</label>
                <div class="controls">
                    <input id="ip" name="email" type="text" value="<?php echo $row['5']; ?>" />
                </div>
      		</div>
  			<div class="control-group">
                <label class="control-label" >当前密码</label>
                <div class="controls">
                    <input  name="old" type="password" />
                </div>
      		</div>
            <div class="control-group">
                <label class="control-label" >新密码</label>
                <div class="controls">
                    <input  name="new1" type="password" />
                </div>
            </div>
  			<div class="control-group">
        		<label class="control-label" >再次输入</label>
        		<div class="controls">
      				<input  name="new2" type="password" />
        		</div>
      		</div>
    		<div class="control-group">
        		<div class="controls">
      				<input class ="btn btn-primary" type="submit" value="更新" />
      				<p class="help-block">如果不需要更改密码，则新密码留空即可</p>
     				<p class="help-block">如果email也不需要更改，则当前密码也可以留空</p>
        		</div>
      		</div>
    		</form>
  		</div>
        <!--alipay-->
  		<div class="span5">
    	<h4>支付宝充值</h4>
            <form action="" method="post" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label" >充值金额</label>
                    <div class="controls">
                        <input id="" name="num" type="number" value="0" placeholder="请输入需要充值的金额"/>
                        <p class="help-block">支付宝充值收取<code>1.20%</code>手续费！</p>
                    </div>
                </div>
            <div class="control-group">
                <label class="control-label" >充值备注</label>
                <div class="controls">
                    <textarea id="reason" name="reason" rows="1" cols="30"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" >输入密码</label>
                <div class="controls">
                    <input id="" name="password" type="password" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" ></label>
                <div class="controls">
                    <input class="btn btn-primary" type="submit" value="充值" />
                    <p class="help-block">此功能还处于开发状态!</p>
                </div>
            </div>
            </form>
		</div>
	</div>
<hr />
<div class="span4">
	<h4>VPN账户余额</h4><br>
	<?php echo "当前剩余 <code><big>".$row['12']."</big></code>元";?>
</div>
<br />
</div>

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
