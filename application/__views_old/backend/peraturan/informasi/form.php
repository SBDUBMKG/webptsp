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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Bidang</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control cmb_select2" id="id_bidang" name="id_bidang">
                                <option value=""> - Pilih Bidang - </option>
                                <?php
                                $list_bidang = $this->global_model->get_list('tbl_bidang');
                                foreach ( $list_bidang as $dt ) {
                                $selected = $dt->id_bidang == (empty($detail['id_bidang']) ? NULL : $detail['id_bidang']) ? 'selected' : NULL;
                                ?>
                                <option value="<?php echo $dt->id_bidang; ?>" <?php echo $selected; ?>><?php echo $dt->bidang; ?></option>
                                <?php
                                }
                                ?>       
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Informasi <span class="required">*</span></label>
                             <div class="col-md-9 col-sm-9 col-xs-12">
                                 <input type="text" class="form-control" name="informasi" value="<?php echo empty($detail['informasi']) ? NULL : $detail['informasi']; ?>" max_length="255" required>
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Informasi En <span class="required">*</span></label>
                             <div class="col-md-9 col-sm-9 col-xs-12">
                                 <input type="text" class="form-control" name="informasi_en" value="<?php echo empty($detail['informasi_en']) ? NULL : $detail['informasi_en']; ?>" max_length="255" required>
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Isi <span class="required">*</span></label>
                             <div class="col-md-9 col-sm-9 col-xs-12">
                                 <textarea class="textarea" name="isi" id="isi" required style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['isi']) ? NULL : $detail['isi']; ?></textarea>
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Isi En <span class="required">*</span></label>
                             <div class="col-md-9 col-sm-9 col-xs-12">
                                 <textarea class="textarea" name="isi_en" id="isi_en" required style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['isi_en']) ? NULL : $detail['isi_en']; ?></textarea>
                             </div>
                          </div>
                          <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Lampiran <span class="required">*</span></label>
                             <div class="col-md-9 col-sm-9 col-xs-12">
                                 <input type="file" class="form-control" name="lampiran" value="<?php echo empty($detail['lampiran']) ? NULL : $detail['lampiran']; ?>">
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
        $('.cmb_select2').select2({
            theme: 'bootstrap'
        });
    });
</script>