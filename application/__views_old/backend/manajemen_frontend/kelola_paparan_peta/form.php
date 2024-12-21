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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Paparan</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                              <select class="form-control cmb_select2" id="id_jenis_paparan" name="id_jenis_paparan">
                                  <option value=""> - Pilih Jenis Paparan - </option>
                                  <?php
                                  $list_paparan = $this->global_model->get_list('m_jenis_paparan');
                                  foreach ( $list_paparan as $dt ) {
                                      $selected = $dt->id_jenis_paparan == (empty($detail['id_jenis_paparan']) ? NULL : $detail['id_jenis_paparan']) ? 'selected' : NULL;
                                      ?>
                                      <option value="<?php echo $dt->id_jenis_paparan; ?>" <?php echo $selected; ?>><?php echo $dt->jenis_paparan;?></option>
                                      <?php
                                  }
                                  ?>       
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="judul" value="<?php echo empty($detail['judul']) ? NULL : $detail['judul']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Lampiran</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="file" class="form-control" id="lampiran" name="lampiran">
                                <?php
                                if(!empty($detail['lampiran'])){
                                ?>
                                <a href="<?php echo base_url();?>upload/paparan_peta/<?php echo $detail['lampiran'];?>" target="blank"><?php echo $detail['lampiran'];?></a>
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
        // $('#judul').summernote();
        // $('#isi').summernote();

        $(".textarea").wysihtml5();

        $('.datepicker').datepicker({
            autoclose: true
        });
        $('.cmb_select2').select2({
            theme: 'bootstrap'
        });
    });
</script>