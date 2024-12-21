<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');
//var_dump($detail_perusahaan);
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
<?php                   if(isset($errMsg)) echo '<div class="alert alert-danger">'.$errMsg.'</div>';
                        if($mode=='view') {
?>                          <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Foto Profil <span class="readonly"></span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">  
                                <!-- Bikin tampilan foto pada menu edit profile  -->
                                <img src="<?php echo base_url() ?>upload/profil/foto_identitas/<?php echo empty($detail['foto_ktp'])?"no-photo.jpg":$detail['foto_ktp']; ?>" style="width:100px; height:100px;">
                                </br>                            
                                <!-- <input type="file" name="foto" class="form-control-file"> -->
                                </div>
                            </div>
<?php                   }
?>                      <h5></h5>
                        <div class="form-group" id="form_group_username">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Username <span class="readonly"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="username" id="username" value="<?php echo empty($detail['username']) ? NULL : $detail['username']; ?>" max_length="60" readonly>
                                <span class="help-block" id="username_massage" style="display: none;">Help block with error</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama <span class="readonly"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <?php echo $detail['mode']?>
                                <input type="text" class="form-control" name="nama" id="nama" value="<?php echo empty($detail['nama']) ? NULL : $detail['nama']; ?>" max_length="255" <?php echo ($mode=='view')?'readonly':''?>>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password <?php echo isset($id) ? NULL : '<span class="readonly"></span>'; ?></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" class="form-control" name="password" value="" max_length="255" <?php echo isset($id) ? NULL : 'readonly'; ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ulangi Password <?php echo isset($id) ? NULL : '<span class="readonly"></span>'; ?></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="password" class="form-control" name="r_password" value="" max_length="255" <?php echo isset($id) ? NULL : 'readonly'; ?>>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="readonly"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo empty($detail['email']) ? NULL : $detail['email']; ?>" max_length="100" <?php echo $mode=='view'?'readonly':''?>>
                                <span class="help-block" id="label_email"></span>
                            </div>
                        </div>
                        <div class="form-group" id="fg-npwp">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">NPWP <span class="readonly"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="npwp" id="npwp" value="<?php echo empty($detail['npwp']) ? NULL : $detail['npwp']; ?>" max_length="255" <?php echo $mode=='view'?'readonly':''?>>
                                <!-- Menambahkan Span dan id='fg-npwp begitu juga dengan KTP dan email' -->
                                <span class="help-block" id="label_npwp"></span>
                            </div>
                        </div>
       
                        <div class="form-group" id="fg-ktp">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No KTP <span class="readonly"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="no_ktp" id="no_ktp" value="<?php echo empty($detail['no_ktp']) ? NULL : $detail['no_ktp']; ?>" max_length="255" <?php echo $mode=='view'?'readonly':''?>>
                                <span class="help-block" id="label_ktp"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tempat Lahir <span class="readonly"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?php echo empty($detail['tempat_lahir']) ? NULL : $detail['tempat_lahir']; ?>" max_length="255" <?php echo $mode=='view'?'readonly':''?>>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin<span class="readonly"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <div class="radio">
                                  <label><input type="radio" name="jenis_kelamin" value="1" <?php echo ($detail['jenis_kelamin'] == 1)?'checked':''?> >Laki - laki</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" name="jenis_kelamin" value="0" <?php echo ($detail['jenis_kelamin'] == 0)?'checked':''?>> Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pekerjaan<span class="readonly"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="<?php echo empty($detail['pekerjaan']) ? NULL : $detail['pekerjaan']; ?>" max_length="255" <?php echo $mode=='view'?'readonly':''?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat<span class="readonly"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" name="alamat" id="alamat" value="<?php echo empty($detail['alamat']) ? NULL : $detail['alamat']; ?>" max_length="255" <?php echo $mode=='view'?'readonly':''?>>
                            </div>
                        </div>
                        <!-- Awal script yang ditambahkan Rahmat, 10 Agustus 2020 -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Pendidikan Terakhir</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_pendidikan" name="id_pendidikan" >
                                    <option value=""> - Pilih Pendidikan - </option>
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Provinsi</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_provinsi" name="id_provinsi" required >
                                    <option value=""> - Pilih Provinsi - </option>
