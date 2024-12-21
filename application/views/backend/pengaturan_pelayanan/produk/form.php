<?php
/*
* Author : Arif Kurniawan
* Email : arif.kurniawan86@gmail.com
* Website : infoharga123.com
*/
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<section class="content-header">
  <h1><?= $page_title; ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url(); ?>">Home</a></li>
    <li><a href="<?= base_url().$this->module; ?>"><?= $page_title; ?></a></li>
    <li class="active"><?= $title; ?></li>
  </ol>
</section>

<form class="form-horizontal" enctype="multipart/form-data" method="post">
  <section class="content" style="padding:15px 15px 0px 15px;">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"><?= $title; ?></h3>
          </div>

          <div class="box-body">
            <?php if ( !empty($errMsg) ) { ?> <div class="alert alert-danger" role="alert"><?= $errMsg; ?></div><?php } ?>
            <?php if ( !empty($sccMsg) ) { ?> <div class="alert alert-success" role="alert"><?= $sccMsg; ?></div><?php } ?>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Layanan * </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="layanan" value="<?= empty($detail['layanan']) ? NULL : $detail['layanan']; ?>" max_length="200" required>
                </div>
              </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Satuan * </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control cmb_select2" id="satuan" name="satuan" required>
                  <option value=""> - Pilih Satuan - </option>
                  <?php
                  $list_satuan = $this->global_model->get_list('m_satuan');
                  foreach ( $list_satuan as $dt ) {
                    $selected = '';
                    if(!empty($detail['satuan'])){
                      if ($dt->satuan == $detail['satuan']){
                        $selected = 'selected';
                      }
                    }
                  ?>
                  <option value="<?= $dt->satuan ?>" <?= $selected ?> ><?= $dt->satuan ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga * </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="number" min="0" class="form-control" name="harga" value="<?= empty($detail['harga']) ? NULL : $detail['harga']; ?>" max_length="50" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Penanggung Jawab * </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control cmb_select2" id="penanggung_jawab" name="penanggung_jawab" required>
                  <option value=""> - Pilih Penanggung Jawab - </option>
                  <?php
                  $list_penanggung_jawab = $this->global_model->get_list('tbl_role','id_role > 8');
                  foreach ( $list_penanggung_jawab as $dt ) {
                    $selected = '';
                    if(!empty($detail['penanggung_jawab'])){
                      if ($dt->id_role == $detail['penanggung_jawab']){
                        $selected = 'selected';
                      }
                    }
                  ?>
                  <option value="<?php echo $dt->id_role; ?>" <?php echo $selected;?> ><?php echo $dt->role; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Produk * </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="nama_produk" value="<?php echo empty($detail['nama_produk']) ? NULL : $detail['nama_produk']; ?>" max_length="50" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Download Dokumen * </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control cmb_select2" id="download" name="download" required>
                  <?php if(!empty($detail['download'])) { if($detail['download'] === "Ya") { ?>
                  <option value="Ya">Ya</option>
                  <option value="Tidak">Tidak</option>
                  <?php } else { ?>
                  <option value="Tidak">Tidak</option>
                  <option value="Ya">Ya</option>
                  <?php } } else { ?>
                  <option value=""> - Pilih Ketersidiaan Download - </option>
                  <option value="Tidak">Tidak</option>
                  <option value="Ya">Ya</option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div id="file_download"></div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Menyerahkan Sampel * </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control cmb_select2" id="menyerahkan_sampel" name="menyerahkan_sampel">
                    <?php if($detail['menyerahkan_sampel'] === "Dokumen") { ?>
                    <option value="Dokumen" selected>Dokumen (Upload File)</option>
                    <option value="Sampel">Sampel (Menyerahkan Ke PTSP)</option>
                    <option value="">Tidak Butuh Sampel</option>
                    <?php } else if($detail['menyerahkan_sampel'] === "Sampel") { ?>
                    <option value="Sampel" selected>Sampel (Menyerahkan Ke PTSP)</option>
                    <option value="Dokumen">Dokumen (Upload File)</option>
                    <option value="">Tidak Butuh Sampel</option>
                    <?php } else if(empty($detail['menyerahkan_sampel'])) { ?>
                    <option value="" selected>Tidak Butuh Sampel</option>
                    <option value="Dokumen">Dokumen (Upload File)</option>
                    <option value="Sampel">Sampel (Menyerahkan Ke PTSP)</option>
                    <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Mengambil Alat Di PTSP * </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control cmb_select2" id="mengambil_alat_di_ptsp" name="mengambil_alat_di_ptsp">
                    <?php if($detail['mengambil_alat_di_ptsp'] === "Ya") { ?>
                    <option value="Ya" selected>Ya</option>
                    <option value="">Tidak</option>
                    <?php } else if(empty($detail['mengambil_alat_di_ptsp'])) { ?>
                    <option value="" selected>Tidak</option>
                    <option value="Ya">Ya</option>
                    <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Estimasi Pengerjaan <small><i>(Opsional)</i></small></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="number" min="0" class="form-control" name="estimasi" value="<?php echo empty($detail['estimasi']) ? NULL : $detail['estimasi']; ?>" max_length="50">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Berat <small><i>(Opsional)</i></small></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="number" min="0" class="form-control" name="berat" value="<?php echo empty($detail['berat']) ? NULL : $detail['berat']; ?>" max_length="50">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Satuan Berat <small><i>(Opsional)</i></small></label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control cmb_select2" id="satuan_berat" name="satuan_berat">
                  <option value=""> - Pilih Satuan Berat - </option>
                  <?php
                  $list_dt = $this->global_model->get_list('m_satuan_berat');
                  foreach ( $list_dt as $dt ) {
                    $selected = '';
                    if(!empty($detail['satuan_berat'])){
                      if ($dt->satuan_berat == $detail['satuan_berat']){
                        $selected = 'selected';
                      }
                    }
                  ?>
                  <option value="<?php echo $dt->satuan_berat; ?>" <?php echo $selected;?> ><?php echo $dt->satuan_berat; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Contoh (jpg|png)</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="file" name="contoh" >
                <?php if(!empty($detail['contoh'])){?><img src="<?php echo base_url()."upload/dokumen/".$detail['contoh'] ?>" class="img-responsive" width=200><?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php 
  if($get_field_data != NULL){
  ?>
  <section class="content" style="padding:0px 15px 0px 15px;min-height:100px">
  <div class="row">
  <div class="col-xs-12">
  <div class="box box-info">
  <div class="box-header">
  <h3 class="box-title">Edit Parameter</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  <table id="example2" class="table table-bordered table-hover">
  <thead>
  <tr>
  <th style="width:40%">Nama Kolom</th>
  <th style="width:60%">Show Kolom</th>
  <!--
  <th>Label</th>
  -->
  </tr>
  </thead>
  <tbody>
  <?php
  $i = 0;
  foreach ($get_field_data as $key) {
    if($key->primary_key != 1){
    $namakolom  = $key->name;
    $checked   = '';
    $value      = convert_field_to_string($key->name);
    $value_en   = convert_field_to_string($key->name);

    $dp = json_decode($detail['display_coloumn'], true);
    if(is_array($dp)){
      if(array_key_exists($namakolom, $dp)){
      $checked = "checked";
      $value   = $dp[$namakolom];
      }
    }
    $dp_en = json_decode($detail['display_coloumn_en'], true);
    if(is_array($dp_en)){
      if(array_key_exists($namakolom, $dp_en)){
        $value_en   = $dp_en[$namakolom];
      }
    }
    ?>
    <tr>
    <?php if(convert_field_to_string($key->name) !== 'Download') { ?>
    <td><?php echo convert_field_to_string($key->name);?></td>
    <td>
    <div class="checkbox">
    <label class="checkbox"><input type="checkbox" value="<?php echo $key->name;?>" id="<?php echo $key->name.'_ck';?>" name="<?php echo 'show_coloumn_'.$i;?>" <?php echo $checked;?> > Ya</label>
    </div>
    </td>
    </tr>
    <tr id="<?php echo $key->name.'_lb';?>">
    <td></td>
    <td>
    Label : <input type="text" class="form-control" name="<?php echo 'label_'.$i;?>" value="<?php echo $value;?>" max_length="50">
    Label EN : <input type="text" class="form-control" name="<?php echo 'label_en_'.$i;?>" value="<?php echo $value_en;?>" max_length="50">
    </td>
    <tr>
    <?php
    }
    }
    $i++;
  }
  ?>
  </tbody>
  </table>
  </div>
  </div>
  </div>
  </div>
  </section>
  <?php } ?>

  <section class="content" style="padding:0px 15px 0px 15px;">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-footer" style="text-align: center;">
            <button type="button" class="btn btn-primary" onclick="<?php echo $url_back; ?>">Kembali</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>

<script type="text/javascript">
  $(document).ready(function () {
    window.onload = goRun;
    function goRun(){
      <?php foreach ($get_field_data as $key) { if($key->primary_key != 1){ ?>
      if (document.getElementById('<?= $key->name."_ck" ?>').checked){
        $('#<?= $key->name."_lb" ?>').show();                        
      } else {
        $('#<?= $key->name."_lb" ?>').hide();
      }
      <?php } } ?>
    }

    $("#download").change(function(e) {
      var data = '',
          download = $('#download').val();
      if(download == 'Ya') {
        data += ''
        + '<div class="form-group">'
          + '<label class="control-label col-md-3 col-sm-3 col-xs-12">File Dokumen * </label>'
          + '<div class="col-md-9 col-sm-9 col-xs-12">'
            + '<input type="file" class="form-control" id="file_dokumen" name="file_dokumen" />'
          + '</div>';
        + '</div>';
        $('#file_download').html(data);
      } else {
        $("#file_download").empty();
      }
    });

    $(function () {
      $(".textarea").wysihtml5();
      $('.datepicker').datepicker({
        autoclose: true
      });
      $('.cmb_select2').select2({
        theme: 'bootstrap'
      });

      <?php foreach ($get_field_data as $key) { if($key->primary_key != 1){ ?>
      $('#<?php echo $key->name."_ck";?>').click(function() {
        if(this.checked) {
          $('#<?php echo $key->name."_lb";?>').show();
        } else{
          $('#<?php echo $key->name."_lb";?>').hide();
        }
      });
      <?php } } ?>
    });
  });
</script>