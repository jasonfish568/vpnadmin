<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="../"><?php echo SITE_NAME ?></a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
				<?php
                $username=$_SESSION['username'];
                echo '<a href="../setting" class="navbar-link"><i style="margin-top:3px" class="icon-user icon-white"></i>'.$username.'</a>';
                echo" <a href='?logout=1' class='navbar-link' ><i style='margin-top:3px' class='icon-off icon-white'></i>登出</a>  ";
                ?>
            </p>
            <ul class="nav">
              <li id="nav_home"><a href="../">Home</a></li>
              <li id="nav_setting"><a href="../setting">个人中心</a></li>
         <?php if ($_SESSION['addInfo'] == 1) echo ' <li><a href="../admin">后台管理</a></li>'; ?>
            </ul>
<form action="../search.php"  class="navbar-search">
<input  name="q" type="text" placeholder="搜索通知或资源..." class="search-query" />
</form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>