<!DOCTYPE html>

<html>

<head>

<title><?php echo !empty($title) ? $title.' - '.$this->config->item('short_app_name') : $this->config->item('short_app_name'); ?></title>

<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(). 'favicon.ico';?>">

<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/frontend/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/frontend/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/frontend/css/animate.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/frontend/css/font.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/frontend/css/li-scroller.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/frontend/css/slick.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/frontend/css/jquery.fancybox.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/frontend/css/theme.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/frontend/css/style.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/plugins/zabuto_calendar/zabuto_calendar.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/plugins/jssocials/jssocials.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>resources/plugins/jssocials/jssocials-theme-minima.css">

<?php echo isset($_styles) ? $_styles : NULL; ?>

<script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script>

<!--[if lt IE 9]>

<script src="resources/frontend/js/html5shiv.min.js"></script>

<script src="resources/frontend/js/respond.min.js"></script>

<![endif]-->



<style>

.center {

    text-align: center;

}



.pagination {

    display: inline-block;

}



.pagination a {

    color: black;

    float: left;

    padding: 8px 16px;

    text-decoration: none;

}



.pagination strong {

    background-color: #A5E126;

    color: white;

    float: left;

    padding: 8px 16px;

    text-decoration: none;

}



.pagination a:hover:not(.active) {

    background-color: #ddd;

}

</style>



<style>

    .google-maps {

        position: relative;

        padding-bottom: 75%; // This is the aspect ratio

        height: 0;

        overflow: hidden;

    }

    .google-maps iframe {

        position: absolute;

        top: 0;

        left: 0;

        width: 100% !important;

        height: 80% !important;

    }

</style>



<style>

img.nohover:hover {

  opacity: 1.0;

  filter: alpha(opacity=1.0);

}

</style>

</head>

<?php 
  /*
  $CI = &get_instance();

  $CI->load->model('global_model');



  $bg = $CI->global_model->get_by_id_array('tbl_background','is_active','1');



  $counter = check_counter();

  if(!isset($_SESSION['add_counter'])){

      update_counter();

      $_SESSION['add_counter'] = '1';

  }



  $cdisp=$counter; // Storing the counter value in another variable

  $divisor=10; // setting the divisor value to 10

  $digitarray=array(); // creating an array



  do {$digit=($cdisp % $divisor); // looping through the till all digits are taken

  $cdisp=($cdisp/$divisor); // getting the digits from right side

  array_push($digitarray,$digit); // storing them in the array

  } while($cdisp >=1); // condition of do loop



  // array is to be reversed as digits are in reverse order

  $digitarray=array_reverse($digitarray); 
  */
?>



