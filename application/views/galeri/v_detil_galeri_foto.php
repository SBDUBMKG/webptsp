<div class="col-lg-8 col-md-8 col-sm-8">
  <div class="single_post_content" style="margin-bottom:0px;">
    <?php
      foreach($kegiatan as $key => $value){
    ?>
    <p><center><b><?php echo $value['keterangan'.$bahasa];?></b></center></p>
    <?php } ?>
    <ul class="photograph_nav  wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
      <?php
        foreach($detil_kegiatan as $key => $value){
      ?>
      <li>
        <div class="photo_grid">
          <figure class="effect-layla"> <a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo base_url()."upload/kegiatan/".$value['nama'];?>" title="<?php echo $value['judul'.$bahasa];?>"> <img src="<?php echo base_url()."upload/kegiatan/".$value['nama'];?>" alt=""></a> </figure>
        </div>
      </li>
      <?php    
        }
      ?>
    </ul>  
  </div>
</div>