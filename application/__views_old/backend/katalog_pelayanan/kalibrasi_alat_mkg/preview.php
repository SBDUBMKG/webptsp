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

<form method="post">
  <section class="content">
    <!--data permohonan-->
    <div class="row">
        <div class="col-xs-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>DATA PERMOHONAN</strong></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                  <table class="table table-striped">
                      <tbody>
                         <tr>
                            <td>No Permohonan</td>
                            <td style="width: 10px">:</td>
                            <td><?php echo empty($detail['no_permohonan']) ? '-' : $detail['no_permohonan']; ?></td>
                         </tr>
                         <tr>
                            <td>Tanggal Permohonan</td>
                            <td style="width: 10px">:</td>
                            <td><?php echo empty($detail['tanggal_permohonan']) ? '-' : format_datetime($detail['tanggal_permohonan']); ?></td>
                         </tr>
                         <tr>
                            <td>Status</td>
                            <td style="width: 10px">:</td>
                            <td><?php echo empty($detail['status']) ? '-' : $detail['status'] == 0 ? 'Submited' : ' - '; ?></td>
                         </tr>
                      </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>

    <!--data produk-->
    <div class="row">
        <div class="col-xs-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>DATA PRODUK</strong></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                  <table class="table table-bordered">
                      <tbody>
                         <tr>
                           <th>Layanan</th>
                           <th>Rincian</th>
                           <th>Jumlah</th>
                           <th>Harga</th>
                         </tr>
                         <?php 
                         foreach ($detail_produk as $produk) {
                         ?>
                         <tr>
                           <td>
                              <?php 
                                $con = "id_layanan = ".$produk['id_layanan'];
                                $this->db->from('m_layanan')->where($con);
                                $query = $this->db->get();
                                $layanan = $query->row();
                                echo empty($layanan->layanan) ? '-' : $layanan->layanan;
                              ?>
                           </td>
                           <td>
                              <ul>
                                <?php
                                if($produk['jumlah_orang'] != '0'){
                                  echo '<li>Jumlah Orang : '.$produk['jumlah_orang'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['jumlah_alat'] != '0'){
                                  echo '<li>Jumlah Alat : '.$produk['jumlah_alat'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['tanggal_mulai'] != '0000-00-00 00:00:00'){
                                  echo '<li>Tanggal Mulai : '.format_datetime($produk['tanggal_mulai']).'</li>';
                                }
                                ?>
                                <?php
                                if($produk['tanggal_selesai'] != '0000-00-00 00:00:00'){
                                  echo '<li>Tanggal Selesai : '.format_datetime($produk['tanggal_selesai']).'</li>';
                                }
                                ?>
                                <?php
                                if($produk['tahun'] != '0'){
                                  echo '<li>Tahun : '.$produk['tahun'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['bulan'] != '0'){
                                  echo '<li>Bulan : '.get_nama_bulan($produk['bulan']).'</li>';
                                }
                                ?>
                                <?php
                                if($produk['provinsi'] != '0'){
                                  $provinsi = $this->global_model->get_by_id('m_provinsi', 'id_provinsi', $produk['provinsi']);
                                  echo '<li>Provinsi : '.$provinsi->provinsi.'</li>';
                                }
                                ?>
                                <?php
                                if($produk['kabupaten'] != '0'){
                                  $kabkot = $this->global_model->get_by_id('m_kabkot', 'id_kabkot', $produk['kabupaten']);
                                  echo '<li>Kabupaten : '.$kabkot->kabkot.'</li>';
                                }
                                ?>
                                <?php
                                if($produk['kecamatan'] != '0'){
                                  echo '<li>Kecamatan : '.$produk['kecamatan'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['upt'] != '0'){
                                  echo '<li>UPT : '.$produk['upt'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['tambahan_perjam'] != '0'){
                                  echo '<li>Tambahan Perjam : '.$produk['tambahan_perjam'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['merk'] != '0'){
                                  echo '<li>Merk : '.$produk['merk'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['no_seri'] != '0'){
                                  echo '<li>No Seri : '.$produk['no_seri'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['jam_mulai'] != '0'){
                                  echo '<li>Jam Mulai : '.$produk['jam_mulai'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['edisi'] != '0'){
                                  echo '<li>Edisi : '.$produk['edisi'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['zona_waktu'] != '0'){
                                  echo '<li>Zona Waktu : '.$produk['zona_waktu'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['npt'] != '0'){
                                  echo '<li>NPT : '.$produk['npt'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['no_pendaftaran'] != '0'){
                                  echo '<li>No Pendaftaran : '.$produk['no_pendaftaran'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['jam_selesai'] != '0'){
                                  echo '<li>Jam Selesai : '.$produk['jam_selesai'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['jurusan'] != '0'){
                                  echo '<li>Jurusan : '.$produk['jurusan'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['menyerahkan_sampel'] != '0'){
                                  echo '<li>Menyerahkan Sampel : '.$produk['menyerahkan_sampel'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['semester'] != '0'){
                                  echo '<li>Semester : '.$produk['semester'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['download'] != '0'){
                                  echo '<li>Download : '.$produk['download'].'</li>';
                                }
                                ?>
                                <?php
                                if($produk['ambil_di_ptsp'] != '0'){
                                  echo '<li>Ambil di PTSP : '.$produk['ambil_di_ptsp'].'</li>';
                                }
                                ?>
                              </ul>
                           </td>
                           <td><?php echo empty($produk['jumlah_produk']) ? '-' : $produk['jumlah_produk']; ?></td>
                           <td>Rp. <?php echo empty($produk['harga']) ? '-' : $produk['harga']; ?></td>
                         </tr>
                         <?php } ?>
                         <tr>
                           <td colspan="3"><strong>Total Harga</strong></td>
                            <td><strong>Rp. <?php echo empty($detail['total_harga']) ? '-' : $detail['total_harga']; ?></strong></td>
                         </tr>
                      </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-footer" style="text-align: center;">
                  <button type="button" class="btn btn-primary" onclick="<?php echo $url_back; ?>">Kembali</button>
                </div> 
            </div>
        </div>
    </div>
  </section>
</form>