<?php
//file: application\views\v_home.php
$lang = $this->session->userdata('bahasa');
$lang_code = 'id';
if($lang == '_en'){
  $lang_code = 'en';
}
?>
<style>

  .carousel {
      border-radius: 5px 5px 0 0;
      overflow: hidden;
  }

  img.addhover1:hover{
    background-color: #c7d3ea!important;
  }

  img.addhover2:hover{
    background-color: #c7d3ea!important;
  }

  .gambar-slider {
      margin-top: 10px;
  }

  .marquee-pengumuman{
    background-color: #42a5f5;
    padding:5px;
  }

  .thumbutama {
      display: block;
      padding: 4px;
      line-height: 1.42857143;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 4px;
  }

  .nav-tabs {
      border-bottom: 1.5px solid #42a5f5;
  }

  .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
      cursor: default;
      border-bottom-color: transparent;
  }

  .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: #42a5f5;
    background-color: none;
    border:none;
    padding: 3px;
    font-weight: 700;
  }

  .nav-tabs>li{
    border-bottom: solid 5px #42a5f5;
  }

  .carousel-caption {
      position: relative;
      left: auto;
      right: auto;
      background-color:#000;
      bottom:auto;
  }

  .nav-sosmed {
      border-bottom: 1.5px solid #42a5f5;
  }

  .nav-sosmed>li{
      float: left;
  }

  .nav-sosmed>li>a {
      padding: 4.3px 15px;
      border-top-left-radius: 3px;
      border-top-right-radius: 3px;
  }

  .nav-sosmed>li.active {
      padding: 0px 15px;
      text-align: center;
      border-top: solid 1px #42a5f5;
      border-left: solid 1px #42a5f5;
      border-right: solid 1px #42a5f5;
      border-bottom: 5px solid #42a5f5;
      border-top-left-radius: 3px;
      border-top-right-radius: 3px;
  }

  .nav-sosmed>li.active>a, .nav-sosmed>li.active>a:focus, .nav-sosmed>li.active>a:hover {
    cursor: default;
    border-bottom-color: transparent;
  }

  .nav-sosmed>li.active>a, .nav-sosmed>li.active>a:focus, .nav-sosmed>li.active>a:hover {
    color: #555;
    background-color: none;
    border:none;
    padding: 1.5px;
    font-weight: 700;
  }

  .newsticker-jcarousellite .info {
    padding-left: 10px;
  }

  .newsticker-jcarousellite-artikel .info {
    padding-left: 10px;
  }

  .head {
    margin-top: 10%;
  }

</style>

<div class="wrapper row3">
  <section class="hoc container clear"> 
    <div id="slider_carousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php 
        $i_slider=0;
    	foreach($list_slider as $key => $value) { 
        	$active_slider = $i_slider==0 ? 'active' : NULL;
        ?>
        <li data-target="#slider_carousel" data-slide-to="<?= $i_slider ?>" class="<?= $active_slider ?>" style="background-color:black;color:black;border:1px solid black;opacity:0.3;"></li>
        <?php
	    	$i_slider++;
        }
        ?>      
      </ol>
      <div class="carousel-inner">
        <?php 
        $i_slider=0; foreach($list_slider as $key => $value) { $i_slider++;
        $active_slider = $i_slider==1 ? 'active' : NULL;
        ?>
        <div class="item <?= $active_slider?>" style="max-height:330px">
          <img src="<?= base_url().'upload/slider/'.$value['slider'.$bahasa]?>" alt="" style="width:100%;">
        </div>  
        <?php } ?>      
      </div>

      <a class="left carousel-control" href="#slider_carousel" data-slide="prev">
        <span class="fa fa-chevron-left navmid"></span>
      </a>
      <a class="right carousel-control" href="#slider_carousel" data-slide="next">
        <span class="fa fa-chevron-right navmid"></span>
      </a>
    </div>
  </section>
</div>



<div class="wrapper row3" style="margin-bottom: -10px;">
  <section class="hoc container clear">
  <marquee style="padding: 3px!important; font-size: 9pt;" class="marquee-pengumuman" behavior="scroll" direction="left"onmouseover="this.stop();" onmouseout="this.start();">
    <?php
    $list_topikutama = $this->global_model->get_list_array('tbl_pengumuman','is_publish=1','id_pengumuman','desc','5');
    foreach($list_topikutama as $key => $value){
    ?>
    <i class="fa fa-arrow-circle-right"></i> <a style="color:#FFFFFF" href="<?= base_url().'pengumuman/detil_pengumuman/'.$value['id_pengumuman'] ?>"> <?= strip_tags($value['isi'.$bahasa]) ?></a>
    <?php
    }
    ?>
  </marquee> 
  </section>
