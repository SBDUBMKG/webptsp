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
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori Menu</label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control cmb_select2" id="id_kategori_menu" name="id_kategori_menu">
                              <option value=""> - Pilih Kategori - </option>
                              <?php
                              $list_kategori = $this->global_model->get_list('tbl_kategori_menu_frontend','is_show=1');
                              foreach ( $list_kategori as $dt ) {
                                  $selected = $dt->id_kategori_menu == (empty($detail['id_kategori_menu']) ? NULL : $detail['id_kategori_menu']) ? 'selected' : NULL;
                                  ?>
                                  <option value="<?php echo $dt->id_kategori_menu; ?>" <?php echo $selected; ?>><?php echo $dt->kategori_menu.' ( '.$dt->kategori_menu_en.' ) '; ?></option>
                                  <?php
                              }
                              ?>       
                          </select>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Menu <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="menu" value="<?php echo empty($detail['menu']) ? NULL : $detail['menu']; ?>" max_length="255" required>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Menu En <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="menu_en" value="<?php echo empty($detail['menu_en']) ? NULL : $detail['menu_en']; ?>" max_length="255" required>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipe Menu</label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control cmb_select2" id="tipe_menu" name="tipe_menu">
                              <option value=""> - Pilih Tipe - </option>
                              <option value="1" <?php echo !empty($detail['link_file']) ? 'selected' : NULL ?>>Link File</option>
                              <option value="2" <?php echo !empty($detail['link_file']) ? NULL : (!empty($detail['rte']) ? 'selected' : NULL) ?>>Halaman</option>
                          </select>
                         </div>
                      </div>
                      <div class="form-group box_cname">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Controller <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" id="cname" name="cname" value="<?php echo empty($detail['cname']) ? NULL : $detail['cname']; ?>" max_length="100" required>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat Url <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" id="uri" name="uri" value="<?php echo empty($detail['uri']) ? NULL : $detail['uri']; ?>" max_length="255" required>
                         </div>
                      </div>
                      <div class="form-group linkfile">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Link File</label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control cmb_select2" id="link_file" name="link_file">
                              <option value=""> - Pilih File - </option>
                              <?php
                              $list_file = $this->global_model->get_list('tbl_file_menu');
                              foreach ( $list_file as $dt ) {
                                  $selected = $dt->id == (empty($detail['link_file']) ? NULL : $detail['link_file']) ? 'selected' : NULL;
                                  ?>
                                  <option value="<?php echo $dt->id; ?>" <?php echo $selected; ?>><?php echo $dt->nama_file; ?></option>
                                  <?php
                              }
                              ?>       
                          </select>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-6">Urutan Menu<span class="required">*</span></label>
                         <div class="col-md-3 col-sm-3 col-xs-6">
                             <input type="number" class="form-control is_integer" name="urutan" value="<?php echo empty($detail['urutan']) ? NULL : $detail['urutan']; ?>" required>
                         </div>
                      </div>                      
                      <div class="form-group halaman">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Halaman <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="nama_halaman" value="<?php echo empty($detail['nama_halaman']) ? NULL : $detail['nama_halaman']; ?>" max_length="255">
                         </div>
                      </div>
                      <div class="form-group halaman">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Isi Halaman <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <textarea id="rte" name="rte" rows="10" cols="80"><?php echo empty($detail['text_rte']) ? ' - ' : $detail['text_rte']; ?></textarea>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Publish</label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                            <?php
                            $tampilkan_menu = isset($detail['tampilkan_menu']) ? $detail['tampilkan_menu'] : 1; 
                            ?>
                             <label class="radio-inline"><input type="radio" name="tampilkan_menu" value="1" <?php echo $tampilkan_menu == 1 ? 'checked' : NULL; ?>>Ya</label>
                             <label class="radio-inline"><input type="radio" name="tampilkan_menu" value="0" <?php echo $tampilkan_menu == 0 ? 'checked' : NULL; ?>>Tidak</label>
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
        $('#rte').summernote();
        $(".textarea").wysihtml5();
        $('.datepicker').datepicker({
            autoclose: true
        });
        $('.cmb_select2').select2({
            theme: 'bootstrap'
        });

        var val_tipe_menu = $('#tipe_menu').select2().val();
        switch (parseInt(val_tipe_menu)) {
        case 1:
          $('.linkfile').show();
          $('.halaman').hide();
        break;
        case 2:
          $('.halaman').show();
          $('.linkfile').hide();
        break;
        }
        var last_tipe_menu = 0;
        $('#tipe_menu').change(function(){
          var val_tipe_menu_selected = $('#tipe_menu').select2().val();
          switch (parseInt(val_tipe_menu_selected)) {
          case 1:
            $('.linkfile').show();
            $('.halaman').hide();
            $('.box_cname').hide();
            $('#uri').removeAttr('readonly');
            $('#cname').val('show');
            $('#uri').val('show/show_pdf?link_file='+$('#link_file').val());
            last_tipe_menu = parseInt(val_tipe_menu_selected);
          break;
          case 2:
            $('.halaman').show();
            $('.linkfile').hide();
            $('.box_cname').hide();
            $('#uri').attr('readonly', 'readonly');
            $('#uri').val('show/show_halaman?halaman=<?php echo $new_rte_id; ?>');
            $('#cname').val('show');
            last_tipe_menu = parseInt(val_tipe_menu_selected);
          break;
          default:
            $('.linkfile').hide();
            $('.halaman').hide();
            $('.box_cname').show();
            $('#uri').removeAttr('readonly');
            if ( last_tipe_menu == 1 || last_tipe_menu == 2 ) {
              $('#cname').val('');
              $('#uri').val('');
            }
            last_tipe_menu = parseInt(val_tipe_menu_selected);
          break;
          }
        });
        $('#link_file').change(function() {
          var tipe_halaman = $('#tipe_menu').val();
          if ( tipe_halaman == 1 ) {
            $('#uri').val('show/show_pdf?link_file='+$(this).val());
          }
        });
        $('#tipe_menu').change();
    });
</script>

<!-- line 83 : mengubah kalimat "Uri" menjadi "Alamat Url". Perubahan dilakukan oleh : Nurhayati Rahayu (14/10/2019) -->