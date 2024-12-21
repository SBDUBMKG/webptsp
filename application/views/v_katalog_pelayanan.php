<div class="wrapper row3">
  <main class="hoc container clear">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="<?= site_url() ?>"><i class="fa fa-dashboard"></i> <?= translate(37) ?></a></li>
        <li class="fw-bold"><?= translate(1) ?></li>
      </ol>
    </section>

    <div class="content" style="min-height:700px">
      <h1><?= translate(1) ?></h1>
      <button type="button" class="btn btn-sm btn-flat btn-primary" onclick="history.go(-1);return false;">
        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
      </button>
      <a class="btn btn-sm btn-flat btn-success" href="<?= site_url('katalog_pelayanan/proses_pesanan') ?>">
        <i class="fa fa-fw fa-lg fa-shopping-basket"></i> <?= translate(80) ?> <span class="badge"><?= $this->cart->total_items() ?></span>
      </a>
      <a class="btn btn-sm btn-flat btn-danger" href="<?= site_url('katalog_pelayanan/hapus_pesanan') ?>"   onclick="if(!confirm('<?php echo translate(93);?>')) return false;">
        <i class="fa fa-fw fa-lg fa-trash-o"></i>
      </a>
      <hr>
      <div class="panel-group" id="accordion">
        <?php foreach ($jenis_layanan as $jl) { ?>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $jl['id_jenis_layanan']?>"><?= translate($jl['jenis_layanan'],true);?></a>
            </h4>
          </div>
          <div id="collapse<?= $jl['id_jenis_layanan']?>" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="wrapper row3" style="padding: 15px 0;">
                  <main class="hoc container clear" style="width:100%">
                      <div class="group center">
                        <?php
                        $con = 'id_jenis_layanan = '.$jl['id_jenis_layanan'].' AND id_parent = 0';
                        $child = $this->global_model->get_list_array('m_layanan', $con);
                        if(count($child) > 0){
                          $i=1;
                          foreach ($child as $key => $value) {
                        ?>
                        <article class="one_quarter<?php if($i == 1 || $i % 5 == 0){echo " first";}?>" style="margin-bottom:10px;">
                          <a href="<?= site_url('katalog_pelayanan/layanan/'.$value['id_layanan']) ?>">
                            <i class="icon" style="font-size: 0px;">
                              <?php if (empty($value['icon'])) { ?>
                              <img src="<?= site_url('/resources/frontend/images/katalog.png') ?>" style="width:90px;">
                              <?php } else { ?>
                              <img src="<?= site_url('upload/icon/'.$value['icon']) ?>" style="width:90px;">
                              <?php } ?>
                            </i>
                          </a>
                          <h4 class="font-x1">
                            <a href="<?= site_url('katalog_pelayanan/layanan/'.$value['id_layanan'])?>">
                              <?= strtoupper($value['layanan'.$bahasa]);?>
                            </a>
                          </h4>
                        </article>
                        <?php
                          if($i % 4 == 0) {
                            echo "<hr>";
                          }
                          $i++;
                          }
                        }
                        else{
                          echo "Belum Ada Layanan Tersedia.";
                        }
                        ?>
                      </div>
                      <div class="clear"></div>
                  </main>
              </div>

            </div>
          </div>
        </div>
        <?php } ?>
      </div>

    </div>
    <div class="clear"></div>
  </main>
</div>
