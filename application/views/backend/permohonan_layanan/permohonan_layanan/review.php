<?php
defined("BASEPATH") or exit("No direct script access allowed");

$curr_lang = $this->session->userdata("language");
$suffix = $curr_lang === "indonesia" ? "" : "_en";
$this->lang->load("backend/service_request/review", $curr_lang);
?>

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
      <?php
      if (
          !empty($scsMsg)
      ) { ?><div class="alert alert-success" role="alert"><?= $scsMsg ?></div>
      <?php }
      if (
          !empty($errMsg)
      ) { ?><div class="alert alert-danger" role="alert"><?= $errMsg ?></div><?php }
      ?>
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><strong>
              <?= strtoupper($this->lang->line("card.1.title")) ?>
          </strong></h3>
        </div>
        <div class="box-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td> <?= $this->lang->line('card.1.form.label') ?> </td>
                <td style="width: 10px">:</td>
                <td><?= empty($detail_layanan->layanan)
                    ? "-"
                    : ($curr_lang === "indonesia"
                        ? $detail_layanan->layanan
                        : $detail_layanan->layanan_en) ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-xs-12">
    	<form class="form-horizontal" method="post">
      <?php if ($detail->status == 7) {
          if (!empty($detail_produk)) { ?>
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><strong>
              <?= $this->lang->line("card.2.title") ?>
          </strong></h3>
        </div>
        <div class="box-body">
        	<?php foreach ($pertanyaan as $key => $val) {
             $id = $val["id_pertanyaan_survey"]; ?>
					<div class="form-group text-left">
						<div class="col-md-3">
							<label class="text-left">
							     <?= $val["pertanyaan_survey" . $suffix] ?>
							</label>
						</div>
						<div class="col-md-9">
						    <label class="radio-inline">
            	           	<input type="radio" value="4" name="<?= $id ?>" id="<?= $id ?>" required />
                                <?= $this->lang->line("card.2.form.radio.1") ?>
            	            </label>
            	            <label class="radio-inline">
            	           	<input type="radio" value="3" name="<?= $id ?>" id="<?= $id ?>" required />
                                <?= $this->lang->line("card.2.form.radio.2") ?>
            	            </label>
						      <label class="radio-inline">
            	           	<input type="radio" value="2" name="<?= $id ?>" id="<?= $id ?>" required />
                                <?= $this->lang->line("card.2.form.radio.3") ?>
            	            </label>
            	            <label class="radio-inline">
            	           	<input type="radio" value="1" name="<?= $id ?>" id="<?= $id ?>" required />
                                <?= $this->lang->line("card.2.form.radio.4") ?>
            	           </label>
						</div>
					</div>
					<hr>
					<?php
         } ?>
				</div>
				<div class="box-footer" style="text-align: center;">
          <button type="button" class="btn btn-primary" onclick="<?= $url_back ?>">
              <?= $this->lang->line("form.button.back") ?>
          </button>
          <button type="submit" class="btn btn-success">
              <?= $this->lang->line("form.button.send") ?>
          </button>
	      </div>
	  	</div>
	    <?php }
      } ?>
		</form>
	</div>
</section>
