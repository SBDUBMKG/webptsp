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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Event<span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input id="date" style="padding: 3px 0;" type="date" data-date-format="yyyy-mm-dd" value="<?php echo empty($detail['expired_date']) || $detail['expired_date'] == '0000-00-00' ? date('Y-m-d'): date('Y-m-d', strtotime($detail['expired_date'])); ?>" name="expired_date" required>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Publish</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                              <?php
                              $tampilkan_menu = isset($detail['is_publish']) ? $detail['is_publish'] : 1;
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

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" /> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script> -->
<script type="text/javascript">
  <?php

  $tm = empty($detail['created_date']) ? time(): strtotime($detail['created_date']);
  $y = date('Y', $tm);
  $m = date('n', $tm)-1;
  $d = date('j', $tm)+1;
  ?>
  var year = <?php echo json_encode($y) ?>;
  var month = <?php echo json_encode($m) ?>;
  var date = <?php echo json_encode($d) ?>;
    $(function () {
        $('#isi').summernote();
        $('#isi_en').summernote();
        $('#date1').datepicker({
            autoclose: true,
            onSelect: function(dateText) {
                // $sD = new Date(dateText);
                // $("input#DateTo").datepicker('option', 'minDate', min);
                console.log(1);
            },
            startDate:new Date(year,month,date) //month is 0-11
        });
    });
</script>
