<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<section class="content-header">
  <h1><?= $page_title ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url() ?>">Home</a></li>
    <li><a href="<?= site_url($this->module) ?>"><?= $page_title ?></a></li>
    <li class="active"><?= $title ?></li>
  </ol>
</section>

<form method="post" enctype="multipart/form-data" action="">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"><strong>DATA PERMOHONAN</strong></h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td>No Permohonan</td>
                  <td style="width: 10px">:</td>
                  <td><?= empty($detail['no_permohonan']) ? '-' : $detail['no_permohonan']; ?></td>
                </tr>
                <tr>
                  <td>Tanggal Permohonan</td>
                  <td style="width: 10px">:</td>
                  <td><?= empty($detail['tanggal_permohonan']) ? '-' : format_datetime($detail['tanggal_permohonan']); ?></td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td style="width: 10px">:</td>
                  <td><?= status($detail['status'], $this->session->userdata('id_role')) ?></td>
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
                  <?php if($detail['status'] == 7 || $detail['status'] == 10) { ?>
                  <th>Download Data</th>
                  <?php } ?>
                </tr>
                <?php foreach ($detail_produk as $produk) { ?>
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
                    <?php
                      if(!empty($produk['jumlah_hari'])){
                        echo '<li>Jumlah Hari : '.$produk['jumlah_hari'].'</li>';
                      }
                      if($produk['tanggal_mulai'] != '0000-00-00 00:00:00'){
                        echo '<li>Tanggal Mulai : '.format_datetime($produk['tanggal_mulai']).'</li>';
                      }
                      if($produk['tanggal_selesai'] != '0000-00-00 00:00:00'){
                        echo '<li>Tanggal Selesai : '.format_datetime($produk['tanggal_selesai']).'</li>';
                      }
                      if( !empty($produk['tahun']) ){
                        echo '<li>Tahun : '.$produk['tahun'].'</li>';
                      }
                      if( !empty($produk['bulan']) ) {
                        echo '<li>Bulan : '.get_nama_bulan($produk['bulan']).'</li>';
                      }
                      if( !empty($produk['provinsi']) ) {
                      $provinsi = $this->global_model->get_by_id('m_provinsi', 'id_provinsi', $produk['provinsi']);
                      echo '<li>Provinsi : '.$provinsi->provinsi.'</li>';
                      }
                      if( !empty($produk['kabupaten']) ) {
                      $kabkot = $this->global_model->get_by_id('m_kabkot', 'id_kabkot', $produk['kabupaten']);
                      echo '<li>Kabupaten : '.$kabkot->kabkot.'</li>';
                      }
                      if( !empty($produk['kecamatan']) ) {
                      $kecamatan = $this->global_model->get_by_id('m_kecamatan', 'id_kecamatan', $produk['kecamatan']);
                      echo '<li>Kecamatan : '.$kecamatan->kecamatan.'</li>';
                      }
                      if( !empty($produk['upt']) ) {
                        echo '<li>UPT : '.$produk['upt'].'</li>';
                      }
                      if( !empty($produk['tambahan_perjam']) ) {
                        echo '<li>Tambahan Perjam : '.$produk['tambahan_perjam'].'</li>';
                      }
                      if( !empty($produk['merk']) ) {
                        echo '<li>Merk : '.$produk['merk'].'</li>';
                      }
                      if( !empty($produk['no_seri']) ) {
                        echo '<li>No Seri : '.$produk['no_seri'].'</li>';
                      }
                      if( !empty($produk['jam_mulai']) ) {
                        echo '<li>Jam Mulai : '.$produk['jam_mulai'].'</li>';
                      }
                      if( !empty($produk['edisi']) ) {
                        echo '<li>Edisi : '.$produk['edisi'].'</li>';
                      }
                      if( !empty($produk['koordinat']) ) {
                        echo '<li>Koordinat : '.$produk['koordinat'].'</li>';
                      }
                      if( !empty($produk['zona_waktu']) ) {
                        echo '<li>Zona Waktu : '.$produk['zona_waktu'].'</li>';
                      }
                      if( !empty($produk['npt']) ) {
                        echo '<li>NPT : '.$produk['npt'].'</li>';
                      }
                      if( !empty($produk['no_pendaftaran']) ) {
                        echo '<li>No Pendaftaran : '.$produk['no_pendaftaran'].'</li>';
                      }
                      if( !empty($produk['jam_selesai']) ) {
                        echo '<li>Jam Selesai : '.$produk['jam_selesai'].'</li>';
                      }
                      if( !empty($produk['jurusan']) ) {
                        echo '<li>Jurusan : '.$produk['jurusan'].'</li>';
                      }
                      if( !empty($produk['menyerahkan_sampel']) ) {
                        echo '<li>Menyerahkan Sampel : '.$produk['menyerahkan_sampel'].'</li>';
                      }
                      if( !empty($produk['semester']) ) {
                        echo '<li>Semester : '.$produk['semester'].'</li>';
                      }
                    ?>
                    <?php
                    if( $produk['ambil_di_ptsp'] == "Ya" ) {
                      echo '<b>Silahkan ambil di PTSP</b><br>';
                    }
                    if( !empty($produk['catatan']) ) {
                        echo '<b>Catatan</b> : '.$produk['catatan'];
                      }
                    ?>
                  </td>
                  <td><?= empty($produk['jumlah']) ? '-' : $produk['jumlah']; ?></td>
                  <td>Rp. <?= empty($produk['harga']) ? '-' : number_format($produk['harga'], 0 , '' , '.' ) ?></td>
                  <?php if($detail['status'] == 7 || $detail['status'] == 10) { ?>
                  <td>
                    <?php
                    if( !empty($produk['download']) ) {
                      echo '<a class="btn btn-sm btn-primary" href="'.site_url('upload/dokumen/'.$produk['download']).'">Dokumen</a> ';
                    } else {
                      echo 'Tidak ada dokumen';
                    }
                    ?>
                  </td>
                  <?php } ?>
                </tr>
                <?php } ?>
                  <td colspan="3"><strong>Total Harga</strong></td>
                  <td><strong>Rp. <?= empty($detail['total_harga']) ? '-' : number_format($detail['total_harga'], 0 , '' , '.' ) ?></strong></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-footer" style="text-align: center;">
            <button type="button" class="btn btn-primary" onclick="<?= $url_back ?>">Kembali</button>
            <a class="btn btn-success" href="<?= site_url('backend/katalog_pelayanan/informasi_mkg/invoice/'.$detail['id_permohonan']) ?>" target="_blank">Cetak Faktur</a>
          </div> 
        </div>
      </div>
    </div>
  </section>
</form>