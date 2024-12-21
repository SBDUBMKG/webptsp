<?php

$curr_lang = $this->session->userdata('language');
$this->lang->load('backend/monitoring/monitoring', $curr_lang);

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
      <?= $this->lang->line('title.page.long') ?>
      <small>
          <?= $this->lang->line('title.page.sub') ?>
      </small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url('backend') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?= $this->lang->line('title.page') ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- filter -->
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">
          <?= $this->lang->line('card.search.title') ?>
      </h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-12">
          <?php if (!empty($errMsg)) { ?><div class="alert alert-danger" role="alert"><?= $errMsg ?></div><?php } ?>
          <form method="post" action="">
            <div class="form-group">
              <label>
                  <?= $this->lang->line('card.search.form.input.label') ?>
              </label>
              <div class="input-group">
                <input type="text" id="no_permohonan" name="no_permohonan" class="form-control" placeholder=" <?= $this->lang->line('card.search.form.input.plc') ?> " required />
                <span class="input-group-btn" id="basic-addon2">
                  <button type="submit" id="submit" name="submit" class="btn btn-warning " id="basic-addon2">
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

  <?php if( !empty($permohonan) && !empty($detail_akun) && !empty($detail_permohonan)) { ?>
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">
          <?= $this->lang->line('card.result.title') ?>
      </h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td> <?= $this->lang->line('card.result.id.name') ?> </td>
                <td>: <?= $detail_akun->nama ?></td>
              </tr>
              <tr>
                <td> <?= $this->lang->line('card.result.id.mobile') ?> </td>
                <td>: <?= $detail_akun->no_hp ?></td>
              </tr>
              <tr>
                <td> <?= $this->lang->line('card.result.id.address') ?> </td>
                <td>: <?= $detail_akun->alamat ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-6">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td> <?= $this->lang->line('card.result.service.invoice') ?> </td>
                <td>: <?= $permohonan->no_permohonan ?></td>
              </tr>
              <tr>
                <td> <?= $this->lang->line('card.result.service.date') ?> </td>
                <td>: <?= $permohonan->tanggal_permohonan ?></td>
              </tr>
              <tr>
                <td> <?= $this->lang->line('card.result.service.status') ?> </td>
                <td>:
                    <?php echo
                    strcmp($curr_lang, 'english') === 0
                    ? $this->lang->line('card.result.service.status.'.$permohonan->status)
                    : status($permohonan->status, $this->session->userdata('id_role'))
                    ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-6">
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
                <th class="text-center"> <?= $this->lang->line('card.result.table.header.service') ?> </th>
                <th class="text-center"> <?= $this->lang->line('card.result.table.header.cost') ?> </th>
                <th class="text-center"> <?= $this->lang->line('card.result.table.header.status') ?> </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $total_harga = 0;
              foreach ($detail_permohonan as $key => $value) {
              ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td>
                    <?php
                        $suffix = strcmp($curr_lang, 'english') === 0 ? '_en' : '';
                        echo $this->db->get_where('m_layanan', ['id_layanan' => $value->id_layanan ] )->row('layanan'.$suffix)
                    ?>
                </td>
                <td class="text-right"><?= number_format($value->harga, 2, ",", ".") ?></td>
                <td><?= strcmp($curr_lang, 'english') === 0 ? $this->lang->line('card.result.table.body.status.'.$value->status) : $value->status ?></td>
              </tr>
              <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <td class="text-center text-bold" colspan="2"> <?= $this->lang->line('card.result.table.footer.total') ?> </td>
                <td class="text-center text-bold" colspan="2"><?= number_format($permohonan->total_harga, 2, ",", ".") ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>

    </div>
  </div>
  <?php } ?>
</section>
