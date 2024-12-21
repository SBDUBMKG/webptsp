<?php
//filepath:  application\views\v_katalog_layanan.php
?>
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <section class="content-header">
      <ol class="breadcrumb">
        <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
        <li><a href="<?= site_url() ?>"><i class="fa fa-dashboard"></i> <?= translate(37) ?></a></li> 
        Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->


        <!-- script awal yang diedit Rahmat 14 Oktober 2019 -->
        <li><a href="<?= base_url();?>"><?= translate(37);?></a></li>
        <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->

        <li class="active text-capitalize"><?= translate(1) ?></li>
      </ol>
    </section>

    <div class="content" style="min-height:700px"> 
      <h1><?= translate(1) ?></h1>
      <?= $this->session->flashdata('not_1') ?>
      <?= $this->session->flashdata('not_2') ?>
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
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><?= $detail_layanan['layanan'] ?></a></h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse in">
            <div class="panel-body">
              <div class="wrapper row3" style="padding: 15px 0;">
                <main class="hoc container clear" style="width:100%">
                  <div class="group center">
                    <?php if( count($child) > 0 ) { $i=0; foreach ($child as $key => $value) { ?>
                    <article class="one_quarter<?php if($i == 0 || $i % 4 == 0){ echo " first"; } ?>" style="margin-bottom:10px; border:solid 2px #42a5f5;padding:3px">
                      <?php if($value['is_produk'] == 1){ ?>
                      <a href="<?= site_url('katalog_pelayanan/detail_layanan/'.$value['id_layanan']) ?>">
                        <i class="icon" style="font-size: 0px;margin-bottom:20px">
                          <?php if (empty($value['icon'])) { ?>
                          <img src="<?= site_url('/resources/frontend/images/katalog.png') ?>" style="width:90px;">
                          <?php } else { ?>
                          <img src="<?= site_url('upload/icon/'.$value['icon']) ?>" style="width:90px;">
                          <?php } ?>
                        </i>
                      </a>
                      <div style="height:120px">
                        <h4 class="font-x1">
                          <a href="<?= site_url('katalog_pelayanan/detail_layanan/'.$value['id_layanan']) ?>"><?= strtoupper($value['layanan'.$bahasa]) ?></a>
                        </h4>
                      </div>
                      <form method="post" action="<?php echo base_url().'katalog_pelayanan/tambah_layanan/'.$value['id_layanan'] ?>">
                        <div class="col-md-6" style="padding-left:0px">
                          <input class="form-control" type="number" min="1" name="kuantitas_pesanan" placeholder="qty"/>
                        </div>
                        <button class="btn btn-sm btn-primary">
                          <small><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> <?= translate(82) ?></small>
                        </button>
                      </form>
                      <?php } else { ?>
                      <a href="<?= site_url('katalog_pelayanan/detail_layanan/'.$value['id_layanan']) ?>">
                        <i class="icon" style="font-size: 0">
                          <img src="<?= site_url('resources/frontend/images/katalog.png') ?>" style="width:70px">
                        </i>
                      </a>
                      <h4 class="font-x1">
                        <a href="<?= site_url('katalog_pelayanan/layanan/'.$value['id_layanan']) ?>"><?= strtoupper($value['layanan'.$bahasa]) ?></a>
                      </h4>
                      <?php } ?>
                    </article>
                    <?php
                    $i++;

// line 38 : mengubah margin-bottom:30px menjadi margin-bottom:20px. Perubahan dilakukan oleh : Nurhayati Rahayu (14/10/2019)					
// line 46 : mengubah height:76px menjadi height:120px. Perubahan dilakukan oleh : Nurhayati Rahayu (14/10/2019)

                    // if($i % 4 == 0) { echo "<hr>"; }
                      } // end foreach
                    } //  end if child
                    else {
                      echo "Belum ada data.";
                    }
                    ?>
                  </div>
                  <div class="clear"></div>
                </main>
              </div>
            </div>
          </div>
        </div>
      </div> 

    </div>
    <div class="clear"></div>
  </main>
</div>