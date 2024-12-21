<div class="wrapper row3">
  <section class="hoc container clear"> 
    <div class="left_content">
      <div class="single_post_content">
        <?php 
          echo $bahasa == '_en' ? '<h2><span>Opening Speech</span></h2>' : '<h2><span>Kata Sambutan</span></h2>';
        ?>
      </div>
    </div>
    <div class="left_content">
      <div class="single_page">
        <div class="post_commentbox"> <a href="#"><i class="fa fa-user"></i><?php echo setting_content(5);?> - <?php echo $bahasa=='' ? 'Kepala dinas perumahan, kawasan permukiman dan pertanahan' : 'Head of the housing office, settlement and land area' ?></a></div>
        <div class="single_page_content"> 
          <img class="img-center" src="<?php echo base_url().'resources/frontend/images/dirjen.jpg'?>" alt="<?php echo setting_content(5) ?>">
          <p style="text-align:center"><?php echo $bahasa=='' ? 'Nama' : 'Name' ?>: <?php echo setting_content(5);?></p>
          <p style="text-align:center"><?php echo $bahasa=='' ? 'Jabatan' : 'Position' ?>: <?php echo setting_content(6);?></p>
          <!-- <p style="text-align:center">NIP: <?php echo setting_content(7);?></p> -->
          <p style="text-align:justify"><?php echo translate(13);?></p>
        </div>
      </div>
    </div>
  </section>
</div>