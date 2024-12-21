<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<section class="content-header">
  <h1><?= $page_title ?></h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url() ?>">Home</a></li>
    <li><a href="<?= base_url().$this->module ?>"><?= $page_title ?></a></li>
    <li class="active"><?= $title ?></li>
  </ol>
</section>

<form class="form-horizontal" method="post">
  <section class="content" style="padding:15px 15px 0px 15px;">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"><?= $title ?></h3>
          </div>

          <div class="box-body">
            <?php if ( !empty($errMsg) ) { ?>
              <div class="alert alert-danger" role="alert"><?= $errMsg ?></div>
            <?php } ?>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Layanan</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control cmb_select2" id="id_layanan" name="id_layanan" onchange="get_detail_layanan(this.value);check_id_layanan();">
                  <option value=""> - Pilih Jenis Informasi - </option>
                  <?php
                  $list_layanan = $this->global_model->get_list('m_layanan', 'id_jenis_layanan = 1 AND is_produk = 1');
                  foreach ( $list_layanan as $dt ) : ?>
                    <option value="<?= $dt->id_layanan ?>"><?= $dt->layanan ?></option>
                  <?php endforeach ?>
                </select>
                <input type="hidden" name="layanan" id="layanan" value="">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Satuan</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" id="satuan" name="satuan" max_length="100" disabled>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" id="harga" name="harga" max_length="100" disabled>
                <div id="note"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Back Office</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" max_length="100" disabled>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Berat</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" id="berat" name="berat" max_length="100" disabled>
                <div id="estimasi"></div>
              </div>
            </div>
            <div id="content_form"></div>
          </div>

          <div class="box-footer" style="text-align: center;">
            <button type="button" class="btn btn-success" id="add_produk">Tambah</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="content" style="padding:0px 15px 0px 15px;min-height:0px">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
          </div>

          <div class="box-body">
            <table id="tabel_produk" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Jenis Informasi</th>
                  <th>Harga Satuan</th>
                  <th>Satuan</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Pilihan</th>
                </tr>
              </thead>
              <tbody id="list_produk">
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="4"><strong>Total Harga</strong></th>
                  <th>
                    <input type="number" class="form-control" id="total_harga" name="total_harga" value="0" disabled>
                  </th>
                  <th></th>
                </tr>                            
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="content" style="padding:0px 15px 0px 15px;">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-footer" style="text-align: center;">
            <button type="button" class="btn btn-primary" onclick="<?= $url_back ?>">Kembali</button>
            <button type="submit" class="btn btn-success" id="submit" disabled>Proses Selanjutnya</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>

