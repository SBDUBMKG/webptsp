<div class="wrapper row3">
    <section class="hoc container clear"> 
    <div class="left_content">
        <div class="single_post_content">
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <ol class="breadcrumb">
                <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
                <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo translate(37);?></a></li> 
                Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->


                <!-- script awal yang diedit Rahmat 14 Oktober 2019 -->
                <li><a href="<?= base_url(); ?>"><?= translate(37);?></a></li>
                <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->

                <li class="active"><?php echo translate(42);?></li>
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">
              <!-- filter -->
              <div class="box box-default">
                <h1 align="center"><?php echo translate(42);?></h1>
                <hr>
                <!--
                <div class="box-body" style="margin: 11% 0 11% 0;">
                -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <a href="<?= site_url('registrasi/registrasi_perorangan') ?>">
                        <div class="alert alert-info" style="color:#5E5E5E;background-color: #8DD5D6;border-color: #03A1A3;text-align: center; height:220px;">
                          <img src="<?= site_url('resources/frontend/images/r_orang.png') ?>" style="height:150px;">
                          <br>
                          <?= translate(43);?>
                        </div>
                      </a>
                    </div>
                    <div class="col-md-6">
                      <a href="<?= site_url('registrasi/registrasi_perusahaan') ?>">
                        <div class="alert alert-info" style="color:#5E5E5E;background-color: #8DD5D6;border-color: #03A1A3;text-align: center; height:220px;">
                          <img src="<?= site_url('resources/frontend/images/r_perusahaan.png') ?>" style="height:150px;">
                          <br>
                          <?= translate(44);?>
                        </div>
                      <!-- </a> -->
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
      </div>
    </div>
  </section>
</div>
