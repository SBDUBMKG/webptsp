<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<style type="text/css">
@media print {
  .box-footer * {
    visibility: hidden;
  }
  .box-header * {
    visibility: hidden;
  }
}
</style>

<section class="content-header">
  <h1><?= $page_title; ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url() ?>">Home</a></li>
    <li><a href="<?= site_url($this->module) ?>"><?= $page_title ?></a></li>
    <li class="active"><?= $title ?></li>
  </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $title; ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body" id="printspb">
                  <table width="100%" border="0">
                    <tr>
                      <td width="13%"><img src="<?= base_url().'resources/images/logo_bmkg.png'?>" alt="" height="100"></td>
                      <td>
                        Pelayanan Terpadu Satu Pintu
                        <br>
                        Badan Meteorologi, Klimatologi, dan Geofisika
                        <br>
                        Jl. Angkasa I No.2, Kemayoran, Jakarta Pusat
                      </td>
                      <?php if($detail['status'] == 6) { ?>
                      <td align="right"><strong><font size="7">KWITANSI</font></strong></td></strong></td>
                      <?php } elseif($detail['status'] == 7) { ?>
                      <td align="right"><strong><font size="7">KWITANSI</font></strong></td></strong></td>
                      <?php } elseif($detail['status'] == 9) { ?>
                      <td align="right"><strong><font size="7">KWITANSI</font></strong></td></strong></td>
                      <?php } elseif($detail['status'] == 10) { ?>
                      <td align="right"><strong><font size="7">KWITANSI</font></strong></td></strong></td>
                      <?php } else { ?>
                      <td align="right"><strong><font size="7">INVOICE</td>
                      <?php } ?>
                    </tr>
                  </table>
                  <hr style="height:1px;background-color:black;">
                  Kepada Pelanggan Yth,
                  <table width="100%" border="0">
                    <tr>
                      <td style="width:20%">No Pelanggan</td>
                      <td style="width:1%"> : </td>
                      <td><?= empty($data_pemohon['no_ktp']) ? '-' : $data_pemohon['no_ktp'];?></td>
                      <td style="width:20%">No Invoice</td>
                      <td style="width:1%"> : </td>
                      <td><?= empty($detail['no_permohonan']) ? '-' : $detail['no_permohonan'];?></td>
                    </tr>
                    <tr>
                      <td style="width:20%">Nama</td>
                      <td style="width:1%"> : </td>
                      <td><?= empty($data_pemohon['nama']) ? '-' : $data_pemohon['nama'];?></td>
                      <td style="width:20%">Tanggal</td>
                      <td style="width:1%"> : </td>
                      <td><?= empty($detail['tanggal_permohonan']) ? '-' : format_datetime($detail['tanggal_permohonan']);?></td>
                    </tr>
                    <!-- Awal script yang dinon-aktifkan Rahmat, 9 April 2021 -->
          					<!--
          						<?php
          						$perusahaan = get_nama_perusahaan($detail['id_pemohon']);
          						if (!empty($perusahaan)) {
          						?>
          						<tr>
          							<td style="width:20%">Perusahaan</td>
          							<td style="width:1%"> : </td>
          							<td><?= $perusahaan;?></td>
          							<td>&nbsp;</td>
          							<td>&nbsp;</td>
          							<td>&nbsp;</td>
          						</tr>
          						<?php } ?>
          						<tr>
          							<td style="width:20%">No HP</td>
          							<td style="width:1%"> : </td>
          							<td><?= empty($data_pemohon['no_hp']) ? '-' : $data_pemohon['no_hp'];?></td>
          							<td style="width:20%">Status</td>
          							<td style="width:1%"> : </td>
          							<td colspan="4"><?php if($detail['status'] == 6) { ?>Lunas
          									<?php } elseif($detail['status'] == 7) { ?>Lunas
          									<?php } elseif($detail['status'] == 9) { ?>Lunas
          									<?php } elseif($detail['status'] == 10) { ?>Lunas
          									<?php } else { ?>Belum Dibayar<?php } ?>
          							</td>
          						</tr>
          						<tr>
          							<td style="width:20%">Alamat</td>
          							<td style="width:1%"> : </td>
          							<td><?= empty($data_pemohon['alamat']) ? '-' : $data_pemohon['alamat'];?></td>
          						</tr>
          						-->
          						<!-- Akhir script yang dinon-aktifkan Rahmat, 9 April 2021 -->

						          <!-- Awal script yang ditambahkan Rahmat, 9 April 2021 -->
            					<?php
                           $perusahaan = $this->app_model->get_perusahaan_pemohon($detail['id_permohonan']);
                           if (!empty($perusahaan)) {
                       ?>
                       <tr>
                          <td style="width:20%">Perusahaan</td>
                          <td style="width:1%"> : </td>
                          <td><?= empty($perusahaan[0]['id_perusahaan']) ? '-': $perusahaan[0]['perusahaan'];?></td>
                          <td style="width:20%">Status</td>
                          <td style="width:1%"> : </td>
                          <td colspan="4">
                          <?php if (empty($detail['total_harga']) || $detail['total_harga'] == 0): ?>
                            Tarif Nol Rupiah
                          <?php else: ?>
                            <?php if($detail['status'] == 6) { ?>Lunas
                            <?php } elseif($detail['status'] == 7) { ?>Lunas
                            <?php } elseif($detail['status'] == 9) { ?>Lunas
                            <?php } elseif($detail['status'] == 10) { ?>Lunas
                            <?php } else { ?>Belum Dibayar<?php } ?>
                          <?php endif ?>
                          </td>
                       </tr>
                       <?php } ?>
                       <tr>
                          <td style="width:20%">No HP</td>
                          <td style="width:1%"> : </td>
                          <td><?= empty($data_pemohon['no_hp']) ? '-' : $data_pemohon['no_hp'];?></td>
                          <td>&nbsp;</td>
            					    <td>&nbsp;</td>
            					    <td>&nbsp;</td>
                       </tr>
                       <tr>
                           <td style="width:20%">Alamat</td>
                           <td style="width:1%"> : </td>
                           <td><?= empty($data_pemohon['alamat']) ? '-' : $data_pemohon['alamat'];?></td>
                       </tr>
            					<!-- Akhir script yang ditambahkan Rahmat, 9 April 2021 -->

                  </table>
                  <br>
                  <table width="100%" border="1" align="center">
                    <tbody align="center">
                      <tr>
                        <th width="5%"><center>No</center></th>
                        <th><center>Layanan</center></th>
                        <th class="text-center">Rincian</th>
                        <th><center>Jumlah</center></th>
                        <th><center>Satuan</center></th>
                        <th><center>Biaya</center></th>
                      </tr>
                      <?php
                      $i=1;
                      foreach ($list_detail_permohonan as $detail_permohonan) {
                        $layanan = $this->db->get_where('m_layanan', ['id_layanan' => $detail_permohonan['id_layanan']]);
                      ?>
                      <tr>
                        <td><?= $i;?></td>
                        <td>
                          &nbsp;<?= $layanan->row('layanan') ?>
                        </td>
                        <td class="text-left" style="padding-left:5px">
                          <?php
                            if(!empty($detail_permohonan['jumlah_hari'])){
                              echo '<li>Jumlah Hari : '.$detail_permohonan['jumlah_hari'].'</li>';
                            }
                            if($detail_permohonan['tanggal_mulai'] && $detail_permohonan['tanggal_mulai'] != '0000-00-00 00:00:00'){
                              echo '<li>Tanggal Mulai : '.format_datetime($detail_permohonan['tanggal_mulai']).'</li>';
                            }
                            if($detail_permohonan['tanggal_selesai'] && $detail_permohonan['tanggal_selesai'] != '0000-00-00 00:00:00'){
                              echo '<li>Tanggal Selesai : '.format_datetime($detail_permohonan['tanggal_selesai']).'</li>';
                            }
                            if( !empty($detail_permohonan['tahun']) ){
                              echo '<li>Tahun : '.$detail_permohonan['tahun'].'</li>';
                            }
                            if( !empty($detail_permohonan['bulan']) ) {
                              echo '<li>Bulan : '.get_nama_bulan($detail_permohonan['bulan']).'</li>';
                            }
                            if( !empty($detail_permohonan['provinsi']) ) {
                            $provinsi = $this->global_model->get_by_id('m_provinsi', 'id_provinsi', $detail_permohonan['provinsi']);
                            echo '<li>Provinsi : '.$provinsi->provinsi.'</li>';
                            }
                            if( !empty($detail_permohonan['kabupaten']) ) {
                            $kabkot = $this->global_model->get_by_id('m_kabkot', 'id_kabkot', $detail_permohonan['kabupaten']);
                            echo '<li>Kabupaten : '.$kabkot->kabkot.'</li>';
                            }
                            if( !empty($detail_permohonan['kecamatan']) ) {
                            $kecamatan = $this->global_model->get_by_id('m_kecamatan', 'id_kecamatan', $detail_permohonan['kecamatan']);
                            echo '<li>Kecamatan : '.$kecamatan->kecamatan.'</li>';
                            }
                            if( !empty($detail_permohonan['upt']) ) {
                              echo '<li>UPT : '.$detail_permohonan['upt'].'</li>';
                            }
                            if( !empty($detail_permohonan['tambahan_perjam']) ) {
                              echo '<li>Tambahan Perjam : '.$detail_permohonan['tambahan_perjam'].'</li>';
                            }
                            if( !empty($detail_permohonan['merk']) ) {
                              echo '<li>Merk : '.$detail_permohonan['merk'].'</li>';
                            }
                            if( !empty($detail_permohonan['no_seri']) ) {
                              echo '<li>No Seri : '.$detail_permohonan['no_seri'].'</li>';
                            }
                            if( !empty($detail_permohonan['jam_mulai']) ) {
                              echo '<li>Jam Mulai : '.$detail_permohonan['jam_mulai'].'</li>';
                            }
                            if( !empty($detail_permohonan['edisi']) ) {
                              echo '<li>Edisi : '.$detail_permohonan['edisi'].'</li>';
                            }
                            if( !empty($detail_permohonan['koordinat']) ) {
                              echo '<li>Koordinat : '.$detail_permohonan['koordinat'].'</li>';
                            }
                            if( !empty($detail_permohonan['zona_waktu']) ) {
                              echo '<li>Zona Waktu : '.$detail_permohonan['zona_waktu'].'</li>';
                            }
                            if( !empty($detail_permohonan['npt']) ) {
                              echo '<li>NPT : '.$detail_permohonan['npt'].'</li>';
                            }
                            if( !empty($detail_permohonan['no_pendaftaran']) ) {
                              echo '<li>No Pendaftaran : '.$detail_permohonan['no_pendaftaran'].'</li>';
                            }
                            if( !empty($detail_permohonan['jam_selesai']) ) {
                              echo '<li>Jam Selesai : '.$detail_permohonan['jam_selesai'].'</li>';
                            }
                            if( !empty($detail_permohonan['jurusan']) ) {
                              echo '<li>Jurusan : '.$detail_permohonan['jurusan'].'</li>';
                            }
                            if( !empty($detail_permohonan['menyerahkan_sampel']) ) {
                              echo '<li>Menyerahkan Sampel : '.$detail_permohonan['menyerahkan_sampel'].'</li>';
                            }
                            if( !empty($detail_permohonan['semester']) ) {
                              echo '<li>Semester : '.$detail_permohonan['semester'].'</li>';
                            }
                            if( !empty($detail_permohonan['nama_alat']) ) {
                              echo '<li>Nama Alat : '.$detail_permohonan['nama_alat'].'</li>';
                            }
                            if( !empty($detail_permohonan['tipe']) ) {
                              echo '<li>Tipe : '.$detail_permohonan['tipe'].'</li>';
                            }
                          ?>
                          <?php
                          if( $detail_permohonan['ambil_di_ptsp'] == "Ya" ) {
                            echo '<b>Silahkan ambil di PTSP</b><br>';
                          }
			  // menghilangkan catatan. Perubahan oleh :Nurhayati Rahayu (14042020)
                          //if( !empty($detail_permohonan['catatan']) ) {
                          //    echo '<b>Catatan</b> : '.$detail_permohonan['catatan'];
                          //  }
                          ?>
                        </td>
                        <td><?= empty($detail_permohonan['jumlah']) ? '-' : $detail_permohonan['jumlah'] ?></td>
                        <td><?= empty($layanan->row('satuan')) ? '-' : $layanan->row('satuan') ?></td>
                        <td class="text-right" style="padding-right:5px"><?= empty($detail_permohonan['harga']) ? '-' : 'Rp. '.number_format($detail_permohonan['harga'],0,',','.') ?></td>
                      </tr>
                      <?php
                      $i++;
                      }
                      ?>
                      <tr>
                        <td colspan="5">Total Harga</td>
                        <td class="text-right" style="padding-right:5px"><?= empty($detail['total_harga']) ? '-' : 'Rp. '.number_format($detail['total_harga'],0,',','.');?></td>
                      </tr>
                    </tbody>
                  </table>
                  <br>
                  <?php if($detail['status'] == 3 || $detail['status'] == 8) { ?>
                  <p class="text-bold">Untuk melakukan pembayaran, silahkan pilih salah satu rekening di bawah ini : </p>
                  <ul>
                  <?php
                  $rekening = $this->db->get_where('tbl_rekening', ['aktif' => 'Ya'])->result();
                  // Script yang diedit Rahmat, 12 Agustus 2020
                  // asalnya '<li>'.$val->nama.' : '.$val->no_rek.'</li>'; => '<li>'.$val->no_rek.' : '.$val->nama.'</li>';
                  foreach ($rekening as $key => $val) { echo '<li>'.$val->no_rek.' : '.$val->nama.'</li>'; }
                  ?>
                  </ul>
                  <?php } ?>

		  <!-- Menambahkan keterangan pada form KWITANSI. perbaikan oleh : Nurhayati Rahayu (06/11/2019) -->
		  <?php if($detail['status'] == 6) { ?>
                  Catatan :
                  <br>
                  - Permohonan pelayanan akan diproses selama 14 (empat belas) hari kerja mulai sejak KWITANSI ini diterbitkan.
                  <br>
                  - PTSP menyatakan KWITANSI ini merupakan bukti pembayaran yang sah.
                  <br>
                  <br>
                  <?php } elseif($detail['status'] == 7) { ?>
                  Catatan :
                  <br>
                  - Permohonan pelayanan akan diproses selama 14 (empat belas) hari kerja mulai sejak KWITANSI ini diterbitkan.
                  <br>
                  - PTSP menyatakan KWITANSI ini merupakan bukti pembayaran yang sah.
                  <br>
                  <br>
                  <?php } elseif($detail['status'] == 9) { ?>
                  Catatan :
                  <br>
                  - Permohonan pelayanan akan diproses selama 14 (empat belas) hari kerja mulai sejak KWITANSI ini diterbitkan.
                  <br>
                  - PTSP menyatakan KWITANSI ini merupakan bukti pembayaran yang sah.
                  <br>
                  <br>
                  <?php } elseif($detail['status'] == 10) { ?>
                  Catatan :
                  <br>
                  - Permohonan pelayanan akan diproses selama 14 (empat belas) hari kerja mulai sejak KWITANSI ini diterbitkan.
                  <br>
                  - PTSP menyatakan KWITANSI ini merupakan bukti pembayaran yang sah.
                  <br>
                  <br>
                  <?php } ?>
           	  <!-- baris terakhir perbaikan -->


                  <table width="100%" border="0" align="center">
                    <tbody align="center">
                      <tr>
                        <td style="width:70%"></td>
                        <td>Bendahara PTSP BMKG</td>
                      </tr>
                      <tr>
                        <td style="width:70%"></td>
                        <td><br>ttd<br><br></td>
                      </tr>
                      <tr>
                        <td style="width:70%"></td>
                        <!-- merubah nama bendahara. Perbaikan oleh : Nurhayati Rahayu (31/10/2019) -->
                        <td><?php echo $detail['nama_bendahara']?><hr style="height:1px;background-color:black;margin:5px">NIP.<?php echo $detail['nip_bendahara']?></td>
                        <!-- baris terakhir perbaikan -->
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer" style="text-align: center;">
                  <button type="button" class="btn btn-success" onclick="printDiv('printspb')">Print</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
  }
</script>
