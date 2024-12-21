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
                <td>Layanan</td>
                <td style="width: 10px">:</td>
                <td><?= empty($detail_layanan->layanan) ? '-' : $detail_layanan->layanan ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-xs-12">
    	<form class="form-horizontal" method="post">
      <?php if($detail->status == 7) { if(!empty($detail_produk)) {?>
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><strong>Review Layanan</strong></h3>
        </div>
        <div class="box-body">
        	<?php foreach ($pertanyaan as $key => $val) { $id = $val['id_pertanyaan_survey']?>
					<div class="form-group">
						<div class="col-md-3">
							<label class="control-label"><?= $val['pertanyaan_survey'] ?></label>
						</div>
						<div class="col-md-9">
							<label class="radio-inline">
            		<input type="radio" value="1" name="<?= $id ?>" id="<?= $id ?>" required /> Sangat Baik
            	</label>
            	<label class="radio-inline">
            		<input type="radio" value="2" name="<?= $id ?>" id="<?= $id ?>" required /> Cukup Baik
            	</label>
							<label class="radio-inline">
            		<input type="radio" value="3" name="<?= $id ?>" id="<?= $id ?>" required /> Kurang Baik
            	</label>
            	<label class="radio-inline">
            		<input type="radio" value="4" name="<?= $id ?>" id="<?= $id ?>" required /> Tidak Baik
            	</label>
						</div>
					</div>
					<hr>
					<?php } ?>
				</div>
				<div class="box-footer" style="text-align: center;">
          <button type="button" class="btn btn-primary" onclick="<?= $url_back; ?>">Kembali</button>
          <button type="submit" class="btn btn-success">Kirim</button>
	      </div>
	  	</div>
	    <?php } } ?>
		</form>
	</div>
</section>