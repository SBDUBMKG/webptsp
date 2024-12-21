<style>
.jssocials-share-link { border-radius: 50%; }
</style>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content"> 
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li class="active"><?php echo $title ?></li>
      </ol>
      <h1><?php echo $detil_press_release['judul'.$bahasa];?></h1>
      <time datetime="2045-04-06T08:15+00:00"><?php echo format_datetime($detil_press_release['tanggal_berita']);?></time>   
      <p><?php echo $detil_press_release['isi'.$bahasa];?></p>
      <p class="pull-left" id="share"></p>
      <b class="pull-right"><?php echo $bahasa == '' ? 'sumber: '.$detil_press_release['sumber'] : 'source: '.$detil_press_release['sumber'];?></b>
    </div>
  </main>
</div>