</div>

<div class="wrapper row3" style="padding: 15px 0">
    <main class="hoc container clear">
        <div class="group center">
          <article class="one_quarter first">
              <a href="<?= site_url('katalog_pelayanan') ?>">
                <i class="icon" style="font-size: 0px;"><img src="<?= site_url('/resources/frontend/images/katalog.png') ?>" style="width:70px;"></i>
              </a>
              <h4 class="font-x1"><a href="<?= site_url('katalog_pelayanan') ?>"><?= strtoupper(translate(1)) ?></a></h4>
              <p><?= translate(6) ?></p>
          </article>
          <article class="one_quarter">
              <a href="<?= site_url('backend/monitoring_status/monitoring_status') ?>">
                <i class="icon" style="font-size: 0px;"><img src="<?= site_url('/resources/frontend/images/search3.png') ?>" style="width:70px;"></i>
              </a>
              <h4 class="font-x1"><a href="<?= site_url('backend/monitoring_status/monitoring_status') ?>"><?= strtoupper(translate(2)) ?></a></h4>
              <p><?= translate(7) ?></p>
          </article>
          <article class="one_quarter">
              <a href="<?= site_url('registrasi') ?>">
                <i class="icon" style="font-size: 0px;"><img src="<?= site_url('/resources/frontend/images/user.png') ?>" style="width:70px;"></i>
              </a>
              <h4 class="font-x1"><a href="<?= site_url('registrasi') ?>"><?= strtoupper(translate(3)) ?></a></h4>
              <p><?= translate(8) ?></p>
          </article>
          <!--
          <article class="one_quarter">
              <a href="<?= base_url().'backend/login' ?>"><i class="icon" style="font-size: 0px;"><img src="<?= base_url()?>/resources/frontend/images/login.png" style="width:70px;"></i></a>
              <h4 class="font-x1"><a href="<?= base_url().'backend/login' ?>"><?= strtoupper(translate(4)) ?></a></h4>
              <p><?= translate(9) ?></p>
          </article>
          -->
          <article class="one_quarter">
              <a href="javascript:void(Tawk_API.toggle())"><i class="icon" style="font-size: 0px;"><img src="<?= base_url()?>/resources/frontend/images/chat.png" style="width:70px;"></i></a>
              <h4 class="font-x1"><a href="javascript:void(Tawk_API.toggle())"><?= strtoupper(translate(5)) ?></a></h4>
              <p><?= translate(40) ?></p>
          </article>
        </div>
        <div class="clear"></div>
    </main>
