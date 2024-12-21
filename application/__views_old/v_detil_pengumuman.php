<div class="col-lg-8 col-md-8 col-sm-8">
  <div class="single_page">
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>">Home</a></li>
      <li class="active">Pengumuman</li>
    </ol>

    <h1><?php echo $detil_pengumuman['judul'.$bahasa];?></h1>

    <div class="post_commentbox">
      <a href="#">
        <i class="fa fa-user"></i>Admin
      </a>
      <span><i class="fa fa-calendar"></i><?php echo substr($detil_pengumuman['created_date'],0,10);?></span>
      <a href="#"><i class="fa fa-tags"></i>Pengumuman</a>
    </div>
    
    <div class="single_page_content">
      <p><?php echo $detil_pengumuman['isi'.$bahasa];?></p>
    </div>

    <?php
    $gambar = $detil_pengumuman['gambar'];
    if(!empty($gambar)){
    ?>
    <div class="single_page_content">
      <center><img src="<?php echo base_url().'upload/pengumuman/'.$gambar;?>" width="100%"></center>
    </div>
    <?php } ?>

    <?php
    $file = $detil_pengumuman['file'];
    if(!empty($file)){
    ?>
    <div class="single_page_content">
        <table class="table table-striped">
          <thead>
            <th>File Lampiran</th>
            <th style="text-align:center">Download</th>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $detil_pengumuman['judul'.$bahasa];?></td>
              <td style="text-align:center"><a href="<?php echo base_url().'upload/pengumuman/'.$file;?>" target="blank" title="download"><i class="fa fa-download"></i></a></td>
            </tr>
          </tbody>
        </table>
    </div>
    <?php } ?>

    <!--
    <div class="social_link">
      <ul class="sociallink_nav">
        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
      </ul>
    </div>
    -->
  </div>
</div>