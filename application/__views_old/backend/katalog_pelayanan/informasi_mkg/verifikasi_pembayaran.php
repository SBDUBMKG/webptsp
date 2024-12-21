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
                <td>Nama Pemohon</td>
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
                <td>Rekening Tujuan</td>
                <td style="width: 10px">:</td>
                <?php $rek = $this->db->get_where('tbl_rekening', ['id_rekening' => $detail->id_rekening]) ?>
                <td><?= $rek->row('nama').' ( '.$rek->row('no_rek').' )' ?></td>
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
	    <?php if($detail->status == 4) { ?>
      <div class="box box-info">
      	<form class="form-horizontal" method="post">
	      	<div class="box-header with-border">
	          <h3 class="box-title"><strong>BUKTI PEMBAYARAN</strong></h3>
	        </div>
	        <div class="box-body">
            <?php if(!empty($detail->id_rekening_old)) { ?>
            <center>
            <p>Pembayaran Sebelumnya<br>
            <?php $rek_old = $this->db->get_where('tbl_rekening', ['id_rekening' => $detail->id_rekening_old]) ?>
            <?= $rek_old->row('nama').' ( '.$rek_old->row('no_rek').' )' ?>
            </p>
            <img src="<?= site_url('upload/bukti/'.$detail->bukti_old) ?>" style="display: block; margin: 0 auto 10px; max-height: 100px">
              <a class="btn btn-xs btn-primary" href="<?= site_url('upload/bukti/'.$detail->bukti_old) ?>" target="_blank">Lihat Full Size</a>
            </center>
            <hr>
            <?php } ?>
		        <img src="<?= site_url('upload/bukti/'.$detail->bukti) ?>" style="display: block; margin: 0 auto 10px; max-height: 300px">
		        <center>
              <a class="btn btn-xs btn-primary" href="<?= site_url('upload/bukti/'.$detail->bukti) ?>" target="_blank">Lihat Full Size</a>
            </center>
            <hr>
	    Catatan Bendahara : 	
            <div class="form-group">
              <div class="col-md-12">
                <textarea class="form-control" id="catatan" name="catatan"></textarea>
              </div>
            </div>
          </div>
          <div class="box-footer" style="text-align: center;">
            <div class="col-md-4">
              <button type="submit" class="btn btn-danger" id="action" name="action" value="cancel">Pembayaran Tidak Valid</button>
            </div>
		      	<div class="col-md-4">
		      		<button type="submit" class="btn btn-warning" id="action" name="action" value="pending">Pembayaran Ditangguhkan</button>
		      	</div>
		      	<div class="col-md-4">
		      		<button type="submit" class="btn btn-success"  id="action" name="action" value="approve">Pembayaran Valid</button>
		      	</div>
	        </div>
	      </form>
      </div>
		  <?php } ?>
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