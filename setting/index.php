<?php
require("../auth_head.php");
html_header("��������");

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
		showTime.innerHTML = "��������:"��+ onHours +"/"+ allHours;
}
</script>
</head>
<body>
    <!--������-->
    <?php include("../header_set.php");?>
    <script type="text/javascript">
    	set_active("nav_setting");
	</script>
    <!--/������-->
	<div class="container" >
	<?php
    $dbc = newDbc();
    $username=$_SESSION['username'];
    $nowip =get_user_ip();
    $result=db_select("user","user.username='".$username."' ");
    $row=mysql_fetch_row($result);
    echo "<div class='alert alert-info'>".$username." ���ã�,��ǰipΪ<code>".$nowip."</code>,";
    echo "����Ҫ�Զ���¼���ڵ�¼ʱ��ѡ remerber</div>";
    ?>
	<div class="row">
  		<div class="span6">
    		<h4><?php echo $username ?>���ϸ���</h4> 
    		<form action="change.php" method="post" class="form-horizontal">
 			<div class="control-group">
       			<label class="control-label" >��¼��</label>
        		<div class="controls">
            		<input name="name" type="text" disabled value="<?php echo $username ?>" />
            		<!-- �������disabled��û���õ� -->
        		</div>
  			</div>
			<div class="control-group">
                <label class="control-label" >�ǳ�</label>
                <div class="controls">
                    <input name="nickname" type="text"  value="<?php echo $row['4']?>" />
                </div>
      		</div>
  			<div class="control-group">
                <label class="control-label" >ǩ����</label>
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
                <label class="control-label" >��ǰ����</label>
                <div class="controls">
                    <input  name="old" type="password" />
                </div>
      		</div>
            <div class="control-group">
                <label class="control-label" >������</label>
                <div class="controls">
                    <input  name="new1" type="password" />
                </div>
            </div>
  			<div class="control-group">
        		<label class="control-label" >�ٴ�����</label>
        		<div class="controls">
      				<input  name="new2" type="password" />
        		</div>
      		</div>
    		<div class="control-group">
        		<div class="controls">
      				<input class ="btn btn-primary" type="submit" value="����" />
      				<p class="help-block">�������Ҫ�������룬�����������ռ���</p>
     				<p class="help-block">���emailҲ����Ҫ���ģ���ǰ����Ҳ��������</p>
        		</div>
      		</div>
    		</form>
  		</div>
        <!--alipay-->
  		<div class="span5">
    	<h4>֧������ֵ</h4>
            <form action="" method="post" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label" >��ֵ���</label>
                    <div class="controls">
                        <input id="" name="num" type="number" value="0" placeholder="��������Ҫ��ֵ�Ľ��"/>
                        <p class="help-block">֧������ֵ��ȡ<code>1.20%</code>�����ѣ�</p>
                    </div>
                </div>
            <div class="control-group">
                <label class="control-label" >��ֵ��ע</label>
                <div class="controls">
                    <textarea id="reason" name="reason" rows="1" cols="30"></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" >��������</label>
                <div class="controls">
                    <input id="" name="password" type="password" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" ></label>
                <div class="controls">
                    <input class="btn btn-primary" type="submit" value="��ֵ" />
                    <p class="help-block">�˹��ܻ����ڿ���״̬!</p>
                </div>
            </div>
            </form>
		</div>
	</div>
<hr />
<div class="span4">
	<h4>VPN�˻����</h4><br>
	<?php echo "��ǰʣ�� <code><big>".$row['12']."</big></code>Ԫ";?>
</div>
<br />
</div>

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
