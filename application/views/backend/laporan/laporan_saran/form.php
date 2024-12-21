<?php
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
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal <span class="required">*</span></label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input class="datepicker" data-date-format="yyyy-mm-dd" value="<?php echo empty($detail['waktu_saran']) || $detail['waktu_saran'] == '0000-00-00' ? NULL : $detail['waktu_saran']; ?>" name="waktu_saran" readonly="readonly" required>
                    </div>
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama <span class="required">*</span></label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="text" class="form-control" name="nama" value="<?php echo empty($detail['nama']) ? NULL : $detail['nama']; ?>" required>
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="text" class="form-control" name="email" value="<?php echo empty($detail['email']) ? NULL : $detail['email']; ?>" required>
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Saran <span class="required">*</span></label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="text" class="form-control is_integer" name="saran" value="<?php echo empty($detail['saran']) ? NULL : $detail['saran']; ?>" required>
                   </div>
                </div><div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Response <span class="required">*</span></label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="text" class="form-control" name="response" value="<?php echo empty($detail['response']) ? NULL : $detail['response']; ?>" required>
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