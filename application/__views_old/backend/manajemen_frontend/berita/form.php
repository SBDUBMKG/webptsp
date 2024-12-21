<?php

/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */

defined('BASEPATH') OR exit('No direct script access allowed');
?>

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
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <?php
                        if ( !empty($errMsg) ) {
                            ?>
                            <div class="alert alert-danger" role="alert"><?php echo $errMsg; ?></div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-6">Jenis Konten</label>
                            <div class="col-md-3 col-sm-3 col-xs-6">
                              <select class="form-control cmb_select2" id="id_jenis_konten" name="id_jenis_konten">
                                  <option value=""> - Pilih Jenis Konten - </option>
                                  <?php
                                  $list_jenis_konten = $this->global_model->get_list('m_jenis_konten');
                                  foreach ( $list_jenis_konten as $key_jk ) {
                                      $selected = $key_jk->id_jenis_konten == (empty($detail['id_jenis_konten']) ? NULL : $detail['id_jenis_konten']) ? 'selected' : NULL;
                                      ?>
                                      <option value="<?php echo $key_jk->id_jenis_konten; ?>" <?php echo $selected; ?>><?php echo $key_jk->jenis_konten;?></option>
                                      <?php
                                  }
                                  ?>       
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul Ind <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="judul" value="<?php echo empty($detail['judul']) ? NULL : $detail['judul']; ?>" max_length="250" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul En <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="judul_en" value="<?php echo empty($detail['judul_en']) ? NULL : $detail['judul_en']; ?>" max_length="250" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Berita <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input class="datepicker" data-date-format="yyyy-mm-dd" value="<?php echo empty($detail['tanggal_berita']) || $detail['tanggal_berita'] == '0000-00-00' ? date('Y-m-d') : $detail['tanggal_berita']; ?>" name="tanggal_berita" readonly="readonly" required>
                            </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Isi Ind<span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea class="input-block-level" id="isi" name="isi" required>
                              <?php echo empty($detail['isi']) ? NULL : $detail['isi']; ?>
                            </textarea>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Isi En<span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea class="input-block-level" id="isi_en" name="isi_en">
                              <?php echo empty($detail['isi_en']) ? NULL : $detail['isi_en']; ?>
                            </textarea>
                           </div>
                        </div>
                        <!-- <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Sumber<span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="sumber" value="<?php echo empty($detail['sumber']) ? NULL : $detail['sumber']; ?>" max_length="250" required>
                           </div>
                        </div> -->
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Thumbnail</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                              <?php
                              $current_thumbnail = empty($detail['thumbnail']) ? NULL : $detail['thumbnail'];
                              if ( !empty($current_thumbnail) ) {
                                if ( file_exists('./upload/thumbnail/'.$current_thumbnail) ) {
                                  ?>
                                  <img src="<?php echo base_url().'upload/thumbnail/'.$current_thumbnail; ?>" style="max-width: 250px;">
                                  <?php
                                }
                              }
                              ?>
                               <input type="file" class="form-control" name="thumbnail" value="<?php echo empty($detail['thumbnail']) ? NULL : $detail['thumbnail']; ?>" max_length="250">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Publish</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="radio">
                              <label><input type="radio" name="is_publish" value="1" <?php if( !empty($detail['is_publish']) ){ if( $detail['is_publish'] == 1 ) { echo "checked"; }} ?> >Ya</label>
                            </div>
                            <div class="radio">
                              <label><input type="radio" name="is_publish" value="0" <?php if( !empty($detail['is_publish']) ){ if( $detail['is_publish'] == 0 ) { echo "checked"; }} ?> >Tidak</label>
                            </div>
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
    $(document).ready(function() {
        $('#isi').summernote({
            height: 200,
            callbacks: {
                onImageUpload : function(files, editor, $editable) {

                     for(var i = files.length - 1; i >= 0; i--) {
                             sendFile(files[i], this,$editable);
                    }
                }
            }
        });

         function sendFile(file,editor,welEditable) {
            data = new FormData();
            data.append("file", file);
             $.ajax({
             url: "<?php echo base_url().$this->module.'/save_image'?>",
             data: data,
             cache: false,
             contentType: false,
             processData: false,
             type: 'POST',
             success: function(data){
             alert(data);
              $('#isi').summernote("insertImage", data, 'filename');
          },
             error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus+" "+errorThrown);
            }
          });
         }

         $('#isi_en').summernote({
            height: 200,
            callbacks: {
                onImageUpload : function(files, editor, $editable) {

                     for(var i = files.length - 1; i >= 0; i--) {
                             sendFile_en(files[i], this,$editable);
                    }
                }
            }
        });

         function sendFile_en(file,editor,welEditable) {
            data = new FormData();
            data.append("file", file);
             $.ajax({
             url: "<?php echo base_url().$this->module.'/save_image'?>",
             data: data,
             cache: false,
             contentType: false,
             processData: false,
             type: 'POST',
             success: function(data){
             alert(data);
              $('#isi_en').summernote("insertImage", data, 'filename');
          },
             error: function(jqXHR, textStatus, errorThrown) {
             console.log(textStatus+" "+errorThrown);
            }
          });
         }

        $('.datepicker').datepicker({
            autoclose: true
        });
        $('.cmb_select2').select2({
            theme: 'bootstrap'
        });
    });
</script>

<!-- line 96-101 : menghilangkan kolom sumber
     perubahan dilakukan oleh : Nurhayati Rahayu (22/10/2019)
-->