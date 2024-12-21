<div class="col-lg-8 col-md-8 col-sm-8">
  <div class="single_sidebar">
    <div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-info"></i> &nbsp; <?php echo $bahasa == '' ? 'Hasil pencarian untuk : "'.$pencarian.'"' : 'Search reslt for : "'.$pencarian.'"';?></h4>
    </div>
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#kegiatan" aria-controls="kegiatan" role="tab" data-toggle="tab" aria-expanded="false"><?php echo $bahasa=='' ? 'Kegiatan' : 'Activity'?></a></li>
      <li role="presentation" class=""><a href="#artikel" aria-controls="artikel" role="tab" data-toggle="tab" aria-expanded="false"><?php echo $bahasa=='' ? 'Artikel' : 'Article'?></a></li>
      <li role="presentation" class=""><a href="#agenda" aria-controls="agenda" role="tab" data-toggle="tab" aria-expanded="true">Agenda</a></li>
    </ul>
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="kegiatan">
        <?php if(!empty($kegiatan)){ ?>
        <ul class="spost_nav">
          <?php foreach ($kegiatan as $key => $value) { ?>
          <li>
            <div class="media wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
              <div class="media-body"> <a href="<?php echo base_url().'galeri/detil_kegiatan/'.$value['id_kegiatan']?>" class="catg_title"> <?php echo $value['judul'.$bahasa];?></a> </div>
            </div>
          </li>
          <?php } ?>
        </ul>
        <?php } else { echo $bahasa=='' ? '<h4 style="text-align:center"><b>Kegiatan tidak ditemukan</b></h4>' : '<h4 style="text-align:center"><b>Activity not found</b></h4>';}?>
      </div>
      <div role="tabpanel" class="tab-pane" id="artikel">
        <?php if(!empty($artikel)){ ?>
        <ul class="spost_nav">
          <?php foreach ($artikel as $key => $value) { ?>
          <li>
            <div class="media wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
              <div class="media-body"> <a href="<?php echo base_url().'/berita_agenda/berita/detil_berita/'.$value['id']?>" class="catg_title"> <?php echo $value['judul'.$bahasa];?></a> </div>
            </div>
          </li>
          <?php } ?>
        </ul>
        <?php } else { echo $bahasa=='' ? '<h4 style="text-align:center"><b>Artikel tidak ditemukan</b></h4>' : '<h4 style="text-align:center"><b>Article not found</b></h4>';}?>
      </div>
      <div role="tabpanel" class="tab-pane" id="agenda">
        <?php if(!empty($agenda)){ ?>
        <ul class="spost_nav">
          <?php foreach ($agenda as $key => $value) { ?>
          <li>
            <div class="media wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
              <div class="media-body"> <a href="<?php echo base_url().'berita_agenda/agenda/detil_agenda/'.$value['id_agenda']?>" class="catg_title"> <?php echo $value['judul'.$bahasa];?></a> </div>
            </div>
          </li>
          <?php } ?>
        </ul>
        <?php } else { echo $bahasa=='' ? '<h4 style="text-align:center"><b>Agenda tidak ditemukan</b></h4>' : '<h4 style="text-align:center"><b>Agenda not found</b></h4>';}?>
      </div>
    </div>
  </div>
</div>