function get_detail_layanan(id_layanan) {
  $.ajax({
    type: "GET",
    url: base_url + "services/get_detail_layanan?id_layanan=" + id_layanan,
    success: function(msg) {
      var data                = JSON.parse(msg),
      result_layanan          = data.layanan,
      result_addformlayanan   = data.addformlayanan,
      result_addform          = data.addform,
      result_note             = data.note,
      result_berat            = result_layanan['berat'],
      result_satuan           = result_layanan['satuan_berat'],
      result_estimasi         = result_layanan['estimasi'];

      if(result_berat != 0 ) {
        if(result_berat != null) {
          result_berat = result_berat + " " + result_satuan;
        } else {
          result_berat = "";
        }
      } else {
        result_berat = "";
      }
      if (result_estimasi != null) {
        estimasi = '<div id="estimasi" class="alert alert-success alert-dismissible" role="alert" style="margin:5px 0 0; padding: 5px 10px">'+
        'Estimasi Pengerjaan Produk selama ' + result_estimasi + ' Hari Kerja.</div>';
        $('#estimasi').replaceWith(estimasi);
      } else {
        $('#estimasi').replaceWith('<div id="estimasi"></div>');
      }
      if (result_note != null) {
        $('#note').replaceWith(result_note);
      } else {
        $('#note').replaceWith('<div id="note"></div>');
      }

      document.getElementById('satuan').value             = result_layanan['satuan'];
      document.getElementById('harga').value              = result_layanan['harga'];
      document.getElementById('penanggung_jawab').value   = result_layanan['penanggung_jawab'];
      document.getElementById('berat').value              = result_berat;

      $('#content_form').replaceWith(result_addform);
      $('#layanan').replaceWith(result_addformlayanan);

      $('.cmb_select2').select2({
        theme: 'bootstrap'
      });

      $('#tanggal_mulai').datepicker({
        autoclose: true
      });
      $('#tanggal_selesai').datepicker({
        autoclose: true
      });
    },
    error: function(xhr, msg, e) {
      console.log(xhr.responseText);
    }
  });
}

function show_detail_layanan(id_layanan) {
  $.ajax({
    type: "GET",
    url: base_url + "services/get_detail_layanan?id_layanan=" + id_layanan,
    success: function(msg) {
      var data                    = JSON.parse(msg);
      var result_layanan          = data.layanan;
      var result_addformlayanan   = data.addformlayanan;
      var result_addform          = data.addform;

      document.getElementById('satuan').value = result_layanan['satuan'];
      document.getElementById('harga').value  = result_layanan['harga'];
      document.getElementById('penanggung_jawab').value   = result_layanan['penanggung_jawab'];
      document.getElementById('berat').value  = result_layanan['berat'] + " " + result_layanan['satuan_berat'];
      document.getElementById('satuan_berat').value = result_layanan['satuan_berat'];

      $('#t_layanan').val(result_layanan['layanan']);
      $('#content_form').replaceWith(result_addform);
      $('#layanan').replaceWith(result_addformlayanan);
      $('.cmb_select2').select2({
        theme: 'bootstrap'
      });
      $('#tanggal_mulai').datepicker({
        autoclose: true
      });
      $('#tanggal_selesai').datepicker({
        autoclose: true
      });
    },
    error: function(xhr, msg, e) {
      console.log(xhr.responseText);
    }
  });
}