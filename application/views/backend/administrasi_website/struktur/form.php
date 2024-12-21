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
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Profil Ind</label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <textarea class="textarea" name="profil" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['profil']) ? NULL : $detail['profil']; ?></textarea>
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Profil En</label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <textarea class="textarea" name="profil_en" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['profil_en']) ? NULL : $detail['profil_en']; ?></textarea>
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Struktur Organisasi Ind</label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <input class="form-control" type="file" id="struktur_organisasi" name="struktur_organisasi">
                       <!--
                       <input type="text" class="form-control" name="struktur_organisasi" value="<?php echo empty($detail['struktur_organisasi']) ? NULL : $detail['struktur_organisasi']; ?>" max_length="255">
                       -->
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Struktur Organisasi En</label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <input class="form-control" type="file" id="struktur_organisasi_en" name="struktur_organisasi_en">
                       <!--
                       <input type="text" class="form-control" name="struktur_organisasi_en" value="<?php echo empty($detail['struktur_organisasi_en']) ? NULL : $detail['struktur_organisasi_en']; ?>" max_length="255">
                       -->
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