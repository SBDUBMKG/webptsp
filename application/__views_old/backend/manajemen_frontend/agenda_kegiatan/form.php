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
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Penyelenggara <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="penyelenggara" value="<?php echo empty($detail['penyelenggara']) ? NULL : $detail['penyelenggara']; ?>" max_length="250" required>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Penyelenggara En <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="penyelenggara_en" value="<?php echo empty($detail['penyelenggara_en']) ? NULL : $detail['penyelenggara_en']; ?>" max_length="250" required>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Lokasi <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea class="textarea" name="lokasi" required style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['lokasi']) ? NULL : $detail['lokasi']; ?></textarea>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Lokasi En <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <textarea class="textarea" name="lokasi_en" required style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['lokasi_en']) ? NULL : $detail['lokasi_en']; ?></textarea>
                         </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Mulai <span class="required">*</span></label>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="input-group date datepicker">
                                  <input class="form-control" data-date-format="yyyy-mm-dd" value="<?php echo empty($detail['tgl_mulai']) || preg_match('/1900-01-01/',$detail['tgl_mulai']) ? date('Y-m-d') : $detail['tgl_mulai']; ?>" name="tgl_mulai" required>
                                  <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-calendar">
                                      </span>
                                  </span>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Selesai <span class="required">*</span></label>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="input-group date datepicker">
                                  <input class="form-control" data-date-format="yyyy-mm-dd" value="<?php echo empty($detail['tgl_selesai']) || preg_match('/1900-01-01/',$detail['tgl_selesai']) ? date('Y-m-d') : $detail['tgl_selesai']; ?>" name="tgl_selesai" required>
                                  <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-calendar">
                                      </span>
                                  </span>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">jam</label>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="input-group date jam">
                                  <?php $jam = empty($detail['jam']) ? NULL : $detail['jam']; ?>
                                  <input type="text" name="jam" id="jam" class="form-control" value="<?php echo (empty($jam) ? null : $jam); ?>" />
                                  <span class="input-group-addon">
                                      <span class="glyphicon glyphicon-calendar">
                                      </span>
                                  </span>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Disposisi <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <textarea class="textarea" name="disposisi" required style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['disposisi']) ? NULL : $detail['disposisi']; ?></textarea>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Dihadiri <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <textarea class="textarea" name="dihadiri" required style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['dihadiri']) ? NULL : $detail['dihadiri']; ?></textarea>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <textarea class="textarea" name="keterangan" required style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['keterangan']) ? NULL : $detail['keterangan']; ?></textarea>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan En <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <textarea class="textarea" name="keterangan_en" required style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['keterangan_en']) ? NULL : $detail['keterangan_en']; ?></textarea>
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="file" class="form-control" name="foto" value="<?php echo empty($detail['foto']) ? NULL : $detail['foto']; ?>">
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
        $('#summernote').summernote();
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('.jam').datetimepicker({
            format: "HH:mm"
        });
        $('.cmb_select2').select2({
            theme: 'bootstrap'
        });
    });
</script>