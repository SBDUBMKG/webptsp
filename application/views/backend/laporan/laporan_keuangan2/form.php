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
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Permohonan<span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <div class="input-group date">
                    		 <div class="input-group-addon">
                        	     <i class="fa fa-calendar"></i>
                    		 </div>
                    		 <input class="datepicker" data-date-format="yyyy-mm-dd" value="<?php echo empty($detail['tanggal_permohonan']) || $detail['tanggal_permohonan'] == '0000-00-00' ? NULL : $detail['tanggal_permohonan']; ?>" name="tanggal_permohonan" readonly="readonly" required>
                    	     </div>
                 	 </div>
                     </div>
		     <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">No Permohonan <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <select class="form-control cmb_select2" id="id_permohonan" name="id_permohonan" required >
                                   <option value=""> - Pilih No Permohonan - </option>
                                   <?php
                                       $list_no_permohonan = $this->global_model->get_list('tbl_permohonan');
                                       foreach ( $list_no_permohonan as $no_permohonan ) {
                                           $selected = $no_permohonan->id_permohonan == (empty($detail['id_permohonan']) ? NULL : $detail['id_permohonan']) ? 'selected' : NULL;
                                           ?>
                                           <option value="<?php echo $no_permohonan->id_permohonan; ?>" <?php echo $selected; ?>><?php echo $no_permohonan->no_permohonan; ?></option>
                                           <?php
                                       }
                                    ?>       
                   </select>
                           </div>
                        </div>
		     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">nama <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="nama" value="<?php echo empty($detail['nama']) ? NULL : $detail['nama']; ?>" required>
                        </div>
                     </div>
		     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">perusahaan <span class="required">*</span></label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="text" class="form-control" name="perusahaan" value="<?php echo empty($detail['perusahaan']) ? NULL : $detail['perusahaan']; ?>" required>
                        </div>
                     </div>
                     <!-- <div class="form-group"> -->
                     <!--    <label class="control-label col-md-3 col-sm-3 col-xs-12">Id Jenis layanan <span class="required">*</span></label>-->
                     <!--    <div class="col-md-9 col-sm-9 col-xs-12">-->
                     <!--        <input type="text" class="form-control" name="id_jenis_layanan" value="<?php echo empty($detail['id_jenis_layanan']) ? NULL : $detail['id_jenis_layanan']; ?>" required>-->
                     <!--    </div>-->
                     <!-- </div> -->
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">jenis_layanan <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="jenis_layanan" value="<?php echo empty($detail['jenis_layanan']) ? NULL : $detail['jenis_layanan']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">layanan <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="layanan" value="<?php echo empty($detail['layanan']) ? NULL : $detail['layanan']; ?>" required>
                         </div>
                     </div>
		     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Tarif_PNBP <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="tarif_pnbp" value="<?php echo empty($detail['tarif_pnbp']) ? NULL : $detail['tarif_pnbp']; ?>" required>
                         </div>
                     </div>
		     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Jumlah <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="jumlah" value="<?php echo empty($detail['jumlah']) ? NULL : $detail['jumlah']; ?>" required>
                         </div>
                     </div>
		             <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Total_Tarif_PNBP <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="total_tarif_pnbp" value="<?php echo empty($detail['total_tarif_pnbp']) ? NULL : $detail['total_tarif_pnbp']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Bukti Transfer <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="bukti" value="<?php echo empty($detail['bukti']) ? NULL : $detail['bukti']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">status_data <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="status_data" value="<?php echo empty($detail['status_data']) ? NULL : $detail['status_data']; ?>" required>
                         </div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">status_transaksi <span class="required">*</span></label>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <input type="text" class="form-control" name="status_transaksi" value="<?php echo empty($detail['status_transaksi']) ? NULL : $detail['status_transaksi']; ?>" required>
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