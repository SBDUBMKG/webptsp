<?php
//file: application\views\template_limberly.php
?>
<!DOCTYPE html>
<html>
<head>
  <title>
    <?php echo !empty($title) ? $title.' - '.$this->config->item('short_app_name') : $this->config->item('short_app_name'); ?>
  </title>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(). 'favicon.ico';?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href="<?php echo base_url().'resources/themes/limberly/styles/layout.css'?>" rel="stylesheet" type="text/css" media="all">
  <link rel="stylesheet" href="<?php echo base_url().'resources/themes/limberly/styles/bootstrap/3.3.7/bootstrap.min.css'?>">
  <link rel="stylesheet" href="<?php echo base_url().'resources/themes/limberly/font-awesome/4.2.0/css/font-awesome.min.css'?>"/>
  <link rel="stylesheet" href="<?php echo base_url().'resources/plugins/vegas/vegas.min.css';?>">

  <?= isset($_styles) ? $_styles : NULL; ?>  

  <?php 
		$bahasa = $this->session->userdata('bahasa');
		$this->load->model('global_model');

		// =========== untuk load menu ============
		$controller = $this->router->fetch_class();
		$current_url = $this->uri->segment(1); 
		$current_url_child = str_replace('index.php/', '', current_url());
		$counter = check_counter();
		if(!isset($_SESSION['add_counter'])){
		  update_counter();
		  $_SESSION['add_counter'] = '1';
		}

		$cdisp=$counter; // Storing the counter value in another variable
		$divisor=10; // setting the divisor value to 10
		$digitarray=array(); // creating an array
		do {
			$digit=($cdisp % $divisor); // looping through the till all digits are taken
			$cdisp=($cdisp/$divisor); // getting the digits from right side
			array_push($digitarray,$digit); // storing them in the array
		}
		while($cdisp >=1); // condition of do loop
		// array is to be reversed as digits are in reverse order
		$digitarray=array_reverse($digitarray); 
  ?>

	<style type="text/css">
		.breadcrumb{
		  background-color: #e2e2e2;
		  border: 1px solid #337ab7;
		  border-top: none;
		  border-radius: 0px;
		}

		.breadcrumb li a {
		  color: #337ab7 !important;
		}

		.difixin{
		  position: fixed;
		  z-index: 9999;
		  margin-left: 0;
		  background-color: white;
		  width: 100%;
		}

		.animate {
		  -webkit-animation-duration: 0.5s;
		  animation-duration: 0.5s;
		  -webkit-animation-fill-mode: both;
		  animation-fill-mode: both;
		  -webkit-animation-delay: 0.5s;
		  -moz-animation-delay: 0.5s;
		  animation-delay: 0.5s;
		}

		/*=== FADE IN DOWN ===*/
		@-webkit-keyframes fadeInDown {
		  from {
		    opacity: 0;
		    -webkit-transform: translate3d(0, -100%, 0);
		    transform: translate3d(0, -100%, 0);
		  }
		 
		  to {
		    opacity: 1;
		    -webkit-transform: none;
		    transform: none;
		  }
		}
		@keyframes fadeInDown {
		  from {
		    opacity: 0;
		    -webkit-transform: translate3d(0, -100%, 0);
		    transform: translate3d(0, -100%, 0);
		  }
		 
		  to {
		    opacity: 1;
		    -webkit-transform: none;
		    transform: none;
		  }
		}
		 
		.fadeInDown {
		  -webkit-animation-name: fadeInDown;
		  animation-name: fadeInDown;
		}

		.search input[type=text] {
		    width: 150px;
		    height: 20px;
		    box-sizing: border-box;
		    border: 1px solid black;
		    border-radius: 4px;
		    font-size: 12px;
		    color: black;
		    background-color: white;
		    background-size: 15px 15px;
		    background-image: url('<?php echo base_url();?>resources/frontend/images/search2.png');
		    background-position: 5px 2.5px; 
		    background-repeat: no-repeat;
		    padding: 10px 5px 10px 25px;
		    -webkit-transition: width 0.4s ease-in-out;
		    transition: width 0.4s ease-in-out;
		}

		.search input[type=text]:focus {
		    width: 100%;
		}

		.select2-container, .select2-dropdown, .select2-search, .select2-results {
			-webkit-transition: none !important;
			-moz-transition: none !important;
			-ms-transition: none !important;
			-o-transition: none !important;
			transition: none !important;
		}
	</style>

	<script type="text/javascript"> var base_url = "<?= site_url() ?>"</script>
	<script type="text/javascript" src="<?= site_url('resources/plugins/jQuery/jquery-2.2.3.min.js') ?>"></script>
	<script type="text/javascript" src="<?= site_url('resources/js/global_function.js') ?>"></script>
</head>

