<div class="col-lg-8 col-md-8 col-sm-8">
  <div class="single_page">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>">Home</a></li>
      <li class="active">Agenda</li>
    </ol>

    <h1><?php echo $detil_agenda['judul'.$bahasa];?></h1>

    <div class="post_commentbox">
      <a href="#">
        <i class="fa fa-user"></i>Admin
      </a>
      <span><i class="fa fa-calendar"></i><?php echo substr($detil_agenda['tgl_mulai'],0,10);?></span>
      <a href="#"><i class="fa fa-tags"></i>Agenda</a>
    </div>
    
    <div class="single_page_content">
      <?php if($bahasa == ''){ ?>
      <p style="font-size:15px;">
        Penyelenggara : <?php echo $detil_agenda['penyelenggara'.$bahasa];?>
        <br>
        Lokasi : <?php echo $detil_agenda['lokasi'.$bahasa];?>
        <br>
        Tanggal Mulai : <?php echo substr($detil_agenda['tgl_mulai'],0,10);?>
        <br>
        Tanggal Selesai : <?php echo substr($detil_agenda['tgl_selesai'],0,10);?>
        <br>
        Jam : <?php echo $detil_agenda['jam'];?>
        <br>
        Disposisi : <?php echo $detil_agenda['disposisi'];?>
        <br>
        Dihadiri : <?php echo $detil_agenda['dihadiri'];?>
        <br>
        Keterangan : <?php echo $detil_agenda['keterangan'.$bahasa];?>
        <br>
        <?php
          $foto = $detil_agenda['foto'];
          if(!empty($foto)){
        ?>
        Foto : <?php echo $detil_agenda['foto'];?>
        <br>
        <?php } ?>
      </p>
      <?php }else{ ?>
      <p style="font-size:15px;">
        Organizer : <?php echo $detil_agenda['penyelenggara'.$bahasa];?>
        <br>
        Location  : <?php echo $detil_agenda['lokasi'.$bahasa];?>
        <br>
        Date Start : <?php echo substr($detil_agenda['tgl_mulai'],0,10);?>
        <br>
        Date End : <?php echo substr($detil_agenda['tgl_selesai'],0,10);?>
        <br>
        Time  : <?php echo $detil_agenda['jam'];?>
        <br>
        Disposition : <?php echo $detil_agenda['disposisi'];?>
        <br>
        Attended  : <?php echo $detil_agenda['dihadiri'];?>
        <br>
        Information  : <?php echo $detil_agenda['keterangan'.$bahasa];?>
        <br>
        <?php
          $foto = $detil_agenda['foto'];
          if(!empty($foto)){
        ?>
        Photo : <?php echo $detil_agenda['foto'];?>
        <br>
        <?php } ?>
      </p>
      <?php } ?>
    </div>

    <!--
    <div class="social_link">
      <ul class="sociallink_nav">
        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
      </ul>
    </div>
    -->
   
    <!-- 
    <div class="related_post">
      <h2>Related Post <i class="fa fa-thumbs-o-up"></i></h2>
      <ul class="spost_nav wow fadeInDown animated">
        <li>
          <div class="media"> <a class="media-left" href="<?php echo base_url('single_page');?>"> <img src="<?php echo base_url();?>resources/frontend/images/berita2.jpg" alt=""> </a>
            <div class="media-body"> <a class="catg_title" href="<?php echo base_url('single_page');?>"> Sambang Kamtibmas Ke Puskesmas, Cara Polsek Cipondoh Lebih Dekat Dengan Masyarakat</a> </div>
          </div>
        </li>
        <li>
          <div class="media"> <a class="media-left" href="<?php echo base_url('single_page');?>"> <img src="<?php echo base_url();?>resources/frontend/images/berita3.jpg" alt=""> </a>
            <div class="media-body"> <a class="catg_title" href="<?php echo base_url('single_page');?>"> Polsek Cipondoh, Kumpul Bersama Warga Binaannya Sambil Membahas Keamanan Lingkungan</a> </div>
          </div>
        </li>
        <li>
          <div class="media"> <a class="media-left" href="<?php echo base_url('single_page');?>"> <img src="<?php echo base_url();?>resources/frontend/images/berita4.jpg" alt=""> </a>
            <div class="media-body"> <a class="catg_title" href="<?php echo base_url('single_page');?>"> Menjaga Komunikasi Kamtibmas, Polsek Cipondoh Lakukan Kunjungan Ke Tokoh Masyarakat</a> </div>
          </div>
        </li>
      </ul>
    </div>
    -->

  </div>
</div>
