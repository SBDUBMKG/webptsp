
<?php
$bahasa = $this->session->userdata('bahasa');
$curr_lang = $this->session->userdata("language");
$user_role = $this->session->userdata("id_role");

if ((int) $user_role === 7) {
    $this->lang->load("backend/sidebar", $curr_lang);
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo !empty($title)
      ? $title . " - " . $this->config->item("short_app_name")
      : $this->config->item("short_app_name"); ?></title>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() .
      "favicon.ico"; ?>">
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
   <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/iCheck/flat/blue.css">
   <!-- jvectormap -->
   <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
   <!-- Date Picker -->
   <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/datepicker/datepicker3.css">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/daterangepicker/daterangepicker.css">
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="<?php echo base_url(); ?>resources/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>resources/css/style.css">
   <?php echo isset($_styles) ? $_styles : null; ?>

    <!-- AddChat CSS Files -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>resources/css/chat/emoji.css">
    <link href="<?php echo base_url() ?>resources/css/chat/addchat-app.css" rel="stylesheet">
    <!-- End AddChat CSS Files -->

   <script async src="https://www.googletagmanager.com/gtag/js?id=UA-128360611-17"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-128360611-17');
</script>

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?php echo base_url(); ?>resources/js/html5shiv.min.js"></script>
  <script src="<?php echo base_url(); ?>resources/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script>
<!-- jQuery 2.2.3 -->
<!-- <script src="<?php echo base_url(); ?>resources/plugins/jQuery/jquery-2.2.3.min.js"></script> -->
<!-- jQuery 3.7.1 -->
<script src="<?php echo base_url(); ?>resources/plugins/jQuery/jquery-3.7.1.min.js"></script>
<script src="<?php echo base_url(); ?>resources/js/global_function.js"></script>

</head>
<style>
  .skin-yellow .main-header .navbar .sidebar-toggle:hover {
    background-color: #0097B2 !important;
  }
  .skin-yellow .sidebar-menu>li:hover>a, .skin-yellow .sidebar-menu>li.active>a {
    border-left-color: #0CC0DF !important;
  }
  /* .skin-yellow .wrapper, .skin-yellow .main-sidebar, .skin-yellow .left-side {
    background-color: #343537 !important;
  } */

  .table-responsive td li {
        text-align: left;
  }
  .table-responsive .table {
    width: 100% !important;
  }

  /* hide radio */
  #langChange input[type="radio"] {
    display: none;
  }
  /* styling the div and labels */
  #langChange {
    display: inline-block;
    background: #0097B1;
    /* padding: 5px; */
    padding: 3px;
    border-radius: 30px;
    margin-left: 50px;
    white-space: nowrap;
  }
  #langChange a {
    font-family: "Roboto", sans-serif;
    /* font-size: 16px; */
    /* font-size: 15px; */
    font-size: 12px;
    font-weight: 500;
    /* padding: 3px 12px; */
    padding: 2px 4px;
    color: #FBFEFD;
    background: transparent;
    border-radius: 20px;
    cursor: pointer;
  }

  #langChange input[type="radio"]:checked + a {
    color: #0097B1;
    background: #FBFEFD;
  }
  #langChange a[for="toEn"]::after {
    content: "EN";
  }
  #langChange a[for="toAr"]::after {
    content: " ID";
  }

