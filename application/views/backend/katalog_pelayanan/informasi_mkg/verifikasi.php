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
    	<?php if (!empty($scsMsg)) { ?><div class="alert alert-success" role="alert"><?= $scsMsg ?></div>
      <?php }  if (!empty($errMsg)) { ?><div class="alert alert-danger" role="alert"><?= $errMsg ?></div><?php } ?>
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><strong>DATA PERMOHONAN</strong></h3>
        </div>
        <div class="box-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td style="width: 400px;">Nama Pemohon</td>
                <td style="width: 10px">:</td>
                <td><?= empty($detail_akun->nama) ? '-' : $detail_akun->nama ?></td>
              </tr>
              <tr>
                <td>No Permohonan</td>
                <td style="width: 10px">:</td>
                <td><?= empty($detail->no_permohonan) ? '-' : $detail->no_permohonan; ?></td>
              </tr>
              <tr>
                <td>Dokumen Permohonan</td>
                <td style="width: 10px">:</td>
                <td><a href="<?= site_url('upload/permohonan/'.$detail->permohonan) ?>" target="_blank">Lihat</a></td>
              </tr>
              <tr>
                <td>Tanggal Permohonan</td>
                <td style="width: 10px">:</td>
                <td><?= empty($detail->tanggal_permohonan) ? '-' : $detail->tanggal_permohonan; ?></td>
              </tr>
              <tr>
                <td>Jumlah Pembayaran</td>
                <td style="width: 10px">:</td>
                <td><?= empty($detail->total_harga) ? '-' : number_format($detail->total_harga, 0 , '' , '.' ) ?></td>
              </tr>
              <tr>
                <td>Bukti Pembayaran</td>
                <td style="width: 10px">:</td>
                <td><a href="<?= site_url('upload/bukti/'.$detail->bukti) ?>" target="_blank">Lihat</a></td>
              </tr>
              <tr>
                <td>Status</td>
                <td style="width: 10px">:</td>
                <td><?= status($detail->status, $this->session->userdata('id_role')) ?></td>
              </tr>
              <?php if($role_user > 8 && $detail_produk): ?>
              <tr>
                  <td>Tahapan Proses</td>
                  <td style="width: 10px">:</td>
                  <td>
                      <select id="tahapanProses" name="tahapan_proses" class="form-control">
                          <?php foreach ($process_arr as $index => $process) : ?>
                          <option value="<?= $index+1  ?>" <?= $detail_produk->tahapan_proses == ($index+1) ? 'selected' : '' ?>>
                              <?= $index+1 ?>/4 : <?= $process ?>
                          </option>
                          <?php endforeach ?>
                      </select>
                  </td>
              </tr>
              <?php endif ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
	    <?php if($detail->status == 6 && !empty($detail_produk)):?>
      <div class="box box-info">
      	<form class="form-horizontal" enctype="multipart/form-data" method="post">
		      <div class="box-header with-border">
		      	<h3 class="box-title">
		      		<strong>DATA PRODUK</strong>
		      	</h3>
	        </div>
		      <div class="box-body">
		      	<?php
		      	$id		= $detail_produk->id_detail_permohonan;
            $data = $this->db->get_where('m_layanan', [ 'id_layanan' => $detail_produk->id_layanan ])->row();
            ?>
		        <div class="form-group">
		        	<div class="col-md-3">
		        		<label class="control-label">Nama Layanan :</label>
		        	</div>
	            <div class="col-md-9">
		        		<input class="form-control" type="text" value="<?= empty($data->layanan) ? 'Nama Layanan Kosong' : $data->layanan ?>" readonly/>
	          	</div>
	          </div>
		        <div class="form-group">
		        	<div class="col-md-3">
		        		<label class="control-label">Ambil di PTSP :</label>
		        	</div>
	            <div class="col-md-9">
	            	<label class="radio-inline">
	            		<input type="radio" value="Ya" name="ambil_di_ptsp" id="ambil_di_ptsp" checked> Ya
	            	</label>
	            	<label class="radio-inline">
	            		<input type="radio" value="Tidak" name="ambil_di_ptsp" id="ambil_di_ptsp"> Tidak
	            	</label>
	          	</div>
	          </div>
		        <div class="form-group">
		        	<div class="col-md-3">
		        		<label class="control-label">Unggah Dokumen :</label>
		        	</div>
	            <div class="col-md-9">
	            	<?php if( $data->download == 'Ya' && !empty($data->file_download) ) { ?>
	            	<input class="form-control" type="text" value="File Tersedia" readonly/>
	            	<?php } else if( $data->download == 'Ya' && empty($data->file_download) ) { ?>
	            	<input class="form-control" type="file" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar"  id="download" name="download"/>
	            	<?php } else { ?>
	            	<input class="form-control" type="text" value="File Tidak Tersedia" readonly/>
	            	<?php } ?>
	            </div>
	          </div>
				<div class="form-group">
		        	<div class="col-md-3"></div>
					<div class="col-md-9" style="">
				        <div class="">Ekstensi file: <code>docx, doc, pdf, jpg, jpeg, png, xls, xlsx, ppt, pptx, zip, rar</code></div>
						<div class="">Ukuran maksimal file: <code>20MB</code></div>
					</div>
				</div>
	          <div class="form-group">
		        	<div class="col-md-3 col-sm-3 col-xs-12">
		        		<label class="control-label">Catatan :</label>
		        	</div>
	            <div class="col-md-9 col-sm-9 col-xs-12">
	          		<textarea class="form-control" id="catatan" name="catatan"></textarea>
	          	</div>
	          </div>
					<div class="form-group">
					<div class="col-md-3 col-xs-12"></div>
					<div class="col-md-9 col-xs-12">
					* Untuk dokumen dengan ukuran di atas 20 MB, disarankan untuk menggunakan link Google Drive dan menuliskan link pada kolom Catatan
					</div>
					</div>
		      </div>
		      <div class="box-footer" style="text-align: center;">
		      	<div class="col-md-12">
		      		<button type="submit" class="btn btn-success" id="submit" name="submit" <?= (int) $detail_produk->tahapan_proses < 4 ? 'disabled' : NULL ?>>Konfirmasi Data Layanan</button>
		      	</div>
	        </div>
	      </form>
      </div>
		  <?php endif ?>
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

<script type="text/javascript">
	$(document).ready(function () {
		$("#catatan").wysihtml5();

		$('#tahapanProses').change(function(e) {
		    e.preventDefault();

			const value = parseInt($(this).val());
			if (value === 0) return;

			const result = confirm('Apakah anda yakin ingin mengubah tahapan proses produk ini?');
			if (!result) return;

			$.ajax({
                url: "<?= site_url('backend/katalog_pelayanan/informasi_mkg/update_tahapan_proses') ?>",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id_detail_permohonan: '<?= $detail_produk->id_detail_permohonan ?>',
                    id_permohonan: '<?= $detail_produk->id_permohonan ?>',
                    tahapan_proses: value,
                },
                success: function(result) {
                  alert(result.message);
                  location.reload();
                },
                error: function(result) {
                  alert(result.responseJSON.message);
                  defaultStatus();
                }
            });
		});
	});
</script>
