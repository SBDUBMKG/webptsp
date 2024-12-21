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
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Provinsi <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_provinsi" name="id_provinsi" required>
                                    <option value=""> - Pilih Provinsi - </option>
                                    <?php
                                    $list = $this->global_model->get_list('m_provinsi');
                                    foreach ( $list as $dt ) {
                                        $selected = $dt->id_provinsi == (empty($detail['id_provinsi']) ? NULL : $detail['id_provinsi']) ? 'selected' : NULL;
                                        ?>
                                        <option value="<?php echo $dt->id_provinsi; ?>" <?php echo $selected; ?>><?php echo $dt->provinsi; ?></option>
                                        <?php
                                    }
                                    ?>       
                                </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Kabupaten/Kota <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="kabkot" value="<?php echo empty($detail['kabkot']) ? NULL : $detail['kabkot']; ?>" max_length="255" required>
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

<!-- line 38 :
     mengubah : <select class="form-control cmb_select2" id="id_provinsi" name="id_provinsi">
     menjadi  : <select class="form-control cmb_select2" id="id_provinsi" name="id_provinsi" required>
     perubahan dilakukan oleh : Nurhayati Rahayu (18/10/2019)
-->
