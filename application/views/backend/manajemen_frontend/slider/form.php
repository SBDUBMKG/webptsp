<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//var_dump($detail);
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
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $title; ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="box-body">
<?php                   if ( !empty($errMsg) ) {
?>                          <div class="alert alert-danger" role="alert"><?php echo $errMsg; ?></div>
<?php                   }
?>                      <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Title</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="title" value="<?php echo empty($detail['title']) ? NULL : $detail['title']; ?>" max_length="100">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Link</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="link" value="<?php echo empty($detail['link']) ? NULL : $detail['link']; ?>" max_length="100">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-3">Slider Ind</label>
                           <div class="col-md-3 col-sm-3 col-xs-3">
                               <input id="input_img_in" type="file" class="form-control" name="slider" value="<?php echo empty($detail['slider']) ? NULL : $detail['slider']; ?>" max_length="100" onchange="load_img_in(event)">
                           </div>
                           <div class="col-md-4 col-sm-4 col-xs-4">
                               <span><small class="label bg-yellow"><em>* Maks Dimensi File : 1100 x 385 pixel</em></small></span>
                               <span><small class="label bg-red"><em>* Maks Ukuran File : 30MB</em></small></span>
			       <span><small class="label bg-red"><em>* File banner harus berekstensi jpeg|jpg|png|bmp|gif</em></small></span>
                           </div>
                           <div class="col-md-2 col-sm-2 col-xs-2"></div>
                           <div class="col-md-3 col-sm-3 col-xs-3"></div>
                           <div class="col-md-7 col-sm-7 col-xs-7">
<?php                           if(!empty($detail['slider'])) $src_in = base_url().'upload/slider/'.$detail['slider'];else $src_in="#";
?>                              <img id="img_in" src="<?=$src_in?>" class="img-responsive" width="100%" style="padding-top:6px" />
                            </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-3">Slider En</label>
                           <div class="col-md-3 col-sm-3 col-xs-3">
                               <input type="file" class="form-control" name="slider_en" value="<?php echo empty($detail['slider_en']) ? NULL : $detail['slider_en']; ?>" max_length="100" onchange="load_img_en(event)">
                           </div>
                           <div class="col-md-4 col-sm-4 col-xs-4">
                               <span><small class="label bg-yellow"><em>* Maks Dimensi File : 1100 x 385 pixel</em></small></span>
                               <span><small class="label bg-red"><em>* Maks Ukuran File : 30MB</em></small></span>
			       <span><small class="label bg-red"><em>* File banner harus berekstensi jpeg|jpg|png|bmp|gif</em></small></span>
                           </div>
                           <div class="col-md-2 col-sm-2 col-xs-2"></div>
                           <div class="col-md-3 col-sm-3 col-xs-3"></div>
                           <div class="col-md-7 col-sm-7 col-xs-7">
<?php                           if(!empty($detail['slider_en'])) $src_en = base_url().'upload/slider/'.$detail['slider_en'];else $src_en="#";
?>                              <img id="img_en" src="<?=$src_en?>" class="img-responsive" width="100%" style="padding-top:6px" />
                           </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Urutan</label>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <input type="number" class="form-control" name="urutan" value="<?php echo isset($detail['urutan'])?$detail['urutan']:NULL?>"/>
                            </div>

                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Publish</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                              <?php
                              $tampilkan_menu = isset($detail['is_active']) ? $detail['is_active'] : 1;
                              ?>
                               <label class="radio-inline"><input type="radio" name="is_active" value="1" <?php echo $tampilkan_menu == 1 ? 'checked' : NULL; ?>>Ya</label>
                               <label class="radio-inline"><input type="radio" name="is_active" value="0" <?php echo $tampilkan_menu == 0 ? 'checked' : NULL; ?>>Tidak</label>

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

<script>
    const load_img_in = function(event) {
        var img_in = document.getElementById('img_in');
        img_in.src = URL.createObjectURL(event.target.files[0]);
        img_in.onload = function() {
        URL.revokeObjectURL(img_in.src) // free memory
        }
    };

    const load_img_en = function(event) {
        var img_en = document.getElementById('img_en');
        img_en.src = URL.createObjectURL(event.target.files[0]);
        img_en.onload = function() {
            URL.revokeObjectURL(img_en.src) // free memory
        }
    };
</script>