</div>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content"> 
      <article class="one_third first" style="min-height:420px;border: 0px solid;">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#berita_utama" aria-controls="berita_utama" role="tab" data-toggle="tab" style="color:#42a5f5;"><?= strtoupper(translate(10)) ?></a></li>
        </ul>

        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="berita_utama" style="margin-top:10px; ">
            <div class="row">
              <div class="col-md-12" id="kalender">
              </div>
          </div>
        </div>
        <div class="clear"></div>
      </article>

      <article class="one_third" style="min-height:420px;border: 0px solid;">
        <ul class="nav nav-sosmed" role="tablist">
          <li role="presentation" class="active"><a href="#index_berita" aria-controls="index_berita" role="tab" data-toggle="tab" style="color:#42a5f5"><?= strtoupper(translate(11)) ?></a></li>
          <li role="presentation"><a href="#index_artikel" aria-controls="index_artikel" role="tab" data-toggle="tab" style="color:#42a5f5"><?= strtoupper(translate(12)) ?></a></li>
        </ul>

        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="index_berita" style="margin-top:10px">
            <div class="newsticker-jcarousellite" style="width: 100%;">
              <ul>
                <?php
                $berita = $this->global_model->get_list_array('tbl_berita','id_jenis_konten=1 AND is_publish = 1','id','DESC','5'); 
                foreach ($berita as $key_berita_ticker => $value_berita_ticker) {
                ?>
                <li>
                    <div class="thumbnail" style="width: 30%;">
                        <?= !empty($value_berita_ticker['thumbnail']) ? '<img src="'.base_url().'upload/thumbnail/'.$value_berita_ticker['thumbnail'].'" />' : '<img src="'.base_url().'resources/frontend/images/noimage.png" />' ?>
                    </div>
                    <div class="info" style="width: 70%;">
                        <!-- <a style="color:rgb(102, 102, 102)" href="<?= base_url().'berita/ptsp/detil/'.$value_berita_ticker['id']?>"><?= substr(ucfirst(strtolower($value_berita_ticker['judul'.$bahasa])),0,40) ?></a> 
			Merubah panjang judul dair '40' menjadi '100'. Perubahan oleh : Nurhayati Rahayu (18/10/2019) 
			Merubah format pada judul. Perubahan oleh : Nurhayati Rahayu (18/10/2019) -->
			<a style="color:rgb(102, 102, 102)" href="<?= base_url().'berita/ptsp/detil/'.$value_berita_ticker['id']?>"><?= substr($value_berita_ticker['judul'.$bahasa],0,100) ?></a>
			<!-- baris terakhir perubahan. Perubahan oleh : Nurhayati Rahayu (18/10/2019) -->
			<span class="cat" style="color:#03A1A3"><?= format_datetime($value_berita_ticker['tanggal_berita'])?></span>
                    </div>
                    <div class="clear"></div>
                </li>
                <?php } ?>
              </ul>
            </div>
            <hr>
            <div style='margin-top: -15px; padding: 0 10px 10px 5px;'>
              <a class="btn btn-sm btn-warning pull-right" style="padding: 0 15px; color: white; text-transform: none; font-size: 8pt;" href="<?= base_url().'berita/ptsp/' ?>"><?= translate(16) ?>
              </a>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="index_artikel" style="margin-top:10px">
            <?php
            $artikel = $this->global_model->get_list_array('tbl_berita','id_jenis_konten=2 AND is_publish = 1','id','DESC','5');
            ?>
            <div class="newsticker-jcarousellite-artikel">
              <ul>
                <?php
                foreach ($artikel as $key_artikel_ticker => $value_artikel_ticker) {
                ?>
                <li>
                    <div class="thumbnail-artikel" style="width:30%;">
                        <?= !empty($value_artikel_ticker['thumbnail']) ? '<img src="'.base_url().'upload/thumbnail/'.$value_artikel_ticker['thumbnail'].'" />' : '<img src="'.base_url().'resources/frontend/images/noimage.png" />' ?>
                    </div>
                    <div class="info-artikel">
                        <!-- <a style="color:rgb(102, 102, 102)" href="<?= base_url().'berita/artikel/detil/'.$value_artikel_ticker['id']?>"><?= substr(ucfirst(strtolower($value_artikel_ticker['judul'.$bahasa])),0,40) ?></a>
			Merubah panjang judul dair '40' menjadi '100'. Perubahan oleh : Nurhayati Rahayu (18/10/2019)
			Merubah format pada judul. Perubahan oleh : Nurhayati Rahayu (18/10/2019) -->
			<a style="color:rgb(102, 102, 102)" href="<?= base_url().'berita/artikel/detil/'.$value_artikel_ticker['id']?>"><?= substr($value_artikel_ticker['judul'.$bahasa],0,100) ?></a>
			<!-- baris terakhir perubahan -->	
                        <span class="cat-artikel" style="color:#13d260"><?= format_datetime($value_artikel_ticker['tanggal_berita'])?></span>
                    </div>
                    <div class="clear"></div>
                </li>
                <?php } ?>
              </ul>
            </div>
            <hr>
            <div style='margin-top: -15px; padding: 0 10px 10px 5px;'>
              <a class="btn btn-sm btn-warning pull-right" style="padding: 0 15px; color: white; text-transform: none; font-size: 8pt;" href="<?= base_url().'berita/artikel/' ?>"><?= translate(17) ?>
              </a>
            </div>
          </div>
        </div>

        <div class="clear"></div>
      </article>

      <article class="one_third" style="min-height:420px;border: 0px solid;">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#berita_utama" aria-controls="berita_utama" role="tab" data-toggle="tab"><?= strtoupper(translate(14)) ?></a></li>
        </ul>

        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="berita_utama" style="margin-top:10px; ">
            <div id="comments">
              <ul>
                <?php
                if(empty($pengaduan)){
                ?>
                <li style="width:95%;background-color:#42a5f5;border-radius:3%;">
                  <article>
                    <header>
                      <address style="color:black">
                      <?php echo translate('tidak_ada_pengaduan',true);?>
                      </address>
                    </header>
                  </article>
                </li>                
                <?php
                }
                else{
                foreach ($pengaduan as $value) {
                ?>
                <li style="width:95%;background-color:#42a5f5;border-radius:3%;">
                  <article>
                    <header>
                      <figure class="avatar" style="border-radius:50%;"><img src="<?= base_url()."resources/frontend/images/user_foto.png" ?>" alt="" style="width:60px;"></figure>
                      <address style="color:black">
                      <?= '- '.ucwords($value['nama']); ?>
                      </address>
                      <time style="color:black"><?= translate(15) ?> : <?= $value['waktu_pengaduan'] ?></time>
                    </header>
                    <div class="comcont">
                      <p style="color:black"><?= substr($value['pengaduan'], 0, 30).'...'; ?></p>
                    </div>
                  </article>
                </li>
                <?php } } ?>
              </ul>
            </div>
          </div>
        </div>
      </article>
    </div>
  </main>
