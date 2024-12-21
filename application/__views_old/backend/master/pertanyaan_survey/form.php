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
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Kategori Survey</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <select class="form-control cmb_select2" id="id_kategori_survey" name="id_kategori_survey" required>
                               <option value=""> - Pilih Kategori Survey - </option>
                               <?php
                               $list_kategori_survey = $this->global_model->get_list('m_kategori_survey');
                               foreach ( $list_kategori_survey as $kategori_survey ) {
                                   $selected = $kategori_survey->id_kategori_survey == (empty($detail['id_kategori_survey']) ? NULL : $detail['id_kategori_survey']) ? 'selected' : NULL;
                                   ?>
                                   <option value="<?php echo $kategori_survey->id_kategori_survey; ?>" <?php echo $selected; ?>><?php echo $kategori_survey->kategori_survey; ?></option>
                                   <?php
                               }
                              ?>       
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Pertanyaan Survey</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="pertanyaan_survey" value="<?php echo empty($detail['pertanyaan_survey']) ? NULL : $detail['pertanyaan_survey']; ?>" max_length="255" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Pertanyaan Survey En</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="pertanyaan_survey_en" value="<?php echo empty($detail['pertanyaan_survey_en']) ? NULL : $detail['pertanyaan_survey_en']; ?>" max_length="255" required>
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