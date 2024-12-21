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
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Layanan</label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control cmb_select2" id="id_jenis_layanan" name="id_jenis_layanan" >
                            <option value=""> - Pilih Jenis Layanan - </option>
                            <?php
                            $list_jenis_layanan = $this->global_model->get_list('m_jenis_layanan');
                            foreach ( $list_jenis_layanan as $jenis_layanan ) {
                              $selected = $jenis_layanan->id_jenis_layanan == (empty($detail['id_jenis_layanan']) ? NULL : $detail['id_jenis_layanan']) ? 'selected' : NULL;
                            ?>
                            <option value="<?php echo $jenis_layanan->id_jenis_layanan; ?>" <?php echo $selected; ?>><?php echo $jenis_layanan->jenis_layanan; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Permintaan Layanan</label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control cmb_select2" id="id_jenis_permintaan_layanan" name="id_jenis_permintaan_layanan" >
                            <option value=""> - Pilih Jenis Permintaan Layanan - </option>
                            <?php
                            $list_jenis_permintaan_layanan = $this->global_model->get_list('m_jenis_permintaan_layanan');
                            foreach ( $list_jenis_permintaan_layanan as $jenis_permintaan_layanan ) {
                              $selected = $jenis_permintaan_layanan->id_jenis_permintaan_layanan == (empty($detail['id_jenis_permintaan_layanan']) ? NULL : $detail['id_jenis_permintaan_layanan']) ? 'selected' : NULL;
                            ?>
                            <option value="<?php echo $jenis_permintaan_layanan->id_jenis_permintaan_layanan; ?>" <?php echo $selected; ?>><?php echo $jenis_permintaan_layanan->jenis_permintaan_layanan; ?></option>
                            <?php
                            }
                            ?>
                            </select>
                          </div>
                        </div>
                <div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Unsur Layanan</label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <select class="form-control cmb_select2" id="id_jenis_unsur_layanan" name="id_jenis_unsur_layanan" >
                       <option value=""> - Pilih Jenis Unsur Layanan - </option>
                       <?php
                       $list_jenis_unsur_layanan = $this->global_model->get_list('m_jenis_unsur_layanan');
                       foreach ( $list_jenis_unsur_layanan as $jenis_unsur_layanan ) {
                           $selected = $jenis_unsur_layanan->id_jenis_unsur_layanan == (empty($detail['id_jenis_unsur_layanan']) ? NULL : $detail['id_jenis_unsur_layanan']) ? 'selected' : NULL;
                           ?>
                           <option value="<?php echo $jenis_unsur_layanan->id_jenis_unsur_layanan; ?>" <?php echo $selected; ?>><?php echo $jenis_unsur_layanan->jenis_unsur_layanan; ?></option>
                           <?php
                       }
                                        ?>       </select>
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Informasi Layanan</label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <select class="form-control cmb_select2" id="id_jenis_informasi_layanan" name="id_jenis_informasi_layanan" >
                       <option value=""> - Pilih Jenis Informasi Layanan - </option>
                       <?php
                       $list_jenis_informasi_layanan = $this->global_model->get_list('m_jenis_informasi_layanan');
                       foreach ( $list_jenis_informasi_layanan as $jenis_informasi_layanan ) {
                           $selected = $jenis_informasi_layanan->id_jenis_informasi_layanan == (empty($detail['id_jenis_informasi_layanan']) ? NULL : $detail['id_jenis_informasi_layanan']) ? 'selected' : NULL;
                           ?>
                           <option value="<?php echo $jenis_informasi_layanan->id_jenis_informasi_layanan; ?>" <?php echo $selected; ?>><?php echo $jenis_informasi_layanan->jenis_informasi_layanan; ?></option>
                           <?php
                       }
                                        ?>       </select>
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Detail Informasi Layanan</label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="text" class="form-control" name="jenis_detail_informasi_layanan" value="<?php echo empty($detail['jenis_detail_informasi_layanan']) ? NULL : $detail['jenis_detail_informasi_layanan']; ?>" max_length="50">
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan</label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <textarea class="textarea" name="keterangan" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['keterangan']) ? NULL : $detail['keterangan']; ?></textarea>
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Aktivasi</label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <label class="radio-inline"><input type="radio" value="1" name="aktivasi" <?php echo isset($detail['aktivasi']) && $detail['aktivasi'] == 1 ? 'checked' : NULL; ?>> Ya</label>
 <label class="radio-inline"><input type="radio" value="0" name="aktivasi" <?php echo isset($detail['aktivasi']) && $detail['aktivasi'] == 0 && is_numeric($detail['aktivasi']) ? 'checked' : NULL; ?>> Tidak</label>
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