<div class="col-lg-8 col-md-8 col-sm-8">
  <?php  
  $CI = &get_instance();
  $list_bidang = $CI->global_model->get_list_array('tbl_bidang');
  foreach($list_bidang as $key => $value){
    $id_bidang = $value['id_bidang'];
    $list = $this->kegiatan_model->list_kegiatan_perbidang($id_bidang);
    if(!empty($list)){
  ?>
  <div class="single_post_content" style="margin-bottom:0px;">
    <h2><span><?php echo 'Bidang '.$value['bidang'];?></span></h2>
    <ul class="photograph_nav  wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
  <?php
    }
    foreach($list as $keys => $values){
  ?>
  <li>
    <div class="photo_grid">
      <figure class="effect-layla"> <a class="fancybox-buttons" data-fancybox-group="button" href="<?php echo base_url()."upload/kegiatan/".$values['bidang']."/".$values['nama'];?>" title="<?php echo $values['judul'.$bahasa];?>"> <img src="<?php echo base_url()."upload/kegiatan/".$values['bidang']."/".$values['nama'];?>" alt=""></a> </figure>
    </div>
  </li>
  <?php    
    }
    if(!empty($list)){    
  ?>
    </ul>  
  </div>
  <?php
  }
  }
  ?>
</div>