<?php                               $list_provinsi = $this->global_model->get_list('m_provinsi');
                                    foreach ( $list_provinsi as $provinsi ) {
                                        $selected = $provinsi->id_provinsi == (empty($detail['id_provinsi']) ? NULL : $detail['id_provinsi']) ? 'selected' : NULL;
?>                                      <option value="<?php echo $provinsi->id_provinsi; ?>" <?php echo $selected; ?>><?php echo $provinsi->provinsi; ?></option>
<?php                               }
?>                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kabupaten/Kota</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_kabupaten" name="id_kabupaten" >
                                    <option value=""> - Pilih Kabkot - </option>
<?php                               $list_kabkot = $this->global_model->get_list('m_kabkot',['id_provinsi'=>$detail['id_provinsi']]);
                                    foreach ( $list_kabkot as $kabkot ) {
                                        $selected = $kabkot->id_kabkot == (empty($detail['id_kabupaten']) ? NULL : $detail['id_kabupaten']) ? 'selected' : NULL;
?>                                      <option value="<?php echo $kabkot->id_kabkot; ?>" <?php echo $selected; ?>><?php echo $kabkot->kabkot; ?></option>
<?php                               }
?>                             </select>
                           </div>
                        </div>

                        <!-- Awal script yang ditambahkan Rahmat, 29 Juli 2020 -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kecamatan</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_kecamatan" name="id_kecamatan" >
                                    <option value=""> - Pilih Kecamatan - </option>
<?php                               $list_kecamatan = $this->global_model->get_list('m_kecamatan',['id_kabkot'=>$detail['id_kabupaten']]);
                                        foreach ( $list_kecamatan as $kecamatan ) {
                                            $selected = $kecamatan->id_kecamatan == (empty($detail['id_kecamatan']) ? NULL : $detail['id_kecamatan']) ? 'selected' : NULL;
?>                                          <option value="<?php echo $kecamatan->id_kecamatan; ?>" <?php echo $selected; ?>><?php echo $kecamatan->kecamatan; ?></option>
<?php                                    }
?>                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kelurahan</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control cmb_select2" id="id_kelurahan" name="id_kelurahan" >
                                    <option value=""> - Pilih Kelurahan - </option>
<?php                               $list_kelurahan = $this->global_model->get_list('m_kelurahan',['id_kecamatan'=>$detail['id_kecamatan']]);
                                    foreach($list_kelurahan as $kelurahan) {
                                        $selected = $kelurahan->id_kelurahan == (empty($detail['id_kelurahan']) ? NULL : $detail['id_kelurahan']) ? 'selected' : NULL;
?>                                      <option value="<?php echo $kelurahan->id_kelurahan?>" <?php echo $selected; ?>><?php echo $kelurahan->kelurahan?></option>
<?php                               }
?>                              </select>
                           </div>
                        </div>
                        <!-- Akhir script yang ditambahkan Rahmat, 29 Juli 2020 -->
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Pos <span class="readonly"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input class="form-control" name="kode_pos" id="kode_pos" value="<?php echo empty($detail['kode_pos']) ? NULL : $detail['kode_pos']; ?>" max_length="255" <?php echo $mode=='view'?'readonly':''?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No Telepon <span class="readonly"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="no_telepon" id="no_telepon" value="<?php echo empty($detail['no_telepon']) ? NULL : $detail['no_telepon']; ?>" max_length="255" <?php echo $mode=='view'?'readonly':''?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No Handphone <span class="readonly"></span></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" name="no_hp" id="no_hp" value="<?php echo empty($detail['no_hp']) ? NULL : $detail['no_hp']; ?>" max_length="255" <?php echo $mode=='view'?'readonly':''?>>
                            </div>
                        </div>
