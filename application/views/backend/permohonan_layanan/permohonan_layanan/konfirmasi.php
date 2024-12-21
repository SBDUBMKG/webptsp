<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<style>
.switch-button {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 25px;
}

.switch-button input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  bottom: 0;
  width: 54px;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 20px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

<section class="content-header">
  <h1><?= $page_title ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?= site_url() ?>">Home</a></li>
    <li><a href="<?= site_url($this->module) ?>"><?= $page_title ?></a></li>
    <li class="active"><?= $title ?></li>
  </ol>
</section>

<form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"><strong>KONFIRMASI DATA PERMOHONAN</strong></h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td style="width: 400px;">Nama Pemohon</td>
                  <td style="width: 10px">:</td>
                  <td><?= empty($detail_akun->nama) ? '-' : $detail_akun->nama ?></td>
                </tr>
                <tr>
                  <td>No Permohonan</td>
                  <td style="width: 10px">:</td>
                  <td><?= empty($detail->no_permohonan) ? '-' : $detail->no_permohonan ?></td>
                </tr>
                <tr>
                  <td>Dokumen Permohonan</td>
                  <td style="width: 10px">:</td>
                  <td><a href="<?= site_url('upload/permohonan/'.$detail->permohonan) ?>" target="_blank">Lihat</a></td>
                </tr>
                <tr>
                  <td>Tanggal Permohonan</td>
                  <td style="width: 10px">:</td>
                  <td><?= empty($detail->tanggal_permohonan) ? '-' : $detail->tanggal_permohonan ?></td>
                </tr>
                <tr>
                  <td>Tanggal Verifikasi Pembayaran</td>
                  <td style="width: 10px">:</td>
                  <td><?= empty($detail->tanggal_verifikasibendahara) ? '-' : $detail->tanggal_verifikasibendahara ?></td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td style="width: 10px">:</td>
                  <td><?= status($detail->status, $this->session->userdata('id_role')) ?></td>
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
            <div class="table-responsive">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th>Layanan</th>
                    <th>Rincian</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Konfirmasi</th>
                  </tr>
                  <?php foreach ($detail_produk as $produk) { $id = $produk['id_detail_permohonan']; ?>
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
                          if(!empty($produk['jumlah_hari']) ) {
                            echo '<li>Jumlah Hari : '.$produk['jumlah_hari'].'</li>';
                          }
                          if(!empty($produk['tanggal_mulai']) && $produk['tanggal_mulai'] != '0000-00-00 00:00:00'){
                            echo '<li>Tanggal Mulai : '.format_datetime($produk['tanggal_mulai']).'</li>';
                          }
                          if(!empty($produk['tanggal_selesai']) && $produk['tanggal_selesai'] != '0000-00-00 00:00:00'){
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
                            echo '<li>Kecamatan : '.$produk['kecamatan'].'</li>';
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
                          if( !empty($produk['download']) ) {
                            echo '<li>Download : '.$produk['download'].'</li>';
                          }
                          if( !empty($produk['ambil_di_ptsp']) ) {
                            echo '<li>Ambil di PTSP : '.$produk['ambil_di_ptsp'].'</li>';
                          }
                        ?>
                      </ul>
                    </td>
                    <td><?php echo empty($produk['jumlah']) ? '-' : $produk['jumlah']; ?></td>
                    <td>Rp. <?= empty($layanan->harga) ? '-' : number_format($produk['harga_satuan'], 0 , '' , '.' ) ?></td>
                    <td>Rp. <?= empty($produk['harga']) ? '0' : number_format($produk['harga'], 0 , '' , '.' ) ?></td>
                    <td>
                      <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal_konfirmasi" onclick="detail_produk(<?=$id?>)">
                        <span class="fa fa-fw fa-check"></span>
                      </a>
                    </td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="4"><strong>Total Harga</strong></td>
                    <td><strong>Rp. <?= empty($detail->total_harga) ? '0' : number_format($detail->total_harga, 0 , '' , '.' ) ?></strong></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_konfirmasi" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h3 class="modal-title" id="myModalLabel">Konfirmasi Pesanan</h3>
          </div>
          <input type="hidden" id="id_detail_permohonan" name="id_detail_permohonan">
          <div class="modal-body">
            <input id="old_id_layanan" name="old_id_layanan" type="hidden" value="<?= $layanan->id_layanan ?>"></input>
            <div class="form-group">
                <label class="control-label col-xs-4" >Layanan</label>
                <div class="col-xs-7">
                    <select name="id_layanan" id="id_layanan" class="form-control">
                        <?php foreach($all_layanan as $layanan): ?>
                            <option value="<?= $layanan->id_layanan; ?>" data-price="<?= $layanan->harga; ?>">
                                <?= $layanan->layanan; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-4" >Jumlah</label>
              <div class="col-xs-4">
                  <input type="number" name="jumlah" id="jumlah" min="1" class="form-control text-right" required>
              </div>
            </div>
            <?php if(isset($detail_produk[0]['jumlah_dokumen'])): ?>
                <div class="form-group">
                    <label class="control-label col-xs-4" >Jumlah Dokumen</label>
                    <div class="col-xs-4">
                        <input type="number" name="jumlah_dokumen" id="jumlah_dokumen" min="1" class="form-control text-right" required>
                    </div>
                </div>
            <?php endif ?>
            <div class="form-group">
              <label class="control-label col-xs-4" >Harga Satuan</label>
              <div class="col-xs-4">
                <input name="harga_satuan" id="harga_satuan" class="form-control text-right" type="text" value="<?php echo !empty($layanan->harga) ? $layanan->harga : 0?>" required>
              </div>
              <div class="col-xs-4" style="padding-left: 0px; margin-top: 5px">
                  <label class="switch-button">
                    <input type="checkbox" name="tarifNol" id="tarifNol" aria-hidden="true">
                    <span class="slider round"></span>
                  </label>
                  <label style="">Tarif Rp.0</label>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-4">Keterangan</label>
              <div class="col-xs-8">
                  <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-xs-4" >Total Harga</label>
              <div class="col-xs-4">
                  <input name="harga" id="harga" class="form-control text-right" type="text" readonly>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" name="tutup" class="pull-left btn btn-warning" data-dismiss="modal" aria-label="Close">Tutup</button>
            <button type="submit" name="btn_tersedia" class="btn btn-success">Tersedia</button>
            <button type="submit" name="btn_tidak_tersedia" class="btn btn-danger">Tidak Tersedia</button>
          </div>
        </div>
      </div>
    </div>

    <!--upload bukti pembayaran-->
    <?php if($detail->status === 3) { ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Upload Bukti Pembayaran</h3>
          </div>

          <div class="box-body">
            <?php if ( !empty($errMsg) ) { ?>
            <div class="alert alert-danger" role="alert"><?= $errMsg ?></div>
            <?php } ?>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Bukti pembayaran</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" required>
              </div>
            </div>
          </div>
          <div class="box-footer" style="text-align: center;">
            <button type="button" class="btn btn-success" id="bukti_pembayaran">Upload</button>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>

    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-footer" style="text-align: center;">
            <button type="button" class="btn btn-primary" onclick="<?= $url_back ?>">Kembali</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>

let temp_harga_satuan = 0;
$(document).ready(function() {

    function amountChange() {
        const jumlah = $('#jumlah').val();
        const jumlah_dokumen = $('#jumlah_dokumen').val();
        const harga_satuan = $('#harga_satuan').val().replace(/\./g, '');

        let total = (jumlah * harga_satuan);
        if (jumlah_dokumen) {
            total = total * jumlah_dokumen;
        }

        $('#harga_satuan').val(formatRupiah(harga_satuan));
        $('#harga').val(formatRupiah(total));
    }

    $("#jumlah").on("input", amountChange);
    $('#harga_satuan').on('input', amountChange);
    $("#jumlah_dokumen").on("input", amountChange);

    $('#id_layanan').change(function() {
        const selected = $(this).find('option:selected');
        const dataPrice = selected.data('price');

        $('#harga_satuan').val(dataPrice).trigger('input');
    });

    $('#modal_konfirmasi').on('shown.bs.modal', function() {
        $('#jumlah').focus();
    })

    $("#tarifNol").on('change', function() {
        const checked = $(this).is(':checked');
        const harga_satuan_comp = $('#harga_satuan');

        if (checked) {
            temp_harga_satuan = harga_satuan_comp.val();
            harga_satuan_comp.val('0').trigger('input');
            return;
        }

        harga_satuan_comp.val(temp_harga_satuan).trigger('input');
    });
});

function formatRupiah(angka, prefix){
    var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
    split       = number_string.split(','),
    sisa        = split[0].length % 3,
    rupiah        = split[0].substr(0, sisa),
    ribuan        = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
  }

function detail_produk(id)
{
  $.ajax({
    url : "<?php echo base_url().'backend/permohonan_layanan/permohonan_layanan/detail_produk'?>",
    type: "POST",
    data      : {
        id_detail_permohonan   : id
    },
    dataType: "JSON",
     error: function (request, error) {
        console.log(arguments);
        alert(" Can't do because: " + error);
    },
    success: function(data)
    {
      $('#jumlah').val(data.jumlah);
      $('#jumlah_dokumen').val(data.jumlah_dokumen);
      $('#harga_satuan').val(formatRupiah(data.harga_satuan));
      $('#harga').val(formatRupiah(data.harga));
      $('#id_detail_permohonan').val(id);
      $('#id_layanan').val(data.id_layanan);

      temp_harga_satuan = formatRupiah(data.harga_asli);
      temp_harga = formatRupiah(data.harga_asli * data.jumlah);

      if (data.harga_satuan == 0 && data.harga == 0) {
        $('#tarifNol').prop('checked', true);
      }
    }
  });
}
</script>
