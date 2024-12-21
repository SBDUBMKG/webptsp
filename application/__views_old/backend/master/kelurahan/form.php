<?php
// file: application\views\backend\master\kelurahan\form.php

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
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Provinsi <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <select class="form-control cmb_select2" id="id_provinsi" name="id_provinsi" required>
                               <option value=""> - Pilih Provinsi - </option>
                               <?php
                               $list_provinsi = $this->global_model->get_list('m_provinsi');
                               foreach ( $list_provinsi as $provinsi ) {
                                   $selected = $provinsi->id_provinsi == (empty($detail['id_provinsi']) ? NULL : $detail['id_provinsi']) ? 'selected' : NULL;
                                   ?>
                                   <option value="<?php echo $provinsi->id_provinsi; ?>" <?php echo $selected; ?>><?php echo $provinsi->provinsi; ?></option>
                                   <?php
                               }
                                                ?>       </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Kabupaten/Kota <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <select class="form-control cmb_select2" id="id_kabkot" name="id_kabkot" required>
                               <option value=""> - Pilih Kabkot - </option>
                               <?php
                               $list_kabkot = $this->global_model->get_list('m_kabkot');
                               foreach ( $list_kabkot as $kabkot ) {
                                   $selected = $kabkot->id_kabkot == (empty($detail['id_kabkot']) ? NULL : $detail['id_kabkot']) ? 'selected' : NULL;
                                   ?>
                                   <option value="<?php echo $kabkot->id_kabkot; ?>" <?php echo $selected; ?>><?php echo $kabkot->kabkot; ?></option>
                                   <?php
                               }
                                                ?>       </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Kecamatan <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <select class="form-control cmb_select2" id="id_kecamatan" name="id_kecamatan" required>
                               <option value=""> - Pilih Kecamatan - </option>
                               <?php
                               $list_kecamatan = $this->global_model->get_list('m_kecamatan');
                               foreach ( $list_kecamatan as $kecamatan ) {
                                   $selected = $kecamatan->id_kecamatan == (empty($detail['id_kecamatan']) ? NULL : $detail['id_kecamatan']) ? 'selected' : NULL;
                                   ?>
                                   <option value="<?php echo $kecamatan->id_kecamatan; ?>" <?php echo $selected; ?>><?php echo $kecamatan->kecamatan; ?></option>
                                   <?php
                               }
                                                ?>       </select>
                           </div>
                        </div>
                <div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelurahan <span class="required">*</span></label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="text" class="form-control" name="kelurahan" value="<?php echo empty($detail['kelurahan']) ? NULL : $detail['kelurahan']; ?>" max_length="100" required>
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Pos <span class="required">*</span></label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="text" class="form-control is_integer" name="kode_pos" value="<?php echo empty($detail['kode_pos']) ? NULL : $detail['kode_pos']; ?>" required>
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
        $('#id_provinsi').change(function() {
          set_loader_select2('id_kabkot');
          $.ajax({
              type: "GET",
	      dataType: "json",	
              url: base_url + "services/get_data_kabkot?id_provinsi="+$(this).val(),
              success: function(msg) {
                  var data = msg;
                  var result = data.result;
                  set_option_select2('id_kabkot', result, ' - Pilih Kabkot - ', 'id_kabkot', 'kabkot');
              },
              error: function(xhr, msg, e) {
                  console.log(xhr.responseText);
              }
          });
        });
        $('#id_kabkot').change(function() {
          set_loader_select2('id_kecamatan');
          $.ajax({
              type: "GET",
	      dataType: "json",	
              url: base_url + "services/get_data_kecamatan?id_kabkot="+$(this).val(),
              success: function(msg) {
                  var data = msg;
                  var result = data.result;
                  set_option_select2('id_kecamatan', result, ' - Pilih Kecamatan - ', 'id_kecamatan', 'kecamatan');
              },
              error: function(xhr, msg, e) {
                  console.log(xhr.responseText);
              }
          });
        });
    });
</script>

<!-- line 35 :
     mengubah : <label class="control-label col-md-3 col-sm-3 col-xs-12">Provinsi</label>
     menjadi  : <label class="control-label col-md-3 col-sm-3 col-xs-12">Provinsi<span class="required">*</span></label>
     perubahan dilakukan oleh : Nurhayati Rahayu (18/10/2019)
-->
<!-- line 37 :
     mengubah : <select class="form-control cmb_select2" id="id_provinsi" name="id_provinsi">
     menjadi  : <select class="form-control cmb_select2" id="id_provinsi" name="id_provinsi" required>
     perubahan dilakukan oleh : Nurhayati Rahayu (18/10/2019)
-->
<!-- line 51 :
     mengubah : <label class="control-label col-md-3 col-sm-3 col-xs-12">Kabkot </label>
     menjadi  : <label class="control-label col-md-3 col-sm-3 col-xs-12">Kabupaten/Kota <span class="required">*</span></label>
     perubahan dilakukan oleh : Nurhayati Rahayu (18/10/2019)
-->
<!-- line 53 :
     mengubah : <select class="form-control cmb_select2" id="id_kabkot" name="id_kabkot">
     menjadi  : <select class="form-control cmb_select2" id="id_kabkot" name="id_kabkot" required>
     perubahan dilakukan oleh : Nurhayati Rahayu (18/10/2019)
-->
<!-- line 67 :
     mengubah : <label class="control-label col-md-3 col-sm-3 col-xs-12">Kecamatan </label>
     menjadi  : <label class="control-label col-md-3 col-sm-3 col-xs-12">Kecamatan <span class="required">*</span></label>
     perubahan dilakukan oleh : Nurhayati Rahayu (18/10/2019)
-->
<!-- line 69 :
     mengubah : <select class="form-control cmb_select2" id="id_kecamatan" name="id_kecamatan">
     menjadi  : <select class="form-control cmb_select2" id="id_kecamatan" name="id_kecamatan" required>
     perubahan dilakukan oleh : Nurhayati Rahayu (18/10/2019)
-->
<!-- line 118 :
     penambahan baris perintah : dataType: "json",
     perubahan dilakukan oleh : Harmaji Aribowo (18/10/2019)
-->
<!-- line 121 :
     mengubah : var data = JSON.parse(msg)
     menjadi  : var data = msg
     perubahan dilakukan oleh : Harmaji Aribowo (18/10/2019)
-->
<!-- line 134 :
     penambahan baris perintah : dataType: "json",
     perubahan dilakukan oleh : Harmaji Aribowo (18/10/2019)
-->
<!-- line 137 :
     mengubah : var data = JSON.parse(msg)
     menjadi  : var data = msg
     perubahan dilakukan oleh : Harmaji Aribowo (18/10/2019)
-->

