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
                        Badan Meteorologi, Klimatologi dan Geofisika
                        <br>
                        Jl. Angkasa I No.2, Kemayoran, Jakarta Pusat
                      </td>
                      <?php if($detail['status'] == 6) { ?>
                      <td align="right"><strong><font size="7">KUITANSI</font></strong></td></strong></td>
                      <?php } elseif($detail['status'] == 7) { ?>
                      <td align="right"><strong><font size="7">KUITANSI</font></strong></td></strong></td>
                      <?php } elseif($detail['status'] == 9) { ?>
                      <td align="right"><strong><font size="7">KUITANSI</font></strong></td></strong></td>
                      <?php } elseif($detail['status'] == 10) { ?>
                      <td align="right"><strong><font size="7">KUITANSI</font></strong></td></strong></td>
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
                  </table>
                  <br>
                  <table width="100%" border="1" align="center">
                    <tbody align="center">
                      <tr>
                        <th width="5%"><center>No</center></th>
                        <th><center>Layanan</center></th>
                        <th><center>Jumlah</center></th>
                        <th><center>Biaya</center></th>
                      </tr>
                      <?php
                      $i=1;
                      foreach ($list_detail_permohonan as $detail_permohonan) {
                        $layanan = $this->db->get_where('m_layanan', ['id_layanan' => $detail_permohonan['id_layanan']]);
                      ?>
                      <tr>
                        <td><?= $i;?></td>
                        <td align="left">
                          &nbsp;<?= $layanan->row('layanan') ?>
                        </td>
                        <td><?= empty($detail_permohonan['jumlah']) ? '-' : $detail_permohonan['jumlah'] ?></td>
                        <td><?= empty($detail_permohonan['harga']) ? '-' : 'Rp. '.$detail_permohonan['harga'] ?></td>
                      </tr>
                      <?php
                      $i++;
                      }
                      ?>
                      <tr>
                        <td colspan="3">Total Harga</td>
                        <td><?= empty($detail['total_harga']) ? '-' : 'Rp. '.$detail['total_harga'];?></td>
                      </tr>
                    </tbody>
                  </table>
                  <br>
                  <?php if($detail['status'] == 3 || $detail['status'] == 8) { ?>
                  <p class="text-bold">Untuk melakukan pembayaran, silahkan pilih salah satu rekening di bawah ini : </p>
                  <ul>
                  <?php
                  $rekening = $this->db->get_where('tbl_rekening', ['aktif' => 'Ya'])->result();
                  foreach ($rekening as $key => $val) { echo '<li>'.$val->nama.' : '.$val->no_rek.'</li>'; }
                  ?>
                  </ul>
                  <?php } ?>

		  <!-- Menambahkan keterangan pada form KUITANSI. perbaikan oleh : Nurhayati Rahayu (06/11/2019) --> 	
		  <?php if($detail['status'] == 6) { ?>
                  Catatan : 
		  <br>
		  - Permohonan pelayanan akan diproses selama 14 (empat belas) hari kerja mulai sejak KUITANSI ini diterbitkan.
		  <br>
		  - PTSP menyatakan KUITANSI ini merupakan bukti pembayaran yang sah.
		  <br>
		  <br>
                  <?php } elseif($detail['status'] == 7) { ?>
                  Catatan : 
		  <br>
		  - Permohonan pelayanan akan diproses selama 14 (empat belas) hari kerja mulai sejak KUITANSI ini diterbitkan.
		  <br>
		  - PTSP menyatakan KUITANSI ini merupakan bukti pembayaran yang sah.
		  <br>
		  <br>
                  <?php } elseif($detail['status'] == 9) { ?>
                  Catatan : 
		  <br>
		  - Permohonan pelayanan akan diproses selama 14 (empat belas) hari kerja mulai sejak KUITANSI ini diterbitkan.
		  <br>
		  - PTSP menyatakan KUITANSI ini merupakan bukti pembayaran yang sah.
		  <br>
		  <br>
                  <?php } elseif($detail['status'] == 10) { ?>
                  Catatan : 
		  <br>
		  - Permohonan pelayanan akan diproses selama 14 (empat belas) hari kerja mulai sejak KUITANSI ini diterbitkan.
		  <br>
		  - PTSP menyatakan KUITANSI ini merupakan bukti pembayaran yang sah.
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
                        <td>Lesly Christoffel<hr style="height:1px;background-color:black;margin:5px">NIP.197704302008122001</td>
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