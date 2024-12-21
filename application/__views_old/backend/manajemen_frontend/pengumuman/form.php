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
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul Ind <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="judul" value="<?php echo empty($detail['judul']) ? NULL : $detail['judul']; ?>" max_length="255" required>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul En <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="judul_en" value="<?php echo empty($detail['judul_en']) ? NULL : $detail['judul_en']; ?>" max_length="255" required>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Isi Ind <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <textarea class="textarea" id="isi" name="isi" required style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['isi']) ? NULL : $detail['isi']; ?></textarea>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Isi En <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <textarea class="textarea" id="isi_en" name="isi_en" required style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['isi_en']) ? NULL : $detail['isi_en']; ?></textarea>
                         </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Selesai <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input class="datepicker" data-date-format="yyyy-mm-dd" value="<?php echo empty($detail['expired_date']) || $detail['expired_date'] == '0000-00-00' ? NULL : $detail['expired_date']; ?>" name="expired_date" readonly="readonly" required>
                          </div>
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
    $(function () {
        $('#isi').summernote();
        $('#isi_en').summernote();
        $('.datepicker').datepicker({
            autoclose: true
        });
    });
</script>