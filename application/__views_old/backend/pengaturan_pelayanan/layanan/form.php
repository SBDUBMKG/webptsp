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

<form class="form-horizontal" method="post" enctype="multipart/form-data">
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Layanan * </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="layanan" value="<?php echo empty($detail['layanan']) ? NULL : $detail['layanan']; ?>" max_length="200" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Layanan En* </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="layanan_en" value="<?php echo empty($detail['layanan_en']) ? NULL : $detail['layanan_en']; ?>" max_length="200" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">level </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="number" class="form-control" name="level" value="<?php echo empty($detail['level']) ? NULL : $detail['level']; ?>" max_length="50">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Layanan * </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control cmb_select2" id="id_jenis_layanan" name="id_jenis_layanan" required>
                                <option value=""> - Pilih Jenis Layanan - </option>
                                <?php
                                $list_jenis_layanan = $this->global_model->get_list('m_jenis_layanan');
                                foreach ( $list_jenis_layanan as $dt ) {
                                    $selected = $dt->id_jenis_layanan == (empty($detail['id_jenis_layanan']) ? NULL : $detail['id_jenis_layanan']) ? 'selected' : NULL;
                                    ?>
                                    <option value="<?php echo $dt->id_jenis_layanan; ?>" <?php echo $selected; ?>><?php echo $dt->jenis_layanan; ?></option>
                                    <?php
                                }
                                ?>       
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Parent * </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control cmb_select2" id="id_parent" name="id_parent" required>
                                <option value=""> - Pilih Parent - </option>
                                <?php
                                $list_parent = $this->global_model->get_list('m_layanan');
                                foreach ( $list_parent as $dt ) {
                                    $selected = $dt->id_layanan == (empty($detail['id_parent']) ? NULL : $detail['id_parent']) ? 'selected' : NULL;
                                    ?>
                                    <option value="<?php echo $dt->id_layanan; ?>" <?php echo $selected; ?>><?php echo $dt->layanan; ?></option>
                                    <?php
                                }
                                ?>       
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sebuah Produk</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <label class="radio-inline"><input type="radio" value="1" name="is_produk" <?php echo isset($detail['is_produk']) && $detail['is_produk'] == 1 ? 'checked' : NULL; ?>> Ya</label>
                            <label class="radio-inline"><input type="radio" value="0" name="is_produk" <?php echo isset($detail['is_produk']) && $detail['is_produk'] == 0 || empty($detail['is_produk']) ? 'checked' : NULL; ?>> Tidak</label>
                        </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Icon</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="file" class="form-control" name="icon" value="<?php echo empty($detail['icon']) ? NULL : $detail['icon']; ?>">
			    <!-- Tambah keterangan gambar -->
			    <span><small class="label bg-red"><em>* WARNING</em></small></span><br>
			    <span><small class="label bg-blue"><em>* jenis file yang dapat diupload : ekstensi pdf | doc | png | jpg | gif</em></small></span><br>
			    <span><small class="label bg-blue"><em>* Dimensi Gambar Maksimal : 428 x 430 piksel</em></small></span><br>
			    <span><small class="label bg-blue"><em>* Dimensi Gambar Maksimal : 30 Mb</em></small></span>
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

<!-- line 51 : 
     mengubah : <select class="form-control cmb_select2" id="id_jenis_layanan" name="id_jenis_layanan">
	 menjadi  : <select class="form-control cmb_select2" id="id_jenis_layanan" name="id_jenis_layanan" required>
	 Perubahan dilakukan oleh : Nurhayati Rahayu (14/10/2019) 
-->
<!-- line 68 : 
     mengubah : <select class="form-control cmb_select2" id="id_parent" name="id_parent">
	 menjadi  : <select class="form-control cmb_select2" id="id_parent" name="id_parent" required>
	 Perubahan dilakukan oleh : Nurhayati Rahayu (14/10/2019) 
-->
<!-- line 93-97 : Penambahan keterangan gambar. Perubahan dilakukan oleh : Nurhayati Rahayu (14/10/2019) -->
