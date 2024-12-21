<?php

$bahasa = $this->session->userdata("bahasa");
$curr_lang = strcmp($bahasa, '_en') === 0 ? 'english' : 'indonesia';
$this->lang->load('backend/monitoring/monitoring', $curr_lang);

?>
<div class="wrapper row3" style="min-height: 60vh">
    <section class="hoc container clear">
    <div class="left_content">
        <div class="single_post_content">
          <div class="content-wrapper">

<!-- Main content -->
<section class="content">
  <!-- filter -->
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">
          <?= $this->lang->line('card.search.title') ?>
      </h3>
    </div>
    <div class="box-body mb-4">
      <div class="row">
        <div class="col-md-12">
          <?php if (
              !empty($errMsg)
          ) { ?><div class="alert alert-danger" role="alert"><?= $this->lang->line('search.msg.error') ?></div><?php } ?>
          <form method="post" action="">
            <div class="form-group">
              <label>
                  <?= $this->lang->line('card.search.form.input.label') ?>
              </label>
              <div class="input-group mt-1">
                <input type="text" id="no_permohonan" name="no_permohonan" class="form-control" placeholder="<?= $this->lang->line('card.search.form.input.plc') ?>" required value="<?=(isset($_POST['no_permohonan']))?$_POST['no_permohonan']:''?>"/>
                <span class="input-group-btn" id="basic-addon2">
                  <button type="submit" id="submit" name="submit" class="btn btn-primary " id="basic-addon2">
                      <?= $this->lang->line('card.search.form.button.search') ?>
                  </button>
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php if (
      !empty($permohonan) &&
      !empty($detail_akun) &&
      !empty($detail_permohonan)
  ) { ?>
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">
          <?= $this->lang->line('card.result.title') ?>
      </h3>

    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
            <tbody>
              <tr>
                <td width="25%">
                    <?= $this->lang->line('card.result.service.invoice') ?>
                </td>
                <td width="1%">:</td>
                <td><?= $permohonan->no_permohonan ?></td>
              </tr>
              <tr>
                <td>
                    <?= $this->lang->line('card.result.service.date') ?>
                </td>
                <td>:</td>
                <td><?= $permohonan->tanggal_permohonan ?></td>
              </tr>
              <tr>
                <td><?= $this->lang->line('card.result.service.status') ?></td>
                <td >:</td>
                <td>
<?php               echo ($curr_lang === 'indonesia')? status_lengkap($permohonan->status) : $this->lang->line('card.result.service.status.'.$permohonan->status)
?>              </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-12">

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
                <th class="text-center">
                    <?= $this->lang->line('card.result.table.header.service') ?>
                </th>

              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $total_harga = 0;
              foreach ($detail_permohonan as $key => $value) { ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td>
                    <?php
                    echo $this->db->get_where("m_layanan", ["id_layanan" => $value->id_layanan,])->row("layanan".$bahasa);
                    ?>
                </td>
              </tr>
              <?php }
              ?>
            </tbody>

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
          <p>PTSP BMKG</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="text-center" style="border: 2px solid;padding: 10px">
            <p>Survey Index Kepuasan Masyarakat (IKM) PTSP BMKG</p>
            <br>
            <button class="btn btn-warning">Isi Survey</button>
          </div>
        </div>
      </div> -->

    </div>
  </div>
  <?php } ?>
</section>
          </div>
      </div>
    </div>
  </section>
</div>
