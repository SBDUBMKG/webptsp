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
          <h3 class="box-title">Upload Dokumen Permohonan</h3>
        </div>

         <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
	        <div class="box-body">
	          <div class="form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12">Dokumen Permohonan</label>
	            <div class="col-md-9 col-sm-9 col-xs-12">
	              <input type="file" class="form-control" id="permohonan" name="permohonan" required />
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