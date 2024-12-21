<div class="col-lg-8 col-md-8 col-sm-8">
  <div class="single_post_content" style="margin-bottom:0px;">
    <h2><span>Galeri Foto</span></h2>
    <ul class="photograph_nav  wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
  <?php foreach($list_foto as $keys => $value){ ?>
      <li>
        <div class="photo_grid">
          <center><b><font size="2px"><?php echo $value['judul'.$bahasa];?></font></b></center>
          <figure class="effect-layla" style="margin:2px 1%;">
            <a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo base_url()."galeri/galeri_foto/detil_kegiatan/".$value['id_kegiatan'];?>" title="<?php echo $value['judul'.$bahasa];?>">
              <img src="<?php echo base_url()."upload/kegiatan/".$value['nama'];?>" alt="">
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