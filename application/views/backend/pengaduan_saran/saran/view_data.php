<?php
//file: application\views\backend\pengaduan_saran\saran\view_data.php
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
                    <h3 class="box-title">Saran</h3>
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
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                            <?php echo empty($detail['nama']) ? NULL : $detail['nama']; ?>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                           <?php echo empty($detail['email']) ? NULL : $detail['email']; ?>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Saran</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                              <?php echo empty($detail['saran']) ? NULL : nl2br($detail['saran']); ?>
                           </div>
                        </div>

                        <h4 class="box-title">Tanggapi Saran</h4>
                        <hr>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Response</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <?php echo empty($detail['response']) ? NULL : nl2br($detail['response']); ?>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Dipublikasikan</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                            <?php   $detail['is_publish'] == 1 ? echo 'Ya' :  echo 'Tidak';?>
                            
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