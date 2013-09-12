<?php
require("../auth_head.php");
html_header("管理后台");
$dbc = newDbc();
$username=$_SESSION['username'];
$nowip =get_user_ip();
$result=db_select("user","user.username='".$username."' ");
$row=mysql_fetch_row($result);
?>
<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../../css/style.css">
<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
<script type="text/javascript">
function reloadPage(){
   window.location.reload();
}
function checkForm(){
   if(window.confirm("删除后不可恢复，确定删除？")){
	   return true;
   }
return false;
}
function addList(){
  document.getElementById('content').value += "<ul></ul>"; 
}
function addItem(){
  document.getElementById('content').value += "<li></li>"; 
}
</script>
</head>
<body>
<div class="container" >
<div style="padding: 0px 0px 50px; margin: 0px; border-width: 0px; height: 0px; display: block;" id="yass_top_edge_padding"></div>
  <div class="navbar  navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="../"><?php echo SITE_NAME ?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
<li class="active"> <a href="#" >HOME</a> </li>
<?php
if($_SESSION['addInfo'] ==1)
{
    echo '
    <li> <a href="wadmin.php" >文件管理</a> </li>
<li> <a href="viewUsers.php">用户管理</a> </li>
<li> <a href="setting.php"> 网站设置</a> </li>
';
}

?>

<li> <a href="viewip.php" >访问统计</a> </li>
<li> <a href="todayCoin.php" >今日金币</a> </li>
<li> <a href="viewdown.php" >下载统计</a> </li>
           </ul>
          </div><!--/.nav-collapse -->

<a href="?logout=1" class="btn btn-danger pull-right">Log out</a>
        </div>
      </div>
    </div>


<div class="container">
<!-- new editor -->



 <form  method="post" onSubmit=" $('#content').val($('#editor').html()); " action="./insert_info.php">


            <div >
              <div class="controls">

          <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="icon-font"></i><b class="caret"></b></a>
          <ul class="dropdown-menu">
          </ul>
        </div>
      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i><b class="caret"></b></a>
          <ul class="dropdown-menu">
          <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
          <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
          <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
          </ul>
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a>
        <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a>
        <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a>
        <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a>
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="icon-list-ul"></i></a>
        <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="icon-list-ol"></i></a>
        <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i></a>
        <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="icon-indent-right"></i></a>
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="icon-align-left"></i></a>
        <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="icon-align-center"></i></a>
        <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="icon-align-right"></i></a>
        <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="icon-align-justify"></i></a>
      </div>
      <div class="btn-group">
          <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="icon-link"></i></a>
            <div class="dropdown-menu input-append">
                <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
                <button class="btn" type="button">Add</button>
        </div>
        <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="icon-cut"></i></a>

      </div>
      <div class="btn-group">
        <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="icon-picture"></i></a>
        <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="icon-undo"></i></a>
        <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="icon-repeat"></i></a>
      </div>
      <input type="text" data-edit="inserttext" id="voiceBtn" x-webkit-speech="">
    </div>

    <div id="editor" >

    </div>

                  </div> </div>
<input id="content" type="hidden" name="content" />
                <button type="submit" class="btn">Add</button>
          </form>



<!-- new editor end -->








<?php
        error_reporting(E_ALL);
$dbc =newDbc();
          if(!$dbc){
          echo "failed";
          }
          else{
          echo "<p>数据库连接成功，下面是历史消息：</p>";
          }
          mysql_query("set names gbk");
          mysql_select_db(DB_NAME,$dbc);
          date_default_timezone_set('PRC');

$query = "SELECT * FROM info ORDER BY date DESC;";
          $result =mysql_query($query);
          $num_results = mysql_num_rows($result);

          echo"
              <table class='table table-striped table-bordered'>
              <thead>
                  <tr>
                      <th>#</th>
                      <th>date</th>
                      <th width='60%'>content</th>
                      <th>ip</th>
                      <th>option</th>
                  </tr>
              </thead>
              <tbody> ";

          for($i=0;$i<$num_results;$i++)
          {
              $row = mysql_fetch_row($result);
              echo "<tr>
                  <td>".($i+1)."</td>  ";
              echo "<td>".date("Y/m/d H:i",$row['3'])."</td>";
              echo "<td>".$row['0']."</td>";
              echo "<td>".$row['4']."</td>";
              echo "
                  <td>
                  <form style='margin:0 0 0; ' onsubmit='return checkForm()' target='_blank' action='delete-info.php' method='post'>
                  <input name='deleteInfo' type='hidden' value='".$row['3']."' />
                  <input name='deleteContent' type='hidden' value='".$row['0']."' />
                  <input type='submit'class='btn btn-danger' value='delete' />
                  </form>
                  </td> ";
          }

?>
    </div>

<script src="//cdnjs.bootcss.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="../js/jquery.hotkeys.js"></script>
<script type="text/javascript" src="../../js/bootstrap.js"></script>
<script type="text/javascript" src="http://www.bootcss.com/p/bootstrap-wysiwyg/bootstrap-wysiwyg.js"></script>
<script type="text/javascript">
  $(function(){
    function initToolbarBootstrapBindings() {
      var fonts = ['微软雅黑','Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 
            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
            'Times New Roman', 'Verdana'],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
      $.each(fonts, function (idx, fontName) {
          fontTarget.append($('<li><a data-edit="fontName ' + fontName +'" style="font-family:\''+ fontName +'\'">'+fontName + '</a></li>'));
      });
      $('a[title]').tooltip({container:'body'});
    	$('.dropdown-menu input').click(function() {return false;})
		    .change(function () {$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');})
        .keydown('esc', function () {this.value='';$(this).change();});

      $('[data-role=magic-overlay]').each(function () { 
        var overlay = $(this), target = $(overlay.data('target')); 
        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
      });
      $('#voiceBtn').hide();
      // if ("onwebkitspeechchange"  in document.createElement("input")) {
      //   var editorOffset = $('#editor').offset();
      //   $('#voiceBtn').css('position','absolute').offset({top: editorOffset.top, left: editorOffset.left+$('#editor').innerWidth()-35});
      // } else {
      //   $('#voiceBtn').hide();
      // }
    };
    initToolbarBootstrapBindings();  
    $('#editor').wysiwyg();
    window.prettyPrint && prettyPrint();
  });


</script>




</body>
</html>
