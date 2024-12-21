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
                    		 <input class="datepicker" data-date-format="yyyy-mm-dd" value="<?php echo empty($detail['tanggal']) || $detail['tanggal'] == '0000-00-00' ? NULL : $detail['tanggal']; ?>" name="tanggal" readonly="readonly" required>
                    	     </div>
                 	 </div>
                     </div>
		     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">no_permohonan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="no_permohonan" value="<?php echo empty($detail['no_permohonan']) ? NULL : $detail['no_permohonan']; ?>" required>
                        </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">layanan <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="layanan" value="<?php echo empty($detail['layanan']) ? NULL : $detail['layanan']; ?>" max_length="100 required>
                         </div>
                     </div>
		     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">nama_pelanggan <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="nama" value="<?php echo empty($detail['nama']) ? NULL : $detail['nama']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Pekerjaan <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="pekerjaan" value="<?php echo empty($detail['pekerjaan']) ? NULL : $detail['pekerjaan']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Usia <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="usia" value="<?php echo empty($detail['usia']) ? NULL : $detail['usia']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Perusahaan <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="perusahaan" value="<?php echo empty($detail['perusahaan']) ? NULL : $detail['perusahaan']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="jenis_kelamin" value="<?php echo empty($detail['jenis_kelamin']) ? NULL : $detail['jenis_kelamin']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 1 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey1" value="<?php echo empty($detail['survey1']) ? NULL : $detail['survey1']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 2 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey2" value="<?php echo empty($detail['survey2']) ? NULL : $detail['survey2']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 3 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey3" value="<?php echo empty($detail['survey3']) ? NULL : $detail['survey3']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 4 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey4" value="<?php echo empty($detail['survey4']) ? NULL : $detail['survey4']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 5 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey5" value="<?php echo empty($detail['survey5']) ? NULL : $detail['survey5']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 6 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey6" value="<?php echo empty($detail['survey6']) ? NULL : $detail['survey6']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 7 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey7" value="<?php echo empty($detail['survey7']) ? NULL : $detail['survey7']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 8 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey8" value="<?php echo empty($detail['survey8']) ? NULL : $detail['survey8']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 9 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey9" value="<?php echo empty($detail['survey9']) ? NULL : $detail['survey9']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 10 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey10" value="<?php echo empty($detail['survey10']) ? NULL : $detail['survey10']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 11 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey11" value="<?php echo empty($detail['survey11']) ? NULL : $detail['survey11']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 12 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey12" value="<?php echo empty($detail['survey12']) ? NULL : $detail['survey12']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 13 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey13" value="<?php echo empty($detail['survey13']) ? NULL : $detail['survey13']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 14 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey14" value="<?php echo empty($detail['survey14']) ? NULL : $detail['survey14']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 15 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey15" value="<?php echo empty($detail['survey15']) ? NULL : $detail['survey15']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 16 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey16" value="<?php echo empty($detail['survey16']) ? NULL : $detail['survey16']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 17 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey17" value="<?php echo empty($detail['survey17']) ? NULL : $detail['survey17']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 18 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey18" value="<?php echo empty($detail['survey18']) ? NULL : $detail['survey18']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 19 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey19" value="<?php echo empty($detail['survey19']) ? NULL : $detail['survey19']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Survey 20 <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="survey20" value="<?php echo empty($detail['survey20']) ? NULL : $detail['survey20']; ?>" required>
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