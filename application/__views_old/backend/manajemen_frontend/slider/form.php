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
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Link</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="link" value="<?php echo empty($detail['link']) ? NULL : $detail['link']; ?>" max_length="100">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-3">Slider Ind</label>
                           <div class="col-md-3 col-sm-3 col-xs-3">
                                <input type="file" class="form-control" name="slider" value="<?php echo empty($detail['slider']) ? NULL : $detail['slider']; ?>" max_length="100">
								<!-- Tambah keterangan gambar. Perubahan oleh : Nurhayati Rahayu (28/10/2019) -->
								<span><small class="label bg-red"><em>* WARNING</em></small></span><br>
								<span><small class="label bg-blue"><em>* Jenis file yang dapat diupload : ekstensi GIF | JPG | BMP | PNG</em></small></span><br>
								<span><small class="label bg-blue"><em>* Dimensi Gambar Maksimal : 950 x 530 pixel</em></small></span><br>
                                <span><small class="label bg-blue"><em>* Ukuran Gambar Maksimal : 30MB</em></small></span>
								<!-- baris terakhir perbaikan -->
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-3">Slider En</label>
                           <div class="col-md-3 col-sm-3 col-xs-3">
                                <input type="file" class="form-control" name="slider_en" value="<?php echo empty($detail['slider_en']) ? NULL : $detail['slider_en']; ?>" max_length="100">
                                <!-- Tambah keterangan gambar. Perubahan oleh : Nurhayati Rahayu (28/10/2019) -->
								<span><small class="label bg-red"><em>* WARNING</em></small></span><br>
								<span><small class="label bg-blue"><em>* Jenis file yang dapat diupload : ekstensi GIF | JPG | BMP | PNG</em></small></span><br>
								<span><small class="label bg-blue"><em>* Dimensi Gambar Maksimal : 950 x 530 pixel</em></small></span><br>
                                <span><small class="label bg-blue"><em>* Ukuran Gambar Maksimal : 30MB</em></small></span>
								<!-- baris terakhir perbaikan -->
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Publish</label>
                           <div class="col-md-3 col-sm-3 col-xs-3">
                            <div class="radio">
                              <label><input type="radio" name="is_active" value="1" <?php if( !empty($detail['is_active']) ){ if( $detail['is_active'] == 1 ) { echo "checked"; }} ?> >Ya</label>
                            </div>
                            <div class="radio">
                              <label><input type="radio" name="is_active" value="0" <?php if( !empty($detail['is_active']) ){ if( $detail['is_active'] == 0 ) { echo "checked"; }} ?> >Tidak</label>
                            </div>
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