<script type="text/javascript">
  function check_id_layanan() {
    if( !$('#id_layanan').val() ) {
      $("#add_produk").attr("disabled", true);
    } else {
      $("#add_produk").attr("disabled", false);
    }
  }
  $(document).ready(function () {
    check_id_layanan();

    $(".textarea").wysihtml5();

    $('.cmb_select2').select2({
      theme: 'bootstrap'
    });

    $('#datepicker').datepicker({
      autoclose: true
    });


    $('#add_produk').click(function() {
      check_id_layanan();
      var id_layanan              = document.getElementById("id_layanan");
      var selectedVal_id_layanan  = id_layanan.options[id_layanan.selectedIndex].value;
      var layanan = 0,
        satuan = 0,
        jumlah = 0,
        jumlah_dokumen = 0,
        // jumlah_lokasi = 0,
        // jumlah_route = 0,
        jumlah_hari = 0,
        tanggal_mulai = 0,
        tanggal_selesai = 0,
        koordinat = 0,
        // jumlah_buku = 0,
        edisi = 0,
        tahun = 0,
        bulan = 0,
        provinsi = 0,
        kabupaten = 0,
        kecamatan = 0,
        upt = 0,
        // jumlah_sampel = 0,
        tambahan_perjam = 0,
        merk = 0,
        no_seri = 0,
        // jumlah_alat = 0,
        jam_mulai = 0,
        jam_selesai = 0,
        zona_waktu = 0,
        no_pendaftaran = 0,
        npt = 0,
        jurusan = 0,
        semester = 0,
        harga = 0;

      var element_layanan = document.getElementById('layanan'),
        element_satuan = document.getElementById('satuan'),
        element_jumlah = document.getElementById('jumlah'),
        element_jumlah_dokumen = document.getElementById('jumlah_dokumen'),
        // element_jumlah_lokasi = document.getElementById('jumlah_lokasi'),
        // element_jumlah_route = document.getElementById('jumlah_route'),
        element_jumlah_hari = document.getElementById('jumlah_hari'),
        element_tanggal_mulai = document.getElementById('tanggal_mulai'),
        element_tanggal_selesai = document.getElementById('tanggal_selesai'),
        element_koordinat = document.getElementById('koordinat'),
        // element_jumlah_buku = document.getElementById('jumlah_buku'),
        element_edisi = document.getElementById('edisi'),
        element_tahun = document.getElementById('tahun'),
        element_bulan = document.getElementById('bulan'),
        element_provinsi = document.getElementById('provinsi'),
        element_kabupaten = document.getElementById('kabupaten'),
        element_kecamatan = document.getElementById('kecamatan'),
        element_upt = document.getElementById('upt'),
        // element_jumlah_sampel = document.getElementById('jumlah_sampel'),
        element_tambahan_perjam = document.getElementById('tambahan_perjam'),
        element_merk = document.getElementById('merk'),
        element_no_seri = document.getElementById('no_seri'),
        // element_jumlah_alat = document.getElementById('jumlah_alat'),
        element_jam_mulai = document.getElementById('jam_mulai'),
        element_jam_selesai = document.getElementById('jam_selesai'),
        element_zona_waktu = document.getElementById('zona_waktu'),
        element_no_pendaftaran = document.getElementById('no_pendaftaran'),
        element_npt = document.getElementById('npt'),
        element_jurusan = document.getElementById('jurusan'),
        element_semester = document.getElementById('semester'),        
        element_harga = document.getElementById('harga');

      if(element_layanan != null) { layanan = element_layanan.value; }
      if(element_satuan != null) { satuan = element_satuan.value; }
      if(element_jumlah != null) { jumlah = element_jumlah.value; }
      if(element_jumlah_dokumen != null) { jumlah_dokumen = element_jumlah_dokumen.value; }
      // if(element_jumlah_lokasi != null) { jumlah_lokasi = element_jumlah_lokasi.value; }
      // if(element_jumlah_route != null) { jumlah_route = element_jumlah_route.value; }
      if(element_jumlah_hari != null) { jumlah_hari = element_jumlah_hari.value; }
      // if(element_jumlah_buku != null) { jumlah_buku = element_jumlah_buku.value; }
      // if(element_jumlah_sampel != null) { jumlah_sampel = element_jumlah_sampel.value; }
      // if(element_jumlah_alat != null) { jumlah_alat = element_jumlah_alat.value; }
      if(element_tanggal_mulai != null) { tanggal_mulai = element_tanggal_mulai.value; }
      if(element_tanggal_selesai != null) { tanggal_selesai = element_tanggal_selesai.value; }
      if(element_koordinat != null) { koordinat = element_koordinat.value; }
      if(element_edisi != null) { edisi = element_edisi.value; }
      if(element_tahun != null) { tahun = element_tahun.value; }
      if(element_bulan != null) { bulan = element_bulan.value; }
      if(element_provinsi != null) { provinsi = element_provinsi.value; }
      if(element_kabupaten != null) { kabupaten = element_kabupaten.value; }
      if(element_kecamatan != null) { kecamatan = element_kecamatan.value; }
      if(element_upt != null) { upt = element_upt.value; }
      if(element_tambahan_perjam != null) { tambahan_perjam = element_tambahan_perjam.value; }
      if(element_merk != null) { merk = element_merk.value; }
      if(element_no_seri != null) { no_seri = element_no_seri.value; }
      if(element_jam_mulai != null) { jam_mulai = element_jam_mulai.value; }
      if(element_jam_selesai != null) { jam_selesai = element_jam_selesai.value; }
      if(element_zona_waktu != null) { zona_waktu = element_zona_waktu.value; }
      if(element_no_pendaftaran != null) { no_pendaftaran = element_no_pendaftaran.value; }
      if(element_npt != null) { npt = element_npt.value; }
      if(element_jurusan != null) { jurusan = element_jurusan.value; }
      if(element_semester != null) { semester = element_semester.value; }
      if(element_harga != null) { harga = element_harga.value; }

      var harga_total;
      if(jumlah_dokumen>0) jumlah = jumlah * jumlah_dokumen
      harga_total = harga * jumlah;            

      total_harga = document.getElementById('total_harga').value;
      total_harga = parseFloat(total_harga) + parseFloat(harga_total);
      document.getElementById('total_harga').value = total_harga;

      if( total_harga > 0 ) {
        $("#submit").attr("disabled", false);
      } else {
        $("#submit").attr("disabled", true);
      }
      
      var content = '' +
        '<tr>'+
        '<td>'+ layanan + '</td>'+
        '<td>'+ harga + '</td>'+
        '<td>'+ satuan + '</td>'+
        '<td>'+ jumlah + '</td>'+
        '<td>'+ harga_total + '</td>'+
        '<td>'+
          '<button type="button" class="btn btn-danger" id="hapus" onclick="this.parentNode.parentNode.remove(this)">Hapus</button>'+
        '</td>'+
        '<input type="hidden" name="arr_id_layanan[]" value="'+selectedVal_id_layanan+'">'+
        '<input type="hidden" name="arr_jumlah[]" value="'+jumlah+'">'+
        // '<input type="hidden" name="arr_jumlah_lokasi[]" value="'+ jumlah_lokasi +'">'+
        // '<input type="hidden" name="arr_jumlah_route[]" value="'+ jumlah_route +'">'+
        '<input type="hidden" name="arr_jumlah_hari[]" value="'+ jumlah_hari +'">'+
        '<input type="hidden" name="arr_tanggal_mulai[]" value="'+ tanggal_mulai +'">'+
        '<input type="hidden" name="arr_tanggal_selesai[]" value="'+ tanggal_selesai +'">'+
        '<input type="hidden" name="arr_koordinat[]" value="'+ koordinat +'">'+
        // '<input type="hidden" name="arr_jumlah_buku[]" value="'+ jumlah_buku +'">'+
        '<input type="hidden" name="arr_edisi[]" value="'+ edisi +'">'+
        '<input type="hidden" name="arr_tahun[]" value="'+ tahun +'">'+
        '<input type="hidden" name="arr_bulan[]" value="'+ bulan +'">'+
        '<input type="hidden" name="arr_provinsi[]" value="'+ provinsi +'">'+
        '<input type="hidden" name="arr_kabupaten[]" value="'+ kabupaten +'">'+
        '<input type="hidden" name="arr_kecamatan[]" value="'+ kecamatan +'">'+
        '<input type="hidden" name="arr_upt[]" value="'+ upt +'">'+
        // '<input type="hidden" name="arr_jumlah_sampel[]" value="'+ jumlah_sampel +'">'+
        '<input type="hidden" name="arr_tambahan_perjam[]" value="'+ tambahan_perjam +'">'+
        '<input type="hidden" name="arr_merk[]" value="'+ merk +'">'+
        '<input type="hidden" name="arr_no_seri[]" value="'+ no_seri +'">'+
        // '<input type="hidden" name="arr_jumlah_alat[]" value="'+ jumlah_alat +'">'+
        '<input type="hidden" name="arr_jam_mulai[]" value="'+ jam_mulai +'">'+
        '<input type="hidden" name="arr_jam_selesai[]" value="'+ jam_selesai +'">'+
        '<input type="hidden" name="arr_zona_waktu[]" value="'+ zona_waktu +'">'+
        '<input type="hidden" name="arr_no_pendaftaran[]" value="'+ no_pendaftaran +'">'+
        '<input type="hidden" name="arr_npt[]" value="'+ npt +'">'+
        '<input type="hidden" name="arr_jurusan[]" value="'+ jurusan +'">'+
        '<input type="hidden" name="arr_semester[]" value="'+ semester +'">'+
        '<input type="hidden" name="arr_harga_satuan[]" value="'+ harga +'">'+
        '<input type="hidden" name="arr_harga[]" value="'+ harga_total +'">'+
        '</tr>';
      
      if(jumlah > 0) {
        $('#list_produk').append(content);
      }
    });
});

$(document).on('click','#hapus', function(event){
  var jumlah = 0;
  $(document).find('[name="arr_harga[]"]').each(function(i,v){
    var input = $(this).val();
    jumlah += parseFloat(input);
  });

  $('#total_harga').val(jumlah);

  if( jumlah > 0 ) {
    $("#submit").attr("disabled", false);
  } else {
    $("#submit").attr("disabled", true);
  }

});
</script>