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
                               <input type="text" class="form-control" name="judul" value="<?php echo empty($detail['judul']) ? NULL : $detail['judul']; ?>" max_length="100">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Tautan</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_jenis_tautan" name="id_jenis_tautan" required >
                                    <option value=""> - Pilih Jenis Tautan - </option>
                                    <?php
                                    $list_jenis_tautan = $this->global_model->get_list('m_jenis_tautan');
                                    foreach ( $list_jenis_tautan as $jenis_tautan ) {
                                        $selected = $jenis_tautan->id_jenis_tautan == (empty($detail['id_jenis_tautan']) ? NULL : $detail['id_jenis_tautan']) ? 'selected' : NULL;
                                        ?>
                                        <option value="<?php echo $jenis_tautan->id_jenis_tautan; ?>" <?php echo $selected; ?>><?php echo $jenis_tautan->jenis_tautan; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Link</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="link" value="<?php echo empty($detail['link']) ? NULL : $detail['link']; ?>" max_length="250">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Gambar</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="file" class="form-control" name="gambar">
                        
                       	       <!-- Tambah ekstensi gambar -->
                               <span><small class="label bg-red"><em>* WARNING</em></small></span>
                               <br>
			       <span><small class="label bg-blue"><em>* jenis file yang dapat diupload : ekstensi GIF | JPG | PNG</em></small></span><br>
			       <span><small class="label bg-blue"><em>* Dimensi Gambar Maksimal : 300 x 160 piksel</em></small></span><br>
			       <span><small class="label bg-blue"><em>* Dimensi Gambar Maksimal : 1 mb</em></small></span>
			   </div>
                        </div>
                        <div class="form-group">
                        <!-- Ganti urutan jadi urutan menu -->
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Urutan Menu</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="urutan" value="<?php echo empty($detail['urutan']) ? NULL : $detail['urutan']; ?>" max_length="250">
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

<<!-- 
line 74 : menambahkan baris perintah : <span><small class="label bg-blue"><em>* jenis file yang dapat diupload : ekstensi GIF | JPG | PNG</em></small></span><br>
line 75 : menambahkan baris perintah : <span><small class="label bg-blue"><em>* Dimensi Gambar Maksimal : 300 x 160 piksel</em></small></span><br>
line 76 : menambahkan baris perintah : <span><small class="label bg-blue"><em>* Dimensi Gambar Maksimal : 1 mb</em></small></span>
Perubahan dilakukan oleh : Nurhayati Rahayu (14/10/2019) -->