</div>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content">
      <article class="one_half first" style="min-height:175px;border: 0px solid;">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active">
            <a href="#berita_utama" aria-controls="berita_utama" role="tab" data-toggle="tab"><?= strtoupper(translate(18)) ?></a>
          </li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="berita_utama" style="margin-top:10px; ">
            <div class="row">
              <div class="col-sm-6">
                <i class="fa fa-user"></i>
                <span>Online</span>
              </div>
              <div class="col-sm-6">
                <!--pengunjung online-->
                <span><?= $pengunjung_on ?></span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <i class="fa fa-user"></i>
                <span><?= translate(19) ?></span>
              </div>
              <div class="col-sm-6">
                <!--hari ini-->
                <span><?= $pengunjung_hi ?></span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <i class="fa fa-user"></i>
                <span><?= translate(20) ?></span>
              </div>
              <div class="col-sm-6">
                <!--bulan ini-->
                <span><?= $pengunjung_bi ?></span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <i class="fa fa-user"></i>
                <span><?= translate(21)?></span>
              </div>
              <div class="col-sm-6">
                <!--tahun ini-->
                <span><?= $pengunjung_ti ?></span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <i class="fa fa-users"></i>
                <span>Total</span>
              </div>
              <div class="col-sm-6">
                <!--total pengunjung-->
                <span><?= $pengunjung_all ?></span>
              </div>
            </div>
          </div>
      </article>

      <article class="one_half" style="min-height:175px;border: 0px solid;">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active">
            <a href="#berita_utama" aria-controls="berita_utama" role="tab" data-toggle="tab"><?= strtoupper(translate(22)) ?></a>
          </li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="berita_utama" style="margin-top:10px; ">
            <?= translate(24) ?>
            <br>
            <?= translate(25) ?>
            <br>
            <?= translate(26) ?>
          </div>
        </div>
      </article>
    </div>
  </main>
</div>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content">
      <article class="one_third first" style="width:100%;min-height:100px;border: 0px solid;">

        <ul class="nav nav-tabs" role="tablist">
          <li role="slider_tautan" class="active">
            <a href="#slider_tautan" aria-controls="slider_tautan" role="tab" data-toggle="tab"><?= strtoupper(translate(27)) ?></a>
          </li>
        </ul>

        <div class="tab-content">
          <?php 

          $imgTautan     = 0;

          foreach ($list_layanan_publik as $key => $value) {
            $imgTautan++;

            $paddingKiri   = 5;
            $paddingKanan  = 5;
            $styleTambahan = "";

            if ($imgTautan == 1) {
              $paddingKiri   = 0;
              $styleTambahan = "padding-left:".$paddingKiri."; ";
              echo '<div class="row" style="padding:0 15px">';
            } else if ($imgTautan == 4) {
              $paddingKanan = 0;
              $styleTambahan = "padding-right:".$paddingKanan."; ";
            } 

            if (!empty($value['gambar'])) {
              echo  '<div class="col-xs-2" style="padding:5px; '.$styleTambahan.'" >
                        <a href="'.$value['link'].'" target="blank">
                          <img class="addhover1" src="'.base_url().'upload/tautan/'.$value['gambar'].'" style="margin-top: 5px; width: 234px;border: 1px solid grey; border-radius: 10px; background-color: #eeeeee;" />
                        </a>
                      </div>'; 
            } else {
              echo '<div class="col-xs-2" style="padding:5px; '.$styleTambahan.'" >
                      <img src="'.base_url().'resources/frontend/images/noimage.png" />
                    </div>';
            }

            if ($imgTautan == 6) {
              $imgTautan = 0;
              echo '</div>';
            }
        
          } 

          if($imgTautan < 4) {
            echo '</div>';
          }
          ?>

        </div>
      </article>
    </div>
  </main>
  <br>
</div>

<script type="text/javascript">
$(document).ready(function () {
  $("#kalender").zabuto_calendar({
    ajax: {
      url: '<?= site_url('home/show_data') ?>',
      modal: true
    },
    'language': '<?php echo $lang_code;?>'
  });
});
</script>