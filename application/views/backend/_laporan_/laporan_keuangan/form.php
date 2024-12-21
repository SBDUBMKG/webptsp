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
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">No Permohonan <span class="required">*</span></label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <select class="form-control cmb_select2" id="id_permohonan" name="id_permohonan" required >
                       <option value=""> - Pilih No Permohonan - </option>
                       <?php
                       $list_no_permohonan = $this->global_model->get_list('tbl_permohonan');
                       foreach ( $list_no_permohonan as $no_permohonan ) {
                           $selected = $no_permohonan->id_permohonan == (empty($detail['id_permohonan']) ? NULL : $detail['id_permohonan']) ? 'selected' : NULL;
                           ?>
                           <option value="<?php echo $no_permohonan->id_permohonan; ?>" <?php echo $selected; ?>><?php echo $no_permohonan->no_permohonan; ?></option>
                           <?php
                       }
                                        ?>       </select>
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Jumlah Lokasi <span class="required">*</span></label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="text" class="form-control is_integer" name="jumlah_lokasi" value="<?php echo empty($detail['jumlah_lokasi']) ? NULL : $detail['jumlah_lokasi']; ?>" required>
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga <span class="required">*</span></label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="text" class="form-control is_integer" name="harga" value="<?php echo empty($detail['harga']) ? NULL : $detail['harga']; ?>" required>
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Bukti <span class="required">*</span></label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="text" class="form-control is_integer" name="bukti" value="<?php echo empty($detail['bukti']) ? NULL : $detail['bukti']; ?>" required>
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span></label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="text" class="form-control" name="status" value="<?php echo empty($detail['status']) ? NULL : $detail['status']; ?>" max_length="255" required>
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