<body class="loaded" style="background-repeat: repeat;">

  <!-- <div id="preloader">

    <div id="status">&nbsp;</div>

  </div> -->



  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>



  <div class="container">

    <header id="header">

      <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12">

          <div class="header_top">

            <ul class="top_nav">

              <?php 

                  if($bahasa == ''){

              ?>

              <li><a href="<?php echo base_url().'home/ganti_bahasa/_en';?>">ENGLISH</a></li>

              <?php

                  }

                  else if($bahasa == '_en'){

              ?>

              <li><a href="<?php echo base_url().'home/ganti_bahasa';?>">INDONESIA</a></li>

              <?php }?>

              <form class="pull-right col-md-3" method="get" action="<?php echo base_url().'pencarian'?>">

                <div class="input-group input-group-sm" style="margin-top:5px;">

                  <input type="text" name="search" class="form-control" placeholder="<?php echo $bahasa== '' ? 'Cari' : 'Search';?>" required>

                  <span class="input-group-btn"> <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button> </span>

                </div>

              </form>

            </ul>

          </div>

        </div>

        <div class="col-lg-12 col-md-12 col-sm-12">

          <div class="header_bottom" style="padding: 3px 30px 3px 30px">

            <?php 

                $banner = $CI->global_model->get_by_id_array('tbl_banner','is_active',1);

                if($bahasa == ''){

            ?>

            <div class="logo_area"><a href="<?php echo base_url();?>" class="logo"><img src="<?php echo base_url().'resources/frontend/images/'.$banner['banner'];?>" alt=""></a></div>

            <?php

                }

                else if($bahasa == '_en'){

            ?>

            <div class="logo_area"><a href="<?php echo base_url();?>" class="logo"><img src="<?php echo base_url().'resources/frontend/images/'.$banner['banner_en'];?>" alt=""></a></div>

            <?php }?>

          </div>

        </div>

      </div>

    </header>



    <section id="navArea">

      <nav class="navbar navbar-inverse" role="navigation" style="margin-bottom:3px;">

        <div class="navbar-header">

          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>

        </div>

        <div id="navbar" class="navbar-collapse collapse">

          <?php 

            $controller = $this->router->fetch_class();

            $current_url = $this->uri->segment(1); 

            $current_url_child = str_replace('index.php/', '', current_url());

          ?>

          <ul class="nav navbar-nav main_nav">

            <li <?php echo $controller == 'home' ? 'class="active"' : NULL; ?>><a href="<?php echo base_url();?>"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Beranda</span></a></li>

            <?php

                $list_kategori_menu = get_list_kategori_menu_frontend();

                foreach ( $list_kategori_menu as $key => $catmenu) {

                    $list_menu = get_list_menu_frontend($catmenu['id_kategori_menu']);

                    if ( count($list_menu) > 0 ) {

                        ?>

                        <li class="dropdown <?php echo $catmenu['uri'] == $current_url ? 'active' : NULL; ?>" > 

                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                            <?php echo $catmenu['kategori_menu'.$bahasa].'&nbsp;&nbsp;'.$catmenu['icon'];?>

                          </a>

                          <ul class="dropdown-menu" role="menu">

                            <?php

                              foreach ( $list_menu as $key => $menu ) {

                                  ?>

                                  <li <?php echo $current_url_child == base_url().$menu['uri'] ? 'class="active"' : NULL; ?>><a href="<?php echo base_url().$menu['uri']; ?>"><i class="fa fa-minus"></i>&nbsp; <span><?php echo $menu['menu'.$bahasa]; ?></span></a></li>

                                  <?php

                              }

                            ?>

                          </ul>

                        </li>

                        <?php

                    }

                }

                $list_menu = get_list_menu_frontend(0);

                foreach ( $list_menu as $key =>$menu_nochild ) {

                    ?>

                    <li <?php echo $controller == $menu_nochild['cname'] ? 'class="active"' : NULL; ?>><a href="<?php echo base_url().$menu_nochild['cname']; ?>"><span><?php echo $menu_nochild['menu'.$bahasa]; ?></span></a></li>

                    <?php

                } ?>

                <!--

                <li <?php echo $controller == 'download' ? 'class="active"' : NULL; ?>><a href="<?php echo base_url();?>"><span>download</span></a></li>

                -->

          </ul>

        </div>

      </nav>

    </section>



    <section id="newsSection" style="padding-bottom:3px;">

      <div class="row">

        <div class="col-lg-12 col-md-12">

          <div class="latest_newsarea"><span id="clockbox"></span>

            <ul id="ticker01" class="news_sticker">

              <?php

              $list_topikutama = $CI->global_model->get_list_array('tbl_pengumuman','is_publish=1','id_pengumuman','desc','5');

              foreach($list_topikutama as $key => $value){

              ?>

              <li><a href="<?php echo base_url().'pengumuman/detil_pengumuman/'.$value['id_pengumuman'];?>"><?php echo $value['isi'.$bahasa];?></a></li>

              <?php

              }

              ?>

            </ul>

            <div class="social_area">

              <ul class="social_nav">

                <?php 

                $sosial_media = $CI->global_model->get_list_array('tbl_sosial_media','is_show=1');

                foreach ($sosial_media as $key_sm => $value_sm) {

                  $link = !empty($value_sm['link']) ? $value_sm['link'] : '#';

                  echo '<li class="'.$value_sm['sosial_media'].'"><a href="'.$link.'" target="_blank"></a></li>';

                }

                ?>

              </ul>

            </div>

          </div>

        </div>

      </div>

    </section>



    <section id="sliderSection">

      <div class="row">

        <!--konten-->

        <?php if ( isset($content)  ) { echo $content ; } else { echo "content belum di set" ; }  ?>  



        <div class="col-lg-4 col-md-4 col-sm-4">

          <aside class="right_content">

            <!-- agenda-->

            <div class="single_post_content" style="margin-bottom:10px;">

              <div class="latest_newsarea"> <span><?php echo $last_agenda = $bahasa == '_en' ? 'today\'s agenda' : 'agenda hari ini'?></span>

                <div class="tickercontainer">

                  <div class="mask">

                    <ul id="ticker01" class="news_sticker newsticker" style="width: 1727px; left: 242.31px;">

                      <?php 

                      $agenda_today = $CI->global_model->get_list_array('tbl_agenda','date(tgl_mulai) = CURDATE()');

                      if(count($agenda_today)> 0){

                        foreach ($agenda_today as $key => $value) {

                         echo '<li><a href="'.base_url().'berita_agenda/agenda/detail_agenda/'.$value['id_agenda'].'">'.$value['judul'.$bahasa].'</a></li>';

                        }

                      }

                      else{

                        echo $bahasa == '_en' ? '<li><a href="#">NO AGENDA</a></li>' : '<li><a href="#">TIDAK ADA AGENDA</a></li>';

                      }

                      ?>

                      

                    </ul>

                  </div>

                </div>

              </div>

              <div style="margin-bottom:17px" id="my-calendar"></div>

            </div>

            <!--artikel-->

            <div class="single_sidebar" style="margin-bottom:18px">

              <h2 style="background-color:#000"><span><?php echo strtoupper(translate(6));?></span></h2>

              <ul class="spost_nav">

                <?php

                  $list_artikel = $CI->global_model->get_list_array('tbl_artikel','','tanggal','desc',5);

                  foreach($list_artikel as $key => $value){

                ?>

                <li>

                  <div class="media wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;"> 

                    <a href="<?php echo base_url().'berita/artikel/detil/'.$value['id'];?>" class="media-left"> <img alt="" src="<?php echo base_url().'upload/thumbnail/'.$value['thumbnail'];?>"> </a>

                    <div class="media-body"> <a href="<?php echo base_url().'berita/artikel/detil/'.$value['id'];?>" class="catg_title"> <?php echo substr($value['judul'.$bahasa],0,70);?></a> </div>

                    <small><i class="fa fa-calendar"></i>&nbsp;<?php echo format_datetime($value['tanggal']);?></small>

                    <small class="pull-right"><i class="fa fa-eye"></i>&nbsp;<?php echo $value['is_read'];?></small>

                  </div>

                </li>



                <?php } ?>

              </ul>

            </div>

          </aside>

        </div>

      </div>

    </section>



    <section id="sliderSection">

      <!--link-->

      <div class="latest_post">

        <h2><span><?php echo strtoupper(translate(9));?></span></h2>

        <div class="row">

          <?php

          $tautan = $CI->global_model->get_list_array('tbl_tautan','','urutan');

          foreach ($tautan as $key => $value) {

          ?>

          <div class="col-lg-4 col-md-4 col-sm-4">

            <ul>

              <li>

                <div class="media">

                  <a href="<?php echo $value['link']?>" title="<?php echo $value['judul']?>" target="_blank">

                    <img src="<?php echo base_url().'upload/tautan/'.$value['gambar']?>" alt="<?php echo $value['judul']?>" style="width:100%;height:122px;margin-bottom: 5px;" />

                  </a>

                </div>

              </li>

            </ul>

          </div>

          <?php } ?>

        </div>

        <h2>

          <!--span>

            <?php
            /*
            echo $bahasa=='' ? 'PENGUNJUNG : ' : 'VISITOR : ';

            while (list ($key, $val) = each ($digitarray)) {

                echo '<img src="'.base_url().'resources/images/counter/'.$val.'.png">'; 

            }
            */
            ?>

          </span-->

        </h2>

      </div>

    </section>



    <footer id="footer">

      <div class="footer_top">

        <div class="row">

          <div class="col-lg-4 col-md-4 col-sm-4">

            <div class="footer_widget">

              <h2 style="color:#fee50f"><?php echo strtoupper(translate(11));?></h2>

              <p style="color:#fee50f"><?php echo substr(translate(13),0,150) ;?>...</p>

              <a href="<?php echo base_url().'sambutan';?>" class="btn btn-warning"><?php echo $bahasa=='' ? 'Selengkapnya' : 'More'?></a>

            </div>

          </div>

          <div class="col-lg-4 col-md-4 col-sm-4">

            <div class="footer_widget">

              <h2 style="color:#fee50f"><?php echo strtoupper(translate(10));?></h2>

              <address style="color:#fee50f">

              <?php echo translate(14);?>

              </address>

            </div>

          </div>



          <?php 

          $map = $CI->global_model->get_by_id_array('tbl_setting_content','id_setting',1);

          $map_show = $map['is_show'];

          if($map_show ==1 ){

          ?>

          <div class="col-lg-4 col-md-4 col-sm-4">

            <div class="footer_widget">

              <h2 style="color:#fee50f"><?php echo strtoupper(translate(21));?></h2>

              <div class="google-maps">

                <?php               

                echo $map['value'];

                ?>

              </div>

            </div>

          </div>

          <?php } ?>

        </div>

      </div>

      <div class="footer_bottom">

        <p style="color:#000" class="copyright"><?php echo strtoupper(translate(12));?></p>

        <p class="developer">

          <a style="font-color:white" href="<?php echo base_url().'privasi'?>">PRIVASI </a>

        </p>

      </div>

    </footer>

  </div>

  <!-- pop up -->

  <?php 

  $is_show = $CI->global_model->get_by_id_array('tbl_setting_content', 'id_setting',8);

  if (empty($_SESSION['url_back']) && $is_show['is_show']==1) { ?>

  <div class="modal fade in" id="myModal">

    <div class="modal-header" style="border-bottom:0px;">

    </div>

    <div class="modal-body">

        <img width="700px"  src="<?php echo base_url().'resources/frontend/images/'.setting_content(8)?>" alt="..." class="nohover img-responsive center-block" />

        <br>

        <div class="col-md-12" style="text-align:center">

          <a class="btn btn-lime" data-dismiss="modal">Masuk</a>

        </div>

    </div>

  </div>

  <?php } 

  $_SESSION['url_back'] = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

  ?>  

  <!-- popup -->

  

  <script src="<?php echo base_url();?>resources/frontend/js/jquery.min.js"></script>   

  <script src="<?php echo base_url();?>resources/frontend/js/wow.min.js"></script> 

  <script src="<?php echo base_url();?>resources/frontend/js/bootstrap.min.js"></script> 

  <script src="<?php echo base_url();?>resources/frontend/js/slick.min.js"></script> 

  <script src="<?php echo base_url();?>resources/frontend/js/jquery.li-scroller.1.0.js"></script> 

  <script src="<?php echo base_url();?>resources/frontend/js/jquery.newsTicker.min.js"></script> 

  <script src="<?php echo base_url();?>resources/frontend/js/jquery.fancybox.pack.js"></script> 

  <script src="<?php echo base_url();?>resources/frontend/js/custom.js"></script>

  <script src="<?php echo base_url();?>resources/plugins/zabuto_calendar/zabuto_calendar.min.js"></script>

  <script src="<?php echo base_url();?>resources/plugins/jssocials/jssocials.min.js"></script>



  <!--Vegas-->

  <!--

  <script src="<?php echo base_url().'resources/plugins/vegas/jquery.min.js';?>"></script>

  -->

  <script src="<?php echo base_url().'resources/plugins/vegas/zepto.min.js';?>"></script>

  <link rel="stylesheet" href="<?php echo base_url().'resources/plugins/vegas/vegas.min.css';?>">

  <script src="<?php echo base_url().'resources/plugins/vegas/vegas.min.js';?>"></script>



  <?php echo isset($_scripts) ? $_scripts : NULL; ?>



  <script type="application/javascript">

    var bahasa = '<?php echo $bahasa;?>';

    var hari = '<?php echo $bahasa == "" ? "in" : "en";?>';

      $(document).ready(function(){

          $("#my-calendar").zabuto_calendar({

              ajax: {

                  url: "<?php echo base_url();?>home/show_data",

                  modal: true

              },

                language: hari

              

          });

      });

      if(bahasa === ''){

        tday=new Array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");

        tmonth=new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

      }else{

        tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");

        tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

      }



      function GetClock(){

      var d=new Date();

      var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear();

      if(nyear<1000) nyear+=1900;

      var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;



      if(nhour==0){ap=" AM";nhour=12;}

      else if(nhour<12){ap=" AM";}

      else if(nhour==12){ap=" PM";}

      else if(nhour>12){ap=" PM";nhour-=12;}



      if(nmin<=9) nmin="0"+nmin;

      if(nsec<=9) nsec="0"+nsec;



      document.getElementById('clockbox').innerHTML=""+tday[nday]+", "+ndate+" "+tmonth[nmonth]+" "+nyear+" | "+nhour+":"+nmin+":"+nsec+ap+"";

      }



      window.onload=function(){

      GetClock();

      setInterval(GetClock,1000);

      

      }

      $(window).on('load',function(){

          $('#myModal').modal('show');

      });

      $("#share").jsSocials({

          showLabel: false,

          showCount: false,

          shares: ["email", "twitter", "facebook", "googleplus", "linkedin"]

      });

  </script>



  <script>

  $("#example, body").vegas({

      slides: [

          <?php

          $bg = $CI->global_model->get_list_array('tbl_background', 'is_active = 1');

          foreach($bg as $key => $value){

          ?>

          { src: "<?php echo base_url().'resources/frontend/images/'.$value['background'];?>" },

          <?php 

          }

          ?>

      ]

  });

  </script>

  <?php echo isset($scripts) ? $scripts['css'].'<br>'.$scripts['js'].'<br>'.$scripts['apps'] : null;?>
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