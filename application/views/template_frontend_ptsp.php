<?php
$CI = &get_instance();
$CI->load->helper("menu_helper");
$categories = get_categories_with_submenus();
$this->load->helper("url");

// Social
// $links = $CI->db->where("variable_task LIKE 'social%' OR variable_task LIKE 'store%'")->from('tbl_setting_content')->get()->result_array();
$links = array_reduce(
    [
        "social_facebook",
        "social_instagram",
        "social_x",
        "social_tiktok",
        "social_youtube",
        "store_google",
    ],
    function ($carry, $variable_task) use ($CI) {
        $carry[$variable_task] = $CI->db
            ->select("value_task")
            ->where("variable_task", $variable_task)
            ->get("tbl_setting_content")
            ->row()->value_task;

        return $carry;
    },
    []
);

// Home page and it's child pages
$home_urls = ["katalog_pelayanan", "cek_status", "registrasi"];
$home_active = false;
$path = explode("/", parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH))[2];

foreach ($home_urls as $url) {
    if ($path === "ptsp-bmkg" || strstr(current_url(), $url)) {
        $home_active = true;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
        <title> <?php echo !empty($title)
            ? $title . " - " . $this->config->item("short_app_name")
            : $this->config->item("short_app_name"); ?>
        </title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() .
            "favicon.ico"; ?>">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link rel="stylesheet" href="<?php echo base_url() .
            "resources/themes/frontend_ptsp/css/bootstrap.css"; ?>">
        <link rel="stylesheet" href="<?php echo base_url() .
            "resources/themes/frontend_ptsp/css/owl.carousel.css"; ?>">
        <link rel="stylesheet" href="<?php echo base_url() .
            "resources/themes/frontend_ptsp/style.css"; ?>">
        <link rel="stylesheet" href="<?php echo base_url() .
            "resources/themes/css/responsive.css"; ?>">

        <?= isset($_styles) ? $_styles : null ?>
        <style>
          .owl-theme .owl-nav [class*='owl-']:hover  {
            background: none;
          }
        </style>

        <?php
        $bahasa = $this->session->userdata("bahasa");
        $this->load->model("global_model");

        // =========== untuk load menu ============
        $controller = $this->router->fetch_class();
        $current_url = $this->uri->segment(1);
        $current_url_child = str_replace("index.php/", "", current_url());
        $counter = check_counter();
        if (!isset($_SESSION["add_counter"])) {
            update_counter();
            $_SESSION["add_counter"] = "1";
        }
        $cdisp = $counter; // Storing the counter value in another variable
        $divisor = 10; // setting the divisor value to 10
        $digitarray = []; // creating an array
        do {
            $digit = $cdisp % $divisor; // looping through the till all digits are taken
            $cdisp = $cdisp / $divisor; // getting the digits from right side
            array_push($digitarray, $digit); // storing them in the array
        } while ($cdisp >= 1); // condition of do loop
        // array is to be reversed as digits are in reverse order
        $digitarray = array_reverse($digitarray);
        ?>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-128360611-17');
        </script>
    </head>
  <!-- header-area start -->
  <body>
      <header class="header-area">
          <div class="container">
            <nav class="navbar navbar-expand-lg">
              <div class="container-fluid">
                <a class="navbar-brand" href="<?= base_url() ?>"><img src="<?php echo base_url() .
    "resources/themes/frontend_ptsp/images/icons/bmkg_ptsp_3.png"; ?>" class="img-fluid" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span><i class="fa-solid fa-bars"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">

                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link" id="<?= $home_active
                          ? "active"
                          : "" ?>" aria-current="page" href="<?= base_url() ?>"><?= $bahasa ==
""
    ? "Beranda"
    : "Home" ?></a>
                    </li>
                    <?php foreach ($categories as $category): ?>
                      <?php
                      // Check if any submenu item is active
                      $is_active_sub = false;
                      foreach ($category["submenus"] as $submenu) {
                          if (!empty($submenu["uri_submenu"])) {
                              if (
                                  base_url() . $submenu["uri_submenu"] ==
                                  current_url()
                              ) {
                                  $is_active_sub = true;
                                  break;
                              }
                          }
                      }
                      ?>
                      <li class="nav-item">
                          <a class="nav-link" id="<?php echo $is_active_sub ||
                          base_url() . $category["uri_menu"] == current_url()
                              ? "active"
                              : ""; ?>" href="<?= base_url() .
    $category["uri_menu"] ?>" style="white-space: nowrap;"><?php echo $bahasa ==
""
    ? $category["category_name"]
    : $category["category_name_en"]; ?></a>
                          <ul>
                              <?php foreach (
                                  $category["submenus"]
                                  as $submenu
                              ): ?>
                                  <?php if (!empty($submenu["uri_submenu"])): ?>
                                      <li>
                                          <a class="<?php echo base_url() .
                                              $submenu["uri_submenu"] ==
                                          current_url()
                                              ? "active"
                                              : ""; ?>" href="<?= base_url() .
    $submenu["uri_submenu"] ?>"> <?php echo $bahasa == "_en"
    ? $submenu["submenu_name_en"]
    : $submenu["submenu_name"]; ?> </a>
                                      </li>
                                  <?php endif; ?>
                              <?php endforeach; ?>
                          </ul>
                      </li>
                  <?php endforeach; ?>

                  </ul>
                  <div id="langChange">
                  <form action="" style="white-space: nowrap";>
                    <input type="radio" name="l" id="toAr" <?= $bahasa == ""
                        ? "checked"
                        : "" ?> />
                    <a href="<?= base_url() .
                        "home/ganti_bahasa/" ?>" for="toAr" onclick="document.getElementById('lang-cnt').lang = 'ar'; document.getElementById('lang-cnt').dir = 'rtl'; "></a>
                    <input type="radio" name="l" id="toEn" <?= $bahasa == "_en"
                        ? "checked"
                        : "" ?> />
                    <a href="<?= base_url() .
                        "home/ganti_bahasa/_en" ?>" for="toEn" onclick="document.getElementById('lang-cnt').lang = 'en'; document.getElementById('lang-cnt').dir = 'ltr'; " ></a>
                  </form>
                </div>
                <div class="hd-searchbar">
                  <form class="search" method="post" action="<?php echo base_url() .
                      "search/index"; ?>">
                    <input id="search_top" maxlength="100" name="search" type="search" placeholder="<?= $bahasa ==
                    ""
                        ? "Cari"
                        : "Search" ?>" value="<?php echo empty($_POST["search"])
    ? ""
    : $_POST[
        "search"
    ]; ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                  </form>
                </div>             
<?php           if(empty($this->session->userdata("username"))) { 
?>                <div class="mausk">
                    <a href="<?= base_url()."login" ?>"><img src="<?php echo base_url()."resources/themes/frontend_ptsp/images/man-icon.png"; ?>" class="img-fluid" alt=""> <?= $bahasa ==""?"Masuk":"Login" ?></a>
                  </div>
<?php           } else {                
?>                <div class="dropdown">
                    <button class="btn mausk dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="<?php echo base_url()."resources/themes/frontend_ptsp/images/man-icon.png"; ?>" class="img-fluid" alt="">
<?php                   echo strlen($this->session->userdata("username"))>13? substr($this->session->userdata("username"),0,13) . "...":$this->session->userdata("username");                         
?>                  </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item mausk" href="<?= base_url() . "login" ?>">Administrasi</a></li>
                      <li><a class="dropdown-item mausk" href="<?php echo base_url()."backend/login/logout"; ?>">Logout</a></li>
                    </ul>
                  </div>                                 
<?php           }                
?>            </div>                
            </div>
          </nav>
            
        <!-- ========= navbar end ========== -->

        <!-- ========= offcanvas start ========== -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel"><a href="<?= base_url() ?>"><img src="<?php echo base_url() .
    "resources/themes/frontend_ptsp/images/icons/bmkg_ptsp_3.png"; ?>" class="img-fluid" alt=""></a></h5>
                <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
              </div>
              <div class="offcanvas-body p-0">
                  <div class="langChange-wrap d-flex justify-content-between mb-3" style="margin-left: 10px;">
                    <div class="langChange-left">
                      <div id="langChange" style="margin-left: 0;">
                        <form action="">
                          <input type="radio" name="l" id="toAr" <?= $bahasa ==
                          ""
                              ? "checked"
                              : "" ?> />
                          <a href="<?= base_url() .
                              "home/ganti_bahasa/" ?>" for="toAr" onclick="document.getElementById('lang-cnt').lang = 'ar'; document.getElementById('lang-cnt').dir = 'rtl'; "></a>
                          <input type="radio" name="l" id="toEn" <?= $bahasa ==
                          "_en"
                              ? "checked"
                              : "" ?> />
                          <a href="<?= base_url() .
                              "home/ganti_bahasa/_en" ?>" for="toEn" onclick="document.getElementById('lang-cnt').lang = 'en'; document.getElementById('lang-cnt').dir = 'ltr'; " ></a>
                        </form>
                      </div>
                    </div>
                    <div class="langChange-right" style="margin-right: 10px;">
                      <div class="mausk">
                        <a href="<?= base_url() .
                            "login" ?>"><img src="<?php echo base_url() .
    "resources/themes/frontend_ptsp/images/man-icon.png"; ?>" class="img-fluid" alt=""> <?= $bahasa ==
""
    ? "Masuk"
    : "Login" ?></a>
                      </div>
                    </div>
                  </div>

                  <div class="hd-searchbar" >
                    <form class="search" method="post" action="<?php echo base_url() .
                        "search/index"; ?>">
                      <input maxlength="100" name="search" type="search" placeholder="<?= $bahasa ==
                      ""
                          ? "Cari"
                          : "Search" ?>">
                      <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                  </div>

                  <ul >
                    <li>
                      <a class="dropdown-item" id="<?= base_url() ==
                      current_url()
                          ? "active"
                          : "" ?>" aria-current="page" href="<?= base_url() ?>"><?= $bahasa ==
""
    ? "Beranda"
    : "Home" ?></a>
                    </li>
                    <?php foreach ($categories as $category): ?>
                      <?php
                      // Check if any submenu item is active
                      $is_active_sub = false;
                      foreach ($category["submenus"] as $submenu) {
                          if (!empty($submenu["uri_submenu"])) {
                              if (
                                  base_url() . $submenu["uri_submenu"] ==
                                  current_url()
                              ) {
                                  $is_active_sub = true;
                                  break;
                              }
                          }
                      }
                      ?>
                      <li>
                          <a class="dropdown-item" id="<?php echo $is_active_sub ||
                          base_url() . $category["uri_menu"] == current_url()
                              ? "active"
                              : ""; ?>" href="<?= base_url() .
    $category["uri_menu"] ?>"><?php echo $bahasa == ""
    ? $category["category_name"]
    : $category["category_name_en"]; ?></a>
                          <ul>
                              <?php foreach (
                                  $category["submenus"]
                                  as $submenu
                              ): ?>
                                  <?php if (!empty($submenu["uri_submenu"])): ?>
                                      <li>
                                          <a class="<?php echo base_url() .
                                              $submenu["uri_submenu"] ==
                                          current_url()
                                              ? "active"
                                              : ""; ?>" href="<?= base_url() .
    $submenu["uri_submenu"] ?>"> <?php echo $bahasa == "_en"
    ? $submenu["submenu_name_en"]
    : $submenu["submenu_name"]; ?> </a>
                                      </li>
                                  <?php endif; ?>
                              <?php endforeach; ?>
                          </ul>
                      </li>
                  <?php endforeach; ?>

                  </ul>

              </div>
            </div>
          </div>
      </header>

      <?php if (isset($content)) {
          echo $content;
      } else {
          echo "content belum di set";
      } ?>

      <div class="footer-area">
        <div class="container">
          <div class="row align-items-start">
            <div class="col-md-3 col-lg-3">
              <div class="footer-item-left">
                <a href="<?= base_url() ?>"><img src="<?php echo base_url() .
    "resources/themes/frontend_ptsp/images/icons/logo_footer.png"; ?>" class="img-fluid" alt=""></a>
                <ul>
                  <li><a href="<?= $links[
                      "social_facebook"
                  ] ?>"><i class="fa-brands fa-facebook-f"></i></a></li>
                  <li><a href="<?= $links[
                      "social_instagram"
                  ] ?>"><i class="fa-brands fa-instagram"></i></a></li>
                  <li><a href="<?= $links[
                      "social_x"
                  ] ?>"><i class="fa-brands fa-twitter"></i></a></li>
                  <li><a href="<?= $links[
                      "social_tiktok"
                  ] ?>"><i class="fa-brands fa-tiktok"></i></a></li>
                  <li><a href="<?= $links[
                      "social_youtube"
                  ] ?>"><i class="fa-brands fa-youtube"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="col-md-6 col-lg-6">
              <div class="footer-item-right">
                <div class="footer-item-right-cnt">
                  <h5 style="font-size: 18px"><?= $bahasa == ""
                      ? "Aplikasi Mobile"
                      : "Mobile Application" ?></h5>
                  <ul style="font-size: 13px">
                    <li class="text-white"><?= $bahasa == ""
                        ? "PTSP Online BMKG juga tersedia dalam versi aplikasi mobile"
                        : "PTSP Online BMKG is also available in a mobile version" ?> </li>
                    <li><a href="<?= $links[
                        "store_google"
                    ] ?>"><img width="200" src="<?php echo base_url() .
    "resources/themes/frontend_ptsp/images/icons/googleplay.png"; ?>" alt="" style="max-width: 200px !important;"></a></li>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-lg-3">
              <div class="footer-item-right">
                <div class="footer-item-right-cnt">
                  <h5 style="font-size: 18px"><?= $bahasa == ""
                      ? "Kontak Kami"
                      : "Contact Us" ?> </h5>
                  <ul style="font-size: 13px">
                    <li><a href="#"><img src="<?php echo base_url() .
                        "resources/themes/frontend_ptsp/images/lctn.png"; ?>" class="img-fluid" alt=""> Jalan Angkasa I, No. 2 <br> Kemayoran, Jakarta Pusat</a></li>
                    <li><a href="tel:(021) 4246321"><img src="<?php echo base_url() .
                        "resources/themes/frontend_ptsp/images/tlphn.png"; ?>" class="img-fluid" alt=""> (021) 4246321 <br>Fax : (021) 4246703</a></li>
                    <li><a href="tel:(+62) 813-8232-1504"><img src="<?php echo base_url() .
                        "resources/themes/frontend_ptsp/images/mble.png"; ?>" class="img-fluid" alt=""> (+62) 813-8232-1504</a></li>
                    <li><a href="mailto:tsp@bmkg.go.id"><img src="<?php echo base_url() .
                        "resources/themes/frontend_ptsp/images/msg.png"; ?>" class="img-fluid" alt=""> ptsp@bmkg.go.id</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="copy-right">
          <span></span>
          <a href="#">© <?= date("Y") ?> - PTSP <?= $bahasa == ""
     ? "Badan Meteorologi, Klimatologi, dan Geofisika"
     : "Meteorological, Climatological, and Geophysical Agency" ?></a>
        </div>
      </div>

      <script>
      $(document).ready(function(){
          $("#form_login").submit(function(ev){
              ev.preventDefault();
                var username = $('#username').val();
                var password = $('#password').val();
                var captcha = $('#txt_captcha').val();
                if(username != '' && password != '' && captcha != '')
                {
                      $.ajax({
                          url: '<?php echo base_url() . "auth-login"; ?>',
                          method:"POST",
                          data: {username:username, password:password, captcha:captcha},
                          dataType: "json",
                          success:function(data)
                          {
                                //alert(data);
                                if(data.msg == 'No')
                                {
                                    alert("Username dan Password tidak sesuai");
                                } else if(data.msg == 'captcha') {
                                    alert("Captcha tidak sesuai");
                                } else if(data.msg == 'verify') {
                                    alert("Akun anda tidak aktif");
                                }
                                else
                                {
                    window.location.href = data.url_next;
                                }
                          }
                      });
                }
                else
                {
                      alert("All Fields are required");
                }
            })});
      </script>
    <script type="text/javascript" src="<?= site_url(
        "resources/plugins/jQuery/jquery-3.7.1.min.js"
    ) ?>"></script>
    <script type="text/javascript" src="<?= site_url(
        "resources/themes/frontend_ptsp/js/bootstrap.bundle.min.js"
    ) ?>"></script>
    <script type="text/javascript" src="<?= site_url(
        "resources/themes/frontend_ptsp/js/owl.carousel.js"
    ) ?>"></script>
		<script src="https://kit.fontawesome.com/2b12c591dc.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?= site_url(
        "resources/themes/frontend_ptsp/js/scripts.js"
    ) ?>"></script>
		<a href="#" class="scrolltotop">
			<i class="fa-solid fa-arrow-up"></i>
			<span class="pluse"></span>
			<span class="pluse2"></span>
		</a>

	<?= isset($_scripts) ? $_scripts : null ?>

	<script type="application/javascript">

		var bahasa	= '<?= $bahasa ?>',
				hari		= '<?= $bahasa == "" ? "in" : "en" ?>';
		if(bahasa === '') {
			tday=new Array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
			tmonth=new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		} else {
			tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
			tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
		}



		function GetClock(){
			var d	= new Date(), nday = d.getDay(), nmonth = d.getMonth(), ndate	= d.getDate(), nyear	= d.getYear();
			if( nyear < 1000 ) nyear += 1900;
			var nhour = d.getHours(), nmin = d.getMinutes(), nsec = d.getSeconds(),ap;
			if( nhour == 0 ) { ap	= " AM"; nhour = 12; }
			else if( nhour < 12 ) { ap	= " AM"; }
			else if( nhour == 12 ) { ap = " PM"; }
			else if( nhour > 12 ) { ap = " PM"; nhour	-= 12; }
			if( nmin <= 9 ) nmin ="0" + nmin;
			if( nsec <= 9 ) nsec ="0" + nsec;
			document.getElementById('clockbox').innerHTML=""+tday[nday]+", "+ndate+" "+tmonth[nmonth]+" "+nyear+" | "+nhour+":"+nmin+":"+nsec+ap+"";
		}

		window.onload=function(){

		GetClock();

		setInterval(GetClock,1000);

		}
		$(window).on('load',function(){

		$('#myModal').modal('show');

		});

		$(".slider-background").vegas({
			slides: [
				<?php
    $bg = $this->global_model->get_list_array(
        "tbl_background",
        "is_active = 1"
    );
    foreach ($bg as $key => $value) { ?>
				{
					src: "<?= site_url("resources/frontend/images/" . $value["background"]) ?>"
				},
				<?php }
    ?>
			]
		});
	</script>
	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/5ba77499c9abba579677cf78/default';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
	</script>
	<!--End of Tawk.to Script-->
  <script>
      $(document).ready(function(){
         // Initialize tooltip
         var inputField = $('#search_katalog');

          // Set up tooltip
          inputField.tooltip({
              trigger: 'hover', // Show tooltip on hover
              title: function () {
                  return $(this).val(); // Set the tooltip title based on input value
              }
          });

          // Update tooltip title dynamically as the user types
          inputField.on('input', function() {
              var value = $(this).val(); // Get current input value
              $(this).attr('data-bs-original-title', value).tooltip('show'); // Update tooltip title and show it
          });

           // Initialize tooltip
         var inputFieldTop = $('#search_top');

          // Set up tooltip
          inputFieldTop.tooltip({
              trigger: 'hover', // Show tooltip on hover
              title: function () {
                  return $(this).val(); // Set the tooltip title based on input value
              }
          });

          // Update tooltip title dynamically as the user types
          inputFieldTop.on('input', function() {
              var value = $(this).val(); // Get current input value
              $(this).attr('data-bs-original-title', value).tooltip('show'); // Update tooltip title and show it
          });

      $('.cmb_select2').select2({
            theme: 'bootstrap'
        });

        $('#datepicker').datepicker({
            autoclose: true
        });
        $('#id_pendidikan').select2({
          dropdownPosition: 'below',
          theme: 'bootstrap',
          language: 'id',
          allowClear: true,
          placeholder: 'Pilih Pendidikan',
          ajax: {
            dataType: 'json',
            delay: 0,
            url: "<?= site_url("services/id_pendidikan") ?>",
            beforeSend: function() {
              // $('#id_provinsi').prop("disabled", true);
              $('#id_kabkot').prop("disabled", true);
              $('#id_kecamatan').prop("disabled", true);
              $('#id_kelurahan').prop("disabled", true);
              // $('#provinsi_perusahaan').prop("disabled", true);
              $('#kabupaten_perusahaan').prop("disabled", true);
              $('#kecamatan_perusahaan').prop("disabled", true);
              $('#kelurahan_perusahaan').prop("disabled", true);
            },
            data: function(params) {
              return {
                s: params.term
              }
            },
            processResults: function (data, page) {
              return {
                results: data
              };
            },
            error: function() {
              // $('#id_provinsi').prop("disabled", true);
              $('#id_kabkot').prop("disabled", true);
              $('#id_kecamatan').prop("disabled", true);
              $('#id_kelurahan').prop("disabled", true);
              // $('#provinsi_perusahaan').prop("disabled", true);
              $('#kabupaten_perusahaan').prop("disabled", true);
              $('#kecamatan_perusahaan').prop("disabled", true);
              $('#kelurahan_perusahaan').prop("disabled", true);
            },
            cache: true
          }
        }).on('select2:select', function() {
          $('#id_provinsi').prop("disabled", false);
          $('#provinsi_perusahaan').prop("disabled", false);

        });
        $('#id_provinsi').prop("disabled", false);
        $('#id_kabkot').prop("disabled", true);
        $('#id_kecamatan').prop("disabled", true);
        $('#id_kelurahan').prop("disabled", true);
        $('#id_provinsi').select2({
          dropdownPosition: 'below',
          theme: 'bootstrap',
          language: 'id',
          allowClear: true,
          placeholder: 'Pilih Provinsi',
          ajax: {
            dataType: 'json',
            delay: 0,
            url: "<?= site_url("services/provinsi") ?>",
            beforeSend: function() {
              $('#id_kabkot').prop("disabled", true);
              $('#id_kecamatan').prop("disabled", true);
              $('#id_kelurahan').prop("disabled", true);
            },
            data: function(params) {
              return {
                s: params.term
              }
            },
            processResults: function (data, page) {
              return {
                results: data
              };
            },
            error: function() {
              $('#id_kabkot').prop("disabled", true);
              $('#id_kecamatan').prop("disabled", true);
              $('#id_kelurahan').prop("disabled", true);
            },
            cache: true
          }
        }).on('select2:select', function() {
          $('#id_kabkot').prop("disabled", false);
        });
        $('#id_kabkot').select2({
          theme: 'bootstrap',
          allowClear: true,
          placeholder: 'Pilih Kab/Kota',
          ajax: {
            dataType: 'json',
            delay: 0,
            url: "<?= site_url("services/kab_kota") ?>",
            beforeSend: function() {
              $('#id_kecamatan').prop("disabled", true);
              $('#id_kelurahan').prop("disabled", true);
            },
            data: function(params) {
              return {
                s: params.term,
                q: $("#id_provinsi").val()
              }
            },
            processResults: function (data, page) {
              return {
                results: data
              };
            },
            error: function() {
              $('#id_kecamatan').prop("disabled", true);
              $('#id_kelurahan').prop("disabled", true);
            },
            cache: true
          }
        }).on('select2:select', function () {
          $('#id_kecamatan').prop("disabled", false);
        });
        $('#id_kecamatan').select2({
          theme: 'bootstrap',
          allowClear: true,
          placeholder: 'Pilih Kecamatan',
          ajax: {
            dataType: 'json',
            delay: 0,
            url: "<?= site_url("services/kecamatan") ?>",
            beforeSend: function() {
              $('#id_kelurahan').prop("disabled", true);
            },
            data: function(params) {
              return {
                s: params.term,
                q: $("#id_kabkot").val()
              }
            },
            processResults: function (data, page) {
              return {
                results: data
              };
            },
            error: function() {
              $('#id_kelurahan').prop("disabled", true);
            },
            cache: true
          }
        }).on('select2:select', function () {
          $('#id_kelurahan').prop("disabled", false);
        });
        $('#id_kelurahan').select2({
          theme: 'bootstrap',
          allowClear: true,
          placeholder: 'Pilih Kelurahan',
          ajax: {
            dataType: 'json',
            delay: 0,
            url: "<?= site_url("services/kelurahan") ?>",
            data: function(params) {
              return {
                s: params.term,
                q: $("#id_kecamatan").val()
              }
            },
            processResults: function (data, params) {
              params.page = params.page || 1;
              return {
                results: $.map(data, function(obj) {
                  $('#kode_pos').val(obj.kode);
                  return {
                    id: obj.id,
                    text: obj.text
                  };
                }),
              };
            },
            error: function() {
              $('#id_kelurahan').prop("disabled", true);
            },
            cache: true
          }
        });
        // PERUSAHAAN
        $('#provinsi_perusahaan').prop("disabled", false); // Script yang ditambahkan Rahmat, 10 Agustus 2020
        $('#kabupaten_perusahaan').prop("disabled", true);
        $('#kecamatan_perusahaan').prop("disabled", true);
        $('#kelurahan_perusahaan').prop("disabled", true);

        // Ajax Provinsi
        $('#provinsi_perusahaan').select2({
          theme: 'bootstrap',
          language: 'id',
          allowClear: true,
          placeholder: 'Pilih Provinsi',
          ajax: {
            dataType: 'json',
            delay: 0,
            url: "<?= site_url("services/provinsi") ?>",
            beforeSend: function() {
              $('#kabupaten_perusahaan').prop("disabled", true);
              $('#kecamatan_perusahaan').prop("disabled", true);
              $('#kelurahan_perusahaan').prop("disabled", true);
            },
            data: function(params) {
              return {
                s: params.term
              }
            },
            processResults: function (data, page) {
              return {
                results: data
              };
            },
            error: function() {
              $('#kabupaten_perusahaan').prop("disabled", true);
              $('#kecamatan_perusahaan').prop("disabled", true);
              $('#kelurahan_perusahaan').prop("disabled", true);
            },
            cache: true
          }
        }).on('select2:select', function() {
          $('#kabupaten_perusahaan').prop("disabled", false);
        });
        // Ajax Kabupaten Kota
        $('#kabupaten_perusahaan').select2({
          theme: 'bootstrap',
          allowClear: true,
          placeholder: 'Pilih Kab/Kota',
          ajax: {
            dataType: 'json',
            delay: 0,
            url: "<?= site_url("services/kab_kota") ?>",
            beforeSend: function() {
              $('#kecamatan_perusahaan').prop("disabled", true);
              $('#kelurahan_perusahaan').prop("disabled", true);
            },
            data: function(params) {
              return {
                s: params.term,
                q: $("#provinsi_perusahaan").val()
              }
            },
            processResults: function (data, page) {
              return {
                results: data
              };
            },
            error: function() {
              $('#kecamatan_perusahaan').prop("disabled", true);
              $('#kelurahan_perusahaan').prop("disabled", true);
            },
            cache: true
          }
        }).on('select2:select', function () {
          $('#kecamatan_perusahaan').prop("disabled", false);
        });
        // Ajax Kecamatan
        $('#kecamatan_perusahaan').select2({
          theme: 'bootstrap',
          allowClear: true,
          placeholder: 'Pilih Kecamatan',
          ajax: {
            dataType: 'json',
            delay: 0,
            url: "<?= site_url("services/kecamatan") ?>",
            beforeSend: function() {
              $('#kelurahan_perusahaan').prop("disabled", true);
            },
            data: function(params) {
              return {
                s: params.term,
                q: $("#kabupaten_perusahaan").val()
              }
            },
            processResults: function (data, page) {
              return {
                results: data
              };
            },
            error: function() {
              $('#kelurahan_perusahaan').prop("disabled", true);
            },
            cache: true
          }
        }).on('select2:select', function () {
          $('#kelurahan_perusahaan').prop("disabled", false);
        });
        // Ajax Kelurahan
        $('#kelurahan_perusahaan').select2({
          theme: 'bootstrap',
          allowClear: true,
          placeholder: 'Pilih Kelurahan',
          ajax: {
            dataType: 'json',
            delay: 0,
            url: "<?= site_url("services/kelurahan") ?>",
            data: function(params) {
              return {
                s: params.term,
                q: $("#kecamatan_perusahaan").val()
              }
            },
            processResults: function (data, params) {
              params.page = params.page || 1;
              return {
                results: $.map(data, function(obj) {
                  $('#kode_pos_perusahaan').val(obj.kode);
                  return {
                    id: obj.id,
                    text: obj.text
                  };
                }),
              };
            },
            error: function() {
              $('#kelurahan_perusahaan').prop("disabled", true);
            },
            cache: true
          }
        });
        $('#npwp').on('change', function(){
            var char = $(this).val();
            var charLength = char.length;
            if(charLength == 15){
                $('#label_npwp').text('NPWP Valid');
                var element = document.getElementById("fg_npwp");
                element.classList.remove("has-error");
                element.classList.add("has-success");
            }else{
                $('#label_npwp').text('NPWP Tidak Valid');
                var element = document.getElementById("fg_npwp");
                element.classList.remove("has-success");
                element.classList.add("has-error");
            }
        });
        $('#no_telepon').on('change', function(){
            var char = $(this).val();
            var charLength = char.length;
            if(charLength <= 13){
                $('#label_no_telepon').text('No Telepon Valid');
                var element = document.getElementById("fg_no_telepon");
                element.classList.remove("has-error");
                element.classList.add("has-success");
            }else{
                $('#label_no_telepon').text('No Telepon Tidak Valid');
                var element = document.getElementById("fg_no_telepon");
                element.classList.remove("has-success");
                element.classList.add("has-error");
            }
        });
        $('#no_telepon_perusahaan').on('change', function(){
            var char = $(this).val();
            var charLength = char.length;
            if(charLength <= 13){
                $('#label_no_telepon_perusahaan').text('No Telepon Valid');
                var element = document.getElementById("fg_no_telepon_perusahaan");
                element.classList.remove("has-error");
                element.classList.add("has-success");
            }else{
                $('#label_no_telepon_perusahaan').text('No Telepon Tidak Valid');
                var element = document.getElementById("fg_no_telepon_perusahaan");
                element.classList.remove("has-success");
                element.classList.add("has-error");
            }
        });
        $('#no_hp').on('change', function(){
            var char = $(this).val();
            var charLength = char.length;
            if(charLength <= 13){
                $('#label_no_hp').text('No Hp Valid');
                var element = document.getElementById("fg_no_hp");
                element.classList.remove("has-error");
                element.classList.add("has-success");
            }else{
                $('#label_no_hp').text('No Hp Tidak Valid');
                var element = document.getElementById("fg_no_hp");
                element.classList.remove("has-success");
                element.classList.add("has-error");
            }
        });
        $(document).on("input", ".numeric", function() {
            this.value = this.value.replace(/\D/g,'');
        });
        $('#username').on('change', function(){
            //Menghilangkan validasi pada kolom email. Perubahan oleh Nurhayati Rahayu (24/08/2021)
            //validate_email();
            // Baris terakhir perubahan oleh Nurhayati Rahayu (24/08/2021)

            validasi_username();
        });
        $('#password').on('change', function(){
            var char = $(this).val();
            var charLength = char.length;
            if(charLength >= 5){
                $('#label_password').text('Password Valid');
                var element = document.getElementById("fg_password");
                element.classList.remove("has-error");
                element.classList.add("has-success");
            }else{
                $('#label_password').text('Password harus lebih dari 5 karakter');
                var element = document.getElementById("fg_password");
                element.classList.remove("has-success");
                element.classList.add("has-error");
            }
        });
        $('#password2').on('change', function(){
            validasi_password();
        });

    });
      function validate_email_perusahaan() {
      var $result = $("#label_email_perusahaan");
      var email = $("#email_perusahaan").val();
      $result.text("");

      if (validateEmail(email)) {
        $result.text(email + " valid");
        $result.css("color", "green");
      } else {
        $result.text(email + " tidak valid");
        $result.css("color", "red");
      }
      return false;
    }
    function validasi_username() {
      var user = $('#username').val();
      $("#label_username").load('<?php echo base_url(); ?>services/validasi_username/' + user);
    }
    function validasi_password() {
      var pass1 = jQuery('#password').val();
      var pass2 = jQuery('#password2').val();
      $("#label_password2").load('<?php echo base_url(); ?>services/validasi_password/' + pass1 + '/' + pass2);
    }

  </script>
</body>
</html>
