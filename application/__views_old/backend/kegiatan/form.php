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
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="judul" value="<?php echo empty($detail['judul']) ? NULL : $detail['judul']; ?>" max_length="250" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Judul En <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <input type="text" class="form-control" name="judul_en" value="<?php echo empty($detail['judul_en']) ? NULL : $detail['judul_en']; ?>" max_length="250" required>
                           </div>
                        </div>
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
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <textarea class="textarea" name="keterangan" required style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['keterangan']) ? NULL : $detail['keterangan']; ?></textarea>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan En <span class="required">*</span></label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                               <textarea class="textarea" name="keterangan_en" required style="width: 100%; height: 50px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo empty($detail['keterangan_en']) ? NULL : $detail['keterangan_en']; ?></textarea>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Bidang</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                            <select class="form-control cmb_select2" id="id_bidang" name="id_bidang">
                                <option value=""> - Pilih Bidang - </option>
                                <?php
                                $list_bidang = $this->global_model->get_list('tbl_bidang');
                                foreach ( $list_bidang as $dt ) {
                                    $selected = $dt->id_bidang == (empty($detail['id_bidang']) ? NULL : $detail['id_bidang']) ? 'selected' : NULL;
                                    ?>
                                    <option value="<?php echo $dt->id_bidang; ?>" <?php echo $selected; ?>><?php echo $dt->bidang; ?></option>
                                    <?php
                                }
                                ?>       
                            </select>
                           </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto <span class="required">*</span></label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="file" class="form-control" name="userFiles[]" multiple/>
                              <?php 
                              if(!empty($detail['id_kegiatan'])){
                                $list_foto = $this->global_model->get_list_array('tbl_fotokegiatan','id_kegiatan = '.$detail['id_kegiatan']);
                                $bidang = $this->global_model->get_by_id_array('tbl_bidang','id_bidang',$detail['id_bidang']);
                                if(!empty($list_foto)){
                                  foreach($list_foto as $key => $value){ 
                                    if($value['is_default']==1){ ?>
                                      <div class="col-md-4">
                                        <div class="box box-success box-solid">
                                          <div class="box-header with-border">
                                            <h3 class="box-title"><?php echo $value['nama']?></h3>
                                            <div class="box-tools pull-right">
                                              <?php 
                                                $url = 'upload/kegiatan/'.$bidang['bidang'].'/'.$detail['judul'].'/'.$value['nama'];
                                                $_SESSION['url'] = $url;
                                              ?>
                                              <a href="<?php echo base_url().'backend/kegiatan/kegiatan/delete_foto/'.$value['id_fotokegiatan'].'/'.$detail['id_kegiatan']?>">
                                                <i class="fa fa-trash" title="hapus foto"></i>
                                              </a>
                                            </div>
                                          </div>
                                          <div class="box-body">
                                            <img width="210px" src="<?php echo base_url().'upload/kegiatan/'.$bidang['bidang'].'/'.$value['nama']; ?>" alt="<?php echo $value['nama'];?>" >
                                          </div>
                                        </div>
                                      </div>
                                  <?php 
                                    } else { ?>
                                    <div class="col-md-4">
                                        <div class="box box-info box-solid">
                                          <div class="box-header with-border">
                                            <h3 class="box-title"><?php echo $value['nama']?></h3>
                                            <div class="box-tools pull-right">
                                              <?php 
                                                $url = 'upload/kegiatan/'.$bidang['bidang'].'/'.$detail['judul'].'/'.$value['nama'];
                                                $_SESSION['url'] = $url;
                                              ?>
                                              <a href="<?php echo base_url().'backend/kegiatan/kegiatan/default_foto/'.$value['id_fotokegiatan'].'/'.$detail['id_kegiatan']?>">
                                                <i class="fa fa-check" title="jadikan default"></i>
                                              </a>
                                              <a href="<?php echo base_url().'backend/kegiatan/kegiatan/delete_foto/'.$value['id_fotokegiatan'].'/'.$detail['id_kegiatan']?>" OnClick="return confirm('Yakin hapus foto ini?');">
                                                <i class="fa fa-trash" title="hapus foto"></i>
                                              </a>
                                            </div>
                                          </div>
                                          <div class="box-body">
                                            <img width="210px" src="<?php echo base_url().'upload/kegiatan/'.$bidang['bidang'].'/'.$value['nama']; ?>" alt="<?php echo $value['nama'];?>" >
                                          </div>
                                        </div>
                                      </div>
                               <?php   
                                    }  
                                  }
                                } else { ?>
                                  <p>Foto tidak ada</p>
                            <?php 
                                }
                              } ?>
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
        $('.datepicker').datepicker({
            autoclose: true
        });
        $('.cmb_select2').select2({
            theme: 'bootstrap'
        });
    });
</script>