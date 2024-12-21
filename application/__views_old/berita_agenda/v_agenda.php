<div class="col-lg-8 col-md-8 col-sm-8">
  <div class="single_post_content">
    <h2><span>Agenda</span></h2>
    <?php 
    if(empty($list_agenda)){
    ?>
    <center><font size="3pt"><b>Belum ada agenda.</b></font></center>
    <?php
    }else{
    ?>
    <?php $i=0; foreach($list_agenda as $key => $value){ $i++; ?>
    <div class="single_post_content_right" style="float:left;width:100%">
      <ul class="spost_nav">
        <li>
          <div class="media wow fadeInDown" style="width:100%">
            <div class="media-body" style="width:100%">
              <a href="<?php echo base_url().'berita_agenda/agenda/detil_agenda/'.$value['id_agenda'];?>" class="catg_title" style="font-size:15px;"> <?php echo $value['judul'.$bahasa];?></a>
              <hr style="margin-top:5px;margin-bottom:5px;">
              <p style="font-size:15px;">
                Date : <?php echo $value['tgl_mulai'];?>
                <br>
                Time : <?php echo $value['jam'];?>
                <br>
                Location : <?php echo $value['lokasi'.$bahasa];?>
              </p> 
            </div>
          </div>
        </li>
      </ul>
    </div>
    <?php } ?>
    <?php } ?>
  </div>

  <div class="center">
      <div class="pagination"><?php echo $links;?></div>
  </div>
</div>