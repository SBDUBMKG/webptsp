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

<form class="form-horizontal" method="post">
    <section class="content" style="padding:15px 15px 0px 15px;">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $title; ?></h3>
                    </div>

                    <div class="box-body">
                        <?php
                        if ( !empty($errMsg) ) {
                            ?>
                            <div class="alert alert-danger" role="alert"><?php echo $errMsg; ?></div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Layanan</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="jenis_layanan" value="<?php echo empty($detail['jenis_layanan']) ? NULL : $detail['jenis_layanan']; ?>" max_length="100" required>
                        </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <textarea class="textarea" name="keterangan" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['keterangan']) ? NULL : $detail['keterangan']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Publish</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <label class="radio-inline"><input type="radio" value="1" name="aktivasi" <?php echo isset($detail['aktivasi']) && $detail['aktivasi'] == 1 ? 'checked' : NULL; ?>> Ya</label>
                                <label class="radio-inline"><input type="radio" value="0" name="aktivasi" <?php echo isset($detail['aktivasi']) && $detail['aktivasi'] == 0 || empty($detail['aktivasi']) ? 'checked' : NULL; ?>> Tidak</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content" style="padding:0px 15px 0px 15px;">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-footer" style="text-align: center;">
                        <button type="button" class="btn btn-primary" onclick="<?php echo $url_back; ?>">Kembali</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

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