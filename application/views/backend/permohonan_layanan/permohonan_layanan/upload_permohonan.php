<?php
defined("BASEPATH") or exit("No direct script access allowed");

$current_lang = $this->session->userdata("language");
$this->lang->load("backend/service_request/upload_request", $current_lang);
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
                    : format_datetime(
                        $detail->tanggal_verifikasibendahara
                    ) ?></td>
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
                    <?= $current_lang === "indonesia"
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

            <br><br>
            <?php if($current_lang === 'english'): ?>
                <span><em>Attention : </em></span><br>
                <span><em>The types of documents that MUST be in the PDF file are : </em></span><br>
                <span><em>* Letter of request for data from the agency</em></span><br>
                <span><em>* Assignment letter</em></span><br><br>
                <span><em>For customers who apply for MKG TOOL CALIBRATION SERVICE, after uploading the application document, within a maximum period of 2 x 24 hours MUST come to the PTSP office with the tool to be checked. </em></span><br><br>
            <?php endif; ?>

            <?php if($current_lang === 'indonesia'): ?>
                <span><em>Perhatian : </em></span><br>
                <span><em>Jenis dokumen yang HARUS ada dalam file PDF adalah : </em></span><br>
                <span><em>* Surat permohononan permintaan data dari instansi</em></span><br>
                <span><em>* Surat tugas</em></span><br><br>
                <span><em>Bagi pelanggan yang melakukan permohonan PELAYANAN JASA KALIBRASI ALAT MKG, setelah mengunggah dokumen permohonan, dalam kurun waktu maksimal 2 x 24 jam WAJIB datang ke kantor PTSP dengan membawa alat untuk dilakukan pengecekan. </em></span><br><br>
            <?php endif; ?>

        </div>

         <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
	        <div class="box-body">
	          <div class="form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12">
					<?= $this->lang->line("card.2.form.label") ?>
				</label>
	            <div class="col-md-9 col-sm-9 col-xs-12">
	              <input type="file" class="form-control" id="permohonan" name="permohonan" required />
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
              <?= $this->lang->line("card.2.button.back") ?>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>
