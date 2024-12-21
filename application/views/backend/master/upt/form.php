<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- /.row -->
<section class="content-header">
    <h1><?php echo $page_title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo base_url().$this->module; ?>"><?php echo $page_title; ?></a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $title; ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post">
                    <div class="box-body">
                        <?php
                        if ( !empty($errMsg) ) {
                            ?>
                            <div class="alert alert-danger" role="alert"><?php echo $errMsg; ?></div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">UPT <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="upt" value="<?php echo empty($detail['upt']) ? NULL : $detail['upt']; ?>" max_length="255" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">WMO ID</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="number" class="form-control" name="id_wmo" value="<?php echo empty($detail['id_wmo']) ? NULL : $detail['id_wmo']; ?>" max_length="30">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="alamat" value="<?php echo empty($detail['alamat']) ? NULL : $detail['alamat']; ?>" max_length="255">
                           </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Provinsi <span class="required">*</span></label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" id="id_provinsi" name="id_provinsi" required>
                              <?php 
                              if(!empty($detail['id_provinsi'])) {
                                $provinsi_selected = $this->global_model->get_by_id('m_provinsi','id_provinsi',$detail['id_provinsi']);
                                echo '<option value="'.$provinsi_selected->id_provinsi.'" selected>'.$provinsi_selected->provinsi.'</option>';
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Kab/kota <span class="required">*</span></label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" id="id_kabkot" name="id_kabkot" required>
                            <?php 
                              if(!empty($detail['id_kabkot'])) {
                                $kabkot_selected = $this->global_model->get_by_id('m_kabkot','id_kabkot',$detail['id_kabkot']);
                                echo '<option value="'.$kabkot_selected->id_kabkot.'" selected>'.$kabkot_selected->kabkot.'</option>';
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Kecamatan <span class="required">*</span></label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control" id="id_kecamatan" name="id_kecamatan" required>
                              <?php 
                              if(!empty($detail['id_kecamatan'])) {
                                $kecamatan_selected = $this->global_model->get_by_id('m_kecamatan','id_kecamatan',$detail['id_kecamatan']);
                                echo '<option value="'.$kecamatan_selected->id_kecamatan.'" selected>'.$kecamatan_selected->kecamatan.'</option>';
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Lintang</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="lintang" value="<?php echo empty($detail['lintang']) ? NULL : $detail['lintang']; ?>" max_length="15">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Bujur</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="bujur" value="<?php echo empty($detail['bujur']) ? NULL : $detail['bujur']; ?>" max_length="15">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Telepon</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="telepon_upt" value="<?php echo empty($detail['telepon_upt']) ? NULL : $detail['telepon_upt']; ?>" max_length="40">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="email_upt" value="<?php echo empty($detail['email_upt']) ? NULL : $detail['email_upt']; ?>" max_length="50">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Aktif</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                              <?php
                              $tampilkan_menu = isset($detail['is_active']) ? $detail['is_active'] : 1; 
                              ?>
                               <label class="radio-inline"><input type="radio" name="is_active" value="1" <?php echo $tampilkan_menu == 1 ? 'checked' : NULL; ?>>Ya</label>
                               <label class="radio-inline"><input type="radio" name="is_active" value="0" <?php echo $tampilkan_menu == 0 ? 'checked' : NULL; ?>>Tidak</label>
                           </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer" style="text-align: center;">
                        <button type="button" class="btn btn-primary" onclick="<?php echo $url_back; ?>">Kembali</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function () {
      $(".textarea").wysihtml5();
      $('.datepicker').datepicker({
          autoclose: true
      });
      $('.cmb_select2').select2({
          theme: 'bootstrap'
      });
      $('#id_kabkot').prop("disabled", true);
      $('#id_kecamatan').prop("disabled", true);
      $('#id_kelurahan').prop("disabled", true);
      // Ajax Provinsi
      $('#id_provinsi').select2({
        dropdownPosition: 'below',
        theme: 'bootstrap',
        language: 'id',
        allowClear: true,
        placeholder: 'Pilih Provinsi',
        ajax: {
          dataType: 'json',
          delay: 0,
          url: "<?= site_url('services/provinsi') ?>",
          beforeSend: function() {
            $('#id_kabkot').prop("disabled", true);
            $('#id_kecamatan').prop("disabled", true);
            $('#id_kelurahan').prop("disabled", true);
          },
          data: function(params) {
            return {
              s: params.term
            }
          },
          processResults: function (data, page) {
            return {
              results: data
            };
          },
          error: function() {
            $('#id_kabkot').prop("disabled", true);
            $('#id_kecamatan').prop("disabled", true);
            $('#id_kelurahan').prop("disabled", true);
          },
          cache: true
        }
      }).on('select2:select', function() {
        $('#id_kabkot').prop("disabled", false);
      });
      // Ajax Kabupaten Kota
      $('#id_kabkot').select2({
        theme: 'bootstrap',
        allowClear: true,
        placeholder: 'Pilih Kab/Kota',
        ajax: {
          dataType: 'json',
          delay: 0,
          url: "<?= site_url('services/kab_kota') ?>",
          beforeSend: function() {
            $('#id_kecamatan').prop("disabled", true);
            $('#id_kelurahan').prop("disabled", true);
          },
          data: function(params) {
            return {
              s: params.term,
              q: $("#id_provinsi").val()
            }
          },
          processResults: function (data, page) {
            return {
              results: data
            };
          },
          error: function() {
            $('#id_kecamatan').prop("disabled", true);
            $('#id_kelurahan').prop("disabled", true);
          },
          cache: true
        }
      }).on('select2:select', function () {
        $('#id_kecamatan').prop("disabled", false);
      });
      // Ajax Kecamatan
      $('#id_kecamatan').select2({
        theme: 'bootstrap',
        allowClear: true,
        placeholder: 'Pilih Kecamatan',
        ajax: {
          dataType: 'json',
          delay: 0,
          url: "<?= site_url('services/kecamatan') ?>",
          beforeSend: function() {
            $('#id_kelurahan').prop("disabled", true);
          },
          data: function(params) {
            return {
              s: params.term,
              q: $("#id_kabkot").val()
            }
          },
          processResults: function (data, page) {
            return {
              results: data
            };
          },
          error: function() {
            $('#id_kelurahan').prop("disabled", true);
          },
          cache: true
        }
      }).on('select2:select', function () {
        $('#id_kelurahan').prop("disabled", false);
      });
    });
</script>