</style>
<body class="hold-transition skin-yellow sidebar-mini">
    <!-- Chat Application -->
    <div id="addchat_initiate"></div>
    <!-- End Chat Application -->

  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo base_url() .
          "backend"; ?>" class="logo" style="background-color: #ECF0F5;">

        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini" style="color: #0097B2"><?php echo $this->config->item(
            "short_app_name"
        ); ?></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
          <!-- <?php echo $this->config->item("short_app_name"); ?> -->
          <img style="width: 110px" src="<?php echo base_url() .
              "resources/themes/frontend_ptsp/images/icons/bmkg_ptsp_3.png"; ?>" class="img-fluid" alt="">
        </span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" style="background-color: #0CC0DF;">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <?php if ((int) $user_role === 7) { ?>

            <li id="dropdown-lang" class="dropdown" style="padding: 11px 6px;">
                <!-- <form id="form-change-lang" style="display: none;" method="post" action="<?= site_url() .
                    "backend/language/change" ?>">
                    <input id="lang" name="lang" type="hidden" value="<?= $curr_lang ===
                    "indonesia"
                        ? "english"
                        : "indonesia" ?>" />
                </form>
                <a id="btn-change-lang"  href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?= $curr_lang === "indonesia" ? "ID" : "EN" ?>
                </a> -->

                <div id="langChange" style="margin-left: 0; ">
                   <form action="">
                     <input type="radio" name="l" id="toAr" <?= $curr_lang === 'indonesia' ? 'checked' : ''?> />
                     <a href="<?= base_url().'backend/language/change?lang=indonesia' ?>" for="toAr" onclick="document.getElementById('lang-cnt').lang = 'ar'; document.getElementById('lang-cnt').dir = 'rtl'; "></a>
                     <input type="radio" name="l" id="toEn" <?= $curr_lang === 'english' ? 'checked' : ''?> />
                     <a href="<?= base_url().'backend/language/change?lang=english' ?>" for="toEn" onclick="document.getElementById('lang-cnt').lang = 'en'; document.getElementById('lang-cnt').dir = 'ltr'; " ></a>
                   </form>
                </div>
            </li>

            <?php } ?>

            <?php
            $this->load->helper("general");
            $list_notif1 = list_notif1();
            ?>

            <?php if (!empty($list_notif1)) { ?>
                <li class="dropdown notifications-menu" >
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    <span class="label label-warning"><?php echo count(
                        $list_notif1
                    ); ?></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <ul class="menu">
                            <?php if (count($list_notif1) > 0) {

                                $urlpros =
                                    "backend/permohonan_layanan/permohonan_layanan";
                                if ($this->session->userdata("id_role") >= 9) {
                                    $urlpros =
                                        "backend/katalog_pelayanan/informasi_mkg";
                                }
                                ?>
                            <li>
                                <a href="<?php echo base_url() . $urlpros; ?>">
                                    <?= $curr_lang === 'indonesia' ? 'Ada' : "There are" ?>
                                    <?php echo count($list_notif1); ?>
                                    <?= $curr_lang === 'indonesia' ? 'pesanan menunggu diproses' : "orders waiting to be processed" ?>
                                </a>
                            </li>
                            <?php
                            } ?>
                        </ul>
                    </li>
                </ul>
                </li>
            <?php } ?>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php $nama_user = $this->session->userdata("nama"); ?>
              <i class="fa fa-fw fa-power-off"></i><span class="hidden-xs"><?php echo !empty(
                  $nama_user
              )
                  ? $nama_user
                  : "Anonymous"; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url() .
                      "backend/home/change_password"; ?>" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url() .
                      "backend/login/logout"; ?>" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
          <li>
            <a href="<?php echo base_url() .
                "bantuan"; ?>" title="Bantuan"><i class="fa fa-book"></i></a>
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
      $id_admin = $this->session->userdata("id_admin");
      $list_user = $this->global_model->get_by_id(
          "tbl_admin",
          "id_admin",
          $id_admin
      );
      $pelanggan = $this->global_model->get_by_id(
          "tbl_role",
          "id_role",
          $list_user->id_role
      );
      ?>
      <ul class="sidebar-menu">
        <div class="user-panel">
          <div class="pull-left image">
          <img src="<?php echo $list_user->foto
              ? base_url() . "upload/profil/" . $list_user->foto
              : base_url() .
                  "resources/frontend/images/user.png"; ?>" class="img-circle" style="height:44px;width:auto;" alt="User Image">
          </div>
          <div class="pull-left info">
          <p><?= $this->session->userdata("username") ?></p>
          <p><?= (int) $user_role === 7
              ? $this->lang->line("role." . $user_role)
              : $this->session->userdata("role") ?></p>
          </div>
        </div>

        <li class="header"> <?= (int) $user_role === 7
            ? $this->lang->line("menu_title")
            : "MENU UTAMA" ?> </li>
        <li <?php echo $controller == "home" ? 'class="active"' : null; ?>>
         <?php if ($nama_user == "Administrator") { ?>
           <a href="<?= base_url() .
               "backend" ?>"><i class="fa fa-dashboard"></i><span>Dashboad</span></a>
         <?php } else { ?>

         <?php } ?>
        </li>
        <?php
        $list_kategori_menu = get_list_kategori_menu(1);
        foreach ($list_kategori_menu as $catmenu) {
            $list_menu = get_list_menu($catmenu->id_kategori_menu, 1);

            if (count($list_menu) > 0) { ?>
            <li class="treeview <?php echo $catmenu->kategori_menu ==
            $this->active_kategori_menu
                ? "active"
                : null; ?>">
              <a href="#"><?php if (empty($catmenu->icon)) {
                  echo "<i class='fa fa-folder'></i>";
              } else {
                  echo "<i class='{$catmenu->icon}'></i>";
              } ?> <span><?= (int) $user_role === 7
     ? $this->lang->line(snake_case($catmenu->kategori_menu))
     : $catmenu->kategori_menu ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-right pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php foreach ($list_menu as $menu) { ?>
                    <li
                        <?php echo $controller == $menu->cname
                            ? 'class="active"'
                            : null; ?>>
                            <a href="<?= url_menu($menu->uri); ?>" <?= set_target_http($menu->uri) ?>>
                                <i class="fa fa-folder-open"></i>
                                <span>
                                    <?= (int) $user_role === 7
                                        ? $this->lang->line(
                                            snake_case(
                                                $catmenu->kategori_menu
                                            ) .
                                                "." .
                                                $menu->cname
                                        )
                                        : $menu->menu ?>
                                </span>
                            </a>
                    </li>
                <?php } ?>
              </ul>
            </li>
            <?php }
        }

        $list_menu = get_list_menu(0, 1);
        foreach ($list_menu as $menu) { ?>
          <li <?php echo $controller == $menu->cname
              ? 'class="active"'
              : null; ?>><a href="<?php echo base_url() .
    $menu->cname; ?>"><i class="fa fa-folder-open"></i> <span><?= $this->lang->line(
    $catmenu->kategori_menu . "." . $menu->cname
) ?></span></a></li>
          <?php }
        ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php echo isset($content) ? $content : null; ?>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <?= $this->lang->line('footer') ?>
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
<script>
    $(document).ready(function() {
        $('#btn-change-lang').on('click', function() {
            $('#form-change-lang').submit();
        })
    });
</script>

<?php echo isset($_scripts) ? $_scripts : null; ?>

    <script type="text/javascript">
       var user_id  ="<?php echo isset($_SESSION['id_admin']) ? $_SESSION['id_admin'] : NULL; ?>"
       var base_url  ="<?php echo base_url(); ?>";
    </script>

	<!-- AddChat JS Files -->
    <script src="<?php echo base_url() ?>resources/js/chat/jquery-ui.min.js"></script>
    <script src="<?php echo base_url() ?>resources/js/chat/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>resources/js/chat/config.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>resources/js/chat/util.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>resources/js/chat/jquery.emojiarea.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>resources/js/chat/emoji-picker.js"></script>
    <script src="<?php echo base_url() ?>resources/js/chat/addchat-app.js"></script>
    <!-- End AddChat JS Files -->



</body>
</html>
