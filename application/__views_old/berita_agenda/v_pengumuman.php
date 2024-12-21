<div class="col-lg-8 col-md-8 col-sm-8">
  <div class="single_post_content">
    <h2><span><?php echo strtoupper(translate(24));?></span></h2>
    <?php $i=0; foreach($list_pengumuman as $key => $value){ $i++; ?>
    <div class="single_post_content_right" style="float:left;width:100%">
      <ul class="spost_nav">
        <li>
          <div class="media wow fadeInDown" style="width:100%">
            <div class="media-body" style="width:100%">
              <a href="<?php echo base_url().'berita_agenda/pengumuman/detil_pengumuman/'.$value['id_pengumuman'];?>" class="catg_title" style="font-size:15px;"> <?php echo $value['judul'.$bahasa];?></a>
              <br> 
              <?php echo substr($value['created_date'],0,10);?>
              <hr style="margin-top:5px;margin-bottom:5px;">
            </div>
          </div>
        </li>
      </ul>
    </div>
    <?php } ?>
  </div>

  <div class="center">
      <div class="pagination"><?php echo $links;?></div>
  </div>
</div>