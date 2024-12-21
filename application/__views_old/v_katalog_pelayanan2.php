<div class="wrapper row3">
  <main class="hoc container clear"> 
    <section class="content-header">
      <ol class="breadcrumb">
        <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> <?php echo translate(37);?></a></li> 
        Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->

        <!-- script awal yang diedit Rahmat 14 Oktober 2019 -->
        <li><a href="<?= base_url();?>"><?= translate(37);?></a></li>
        <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->
        
        <li class="active"><?php echo translate(1);?></li>
      </ol>
    </section>

    <div class="content"> 
      <h1>Katalog Pelayanan</h1>
      <?= $list_katalog_pelayanan ?>
    </div>
    <div class="clear"></div>
  </main>
</div>