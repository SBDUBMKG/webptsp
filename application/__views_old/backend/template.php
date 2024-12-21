<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo !empty($title) ? $title.' - '.$this->config->item('short_app_name') : $this->config->item('short_app_name'); ?></title>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(). 'favicon.ico';?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>resources/themes/AdminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?php echo base_url(); ?>resources/themes/AdminLTE/dist/css/skins/_all-skins.min.css">
   <!-- iCheck -->
   <link rel="stylesheet" href="<?php echo base_url() ?>resources/plugins/iCheck/flat/blue.css">
   <!-- jvectormap -->
   <link rel="stylesheet" href="<?php echo base_url() ?>resources/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
   <!-- Date Picker -->
   <link rel="stylesheet" href="<?php echo base_url() ?>resources/plugins/datepicker/datepicker3.css">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="<?php echo base_url() ?>resources/plugins/daterangepicker/daterangepicker.css">
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="<?php echo base_url() ?>resources/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   <link rel="stylesheet" href="<?php echo base_url() ?>resources/css/style.css">
   <?php echo isset($_styles) ? $_styles : NULL; ?>

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?php echo base_url() ?>resources/js/html5shiv.min.js"></script>
  <script src="<?php echo base_url() ?>resources/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script>
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>resources/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url(); ?>resources/js/global_function.js"></script>
</head>
<body class="hold-transition skin-yellow sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo base_url().'backend';?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><?php echo $this->config->item('short_app_name'); ?></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><?php echo $this->config->item('short_app_name'); ?></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php $nama_user = $this->session->userdata('nama'); ?>
              <i class="fa fa-fw fa-power-off"></i><span class="hidden-xs"><?php echo (!empty($nama_user) ? $nama_user : 'Anonymous'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url().'backend/home/change_password'?>" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url().'backend/login/logout'?>" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
          <li>
            <a href="<?php echo base_url(). 'bantuan';?>" title="Bantuan"><i class="fa fa-book"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <?php
      $controller = $this->router->fetch_class();

      ?>
      <ul class="sidebar-menu">
        <li class="header">MENU UTAMA</li>
        <li <?php echo $controller == 'home' ? 'class="active"' : NULL; ?>>
         <?php
         if($nama_user == 'Administrator') {
           ?>
           <a href="<?= base_url().'backend';?>"><i class="fa fa-dashboard"></i><span>Dashboad</span></a>
         <?php } else { ?>

         <?php } ?>
        </li>
        <?php
        $list_kategori_menu = get_list_kategori_menu(1);
        foreach ( $list_kategori_menu as $catmenu ) {
          $list_menu = get_list_menu($catmenu->id_kategori_menu,1);
          if ( count($list_menu) > 0 ) {
            ?>
            <li class="treeview <?php echo $catmenu->kategori_menu == $this->active_kategori_menu ? 'active' : NULL; ?>">
              <a href="#"><i class="fa fa-folder"></i> <span><?php echo $catmenu->kategori_menu; ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-right pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php
                foreach ( $list_menu as $menu ) {
                  if($menu->cname=='chat'){
                    ?>
                    <li <?php echo $controller == $menu->cname ? 'class="active"' : NULL; ?>><a href="https://dashboard.tawk.to/login" target="_blank"><i class="fa fa-th-list"></i> <span><?php echo $menu->menu; ?></span></a></li>
                    <?php
                  } else { ?>
                    <li <?php echo $controller == $menu->cname ? 'class="active"' : NULL; ?>><a href="<?php echo base_url().$menu->uri; ?>"><i class="fa fa-th-list"></i> <span><?php echo $menu->menu; ?></span></a></li>
                  <?php }
                }
                ?>
              </ul>
            </li>
            <?php
          }
        }
        $list_menu = get_list_menu(0,1);
        foreach ( $list_menu as $menu ) {
          ?>
          <li <?php echo $controller == $menu->cname ? 'class="active"' : NULL; ?>><a href="<?php echo base_url().$menu->cname; ?>"><i class="fa fa-th-list"></i> <span><?php echo $menu->menu; ?></span></a></li>
          <?php
        }
        ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php echo isset($content) ? $content : NULL; ?>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <?php echo $this->config->item('description_footer_text'); ?>
  </footer>


</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>resources/js/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>resources/js/bootstrap.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>resources/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url(); ?>resources/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>resources/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>resources/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>resources/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>resources/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url(); ?>resources/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>resources/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url(); ?>resources/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>resources/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>resources/themes/AdminLTE/dist/js/app.min.js"></script>
<?php echo isset($_scripts) ? $_scripts : NULL; ?>
</body>
</html>
