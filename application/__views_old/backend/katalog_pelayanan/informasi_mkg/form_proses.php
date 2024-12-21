<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="content-header">
  <h1><?= $page_title ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url() ?>">Home</a></li>
    <li><a href="<?= site_url($this->module) ?>"><?= $page_title ?></a></li>
    <li class="active"><?php echo $title; ?></li>
  </ol>
</section>

<form id="form" class="form-horizontal" method="post">
  <section class="content" style="padding:15px 15px 0px 15px;">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title; ?></h3>
          </div>
          <div class="box-body">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Informasi</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="hidden" name="id_layanan" id="id_layanan" value="<?= $layanan[0]['id_layanan'] ?>">
                  <input type="hidden" name="id_detail_permohonan" id="id_detail_permohonan" value="<?= $layanan[0]['id_detail_permohonan'] ?>">
                  <input type="text" class="form-control" name="t_layanan" id="t_layanan" value="Sedang Dimuat...." disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Satuan</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" id="satuan" name="satuan" max_length="100" disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" id="harga" name="harga" max_length="100" disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Penanggung Jawab</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" max_length="100" disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Berat</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" id="berat" name="berat" max_length="100" disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Satuan Berat</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" id="satuan_berat" name="satuan_berat" max_length="100" disabled>
                </div>
            </div>
            <div id="content_form"></div>
          </div>

          <div class="box-footer" style="text-align: center;">
              <button type="button" class="btn btn-primary" onclick="<?= $url_back; ?>">Kembali</button>
              <button type="submit" class="btn btn-success" id="save_produk">Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>

<script type="text/javascript">
  $(document).ready(function () {
    var id_layanan,
        element_id_layanan = document.getElementById('id_layanan');
    if (element_id_layanan != null) {
      id_layanan = element_id_layanan.value;
    }
    else {
      id_layanan = 0;
    }
    show_detail_layanan(id_layanan);
      $(".textarea").wysihtml5();
      $('.cmb_select2').select2({
          theme: 'bootstrap'
      });
      $('#datepicker').datepicker({
          autoclose: true
      });
  });
</script>