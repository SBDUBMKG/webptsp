<?php
// filepath: application\views\backend\edit_profil\edit_profil\form.php
defined('BASEPATH') OR exit('No direct script access allowed');

$is_user_role = (int) $this->session->userdata('id_role') === 7;
$curr_lang = $this->session->userdata('language');
$this->lang->load('backend/profile/edit', $curr_lang);

?>
<!-- /.row -->
<section class="content-header">
    <h1><?= $is_user_role ? $this->lang->line('title.page') : $page_title; ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li>
            <a href="<?php echo base_url().$this->module; ?>">
                <?= $is_user_role ? $this->lang->line('title.page') : $page_title ?>
            </a>
        </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $is_user_role ? $this->lang->line('title.card') : $page_title; ?></h3>
                </div>

                <!-- form start -->
                <form class="form-horizontal" method="post"  enctype="multipart/form-data">
                    <div class="box-body">
                        <?php if ( !empty($errMsg) ) {?>
                            <div class="alert alert-danger" role="alert"><?php echo $errMsg; ?></div>
                        <?php }?>

                        <?php
                        $sucMsg = $this->session->flashdata('sucMsg');
                        if ( !empty($sucMsg) ) {
                        ?>
                            <div class="alert alert-success" role="alert"><?php echo $sucMsg; ?></div>
                        <?php } ?>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.picture') : 'Foto Profil' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">

                            <!-- Bikin tampilan foto pada menu edit profile  -->
                            <img src="../../upload/profil/<?php echo $detail['foto']; ?>" style="width:100px; height:100px;">
                            </br>

                            <input type="file" name="foto" class="form-control-file">
                            </div>
                        </div>
                        <h5></h5>
                        <div class="form-group" id="form_group_username">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.username') : 'Nama Pengguna' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo empty($detail['username']) ? NULL : $detail['username']; ?>" max_length="60" required>
                                <span class="help-block" id="username_massage" style="display: none;">Help block with error</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.name') : 'Nama' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="nama" id="nama" value="<?php echo empty($detail['nama']) ? NULL : $detail['nama']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.password') : 'Kata Sandi' ?>
                                <?php echo isset($id) ? NULL : '<span class="required">*</span>'; ?>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" class="form-control" name="password" value="" max_length="255" <?php echo isset($id) ? NULL : 'required'; ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.password.repeat') : 'Ulangi Kata Sandi' ?>
                                <?php echo isset($id) ? NULL : '<span class="required">*</span>'; ?>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" class="form-control" name="r_password" value="" max_length="255" <?php echo isset($id) ? NULL : 'required'; ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.email') : 'Email' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo empty($detail['email']) ? NULL : $detail['email']; ?>" max_length="100" required>
                                <span class="help-block" id="label_email"></span>
                            </div>
                        </div>
                        <div class="form-group" id="fg-npwp">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.npwp') : 'NPWP' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="npwp" id="npwp" value="<?php echo empty($detail['npwp']) ? NULL : $detail['npwp']; ?>" max_length="255" required>
                                <span class="help-block" id="label_npwp"></span>
                            </div>
                        </div>

                        <div class="form-group" id="fg-ktp">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.identity.number') : 'Nomor Identitas' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="no_ktp" id="no_ktp" value="<?php echo empty($detail['no_ktp']) ? NULL : $detail['no_ktp']; ?>" max_length="255" required>
                                <span class="help-block" id="label_ktp"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.identity.picture') : 'Foto Kartu Identitas' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <img src="../../upload/profil/foto_identitas/<?php echo $detail['foto_ktp']; ?>" style="width:100px; height:100px;">
                            </br>
                            <input type="file" name="foto_ktp" class="form-control-file">
                            </div>
                        </div>
                        <h5></h5>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.born.place') : 'Tempat Lahir' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?php echo empty($detail['tempat_lahir']) ? NULL : $detail['tempat_lahir']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.born.date') : 'Tanggal Lahir' ?>
                                <span class="required">*</span>
                            </label>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.gender') : 'Jenis Kelamin' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="radio">
                                  <label><input type="radio" name="jenis_kelamin" value="1" <?php if(isset($detail['jenis_kelamin'])){ if($detail['jenis_kelamin'] == 1){ echo "checked"; } }?>>
                                      <?=  $this->lang->line('form.personal.gender.male') ?>
                                  </label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" name="jenis_kelamin" value="0" <?php if(isset($detail['jenis_kelamin'])){ if($detail['jenis_kelamin'] == 0){ echo "checked"; } }?> >
                                      <?=  $this->lang->line('form.personal.gender.female') ?>
                                  </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.job') : 'Pekerjaan' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="<?php echo empty($detail['pekerjaan']) ? NULL : $detail['pekerjaan']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.education') : 'Pendidikan Terakhir' ?>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_pendidikan" name="id_pendidikan" >
                                    <option value="">
                                        <?=  $is_user_role ? $this->lang->line('form.personal.education.first') : '- Pilih Pendidikan Terakhir -' ?>
                                    </option>
                                    <?php
                                    $list_pendidikan = $this->global_model->get_list('m_pendidikan');
                                    foreach ( $list_pendidikan as $pendidikan ) {
                                        $selected = $pendidikan->id_pendidikan == (empty($detail['id_pendidikan']) ? NULL : $detail['id_pendidikan']) ? 'selected' : NULL;
                                    ?>
                                        <option value="<?php echo $pendidikan->id_pendidikan; ?>" <?php echo $selected; ?>><?php echo $pendidikan->pendidikan; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                           </div>
                        </div>
                        <!-- Akhir script yang ditambahkan Rahmat, 10 Agustus 2020 -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.address') : 'Alamat' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo empty($detail['alamat']) ? NULL : $detail['alamat']; ?>" max_length="255" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.province') : 'Provinsi' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_provinsi" name="id_provinsi" required>
                                    <option value="">
                                        <?=  $is_user_role ? $this->lang->line('form.personal.province.first') : '- Pilih Provinsi -' ?>
                                    </option>
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
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.city') : 'Kabupaten/Kota' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_kabupaten" name="id_kabupaten" required>
                                    <option value="">
                                        <?=  $is_user_role ? $this->lang->line('form.personal.city.first') : '- Pilih Kabupaten/Kota -' ?>
                                    </option>
                                    <?php
                                    $con_kab = array('id_provinsi'=>$provinsi);
                                    $kabkot = '';
                                    if(isset($detail['id_kabupaten'])){
                                        $kabkot = $detail['id_kabupaten'];
                                    }
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.subdistrict') : 'Kecamatan' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_kecamatan" name="id_kecamatan" required>
                                    <option value="">
                                        <?=  $is_user_role ? $this->lang->line('form.personal.subdistrict.first') : '- Pilih Kecamatan -' ?>
                                    </option>
                                    <?php
                                    $con_kec = array('id_kabkot'=>$kabkot);
                                    $kecamatan = '';
                                    if(isset($detail['id_kecamatan'])){
                                        $kecamatan = $detail['id_kecamatan'];
                                    }
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.ward') : 'Kelurahan' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_kelurahan" name="id_kelurahan" required>
                                    <option value="">
                                        <?=  $is_user_role ? $this->lang->line('form.personal.ward.first') : '- Pilih Kelurahan -' ?>
                                    </option>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.postal') : 'Kode Pos' ?>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" id="kode_pos" name="kode_pos" value="<?php echo empty($detail['kode_pos']) ? NULL : $detail['kode_pos']; ?>" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.phone') : 'No. Telepon' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="no_telepon" id="no_telepon" value="<?php echo empty($detail['no_telepon']) ? NULL : $detail['no_telepon']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.personal.mobile') : 'No. Handphone' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="no_hp" id="no_hp" value="<?php echo empty($detail['no_hp']) ? NULL : $detail['no_hp']; ?>" max_length="255" required>
                            </div>
                        </div>

                        <?php
                        if($detail['id_perusahaan'] != NULL){
                        ?>
                        <hr>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <h4>
                                    <b>
                                        <?=  $is_user_role ? $this->lang->line('form.company.title') : 'Data Perusahaan' ?>
                                    </b>
                                </h4>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.company.name') : 'Nama Perusahaan' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" value="<?php echo empty($detail_perusahaan['perusahaan']) ? NULL : $detail_perusahaan['perusahaan']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.company.address') : 'Alamat' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="alamat_perusahaan" id="alamat_perusahaan" value="<?php echo empty($detail_perusahaan['alamat']) ? NULL : $detail_perusahaan['alamat']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.company.province') : 'Provinsi' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="provinsi_perusahaan" name="provinsi_perusahaan" required>
                                    <option value="">
                                        <?=  $is_user_role ? $this->lang->line('form.company.province.first') : '- Pilih Provinsi -' ?>
                                    </option>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.company.city') : 'Kabupaten/Kota' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="kabupaten_perusahaan" name="kabupaten_perusahaan" required>
                                    <option value="">
                                        <?=  $is_user_role ? $this->lang->line('form.company.city.first') : '- Pilih Kabupaten/Kota -' ?>
                                    </option>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.company.subdistrict') : 'Kecamatan' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="kecamatan_perusahaan" name="kecamatan_perusahaan" required>
                                    <option value="">
                                        <?=  $is_user_role ? $this->lang->line('form.company.subdistrict.first') : '- Pilih Kecamatan -' ?>
                                    </option>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.company.ward') : 'Kelurahan' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="kelurahan_perusahaan" name="kelurahan_perusahaan" required>
                                    <option value="">
                                        <?=  $is_user_role ? $this->lang->line('form.company.ward.first') : '- Pilih Kelurahan -' ?>
                                    </option>
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
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.company.postal') : 'Kode Pos' ?>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" id="kode_pos_perusahaan" name="kode_pos_perusahaan" value="<?php echo empty($detail_perusahaan['kode_pos']) ? NULL : $detail_perusahaan['kode_pos']; ?>" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.company.phone') : 'No. Telepon' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="no_telepon_perusahaan" id="no_telepon_perusahaan" value="<?php echo empty($detail_perusahaan['no_telepon']) ? NULL : $detail_perusahaan['no_telepon']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.company.fax') : 'Fax' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="fax" id="fax" value="<?php echo empty($detail_perusahaan['fax']) ? NULL : $detail_perusahaan['fax']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                <?=  $is_user_role ? $this->lang->line('form.company.email') : 'Email' ?>
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="email" class="form-control" name="email_perusahaan" id="email_perusahaan" value="<?php echo empty($detail_perusahaan['email']) ? NULL : $detail_perusahaan['email']; ?>" max_length="255" required>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer" style="text-align: center;">
                        <button type="submit" class="btn btn-success">
                            <?=  $is_user_role ? $this->lang->line('form.button.save') : 'Simpan' ?>
                        </button>
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

        // Awal script yang ditambahkan Rahmat, 30 Juli 2020
        $('#id_kelurahan').select2({
          theme: 'bootstrap',
          allowClear: true,
          placeholder: 'Pilih Kelurahan',
          ajax: {
            dataType: 'json',
            delay: 0,
            url: "<?= site_url('services/kelurahan') ?>",
            data: function(params) {
              return {
                s: params.term,
                q: $("#id_kecamatan").val()
              }
            },
            processResults: function (data, params) {
              params.page = params.page || 1;
              return {
                results: $.map(data, function(obj) {
                  $('#kode_pos').val(obj.kode);
                  return {
                    id: obj.id,
                    text: obj.text
                  };
                }),
              };
            },
            error: function() {
              $('#id_kelurahan').prop("disabled", true);
            },
            cache: true
          }
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

        // Awal script yang ditambahkan Rahmat, 30 Juli 2020
        $('#kelurahan_perusahaan').select2({
          theme: 'bootstrap',
          allowClear: true,
          placeholder: 'Pilih Kelurahan',
          ajax: {
            dataType: 'json',
            delay: 0,
            url: "<?= site_url('services/kelurahan') ?>",
            data: function(params) {
              return {
                s: params.term,
                q: $("#kecamatan_perusahaan").val()
              }
            },
            processResults: function (data, params) {
              params.page = params.page || 1;
              return {
                results: $.map(data, function(obj) {
                  $('#kode_pos_perusahaan').val(obj.kode);
                  return {
                    id: obj.id,
                    text: obj.text
                  };
                }),
              };
            },
            error: function() {
              $('#kelurahan_perusahaan').prop("disabled", true);
            },
            cache: true
          }
        });
        // Akhir script yang ditambahkan Rahmat, 30 Juli 2020
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
