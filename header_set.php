<div style="padding: 0px 0px 50px; margin: 0px; border-width: 0px; height: 0px; display: block;" id="yass_top_edge_padding"></div>

  <div class="navbar  navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="../"><?php echo SITE_NAME ?></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li id="nav_home"><a href="../">Home</a></li>
              <li id="nav_setting"><a href="../setting">个人中心</a></li>
         	  <?php if ($_SESSION['addInfo'] == 1) echo ' <li><a href="../admin">后台管理</a></li>'; ?>
            </ul>
            
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