<?php                   if($detail_perusahaan) {
?>                          <hr>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"><h4><b>Data Perusahaan</b></h4></label>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Perusahaan <span class="readonly"></span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <!-- Script yang diedit Rahmat, 29 Juli 2020, awalnya $detail_perusahaan['nama'] => diedit menjadi $detail_perusahaan['perusahaan'] -->
                                    <input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" value="<?php echo empty($detail_perusahaan['perusahaan']) ? NULL : $detail_perusahaan['perusahaan']; ?>" max_length="255" <?php echo $mode=='view'?'readonly':''?>>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat <span class="readonly"></span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" name="alamat_perusahaan" id="alamat_perusahaan" value="<?php echo empty($detail_perusahaan['alamat']) ? NULL : $detail_perusahaan['alamat']; ?>" max_length="255" <?php echo $mode=='view'?'readonly':''?>>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Provinsi</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select class="form-control cmb_select2" id="provinsi_perusahaan" name="provinsi_perusahaan" readonly>
                                        <option value=""> - Pilih Provinsi - </option>
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

                            <!-- Awal script yang ditambahkan Rahmat, 29 Juli 2020 -->
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
                            <!-- Akhir script yang ditambahkan Rahmat, 29 Juli 2020 -->                            
                            <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Pos <span class="readonly"></span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="number" class="form-control" name="kode_pos_perusahaan" id="kode_pos_perusahaan" value="<?php echo empty($detail_perusahaan['kode_pos']) ? NULL : $detail_perusahaan['kode_pos']; ?>" max_length="255" <?php echo $mode=='view'?'readonly':''?>>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">No Telepon <span class="readonly"></span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="number" class="form-control" name="no_telepon_perusahaan" id="no_telepon_perusahaan" value="<?php echo empty($detail_perusahaan['no_telepon']) ? NULL : $detail_perusahaan['no_telepon']; ?>" max_length="255" <?php echo $mode=='view'?'readonly':''?>>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fax <span class="readonly"></span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="number" class="form-control" name="fax" id="fax" value="<?php echo empty($detail_perusahaan['fax']) ? NULL : $detail_perusahaan['fax']; ?>" max_length="255" <?php echo $mode=='view'?'readonly':''?>>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="readonly"></span></label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="email" class="form-control" name="email_perusahaan" id="email_perusahaan" value="<?php echo empty($detail_perusahaan['email']) ? NULL : $detail_perusahaan['email']; ?>" max_length="255" <?php echo $mode=='view'?'readonly':''?>>
                                </div>
                            </div>
<?php                   } 
?>                  </div>
                    <!-- /.box-body -->
                    <div class="box-footer" style="text-align: center;">
                        <button type="button" id="btn_back" class="btn btn-primary" onclick="<?php echo $url_back; ?>">Kembali</button>
