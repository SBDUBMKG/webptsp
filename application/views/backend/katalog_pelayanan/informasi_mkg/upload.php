<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<section class="content-header">
  <h1><?= $page_title ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url() ?>">Home</a></li>
    <li><a href="<?= site_url($this->module) ?>"><?= $page_title ?></a></li>
    <li class="active"><?= $title ?></li>
  </ol>
</section>


<section class="content">

  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><strong>DATA PERMOHONAN</strong></h3>
        </div>
        <div class="box-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td>No Permohonan</td>
                <td style="width: 10px">:</td>
                <td><?= empty($detail->no_permohonan) ? '-' : $detail->no_permohonan; ?></td>
              </tr>
              <tr>
                <td>Tanggal Permohonan</td>
                <td style="width: 10px">:</td>
                <!--Awal baris menghilangkan format tanggal (Nurhayati Rahayu 07/11/2022)-->
                <!--<td><?= empty($detail->tanggal_permohonan) ? '-' : format_datetime($detail->tanggal_permohonan); ?></td>-->
                <td><?= empty($detail->tanggal_permohonan) ? '-' : $detail->tanggal_permohonan; ?></td>
                <!--Akhir baris menghilangkan format tanggal (Nurhayati Rahayu 07/11/2022)-->
              </tr>
              <tr>
                <td>Jumlah Pembayaran</td>
                <td style="width: 10px">:</td>
                <td><?= empty($detail->total_harga) ? '-' : number_format($detail->total_harga, 0 , '' , '.' ) ?></td>
              </tr>
              <tr>
                <td>Status</td>
                <td style="width: 10px">:</td>
                <td><?= status($detail->status, $this->session->userdata('id_role')) ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!--upload bukti pembayaran-->
  <div class="row">
    <div class="col-xs-12">
    	<?php if (!empty($scsMsg)) { ?><div class="alert alert-success" role="alert"><?= $scsMsg ?></div>
      <?php }  if (!empty($errMsg)) { ?><div class="alert alert-danger" role="alert"><?= $errMsg ?></div><?php } ?> 
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Upload Bukti Pembayaraan</h3>
        </div>

         <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
          <?php if (!empty($detail->feedback)) : ?>
            <br>
            <div class="col-sm-12">
              <div class="alert alert-warning text-center" role="alert"><strong>Catatan:</strong> <?= $detail->feedback ?></div>
            </div>
          <?php endif ?>
	        <div class="box-body">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Rekening Tujuan</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" id="rekening" name="rekening" required>
                  <option value="">Pilih Salah Satu</option>
                  <?php
                  $rekening = $this->db->get_where('tbl_rekening', ['aktif' => 'Ya'])->result();
                  foreach ($rekening as $key => $val) {
                    echo '<option value="'.$val->id_rekening.'">'.$val->nama.' ( '.$val->no_rek.' )</option>';
                  }
                  ?>
                </select>
              </div>
            </div>
	          <div class="form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12">Bukti pembayaran</label>
	            <div class="col-md-9 col-sm-9 col-xs-12">
	              <input type="file" class="form-control" id="bukti" name="bukti" accept="image/*" required />
		      <!-- Tambah keterangan data yang perlu diupload. Perubahan dilakukan oleh : Nurhayati Rahayu (31/10/2019) -->
	              <br><br>			
	              <span><em>Perhatian : </em></span><br>
           	      <span><em>Jenis dokumen yang HARUS ada dalam file PDF adalah : </em></span><br>
	              <span><em>* KTP </em></span><br>
   	              <span><em>* Surat permohononan permintaan data dari instansi</em></span><br>
	              <span><em>* Surat tugas</em></span><br>
		      <span><em>Bagi pelanggan yang melakukan permohonan PELAYANAN JASA KALIBRASI ALAT MKG, setelah mengunggah dokumen permohonan, dalam kurun waktu maksimal 2 x 24 jam WAJIB datang ke kantor PTSP dengan membawa alat untuk dilakukan pengecekan. </em></span><br><br>
	              <!-- baris terakhir perbaikan -->
	            </div>
	          </div>
	        </div>
	        <div class="box-footer" style="text-align: center;">
	          <button type="submit" class="btn btn-success" id="upload" name="upload">Upload</button>
	        </div>
      	</form>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-footer" style="text-align: center;">
          <button type="button" class="btn btn-primary" onclick="<?= $url_back ?>">Kembali</button>
        </div> 
      </div>
    </div>
  </div>
</section>