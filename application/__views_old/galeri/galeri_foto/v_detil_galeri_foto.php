<?php
// var_dump($kegiatan['judul']);exit();
?>
<div class="wrapper row3">
  <main class="hoc container clear">
    <div class="content"> 
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li><a href="<?php echo base_url().'galeri/galeri_foto';?>">Galeri Foto</a></li>
        <?php foreach($kegiatan as $key => $value){ ?>
        <li class="active"><?php echo $value['judul']; ?></li>
        <?php
        }
        ?>
      </ol>
      <div id="gallery">
        <figure>
          <?php foreach($kegiatan as $key => $value){ ?>
          <h1><?php echo $value['judul']; ?></h1>
          <p class="text-bold"><?php echo ucfirst(strtolower($value['keterangan'.$bahasa]));?></p>
          <?php } ?>
        </figure>
      </div>
    </div>
    <div class="clear"></div>
  </main>
</div>

<div class="gambar-slider wrapper row3">
  <section class="hoc container clear"> 
    <div id="slider_carousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <?php
        $i_slider=0;
        foreach($detil_kegiatan as $key => $value){
          $i_slider++;
          $active_slider = $i_slider == 1 ? 'class="Active"' : NULL;
        ?>
        <li data-target="#slider_carousel" data-slide-to="0" <?php echo $active_slider;?>></li>
        <?php
        }
        ?>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <?php 
        $i_slider=0;
        foreach($detil_kegiatan as $key => $value){
          $i_slider++;
          $active_slider = $i_slider == 1 ? 'active' : NULL;
        ?>
        <div class="item <?php echo $active_slider?>" style="max-height: 400px">
          <img src="<?php echo base_url().'upload/kegiatan/'.$value['nama']?>" alt="" style="width:100%;">
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
<br>
