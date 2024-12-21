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
<?php                   if ( !empty($errMsg) ) {
?>                          <div class="alert alert-danger" role="alert"><?php echo $errMsg; ?></div>
<?php                   }
?>                      <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Mulai Libur <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                                </div>
                                <input type="date" style="padding: 3px 0;" id="tgl_mulai" value="<?php echo empty($detail['tgl_mulai'])? date('Y-m-d') : date('Y-m-d', strtotime($detail['tgl_mulai'])); ?>" name="tgl_mulai" required>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Akhir Libur <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="date" style="padding: 3px 0;" id="tgl_akhir" value="<?php echo empty($detail['tgl_akhir'])? date('Y-m-d') : date('Y-m-d', strtotime($detail['tgl_akhir'])); ?>" name="tgl_akhir" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan Libur <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                 <textarea class="textarea" id="keterangan" name="keterangan" required style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo isset($detail['keterangan']) ? $detail['keterangan'] : NULL; ?></textarea>
                            </div>
                        </div>
                        <div class="box-footer" style="text-align: center;">
                            <button type="button" class="btn btn-primary" onclick="<?php echo $url_back; ?>">Kembali</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