<?php                   if($mode=='edit') {
?>                          <button type="submit" class="btn btn-success">Simpan</button>
<?php                   } elseif($mode=='view') {
?>                          <button type="button" id="btn_reset" class="btn btn-danger" onclick="confirm_reset('<?=$detail['username']?>','<?=$detail['nama']?>','<?=$detail['email']?>')">Reset Password</button></a>                            
<?php                   }
?>                  </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(function () {
        $(".textarea").wysihtml5();
        $('.input-group.date').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'

        });
        $('.cmb_select2').select2({
            theme: 'bootstrap',
            disabled:<?php echo $mode=='view'?'true':'false'?>
        });
    
        $('#id_provinsi').on('change', function(){
            $.ajax({        
                url: "<?php echo site_url('services/kab_kota') ?>",
                type: "GET",
                data: { q : $('#id_provinsi').val() },
                dataType: "json",
                success: function(data) {
                    $('#id_kabupaten').empty();
                    $('#id_kecamatan').empty();
                    $('#id_kelurahan').empty();
                    $('#id_kabupaten').append('<option value="">Pilih Kab Kota</option>');
                    $.each(data, function(key, value) {
                        $('#id_kabupaten').append('<option value="' + value.id + '">' + value.text + '</option>');
                    });
                }
            }); 
        }); 

        $('#provinsi_perusahaan').on('change', function(){
            $.ajax({        
                url: "<?php echo site_url('services/kab_kota') ?>",
                type: "GET",
                data: { q : $('#provinsi_perusahaan').val() },
                dataType: "json",
                success: function(data) {
                    $('#kabupaten_perusahaan').empty();
                    $('#kecamatan_perusahaan').empty();
                    $('#kelurahan_perusahaan').empty();
                    $('#kabupaten_perusahaan').append('<option value="">Pilih Kab Kota</option>');
                    $.each(data, function(key, value) {
                        $('#kabupaten_perusahaan').append('<option value="' + value.id + '">' + value.text + '</option>');
                    });
                }
            }); 
        });         

        $('#id_kabupaten').on('change', function() {
            $.ajax({        
                url: "<?php echo site_url('services/kecamatan') ?>",
                type: "GET",
                data: { q : $('#id_kabupaten').val() },
                dataType: "json",
                success: function(data) {
                    $('#id_kecamatan').empty();
                    $('#id_kelurahan').empty();
                    $('#id_kecamatan').append('<option value="">Pilih Kecamatan</option>');
                    $.each(data, function(key, value) {
                        $('#id_kecamatan').append('<option value="' + value.id + '">' + value.text + '</option>');
                    });
                }
            }); 
        })

        $('#kabupaten_perusahaan').on('change', function() {
            $.ajax({        
                url: "<?php echo site_url('services/kecamatan') ?>",
                type: "GET",
                data: { q : $('#kabupaten_perusahaan').val() },
                dataType: "json",
                success: function(data) {
                    $('#kecamatan_perusahaan').empty();
                    $('#kelurahan_perusahaan').empty();
                    $('#kecamatan_perusahaan').append('<option value="">Pilih Kecamatan</option>');
                    $.each(data, function(key, value) {
                        $('#kecamatan_perusahaan').append('<option value="' + value.id + '">' + value.text + '</option>');
                    });
                }
            }); 
        })        

        $('#id_kecamatan').on('change', function() {
            $.ajax({        
                url: "<?php echo site_url('services/kelurahan') ?>",
                type: "GET",
                data: { q : $('#id_kecamatan').val() },
                dataType: "json",
                success: function(data) {
                    $('#id_kelurahan').empty();
                    $('#id_kelurahan').append('<option value="">Pilih Kelurahan</option>');
                    $.each(data, function(key, value) {
                        $('#id_kelurahan').append('<option value="' + value.id + '">' + value.text + '</option>');
                    });
                }
            }); 
        })        

        $('#kecamatan_perusahaan').on('change', function() {
            $.ajax({        
                url: "<?php echo site_url('services/kelurahan') ?>",
                type: "GET",
                data: { q : $('#kecamatan_perusahaan').val() },
                dataType: "json",
                success: function(data) {
                    $('#kelurahan_perusahaan').empty();
                    $('#kelurahan_perusahaan').append('<option value="">Pilih Kelurahan</option>');
                    $.each(data, function(key, value) {
                        $('#kelurahan_perusahaan').append('<option value="' + value.id + '">' + value.text + '</option>');
                    });
                }
            });         
        })            
    });

    function confirm_reset(username, nama, email) {
        if(confirm('Reset Password : ' + username + ' - ' + nama + ' ?')) {
            $('#btn_reset').html('<i class="fa fa-fw fa-spinner fa-spin"></i> Proses Reset Password')
            $('#btn_reset').prop('disabled',true)
            $('#btn_back').prop('disabled',true)
            $.ajax({        
                url: "<?php echo base_url().'home/forget_pass'?>",
                type: "POST",
                data: { 'recover-submit' : true, username: username },
                success: function(data) {
                    alert('Email link reset password telah terkirim ke ' + email)
                    $('#btn_reset').html('Reset Password')
                    $('#btn_reset').prop('disabled',false)
                    $('#btn_back').prop('disabled',false)
                }
            });
        }
    }

</script>