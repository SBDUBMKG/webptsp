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
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama File <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="nama_file" value="<?php echo empty($detail['nama_file']) ? NULL : $detail['nama_file']; ?>" max_length="250" required>
                           </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Lampiran</label>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <?php
                                    $current_thumbnail = empty($detail['lampiran']) ? NULL : $detail['lampiran'];
                                    if ( !empty($current_thumbnail) ) {
                                        if ( file_exists('./upload/file_menu/'.$current_thumbnail) ) {
                                        ?>
                                        <a href="<?php echo base_url().'upload/file_menu/'.$current_thumbnail; ?>" target="_blank"><i class="fa fa-search"> Lampiran</i></a>
                                        <?php
                                        }
                                    }
                                ?>
                                <input type="file" class="form-control" name="lampiran" value="<?php echo empty($detail['lampiran']) ? NULL : $detail['lampiran']; ?>" required>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                               <small class="label bg-yellow">*Ukuran file maksimal 30MB </small><br>
                               <small class="label bg-yellow">*File yang diijinkan: pdf|jpg|png|gif|doc|docx|xls|xlsx|ppt|pptx </small>
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
    });
</script>