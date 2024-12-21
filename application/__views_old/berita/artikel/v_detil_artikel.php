<style>
.jssocials-share-link { border-radius: 50%; }
</style>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content"> 
      <ol class="breadcrumb">
        <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
        <li><a href="<?php echo base_url();?>">Home</a></li> 
        Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->
        
        <!-- script awal diedit Rahmat 14 Oktober 2019 -->
        <li><a href="<?php echo base_url();?>"><?php echo translate(37);?></a></li>
        <!-- script akhir diedit Rahmat 14 Oktober 2019 -->
        
        <li class="active"><?php echo $title ?></li>
      </ol>
      <h1><?php echo $detil['judul'.$bahasa];?></h1>
      <time datetime="2045-04-06T08:15+00:00"><?php echo format_datetime($detil['tanggal_berita']);?></time>   
      <p><?php echo $detil['isi'.$bahasa];?></p>
      <p class="pull-left" id="share"></p>
      <b class="pull-right"><?php echo $bahasa == '' ? 'sumber: '.$detil['sumber'] : 'source: '.$detil['sumber'];?></b>
    </div>
  </main>
</div>
