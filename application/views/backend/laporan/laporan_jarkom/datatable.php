<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<section class="content-header">
    <h1><?php echo $title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Filter</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <form id="form" name="form" method="post">
              <div class="form-group">
                <label>Tahun</label>
                <select class="select2 form-control" id="tahun" name="tahun" required>
                  <option value=""> - Pilih Tahun - </option>
                  <?php 
                  for ($i=date('Y')-3; $i < date('Y')+4 ; $i++) { 
                    $selected = $i==$_POST['tahun'] ? 'selected' : NULL;
                    ?>
                      <option value="<?php echo $i ?>" <?php echo $selected?>><?php echo $i?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Bulan</label>
                <select class="select2 form-control" id="bulan" name="bulan" required>
                  <option value=""> - Pilih Bulan - </option>
                  <?php
                  $list_bulan = $this->global_model->get_list('m_bulan');
                  foreach ( $list_bulan as $dt ) {
                    $selected = '';
                    if( isset( $_POST['bulan'] ) ) {
                      if ($dt->id_bulan == $_POST['bulan']) {
                        $selected = 'selected';
                      }
                    }
                  ?>
                  <option value="<?= $dt->id_bulan ?>" <?= $selected ?> ><?= $dt->nama ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" id="submit" name="submit" class="btn btn-warning">Proses</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                        <tr>
                            <th style="width: 20px;">No</th>
                            <th>Tanggal</th>
                            <th>IP</th>
                            <th>Browser (User Agent)</th>
                            <th>Hit</th>
                            <th>Online</th>
            
                            <th></th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
