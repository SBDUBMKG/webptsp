<?php
// filepath: application\views\backend\edit_profil\edit_profil\form.php
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
                <form class="form-horizontal" method="post"  enctype="multipart/form-data">
                    <div class="box-body">
                        <?php
                        if ( !empty($errMsg) ) {
                            ?>
                            <div class="alert alert-danger" role="alert"><?php echo $errMsg; ?></div>
                            <?php
                        }
                        ?>

                        <?php
                        $sucMsg = $this->session->flashdata('sucMsg');
                        if ( !empty($sucMsg) ) {
                            ?>
                            <div class="alert alert-success" role="alert"><?php echo $sucMsg; ?></div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto Profil <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">  

                            <!-- Bikin tampilan foto pada menu edit profile  -->
                            <img src="../../upload/profil/<?php echo $detail['foto']; ?>" style="width:100px; height:100px;">
                            </br>

                            
                            <input type="file" name="foto" class="form-control-file">
                            </div>
                        </div>
                        <h5></h5>
                        <div class="form-group" id="form_group_username">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Username <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo empty($detail['username']) ? NULL : $detail['username']; ?>" max_length="60" required>
                                <span class="help-block" id="username_massage" style="display: none;">Help block with error</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="nama" id="nama" value="<?php echo empty($detail['nama']) ? NULL : $detail['nama']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password <?php echo isset($id) ? NULL : '<span class="required">*</span>'; ?></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" class="form-control" name="password" value="" max_length="255" <?php echo isset($id) ? NULL : 'required'; ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ulangi Password <?php echo isset($id) ? NULL : '<span class="required">*</span>'; ?></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" class="form-control" name="r_password" value="" max_length="255" <?php echo isset($id) ? NULL : 'required'; ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo empty($detail['email']) ? NULL : $detail['email']; ?>" max_length="100" required>
                                <span class="help-block" id="label_email"></span>
                            </div>
                        </div>
                        <div class="form-group" id="fg-npwp">
                            <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12">NPWP <span class="required">*</span></label>
			    mengubah sifat mandatory NPWP menjadi tidak mandatory. Perubahan oleh : Nurhayati Rahayu (25/10/2019) -->
			    <label class="control-label col-md-3 col-sm-3 col-xs-12">NPWP</label>
		 	    <!-- baris terakhir perubahan -->
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <!-- <input type="number" class="form-control" name="npwp" id="npwp" value="<?php echo empty($detail['npwp']) ? NULL : $detail['npwp']; ?>" max_length="255" required>
				menghilangkan required. Perubahan oleh : Nurhayati Rahayu (25/10/2019) -->
				<input type="number" class="form-control" name="npwp" id="npwp" value="<?php echo empty($detail['npwp']) ? NULL : $detail['npwp']; ?>" max_length="255">
				<!-- baris terakhir perubahan -->
                                <!-- Menambahkan Span dan id='fg-npwp begitu juga dengan KTP dan email' -->
                                <span class="help-block" id="label_npwp"></span>
                            </div>
                        </div>
       
                        <div class="form-group" id="fg-ktp">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No KTP <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="no_ktp" id="no_ktp" value="<?php echo empty($detail['no_ktp']) ? NULL : $detail['no_ktp']; ?>" max_length="255" required>
                                <span class="help-block" id="label_ktp"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Lahir <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?php echo empty($detail['tempat_lahir']) ? NULL : $detail['tempat_lahir']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tanggal Lahir</label>
                            <div class="input-group date col-md-9 col-sm-9 col-xs-12">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <?php
                                if(!empty($detail['tanggal_lahir'])) {
                                    $tanggal        = substr($detail['tanggal_lahir'], 8, 2);
                                    $bulan          = substr($detail['tanggal_lahir'], 5, 2);
                                    $tahun          = substr($detail['tanggal_lahir'], 0, 4);
                                    $tanggal_lahir  = $bulan.'/'.$tanggal.'/'.$tahun;
                                }
                                ?>
                                <input type="text" class="form-control pull-right" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>">
                        </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="radio">
                                  <label><input type="radio" name="jenis_kelamin" value="1" <?php if(!empty($detail['jenis_kelamin'])){ if($detail['jenis_kelamin'] == 1){ echo "checked"; } }?> >Laki - laki</label>
                                </div>


                                <div class="radio">
                                  <label><input type="radio" name="jenis_kelamin" value="0" <?php if(!empty($detail['jenis_kelamin'])){ if($detail['jenis_kelamin'] == 0){ echo "checked"; } }?> >Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pekerjaan<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="<?php echo empty($detail['pekerjaan']) ? NULL : $detail['pekerjaan']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat<span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo empty($detail['alamat']) ? NULL : $detail['alamat']; ?>" max_length="255" required>
                            </div>
                            </div>

                            <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">provinsi</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_provinsi" name="id_provinsi" >
                                    <option value=""> - Pilih provinsi - </option>
                                    <?php
                                    $list_provinsi = $this->global_model->get_list('m_provinsi');
                                    foreach ( $list_provinsi as $provinsi ) {
                                        $selected = $provinsi->id_provinsi == (empty($detail['id_provinsi']) ? NULL : $detail['id_provinsi']) ? 'selected' : NULL;
                                    ?>
                                        <option value="<?php echo $provinsi->id_provinsi; ?>" <?php echo $selected; ?>><?php echo $provinsi->provinsi; ?></option>
                                    <?php
                                    }
                                    ?>       
                                </select>
                           </div>
                        </div>


                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kabupaten/Kota</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_kabupaten" name="id_kabupaten" >
                                    <option value=""> - Pilih Kabkot - </option>
                                    <?php
                                    $list_kabkot = $this->global_model->get_list('m_kabkot');
                                    foreach ( $list_kabkot as $kabkot ) {
                                        $selected = $kabkot->id_kabkot == (empty($detail['id_kabupaten']) ? NULL : $detail['id_kabupaten']) ? 'selected' : NULL;
                                    ?>
                                        <option value="<?php echo $kabkot->id_kabkot; ?>" <?php echo $selected; ?>><?php echo $kabkot->kabkot; ?></option>
                                    <?php
                                    }
                                    ?>       
                                </select>
                           </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kecamatan</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_kecamatan" name="id_kecamatan" >
                                    <option value=""> - Pilih Kecamatan - </option>
                                    <?php
                                    $list_kecamatan = $this->global_model->get_list('m_kecamatan');
                                    foreach ( $list_kecamatan as $kecamatan ) {
                                        $selected = $kecamatan->id_kecamatan == (empty($detail['id_kecamatan']) ? NULL : $detail['id_kecamatan']) ? 'selected' : NULL;
                                        ?>
                                        <option value="<?php echo $kecamatan->id_kecamatan; ?>" <?php echo $selected; ?>><?php echo $kecamatan->kecamatan; ?></option>
                                    <?php
                                    }
                                    ?>       
                                </select>
                           </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelurahan</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_kelurahan" name="id_kelurahan" >
                                    <option value=""> - Pilih Kelurahan - </option>
                                    <?php
                                    if(!empty($detail['id_kelurahan'])){
                                        $selected = $this->global_model->get_by_id('m_kelurahan','id_kelurahan',$detail['id_kelurahan']);
                                        echo '<option value="'.$selected->id_kelurahan.'" selected>'.$selected->kelurahan.'</option>';
                                    }
                                    ?>      
                                </select>
                           </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Pos <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="kode_pos" id="kode_pos" value="<?php echo empty($detail['kode_pos']) ? NULL : $detail['kode_pos']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12">No Telepon <span class="required">*</span></label>
	 		    mengubah sifat mandatory NPWP menjadi tidak mandatory. Perubahan oleh : Nurhayati Rahayu (25/10/2019) -->
			    <label class="control-label col-md-3 col-sm-3 col-xs-12">No Telepon</label>
			    <!-- baris terakhir perubahan -->
                            <div class="col-md-9 col-sm-9 col-xs-12">
				<!-- <input type="number" class="form-control" name="no_telepon" id="no_telepon" value="<?php echo empty($detail['no_telepon']) ? NULL : $detail['no_telepon']; ?>" max_length="255" required>
				menghilangkan required. Perubahan oleh : Nurhayati Rahayu (25/10/2019) -->
                                <input type="number" class="form-control" name="no_telepon" id="no_telepon" value="<?php echo empty($detail['no_telepon']) ? NULL : $detail['no_telepon']; ?>" max_length="255">
				<!-- baris terakhir perubahan -->
			    </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No Handphone <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="no_hp" id="no_hp" value="<?php echo empty($detail['no_hp']) ? NULL : $detail['no_hp']; ?>" max_length="255" required>
                            </div>
                        </div>

                        <?php
                        if($detail['id_perusahaan'] != NULL){
                        ?>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><h4><b>Data Perusahaan</b></h4></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Perusahaan <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" value="<?php echo empty($detail_perusahaan['nama']) ? NULL : $detail_perusahaan['nama']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="alamat_perusahaan" id="alamat_perusahaan" value="<?php echo empty($detail_perusahaan['alamat']) ? NULL : $detail_perusahaan['alamat']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelurahan <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="kelurahan_perusahaan" id="kelurahan_perusahaan" value="<?php echo empty($detail_perusahaan['kelurahan']) ? NULL : $detail_perusahaan['kelurahan']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kecamatan <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="kecamatan_perusahaan" id="kecamatan_perusahaan" value="<?php echo empty($detail_perusahaan['kecamatan']) ? NULL : $detail_perusahaan['kecamatan']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kabupaten <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="kabupaten_perusahaan" id="kabupaten_perusahaan" value="<?php echo empty($detail_perusahaan['kabupaten']) ? NULL : $detail_perusahaan['kabupaten']; ?>" max_length="255" required>
                            </div>
                        </div>
                        Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->

                        <!-- script awal yang diedit Rahmat 14 Oktober 2019 -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Provinsi</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="provinsi_perusahaan" name="provinsi_perusahaan" >
                                    <option value=""> - Pilih provinsi - </option>
                                    <?php
                                    $provinsi_perusahaan = 0;
                                    if(isset($detail_perusahaan['id_provinsi'])){
                                        $provinsi_perusahaan = $detail_perusahaan['id_provinsi'];
                                    }
                                    $list_provinsi = $this->global_model->get_list('m_provinsi');
                                    foreach ( $list_provinsi as $provinsi ) {
                                        $selected = $provinsi->id_provinsi == ($provinsi_perusahaan) ? 'selected' : NULL;
                                    ?>
                                        <option value="<?php echo $provinsi->id_provinsi; ?>" <?php echo $selected; ?>><?php echo $provinsi->provinsi; ?></option>
                                    <?php
                                    }
                                    ?>       
                                </select>
                           </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kabupaten/Kota</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="kabupaten_perusahaan" name="kabupaten_perusahaan" >
                                    <option value=""> - Pilih Kabkot - </option>
                                    <?php
                                    $con_kab = array('id_provinsi'=>$provinsi_perusahaan);
                                    $kabkot_perusahaan = '';
                                    if(isset($detail_perusahaan['id_kabupaten'])){
                                        $kabkot_perusahaan = $detail_perusahaan['id_kabupaten'];
                                    }
                                    $list_kabkot = $this->global_model->get_list('m_kabkot',$con_kab);
                                    foreach ( $list_kabkot as $kabkot ) {
                                        $selected = $kabkot->id_kabkot == ($kabkot_perusahaan) ? 'selected' : NULL;
                                    ?>
                                        <option value="<?php echo $kabkot->id_kabkot; ?>" <?php echo $selected; ?>><?php echo $kabkot->kabkot; ?></option>
                                    <?php
                                    }
                                    ?>       
                                </select>
                           </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kecamatan</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="kecamatan_perusahaan" name="kecamatan_perusahaan" >
                                    <option value=""> - Pilih Kecamatan - </option>
                                    <?php
                                    $con_kec = array('id_kabkot'=>$kabkot_perusahaan);
                                    $kecamatan_perusahaan = '';
                                    if(isset($detail_perusahaan['id_kecamatan'])){
                                        $kecamatan_perusahaan = $detail_perusahaan['id_kecamatan'];
                                    }
                                    $list_kecamatan = $this->global_model->get_list('m_kecamatan',$con_kec);
                                    foreach ( $list_kecamatan as $kecamatan ) {
                                        $selected = $kecamatan->id_kecamatan == ($kecamatan_perusahaan) ? 'selected' : NULL;
                                        ?>
                                        <option value="<?php echo $kecamatan->id_kecamatan; ?>" <?php echo $selected; ?>><?php echo $kecamatan->kecamatan; ?></option>
                                    <?php
                                    }
                                    ?>       
                                </select>
                           </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelurahan</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="kelurahan_perusahaan" name="kelurahan_perusahaan" >
                                    <option value=""> - Pilih Kelurahan - </option>
                                    <?php

                                    $con_kel = array('id_kecamatan'=>$kecamatan_perusahaan);
                                    $kelurahan_perusahaan = '';
                                    if(isset($detail_perusahaan['id_kecamatan'])){
                                        $kelurahan_perusahaan = $detail_perusahaan['id_kelurahan'];
                                    }
                                    $list_kelurahan = $this->global_model->get_list('m_kelurahan',$con_kel);
                                    foreach ( $list_kelurahan as $kelurahan ) {
                                        $selected = $kelurahan->id_kelurahan == ($kelurahan_perusahaan) ? 'selected' : NULL;
                                        ?>
                                        <option value="<?php echo $kelurahan->id_kelurahan; ?>" <?php echo $selected; ?>><?php echo $kelurahan->kelurahan; ?></option>
                                    <?php
                                    }
                                    ?>       
                                </select>
                           </div>
                        </div>
                        
                        <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Pos <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="kode_pos_perusahaan" id="kode_pos_perusahaan" value="<?php echo empty($detail_perusahaan['kode_pos']) ? NULL : $detail_perusahaan['kode_pos']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- <label class="control-label col-md-3 col-sm-3 col-xs-12">No Telepon <span class="required">*</span></label> 
			    menghilangkan mandatory. Perubahan oleh Nurhayati Rahayu (25/10/2019) -->	
			    <label class="control-label col-md-3 col-sm-3 col-xs-12">No Telepon</label>
			    <!-- baris terakhir perubahan -->
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <!-- <input type="number" class="form-control" name="no_telepon_perusahaan" id="no_telepon_perusahaan" value="<?php echo empty($detail_perusahaan['no_telepon']) ? NULL : $detail_perusahaan['no_telepon']; ?>" max_length="255" required> 
				menghilangkan required. Perubahan oleh Nurhayati Rahayu (25/10/2019) -->
				<input type="number" class="form-control" name="no_telepon_perusahaan" id="no_telepon_perusahaan" value="<?php echo empty($detail_perusahaan['no_telepon']) ? NULL : $detail_perusahaan['no_telepon']; ?>" max_length="255">
				<!-- baris terakhir perubahan -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fax <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="fax" id="fax" value="<?php echo empty($detail_perusahaan['fax']) ? NULL : $detail_perusahaan['fax']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="email" class="form-control" name="email_perusahaan" id="email_perusahaan" value="<?php echo empty($detail_perusahaan['email']) ? NULL : $detail_perusahaan['email']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer" style="text-align: center;">
                        <!--
                        <button type="button" class="btn btn-primary" onclick="<?php echo $url_back; ?>">Kembali</button>
                        -->
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
        $('#tanggal_lahir').datepicker({
            autoclose: true
        });
        $('.cmb_select2').select2({
            theme: 'bootstrap'
        });
        $('#username').change(function() {
            var username = $('#username').val();
            $.ajax({
                type: "GET",
                url: base_url + "user/check_username",
                data: "iuser=<?php echo isset($id) ? $id : NULL; ?>&uname=" + username,
                success: function(msg) {
                    if ( parseInt(msg) > 0 ) {
                        $('#form_group_username').addClass('has-error');
                        $('#username_massage').html('Username ' + $('#username').val() + ' tidak tersedia');
                        $('#username_massage').show();
                        $('#username').val('');
                        $('#username').focus();
                    } else {
                        $('#form_group_username').removeClass('has-error');
                        $('#username_massage').hide();
                    }
                },
                error: function(xhr, msg, e) {
                    console.log(xhr.responseText);
                }
            });
        });

        // script awal yang diedit Rahmat 14 Oktober 2019
        $('#id_provinsi').change(function() {
          set_loader_select2('id_kabupaten');
          $.ajax({
              type: "GET",
              dataType: "json",
              url: base_url + "services/get_data_kabkot?id_provinsi="+$(this).val(),
              success: function(msg) {
                  var data = msg;
                  var result = data.result;
                  set_option_select2('id_kabupaten', result, ' - Pilih Kabupaten - ', 'id_kabkot', 'kabkot');
              },
              error: function(xhr, msg, e) {
                  console.log(xhr.responseText);
              }
          });
        });
        // script akhir yang diedit Rahmat 14 Oktober 2019

        $('#id_kabupaten').change(function() {
          set_loader_select2('id_kecamatan');
          $.ajax({
              type: "GET",
              dataType: "json",
              url: base_url + "services/get_data_kecamatan?id_kabkot="+$(this).val(),
              success: function(msg) {
                  var data =  msg;
                  var result = data.result;
                  set_option_select2('id_kecamatan', result, ' - Pilih Kecamatan - ', 'id_kecamatan', 'kecamatan');
              },
              error: function(xhr, msg, e) {
                  console.log(xhr.responseText);
              }
          });
        });
        $('#id_kecamatan').change(function() {
          set_loader_select2('id_kelurahan');
          $.ajax({
              type: "GET",
              dataType: "json",
              url: base_url + "services/get_data_kelurahan?id_kecamatan="+$(this).val(),
              success: function(msg) {
                  var data =  msg;
                  var result = data.result;
                  set_option_select2('id_kelurahan', result, ' - Pilih Kelurahan - ', 'id_kelurahan', 'kelurahan');
              },
              error: function(xhr, msg, e) {
                  console.log(xhr.responseText);
              }
          });
        });

        // untuk combo perusahaan
        $('#provinsi_perusahaan').change(function() {
          set_loader_select2('kabupaten_perusahaan');
          $.ajax({
              type: "GET",
              dataType: "json",
              url: base_url + "services/get_data_kabkot?id_provinsi="+$(this).val(),
              success: function(msg) {
                  var data = msg;
                  var result = data.result;
                  set_option_select2('kabupaten_perusahaan', result, ' - Pilih Kabupaten - ', 'id_kabkot', 'kabkot');
              },
              error: function(xhr, msg, e) {
                  console.log(xhr.responseText);
              }
          });
        });
        // script akhir yang diedit Rahmat 14 Oktober 2019

        $('#kabupaten_perusahaan').change(function() {
          set_loader_select2('kecamatan_perusahaan');
          $.ajax({
              type: "GET",
              dataType: "json",
              url: base_url + "services/get_data_kecamatan?id_kabkot="+$(this).val(),
              success: function(msg) {
                  var data =  msg;
                  var result = data.result;
                  set_option_select2('kecamatan_perusahaan', result, ' - Pilih Kecamatan - ', 'id_kecamatan', 'kecamatan');
              },
              error: function(xhr, msg, e) {
                  console.log(xhr.responseText);
              }
          });
        });
        $('#kecamatan_perusahaan').change(function() {
          set_loader_select2('kelurahan_perusahaan');
          $.ajax({
              type: "GET",
              dataType: "json",
              url: base_url + "services/get_data_kelurahan?id_kecamatan="+$(this).val(),
              success: function(msg) {
                  var data =  msg;
                  var result = data.result;
                  set_option_select2('kelurahan_perusahaan', result, ' - Pilih Kelurahan - ', 'id_kelurahan', 'kelurahan');
              },
              error: function(xhr, msg, e) {
                  console.log(xhr.responseText);
              }
          });
        });
    });

            $('#npwp').on('keydown keyup change', function(){
            var char = $(this).val();
            var charLength = char.length;
            if(charLength == 15){
                $('#label_npwp').text('NPWP Valid');
                $('#label_npwp').css('color', 'green');
                var element = document.getElementById("fg_npwp");
                element.classList.remove("has-error");
                element.classList.add("has-success");
            }else{
                $('#label_npwp').text('NPWP Tidak Valid');
                $('#label_npwp').css('color','red');
                var element = document.getElementById("fg_npwp");
                element.classList.remove("has-success");
                element.classList.add("has-error");
            }
        });

        $('#no_ktp').on('keydown keyup change', function(){
            var char = $(this).val();
            var charLength = char.length;
            if(charLength == 16){
                $('#label_ktp').text('No KTP Valid');
                $('#label_ktp').css('color','green');
                var element = document.getElementById("fg_ktp");
                element.classList.remove("has-error");
                element.classList.add("has-success");
            }else{
                $('#label_ktp').text('No KTP Tidak Valid');
                $('#label_ktp').css('color','red');
                var element = document.getElementById("fg_ktp");
                element.classList.remove("has-success");
                element.classList.add("has-error");
            }

            function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
            }

            function validate_email() {
            var $result = $("#label_email");
            var email = $("#email").val();
            $result.text("");

            if (validateEmail(email)) {
                $result.text(email + " valid");
                $result.css("color", "green");
            } else {
                $result.text(email + " tidak valid");
                $result.css("color", "red");
            }
            return false;
            }
                });
</script>