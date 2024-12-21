<style>
.jssocials-share-link { border-radius: 50%; }
</style>

<div class="wrapper row3" style="min-height:750px">
  <main class="hoc container clear"> 
    <div class="content"> 
      <ol class="breadcrumb">
        <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
        <li><a href="<?php echo base_url();?>">Home</a></li> 
        Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->

        

        <!-- script awal di edit Rahmat tgl 14 Mei 2019 -->
        <li><a href="<?php echo base_url();?>"><?php echo translate(37);?></a></li>
        <!-- script akhir di edit Rahmat tgl 14 Mei 2019 -->

        <li class="active"><?php echo $title ?></li>
      </ol>
      <h1><?php echo $detil_berita['judul'.$bahasa];?></h1>
      <i class="fa fa-calendar" aria-hidden="true"></i>
      <time datetime="2045-04-06T08:15+00:00"><?php echo format_datetime($detil_berita['tanggal_berita']);?></time>  
      <hr style="border: 1px solid grey"> 
      <p><?php echo $detil_berita['isi'.$bahasa];?></p>
      <p class="pull-right" id="share"></p>
      <!-- <b class="pull-left"><?php echo $bahasa == '' ? 'sumber: '.$detil_berita['sumber'] : 'source: '.$detil_berita['sumber'];?></b> -->
    </div>
  </main>
</div>

<!-- line 27 : menghilangkan kolom sumber
	perubahan dilakukan oleh : Nurhayati Rahayu (22/10/2019)	
-->