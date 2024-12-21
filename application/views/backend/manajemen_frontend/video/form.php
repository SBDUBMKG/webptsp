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
                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
                    <div class="box-body">
                        <?php
                        if ( !empty($errMsg) ) {
                            ?>
                            <div class="alert alert-danger" role="alert"><?php echo $errMsg; ?></div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="judul" value="<?php echo empty($detail['judul']) ? NULL : $detail['judul']; ?>" max_length="255">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="jenis" name="jenis">
                                  <option value="1" <?php if(!empty($detail['jenis'])){if($detail['jenis'] == 1){echo 'selected';}}?> >Embed</option>
                                  <option value="2" <?php if(!empty($detail['jenis'])){if($detail['jenis'] == 2){echo 'selected';}}?> >Upload</option>
                                </select>
                           </div>
                        </div>
                        <div class="form-group embed">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Embed <br><small class="label bg-yellow">Ganti width: 300px; height: 200px</small></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <textarea class="textarea" id='embed' name="embed" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['embed']) ? NULL : $detail['embed']; ?></textarea>
                           </div>
                        </div>
                        <div class="form-group upload">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload <br><small class="label bg-yellow">Video berformat mp4</small></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="file" class="form-control" id="uploadvideo" name="uploadvideo">
                                <?php
                                if(!empty($detail['upload'])){
                                ?>
                                <br>
                                <video width="300" controls>
                                    <source src="<?php echo base_url().'upload/video/'.$detail['upload'];?>">
                                </video>
                                <?php } ?>
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
        $('.cmb_select2').select2({
            theme: 'bootstrap'
        });

        var val_jenis = $('#jenis').select2().val();
        switch (parseInt(val_jenis)) {
        case 1:
          $('.embed').show();
          $('.upload').hide();
        break;
        case 2:
          $('.upload').show();
          $('.embed').hide();
        break;
        }

        $('#jenis').change(function(){
          var val_jenis_selected = $('#jenis').select2().val();
          switch (parseInt(val_jenis_selected)) {
          case 1:
            $('.embed').show();
            $('.upload').hide();
          break;
          case 2:
            $('.upload').show();
            $('.embed').hide();
          break;
          }
        });
    });
</script>