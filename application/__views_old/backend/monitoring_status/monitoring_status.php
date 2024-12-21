<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Monitoring Status Pemohonan Pelayanan <small>Data / Informasi / Layanan</small></h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url('backend') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?= $title ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- filter -->
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Pencarian</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <?php if (!empty($errMsg)) { ?><div class="alert alert-danger" role="alert"><?= $errMsg ?></div><?php } ?> 
          <form method="post" action="">
            <div class="form-group">
              <label>No Invoice Pelayanan</label>
              <div class="input-group">
                <input type="text" id="no_permohonan" name="no_permohonan" class="form-control" placeholder="Masukan Nomor Invoice" required />
                <span class="input-group-btn" id="basic-addon2">
                  <button type="submit" id="submit" name="submit" class="btn btn-warning " id="basic-addon2">Cari</button>
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php if( !empty($permohonan) && !empty($detail_akun) && !empty($detail_permohonan)) { ?>
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Status Permohonan Anda:</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td>Nama</td>
                <td>: <?= $detail_akun->nama ?></td>
              </tr>
              <tr>
                <td>No HP</td>
                <td>: <?= $detail_akun->no_hp ?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>: <?= $detail_akun->alamat ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-6">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td>No Invoice</td>
                <td>: <?= $permohonan->no_permohonan ?></td>
              </tr>
              <tr>
                <td>Tanggal</td>
                <td>: <?= $permohonan->tanggal_permohonan ?></td>
              </tr>
              <tr>
                <td>Status</td>
                <td>: <?= status($permohonan->status, $this->session->userdata('id_role')) ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-6">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered table-striped">
            <colgroup>
            </colgroup>
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Layanan</th>
                <th class="text-center">Biaya</th>
                <th class="text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              $total_harga = 0;
              foreach ($detail_permohonan as $key => $value) { 
              ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $this->db->get_where('m_layanan', ['id_layanan' => $value->id_layanan ] )->row('layanan') ?></td>
                <td class="text-right"><?= number_format($value->harga, 2, ",", ".") ?></td>
                <td><?= $value->status ?></td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td class="text-center text-bold" colspan="2">Total Harga</td>
                <td class="text-center text-bold" colspan="2"><?= number_format($permohonan->total_harga, 2, ",", ".") ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

<!--       <div class="row">
        <div class="col-md-12">
          <p>Kepada Yth Pelanggan,</p>
          <p>Permohonan Anda belum dapat diunduh karena salah satu permohonan Anda belum selesai, mohon bersabar hingga tanggal penyelesaian yang disepkati tiba,</p>
          <p>Untuk dapat mengunduh hasil permohonan Data/informasi, mohon mengisi terlebih dahulu index kepuasan masyarakat (IKM) PTSP BMKG</p>
          <p>Atas kerjasamanya kami sampaikan terima kasih</p>
          <p>Hormat Kami,</p>
          <p>PTSP MBKG</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="text-center" style="border: 2px solid;padding: 10px">
            <p>Survey Index Kepuasan Masyarakat (IKM) PTSM BMKG</p>
            <br>
            <button class="btn btn-warning">Isi Survey</button>
          </div>
        </div>
      </div> -->

    </div>
  </div>
  <?php } ?>
</section>
