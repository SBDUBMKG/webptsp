<?php
defined("BASEPATH") or exit("No direct script access allowed");

$curr_lang = $this->session->userdata("language");
$this->lang->load("backend/service_request/upload_payment", $curr_lang);
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
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">
              <strong>
                  <?= strtoupper($this->lang->line("card.1.title")) ?>
              </strong>
          </h3>
        </div>
        <div class="box-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td style="width: 400px;"> <?= $this->lang->line("card.1.content.number") ?> </td>
                <td style="width: 10px">:</td>
                <td><?= empty($detail->no_permohonan)
                    ? "-"
                    : $detail->no_permohonan ?></td>
              </tr>
              <tr>
                <td> <?= $this->lang->line("card.1.content.date") ?> </td>
                <td style="width: 10px">:</td>
                <td><?= empty($detail->tanggal_permohonan)
                    ? "-"
                    : $detail->tanggal_permohonan ?></td>
              </tr>
              <tr>
                <td> <?= $this->lang->line(
                    "card.1.content.date.verify"
                ) ?> </td>
                <td style="width: 10px">:</td>
                <td><?= empty($detail->tanggal_verifikasibendahara)
                    ? "-"
                    : $detail->tanggal_verifikasibendahara ?></td>
              </tr>
              <tr>
                <td> <?= $this->lang->line("card.1.content.payment") ?> </td>
                <td style="width: 10px">:</td>
                <td><?= empty($detail->total_harga)
                    ? "-"
                    : number_format($detail->total_harga, 0, "", ".") ?></td>
              </tr>
              <tr>
                <td>Status</td>
                <td style="width: 10px">:</td>
                <td>
                    <?= $curr_lang === "indonesia"
                        ? status(
                            $detail->status,
                            $this->session->userdata("id_role")
                        )
                        : $this->lang->line(
                            "card.1.content.status." . $detail->status
                        ) ?>
                </td>
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
          <h3 class="box-title">
              <?= $this->lang->line("card.2.title") ?>
          </h3>
        </div>

         <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
          <?php if (!empty($detail->feedback)): ?>
            <br>
            <div class="col-sm-12">
              <div class="alert alert-warning text-center" role="alert"><strong>Catatan:</strong> <?= $detail->feedback ?></div>
            </div>
          <?php endif; ?>
	        <div class="box-body">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">
                  <?= $this->lang->line("card.2.form.destination") ?>
              </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control" id="rekening" name="rekening" required>
                  <option value="">
                      <?= $this->lang->line(
                          "card.2.form.destination.option.1"
                      ) ?>
                  </option>
                  <?php
                  $rekening = $this->db
                      ->get_where("tbl_rekening", ["aktif" => "Ya"])
                      ->result();
                  foreach ($rekening as $key => $val) {
                      echo '<option value="' .
                          $val->id_rekening .
                          '">' .
                          $val->nama .
                          " ( " .
                          $val->no_rek .
                          " )</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
	          <div class="form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12">
					<?= $this->lang->line("card.2.form.proof") ?>
				</label>
	            <div class="col-md-9 col-sm-9 col-xs-12">
	              <input type="file" class="form-control" id="bukti" name="bukti" accept="image/*" required />
                      <?= $this->lang->line('card.2.form.note') ?>
	            </div>
	          </div>
	        </div>
	        <div class="box-footer" style="text-align: center;">
	            <button type="submit" class="btn btn-success" id="upload" name="upload">
					<?= $this->lang->line("card.2.form.button.upload") ?>
				</button>
	        </div>

      	</form>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-footer" style="text-align: center;">
          <button type="button" class="btn btn-primary" onclick="<?= $url_back ?>">
              <?= $this->lang->line("button.back") ?>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>
