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
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="judul" value="<?php echo empty($detail['judul']) ? NULL : $detail['judul']; ?>" max_length="255">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul En</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="judul_en" value="<?php echo empty($detail['judul_en']) ? NULL : $detail['judul_en']; ?>" max_length="255">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input class="datepicker" data-date-format="yyyy-mm-dd" value="<?php echo empty($detail['tanggal']) || $detail['tanggal'] == '0000-00-00' ? date('Y-m-d') : $detail['tanggal']; ?>" name="tanggal" readonly="readonly" required>
                            </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-3">Jenis Lampiran</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                              <span>
                                <input type="radio" name="jenis_lampiran" id="jenis_lampiran" value=1 data-togglejenislampiran="#toggleJenisLampiran">
                                <label for="jenis_lampiran">File</label>
                              </span>
                              <span>
                                <input type="radio" name="jenis_lampiran" id="jenis_lampiran2" value=2 data-togglejenislampiran="#toggleJenisLampiran">
                                <label for="jenis_lampiran2">Teks</label>
                              </span>
                           </div>
                        </div>
                        <div id="toggleJenisLampiran">
                          <div class="form-group" data-toggleitem=1 style="display: none;">
                             <label class="control-label col-md-3 col-sm-3 col-xs-3">Lampiran</label>
                             <div class="col-md-3 col-sm-3 col-xs-3">
                                 <input type="file" class="form-control" name="lampiran" value="<?php echo empty($detail['lampiran']) ? NULL : $detail['lampiran']; ?>" max_length="255">
                             </div>
                             <div class="col-md-4 col-sm-4 col-xs-4">
                                 <small class="label bg-yellow">*Ukuran file maksimal 30MB </small>&nbsp;<small class="label bg-yellow">Tipe file hanya .pdf</small>
                             </div>
                          </div>
                          <div class="form-group" data-toggleitem=2 style="display: none;">
                             <label class="control-label col-md-3 col-sm-3 col-xs-3">Teks</label>
                             <div class="col-md-9 col-sm-9 col-xs-12">
                                <textarea name="lampiran_text" class="form-control"><?php echo empty($detail['lampiran']) ? NULL : $detail['lampiran']; ?></textarea>
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

    $(document).on("click", "[data-togglejenislampiran]", function(e){
      var target = $(this).data("togglejenislampiran");
      var $target = $(target);
      var targetId = $(this).val();

      $target.find("[data-toggleitem]").hide();
      $target.find("[data-toggleitem]").each(function(){
        var toggleItemNo = $(this).data("toggleitem");
        
        if (targetId==toggleItemNo)
        {
          $(this).show();
        }
      });

      // console.log (val, target)
    });
</script>