<body class="background-slide" id="top">
  <div class="bgded overlay">
    <div class="wrapper row1">
      <div id="difix">
        <div class="row0" width="100%">
          <div id="topbar" class="hoc clear row0">
            <div class="container hoc">
              <div class="fl_left">
                  <ul class="nospace">
                  	<!--
                    <li>
                      <a href="<?php echo base_url();?>">
                        <i class="fa fa-lg fa-home"></i>
                      </a>
                    </li>
                    -->
                    <?php echo $bahasa == '' ? '<li  style="color:black"><a href="'.base_url().'home/ganti_bahasa/_en"><img src="'.base_url().'resources/frontend/images/english.png" style="height:15px"> ENGLISH</a></li>' : '<li style="color:#FFFFFF"><a href="'.base_url().'home/ganti_bahasa"><img src="'.base_url().'resources/frontend/images/indonesia.png" style="height:15px"> INDONESIA</a></li>'?>
                    <li style="color:black">
                      <form class="search" method="post" action="<?php echo base_url().'search/index';?>">
                        <input type="text" name="search" placeholder="<?php echo $bahasa == '' ? 'Cari...' : 'Search...';?>">
                      </form>
                    </li>
                  </ul>
              </div>
              <div class="fl_right">
                  <ul class="nospace">
                    <li style="color:black" id="clockbox"></li>
                  </ul>
              </div>
            </div>
          </div>
        </div>
        <?php $banner = $this->global_model->get_by_id_array('tbl_banner','is_active',1);?>
        <header id="header" class="container hoc clear">
            <a href="<?php echo base_url()?>">
              <img src="<?php echo base_url().'resources/frontend/images/'.$banner['banner'.$bahasa];?>" style="width=100%">
            </a>
        </header>
        <div class="wrapper row1" style="background-color:#42a5f5;border-bottom: 3px solid #8DD5D6;">
          <div class="container hoc">
            <nav id="mainav" class="navbar-expand-md" style="font-size: 9pt; width: 100%;">
              <?php echo generate_menu() ?>
            </nav>
          </div>
        </div>
      </div>
      <!-- ======================================= call content here  ======================================= -->
      <!-- -->
      <?php if ( isset($content)  ) { echo $content ; } else { echo "content belum di set" ; }  ?>
      <!-- -->
      <!-- ================================================================================================== -->
      <div class="wrapper coloured">
      </div>
    </div>
    <div class="wrapper row5" style="border-top: solid 5px #8DD5D6;">
      <div id="copyright" class="hoc clear">
	    <p class="text-center">
	        <b style="color:#5E5E5E"><?php echo strtoupper(translate(28));?></b>
	    </p>
      </div>
    </div>
  </div>

  <a id="backtotop" href="#top">
    <i class="fa fa-chevron-up"></i>
  </a>
<!-- Login MODAL -->
<div id="loginModal" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<form action="" method="post" id="form_login">
				<div class="modal-header">				
					<h4 class="modal-title">Login</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">				
					<div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" name="username" id="username" required="required">
					</div>
					<div class="form-group">
						<div class="clearfix">
							<label>Password</label>
							<a href="<?php echo base_url(). 'home/forget_pass/';?>" class="pull-right text-muted"><small><?php echo translate('lupa_password',true);?></small></a>
						</div>
						
						<input type="password" class="form-control" required="required" name="password" id="password">
					</div>
				</div>
				<div class="modal-footer">
<button type="button" class="btn btn-warning  pull-left" onclick="location.href='<?php echo base_url().'registrasi';?>';">Registrasi</button>
					<input type="submit" class="btn btn-primary pull-right" value="Login">
				</div>
			</form>
		</div>
	</div>
</div>    
<script>
 $(document).ready(function(){  
 	  $("#form_login").submit(function(ev){
 	  		ev.preventDefault();
           var username = $('#username').val();  
           var password = $('#password').val();  
           if(username != '' && password != '')  
           {  
                $.ajax({  
                     url: '<?php echo base_url(). "auth-login";?>',  
                     method:"POST",  
                     data: {username:username, password:password}, 
                     dataType: "json", 
                     success:function(data)  
                     {  
                          //alert(data);  
                          if(data.msg == 'No')  
                          {  
                               alert("Username dan Password tidak sesuai");  
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
                alert("Both Fields are required");  
           }  
      })});  
</script> 
  <script type="text/javascript" src="<?= site_url('resources/themes/limberly/scripts/jquery.min.js') ?>"></script>
  <script type="text/javascript" src="<?= site_url('resources/themes/limberly/scripts/3.3.7/bootstrap.min.js') ?>"></script>
  <script type="text/javascript" src="<?= site_url('resources/themes/limberly/scripts/jquery.backtotop.js') ?>"></script>
  <script type="text/javascript" src="<?= site_url('resources/themes/limberly/scripts/jquery.mobilemenu.js') ?>"></script>
  <script type="text/javascript" src="<?= site_url('resources/plugins/vegas/zepto.min.js') ?>"></script>
  <script type="text/javascript" src="<?= site_url('resources/plugins/vegas/vegas.min.js') ?>"></script>

	<?= isset($_scripts) ? $_scripts : NULL ?>

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
				$bg = $this->global_model->get_list_array('tbl_background', 'is_active = 1');
				foreach($bg as $key => $value) { ?> 
				{
					src: "<?= site_url('resources/frontend/images/'.$value['background']) ?>"
				},
				<?php  } ?> 
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
</body>
</html>