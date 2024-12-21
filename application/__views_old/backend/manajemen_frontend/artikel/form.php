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
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul <span class="required">*</span></label>
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
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input class="datepicker" data-date-format="yyyy-mm-dd" value="<?php echo empty($detail['tanggal']) || $detail['tanggal'] == '0000-00-00' ? date('Y-m-d') : $detail['tanggal']; ?>" name="tanggal" readonly="readonly" required>
                            </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Isi <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                            <textarea class="input-block-level" id="isi" name="isi">
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
                               <input type="file" class="form-control" name="thumbnail" value="<?php echo empty($detail['thumbnail']) ? NULL : $detail['thumbnail']; ?>">
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

<!-- line 76-81 : menghilangkan kolom sumber
     perubahan dilakukan oleh : Nurhayati Rahayu (22/10/2019)
-->