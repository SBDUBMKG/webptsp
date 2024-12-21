<style>
.jssocials-share-link { border-radius: 50%; }
</style>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content"> 
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li class="active"><?php echo $title ?></li>
      </ol>
      <h1><span><?php echo strtoupper(translate(20));?></span></h1>
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#vision" aria-controls="home" role="tab" data-toggle="tab"><?php echo isset($bahasa) ? 'Vision' : 'Visi'?></a></li>
        <li role="presentation"><a href="#mission" aria-controls="profile" role="tab" data-toggle="tab"><?php echo isset($bahasa) ? 'Mission' : 'Misi'?></a></li>
      </ul>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="vision">
          <?php 
          $visi = $this->global_model->get_by_id_array('tbl_visimisi_tupoksi','id_jenis',1);
          echo $visi['value'.$bahasa];
          ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="mission">
          <?php 
          $misi = $this->global_model->get_by_id_array('tbl_visimisi_tupoksi','id_jenis',2);
          echo $misi['value'.$bahasa];
          ?>
        </div>
      </div>
    </div>
  </main>
</div>