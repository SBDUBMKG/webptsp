<?php
/*
 * Author : Arif Kurniawan
 * Email : arif.kurniawan86@gmail.com
 * Website : infoharga123.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
.jssocials-share-link { border-radius: 50%; }
</style>

<div class="wrapper row3">
  <main class="hoc container clear"> 
    <div class="content"> 
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li class="active"><?php echo $title ?></li>
      </ol>
      <div class="table-responsive">
      <table class="table table-bordered" id="datatable">
          <thead>
          <tr>
              <th style="width: 20px;">No</th>
              <th>Judul</th>
              <th>Lampiran</th>
              <th>Hit</th>
              <th></th>
          </tr>
          </thead>
          <tbody></tbody>
      </table>
      </div>
    </div>
  </main>
</div>
<script>
$(document).on("click", ".update_hit", function()
  {
    if (window.confirm("Apakah Anda yakin?"))
    {
      id_klien      = $("#id_klien").val();
      nama        = $("#nama").val();
      tanggal_penerimaan  = $("#tanggal_penerimaan").val();
      deskripsi     = $("#deskripsi").val();
      jenis_laporan   = $("#jenis_laporan").val();
      keterangan      = $("#keterangan").val();

      $.ajax({
        type    : "POST",
        url     : base_url + "AjaxPekerjaan/update_pekerjaan/",
        dataType  : "JSON",
        beforeSend: function() {
          $(".btn-submit").html("Silahkan tunggu...");
          $(".btn-submit").prop("disabled", true);
        },
        data    : {
          type        : $(this).attr("data"),
          id          : id,
        },
        success   : function (data) {
          generate_notification(data.result.trim(), data.message.trim(), "topCenter");
          $(".btn-submit").html("SIMPAN");
          $(".btn-submit").prop("disabled", false);

          if (data.result == "success")
          {
            location  = base_url + "pekerjaan/";
          }
        },
      });
    }
  });
</script>
