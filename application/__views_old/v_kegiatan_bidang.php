<div class="col-lg-8 col-md-8 col-sm-8">
  <div class="single_post_content" style="margin-bottom:0px;">
    <?php
      foreach($kegiatan as $key => $value){
    ?>
    <?php echo $bahasa == '_en' ? '<h2><span>'.$value['bidang'.$bahasa].' Activity</span></h2>' : '<h2><span>Aktivitas Bidang '.$value['bidang'.$bahasa].'</span></h2>'; ?>
    <?php } ?>
    <ul class="photograph_nav  wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
      <?php
        foreach($list_kegiatan as $key => $value){
      ?>
      <li>
        <div class="photo_grid">
          <center><b><font size="2px"><?php echo substr($value['keterangan'.$bahasa], 0, 27).'...';?></font></b></center>
          <figure class="effect-layla" style="margin:2px 1%;">
            <a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo base_url()."galeri/detil_kegiatan/".$value['id_kegiatan'];?>" title="<?php echo $value['judul'.$bahasa];?>">
              <img src="<?php echo base_url()."upload/kegiatan/".$value['bidang']."/".$value['nama'];?>" alt="">
            </a>
          </figure>
        </div>
      </li>
      <?php    
        }
      ?>
    </ul>  
  </div>
</div>