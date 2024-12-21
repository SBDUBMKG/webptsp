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
                    <h3 class="box-title"><?php echo $page_title;?></h3>
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
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama *</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="nama" value="<?php echo empty($detail['nama']) ? NULL : $detail['nama']; ?>" max_length="255" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <textarea class="textarea" name="alamat" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" max_length="65535" required><?php echo empty($detail['alamat']) ? NULL : $detail['alamat']; ?></textarea>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Telepon *</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="number" class="form-control" name="telepon" value="<?php echo empty($detail['telepon']) ? NULL : $detail['telepon']; ?>" max_length="255" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Fax *</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="fax" value="<?php echo empty($detail['fax']) ? NULL : $detail['fax']; ?>" max_length="255" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Email *</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="email" class="form-control" name="email" value="<?php echo empty($detail['email']) ? NULL : $detail['email']; ?>" max_length="255" required>
                           </div>
                        </div>
                        <!-- mengaktifkan kembali kolom peta dan perubahan nama kolom pada form. Perubahan oleh : Nurhayati Rahayu (29/10/2019) -->
			<div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Url Peta *</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="map" value='<?php echo empty($detail['map']) ? NULL : $detail['map']; ?>' max_length="255" required>
                               <?php echo empty($detail['map']) ? NULL : '<br><div class="col-md-4 col-sm-4 col-xs-12">'.$detail['map'].'</div>';?>
                           </div>
                        </div>
			<!-- baris terakhir perbaikan -->
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Publish</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <label class="radio-inline"><input type="radio" value="1" name="is_publish" <?php echo isset($detail['is_publish']) && $detail['is_publish'] == 1 ? 'checked' : NULL; ?>> Ya</label>
                               <label class="radio-inline"><input type="radio" value="0" name="is_publish" <?php echo isset($detail['is_publish']) && $detail['is_publish'] == 0 && is_numeric($detail['is_publish']) ? 'checked' : NULL; ?>> Tidak</label>
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