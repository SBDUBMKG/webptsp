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
                <td>Tanggal Permohonan</td>
                <td style="width: 10px">:</td>
                <td><?= empty($detail->tanggal_permohonan) ? '-' : format_datetime($detail->tanggal_permohonan); ?></td>
              </tr>
              <tr>
                <td>Tanggal Verifikasi Pembayaran</td>
                <td style="width: 10px">:</td>
                <td><?= empty($detail->tanggal_verifikasibendahara) ? '-' : format_datetime($detail->tanggal_verifikasibendahara) ?></td>
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

  <div class="row">
    <div class="col-xs-12">
	    <?php if($detail->status == 9) { if(!empty($detail_produk)) {?>
      <div class="box box-info">
      	<form class="form-horizontal" enctype="multipart/form-data" method="post">
		      <div class="box-header with-border">
		      	<h3 class="box-title">
		      		<strong>DATA PRODUK</strong>
		      	</h3>
	        </div>
		      <div class="box-body">
		      	<?php
		      	$id	  = $detail_produk[0]->id_detail_permohonan;
                $data = $this->db->get_where('m_layanan', [ 'id_layanan' => $detail_produk[0]->id_layanan ])->row();
            ?>


		        <div class="form-group">
		        	<div class="col-md-3">
		        		<label class="control-label">Tanggal Surat Keluar :</label>
		        	</div>
	            <div class="col-md-9">
                <input name="tanggal_surat_keluar" id="tanggal_surat_keluar" class="form-control" value="<?= $detail->tanggal_surat_keluar ?>" type="date"  required>
	          	</div>
	          </div>
		        <div class="form-group">
		        	<div class="col-md-3">
		        		<label class="control-label">No Surat Keluar :</label>
		        	</div>
	            <div class="col-md-9">
                <input name="no_surat_keluar" id="no_surat_keluar" class="form-control" value="<?= $detail->no_surat_keluar ?>" type="text" required>
	          	</div>
	          </div>

				<?php foreach($detail_produk as $i => $produk): ?>
		        <div class="form-group">
		        	<div class="col-md-3">
		        		<label class="control-label">Nama Layanan <?= $i + 1 ?> :</label>
		        	</div>
	            <div class="col-md-4">
		        		<input class="form-control"type="text" value="<?= empty($produk->layanan) ? 'Nama Layanan Kosong' : $produk->layanan ?>" readonly/>
	          	</div>
				<div class="col-md-1" style="padding: 0;">
				    <a role="button"  style="width: 100%" target="_blank" href="<?= site_url('upload/dokumen/'.$produk->download) ?>" class="btn btn-success" <?= empty($produk->download) ? 'disabled' : '' ?> >Lihat File</a>
				</div>
				<div class="col-md-4">
                    <?php if( !empty($produk->download) ) { ?>
                    <input class="form-control" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar" type="file" id="download" name="download-<?= $i ?>"/>
                    <?php } elseif( $data->download == 'Ya' && !empty($data->file_download) ) { ?>
                    <input class="form-control" type="text" value="File Tersedia" readonly/>
					<?php } else if( $data->download == 'Ya' && empty($data->file_download) ) { ?>
					<input class="form-control" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar" type="file" id="download" name="download-<?= $i ?>"/>
					<?php } else { ?>
					<input class="form-control" type="text" value="File Tidak Tersedia" readonly/>
					<?php } ?>
				</div>
	          </div>
			<?php endforeach ?>

			<div class="col-md-12" style="">
			     <div class="col-md-3"></div>
			     <div class="col-md-5"></div>
			     <div class="col-md-4">
					<div class="">Ekstensi file: <code>docx, doc, pdf, jpg, jpeg, png, xls, xlsx, ppt, pptx, zip, rar</code></div>
					<div class="">Ukuran maksimal file: <code>20MB</code></div>
				</div>
			</div>

		        <div class="form-group">
		        	<div class="col-md-3">
		        		<label class="control-label">Ambil di PTSP :</label>
		        	</div>
              <?php if($detail_produk[0]->ambil_di_ptsp == "Ya") {
                $check_1 = "checked";
                $check_2 = NULL;
              } else {
                $check_1 = NULL;
                $check_2 = "checked";
              }
              ?>
	            <div class="col-md-9">
	            	<label class="radio-inline">
	            		<input type="radio" value="Ya" name="ambil_di_ptsp" id="ambil_di_ptsp" <?= $check_1 ?>> Ya
	            	</label>
	            	<label class="radio-inline">
	            		<input type="radio" value="Tidak" name="ambil_di_ptsp" id="ambil_di_ptsp" <?= $check_2 ?>> Tidak
	            	</label>
	          	</div>
	          </div>
	          <div class="form-group">
		        	<div class="col-md-3 col-sm-3 col-xs-12">
		        		<label class="control-label">Catatan :</label>
		        	</div>
	            <div class="col-md-9 col-sm-9 col-xs-12">
	          		<textarea class="form-control" id="catatan" name="catatan">
                  <?= empty($detail_produk[0]->catatan) ? '' : $detail_produk[0]->catatan ?>
                </textarea>
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
		      		<button type="submit" class="btn btn-success" id="submit" name="submit">Konfirmasi Data Layanan</button>
		      	</div>
	        </div>
	      </form>
      </div>
		  <?php } } ?>
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
	});
</script>
