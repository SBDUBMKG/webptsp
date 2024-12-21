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
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/themes/AdminLTE/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url() ?>resources/plugins/iCheck/square/blue.css">
       <?php if(!$recaptcha_v2) { ?>
    <!-- reCAPTCHA JS-->
<script src="https://www.google.com/recaptcha/api.js?render=6Ldg38IpAAAAAAlXVYcpwc8ucVEWTse_ryZwlpYz"></script>
<?php } ?>
</head>
<style>
    @media (max-width: 575.98px) {
        .form-mobile {
            display: flex;
            justify-content: center;
        }
        .form-mobile .login-box {
            margin-right: 0 !important;
            margin-left: 0 !important;
        }
    }
</style>

<body class="login-page" style="height:100px;background-image:url('../resources/images/bglogin.jpg');background-size:cover;" >
<br><br><br><br><br><br><br>
<div class="form-mobile">
    <div class="login-box" style="background-color:#fff;border-radius: 25px; padding: 20px; padding-top: 30px; margin-right: 15%;">
        <div class="login-logo">
            <a href="<?php echo base_url(); ?>">
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="col-xs-3" style="padding: 0px;margin-bottom: 10px;">
                            <img src="<?php echo base_url().'resources/images/logo-bmkg.png'?>" height="86px">
                    </div>
                    <div class="col-xs-9" style="padding: 0px">
                            <b><?php echo $this->config->item('short_app_name');?></b>
                          <!--  <h3 style="margin-top:0px">
                                 <b><?php echo $this->config->item('short_description');?></b>
                                <b>Online</b>-->

                    </div>
                </div>
                    <hr style="border:solid 0.5px #b3b3b3;margin-bottom:0px;">
            <h3><b><?php echo 'HALAMAN LOGIN PETUGAS'; ?></b></h3>
                <?php
                //$short_description = $this->config->item('description_footer_text');
                if ( !empty($short_description) ) {
                    ?>
                    <h3><b><?php echo $short_description;?></b></h3>
                    <?php
                }
                ?>
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <?php
            $sucMsg = $this->session->flashdata('sucMsg');
            if ( !empty($sucMsg) ) { ?>
            <div class="alert alert-danger" role="alert" style="color: black;background-color: #beb3fd;border-color: #1102fb;"><?php echo $sucMsg; ?></div>
            <?php } ?>
            <?php echo isset($err) ? '<p class="login-box-msg">'.$err.'</p>' : ""; ?>
            <?php echo isset($msg_change_password) ? '<p class="login-box-msg">'.$msg_change_password.'</p>' : ""; ?>
            <form method="post" action="login">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="text" name="txt_username" class="form-control" placeholder="User ID" required/>
                </div>
                <br>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="password" name="txt_password" id="txt_password" class="form-control" placeholder="Password" required/>
                    <span class="input-group-addon" type="button" style="cursor:pointer"><i class="fa fa-eye" id="show_hide"></i></span>
                </div>
                <br>
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
                <div class="row" style="margin-top:10px;">



                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
                    </div>
                   <div class="col-xs-6">
                        <button type="button" class="btn btn-warning btn-block btn-flat" onclick="location.href='<?php echo base_url().'home/forget_pass/';?>';">Lupa Password</button>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-xs-12">
                        <button type="button" class="btn btn-success btn-block btn-flat" onclick="location.href='<?php echo base_url();?>';">Website PSTP</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- /.login-box-body -->
    </div>

</div>


<!-- /.login-box -->
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
<script src="<?php echo base_url() ?>resources/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url() ?>resources/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url() ?>resources/plugins/iCheck/icheck.min.js"></script>
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
