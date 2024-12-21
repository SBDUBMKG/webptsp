<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(). 'favicon.ico';?>">
    <title><?php echo $this->config->item('short_description'); ?> | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>resources/css/bootstrap.min.css"> -->
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>resources/css/font-awesome.min.css"> -->
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/AdminLTE/dist/css/AdminLTE.min.css"> -->
    <!-- iCheck -->
    <!-- <link rel="stylesheet" href="<?php echo base_url() ?>resources/plugins/iCheck/square/blue.css"> -->

        <!-- Include Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url().'resources/themes/frontend_ptsp/css/bootstrap.css'?>" />
    
    <!-- Main StyleSheet -->
    <link rel="stylesheet" href="<?php echo base_url().'resources/themes/frontend_ptsp/style.css'?>" />	
    
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php echo base_url().'resources/themes/css/responsive.css'?>" />	


       <?php if(!$recaptcha_v2) { ?> 
    <!-- reCAPTCHA JS-->
<script src="https://www.google.com/recaptcha/api.js?render=6Ldg38IpAAAAAAlXVYcpwc8ucVEWTse_ryZwlpYz"></script>
<?php } ?>
</head>

<body class="login-body">

<div class="Login-form-area">
    <div class="container">
        <div class="Login-box">
            <div class="Login-logo">
                <img class="my-4" style="max-width: 150px;" src="<?php echo base_url().'resources/themes/frontend_ptsp/images/icons/bmkg_ptsp_2.png'?>" class="img-fluid" alt="">
            </div>
            <div class="Login-pen">
                <h3>Login Petugas</h3>						
                <div id="langChange">
                <form action="">
                    <input type="radio" name="l" id="toAr"/>
                    <label for="toAr" onclick="document.getElementById('lang-cnt').lang = 'ar'; document.getElementById('lang-cnt').dir = 'rtl'; "></label>
                    <input type="radio" name="l" id="toEn" checked/>
                    <label for="toEn" onclick="document.getElementById('lang-cnt').lang = 'en'; document.getElementById('lang-cnt').dir = 'ltr'; " ></label>
                </form>
                </div>
            </div>
            <div class="Jumlah-border">
                <div class="Jumlah-border-left Jumlah-border-left3"></div>
                <div class="Jumlah-border-right Jumlah-border-right3"></div>
            </div>
            <div class="Login-form">
                <div class="Login-man-logo">
                    <img src="<?php echo base_url().'resources/themes/frontend_ptsp/images/login-man-logo.png'?>" class="img-fluid" alt="">
                </div>
        <?php
        $sucMsg = $this->session->flashdata('sucMsg'); 
        if ( !empty($sucMsg) ) { ?>
        <div class="alert alert-danger" role="alert" style="color: black;background-color: #beb3fd;border-color: #1102fb;"><?php echo $sucMsg; ?></div>
        <?php } ?>
        <?php echo isset($err) ? '<p class="login-box-msg">'.$err.'</p>' : ""; ?>
        <?php echo isset($msg_change_password) ? '<p class="login-box-msg">'.$msg_change_password.'</p>' : ""; ?>
        <form method="post" action="login">

            <input type="text" name="txt_username" class="form-control" placeholder="User ID" required>
            <input type="password" name="txt_password" id="txt_password" class="form-control" placeholder="Password" required>
            <div class="login-lupa">
                <a href="<?php echo base_url().'home/forget_pass/';?>"> Lupa Password?</a>
            </div>
            <?php if($recaptcha_v2) { ?> 
            <div class="row">
                <div class="col-xs-12">
                    <div class="g-recaptcha" data-sitekey="6Lc2RcopAAAAAGNQo3Yr3HRDueNO9eCzkcsNAcSm"></div>

                </div>
            </div>
            <?php } else { ?> 
            <!-- Your form fields -->
            <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
            <?php } ?>
            <div class="login-btn">
                <button type="submit" class="text-white">MASUK</button>
            </div>
            <div class="login-or">
                <p>or</p>
            </div>
            <div class="login-dafter">
                <div class="dafter-left">
                    <button> DAFTAR</button>
                </div>
                <div class="dafter-right">
                    <a class="text-white" href="<?php echo base_url();?>"><button> BERANDA </button></a>
                </div>
            </div>
        </form>
        </div>
        </div>
    </div>
</div>

            <?php if($recaptcha_v2) { ?> 
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <?php } else { ?> 

<script>
    // Generate and store the reCAPTCHA token
    grecaptcha.ready(function() {
        grecaptcha.execute('6Ldg38IpAAAAAAlXVYcpwc8ucVEWTse_ryZwlpYz', {action: 'login'}).then(function(token) {
            document.getElementById('g-recaptcha-response').value = token;
            //console.log(token);
            //console.log(document.getElementById('g-recaptcha-response').value);
        });
    });
</script>
            <?php } ?>
 
<!-- jQuery 2.2.3 -->
<!-- <script src="<?php echo base_url() ?>resources/plugins/jQuery/jquery-2.2.3.min.js"></script> -->
<!-- Bootstrap 3.3.6 -->
<!-- <script src="<?php echo base_url() ?>resources/js/bootstrap.min.js"></script> -->
<!-- iCheck -->
<!-- <script src="<?php echo base_url() ?>resources/plugins/iCheck/icheck.min.js"></script> -->

<!-- Main jQuery -->
<script src="<?= site_url('resources/themes/frontend_ptsp/js/jquery-3.4.1.min.js') ?>"></script>		
    
<!-- Bootstrap jQuery -->
<script src="<?= site_url('resources/themes/frontend_ptsp/js/bootstrap.bundle.min.j') ?>"></script>

<script src="https://www.google.com/recaptcha/api.js"></script>	

<!-- owl.carousel.js -->
<script src="<?= site_url('resources/themes/frontend_ptsp/js/owl.carousel.js') ?>"></script>

<!-- Fontawesome Script -->
<script src="https://kit.fontawesome.com/2b12c591dc.js" crossorigin="anonymous"></script>

<!-- Custom jQuery -->
<script src="<?= site_url('resources/themes/frontend_ptsp/js/scripts.js') ?>"></script>

<!-- Scroll-Top button -->
<a href="#" class="scrolltotop">
    <i class="fa-solid fa-arrow-up"></i>
    <span class="pluse"></span>
    <span class="pluse2"></span>
</a>

<script>
    document.getElementById("show_hide").addEventListener("click", function(e){
        var pwd = document.getElementById("txt_password");
        if(pwd.getAttribute("type")=="password"){
            pwd.setAttribute("type","text");
        } else {
            pwd.setAttribute("type","password");
        }
    });
    window.localStorage.clear();
</script>
</body>
</html>