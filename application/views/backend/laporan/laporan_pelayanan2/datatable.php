<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit','512M');
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
                <label>Jenis Layanan</label>
                <select class="select2 form-control" id="jenis_layanan" name="jenis_layanan" required>
                  <option value=""> - Pilih Jenis Layanan - </option>
                  <?php
                  $list_jenis_layanan = $this->global_model->get_list('m_jenis_layanan');
                  foreach ( $list_jenis_layanan as $dt ) {
                    $selected = '';
                    if( isset( $_POST['jenis_layanan'] ) ) {
                      if ($dt->id_jenis_layanan == $_POST['jenis_layanan']) {
                        $selected = 'selected';
                      }
                    }
                  ?>
                  <option value="<?= $dt->id_jenis_layanan ?>" <?= $selected ?> ><?= $dt->jenis_layanan ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Tahun</label>
                <select class="select2 form-control" id="tahun" name="tahun" required>
                  <option value=""> - Pilih Tahun - </option>
                  <?php
                  for ($i=date('Y')-5; $i < date('Y')+10 ; $i++) {
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
                  <option value="all" <?= isset($_POST['bulan']) && $_POST['bulan'] === 'all' ? 'selected' : '' ?>> Semua </option>
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

              <!-- Baris awal penambahan filter status. Perubahan oleh Nurhayati Rahayu (06/06/2024) -->
              <div class="form-group">
                <label>Status Permohonan</label>
                <select class="select2 form-control" id="status" name="status" required>
                  <option value=""> - Pilih Status Permohonan - </option>
                  <option value="all" <?= isset($_POST['status']) && $_POST['status'] === 'all' ? 'selected' : '' ?>> Semua </option>
                  <?php
                  $list_status = $this->global_model->get_list('m_status');
                  foreach ( $list_status as $dt ) {
                    $selected = '';
                    if( isset( $_POST['status'] ) ) {
                      if ($dt->status == $_POST['status']) {
                        $selected = 'selected';
                      }
                    }
                  ?>
                  <option value="<?= $dt->status ?>" <?= $selected ?> ><?= $dt->status ?></option>
                  <?php } ?>
                </select>
              </div>

              <!-- Baris akhir penambahan filter status. Perubahan oleh Nurhayati Rahayu (06/06/2024) -->
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
                            <th>Tanggal Permohonan</th>
                            <th>No Permohonan</th>
                            <th>Tanggal Surat Keluar</th>
                            <th>No Surat Keluar</th>
                            <th>Nama Pelanggan</th>
                            <th>Perusahaan</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Jenis Layanan</th>
                            <th>Layanan</th>
                            <th>Tarif PNBP</th>
                            <th>Jumlah</th>
                            <th>Total Tarif PNBP</th>
                            <th>Status Data</th>
                            <th>Status Transaksi</th>
                            <th>Petugas Konfirmasi</th>
                            <th>Petugas Verifikasi</th>
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
