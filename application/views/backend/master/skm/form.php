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
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $title; ?></h3>
                </div>
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
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Tahun <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="tahun" value="<?php echo empty($detail['tahun']) ? NULL : $detail['tahun']; ?>" max_length="255" required>
                           </div>
                        </div>
                        <?php if ( !empty($detail['file']) ) : ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Current File</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <a href="<?php echo base_url().$detail['file']; ?>" target="_blank"><?php echo $detail['file']; ?></a>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">File <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="file" class="form-control" name="file" accept="application/pdf, application/vnd.ms-excel, application/msword">
                           </div>
                        </div>
                    </div>
                    <div class="box-footer" style="text-align: center;">
                        <button type="button" class="btn btn-primary" onclick="<?php echo $url_back; ?>">Kembali</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
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