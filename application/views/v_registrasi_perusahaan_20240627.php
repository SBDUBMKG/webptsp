<div class="wrapper row3">
  <section class="hoc container clear"> 
    <div class="left_content">
      <div class="single_post_content">
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <ol class="breadcrumb">
              <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
              <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> <?= translate(37) ?></a></li>
              Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->

              <!-- script awal yang diedit rahmat 14 Oktober 2019 -->
              <li><a href="<?= base_url();?>"><?= translate(37);?></a></li>
              <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->

              <li><a href="<?= base_url().'registrasi' ?>"><?= translate(67) ?></a></li>
              <li class="active"><?= translate(44) ?></li>
            </ol>
          </section>
          <section class="content">
            <div class="row" style="border: 1px solid #97bcf4 !important; background-color: #FBFBFB; margin: 20px 0; padding: 10px">
              <h2 class="text-center"><?php echo translate(44);?></h2>
              <?php
              $errMsg = $this->session->flashdata('errMsg');
              $sucMsg = $this->session->flashdata('sucMsg');
              
              if(!empty($errMsg) && $errMsg !== null){
  					echo "<div class='alert text-red'><b>Error</b><ul>";
  						foreach($errMsg as $errInput){
  							echo "<li class='text-red'>".$errInput."</li>";
  						}
  					echo "</ul></div>";
  				}

              if ( !empty($errMsg) ) { ?>
              <div class="alert alert-danger" role="alert" style="color: black;background-color: #e44f4f;border-color: #ff0029;"><?php echo $errMsg; ?></div>
              <?php } ?>

              <?php if ( !empty($sucMsg) ) { ?>
              <div class="alert alert-danger" role="alert" style="color: black;background-color: #beb3fd;border-color: #1102fb;"><?php echo $sucMsg; ?></div>
              <?php } ?>
              <form method="post" enctype="multipart/form-data">
                  <div class="alert alert-info alert-dismissible">
                    <b><?php echo strtoupper(translate(110));?></b>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-6" id="fg_ktp">
                      <label><?= translate(45) ?> *</label>
                      <input type="text" name="no_ktp" id="no_ktp" value="<?= empty($detail['no_ktp']) ? NULL : $detail['no_ktp']; ?>" class="form-control" required>
                      <span class="help-block" id="label_ktp"></span>
                    </div>
                    <div class="form-group col-xs-6" id="fg_foto_ktp">
                        <label><?php echo translate(109);?> *</label>
                        <input type="file" name="foto_ktp" id="foto_ktp" class="form-control" required>
                        <span class="help-block" id="label_foto_ktp"></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-6">
                      <label><?= translate(46) ?> *</label>
                      <input type="text" name="nama" value="<?= empty($detail['nama']) ? NULL : $detail['nama']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group col-xs-6">
                      <label><?= translate(52) ?> *</label>
                      <input type="text" name="pekerjaan" value="<?= empty($detail['pekerjaan']) ? NULL : $detail['pekerjaan']; ?>" class="form-control" required>
                    </div>
                    <!-- Awal script yang ditambahkan Rahmat, 10 Agustus 2020 -->
                    <div class="form-group col-xs-6">
                      <label><?php echo translate(108);?> *</label>
                      <select class="form-control" id="id_pendidikan" name="id_pendidikan" required></select>
                    </div>
                    <!-- Akhir script yang ditambahkan Rahmat, 10 Agustus 2020 -->
                  </div>
                  <div class="alert alert-info alert-dismissible">
                    <b><?php echo strtoupper(translate(53));?></b>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-6">
                      <label><?= translate(54) ?> *</label>
                      <input type="text" name="alamat" value="<?= empty($detail['alamat']) ? NULL : $detail['alamat']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group col-xs-6" id="fg_no_hp">
                      <label><?= translate(58) ?> *</label>
                      <input type="text" id="no_hp" name="no_hp" value="<?= empty($detail['no_hp']) ? NULL : $detail['no_hp']; ?>" class="form-control numeric" required>
                      <span class="help-block" id="label_no_hp"></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-6">
                      <label><?= translate(78) ?> *</label>
                      <select class="form-control" id="id_provinsi" name="id_provinsi" required></select>
                    </div>

                    <div class="form-group col-xs-6">
                      <label><?= translate(55) ?> *</label>
                      <select class="form-control" id="id_kabkot" name="id_kabkot" required></select>
                    </div>
                  </div>

                  <!-- Start Data Perusahaan -->
                  <div class="alert alert-info alert-dismissible">
                    <b><?php echo strtoupper(translate(70));?></b>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-6" id="fg_npwp">
                      <label>NPWP</label>
                      <input type="number" name="npwp" id="npwp" value="<?= empty($detail['npwp']) ? NULL : $detail['npwp']; ?>" class="form-control">
                      <span class="help-block" id="label_npwp"></span>
                    </div>
                    <div class="form-group col-xs-6">
                      <label><?= translate(71) ?> *</label>
                      <!-- Awal script yang diedit Rahmat, 9 Juni 2020 -->
                      <!-- asalnya sbb:
                      		<input type="text" name="nama_perusahaan" value="<?= empty($detail['nama_perusahaan']) ? NULL : $detail['nama_perusahaan']; ?>" class="form-control" required> -->
                      		
                      <!-- setelah diedit sbb: -->
                      		<input type="text" name="perusahaan" value="<?= empty($detail['perusahaan']) ? NULL : $detail['perusahaan']; ?>" class="form-control" required>
                      <!-- Akhir script yang diedit Rahmat, 9 Juni 2020 -->

                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-12">
                      <label><?= translate(72) ?> *</label>
                      <input type="text" name="alamat_perusahaan" value="<?= empty($detail['alamat_perusahaan']) ? NULL : $detail['alamat_perusahaan']; ?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-6">
                      <label><?php echo translate(78);?> *</label>
                      <select class="form-control" id="provinsi_perusahaan" name="provinsi_perusahaan" required></select>
                    </div>
                    <div class="form-group col-xs-6">
                      <label><?php echo translate(55);?> *</label>
                      <select class="form-control" id="kabupaten_perusahaan" name="kabupaten_perusahaan" required></select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-6" id="fg_email_perusahaan">
                      <label>Email Perusahaan *</label>
                      <input type="email" name="email_perusahaan" id="email_perusahaan" value="<?php echo empty($detail['email_perusahaan']) ? NULL : $detail['email_perusahaan']; ?>" class="form-control" required>
                      <span class="help-block" id="label_email_perusahaan"></span>
                    </div>
                    <div class="form-group col-xs-6" id="fg_email_perusahaan">
                      <label>No Telepon Perusahaan *</label>
                      <input type="text" name="no_telepon_perusahaan" id="no_telepon_perusahaan" value="<?php echo empty($detail['no_telepon_perusahaan']) ? NULL : $detail['no_telepon_perusahaan']; ?>" class="form-control" required>
                      <span class="help-block" id="label_no_telepon_perusahaan"></span>
                    </div>
                  </div>
                  <div class="alert alert-info alert-dismissible">
                    <b><?php echo strtoupper(translate(111));?></b>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-6">
                      <label>Email *</label>
                      <input type="email" name="email" id="email" value="<?php echo empty($detail['email']) ? NULL : $detail['email']; ?>" class="form-control" required>
                      <span class="help-block" id="label_email"></span>
                    </div>
                    <div class="form-group col-xs-6">
                      <label>Username *</label>
                      <input type="text" name="username" id="username" value="<?php echo empty($detail['username']) ? NULL : $detail['username']; ?>" class="form-control" required>
                      <span class="help-block" id="label_username"></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-6" id="fg_password">
                      <label>Password *</label>
                      <input type="password" name="password" id="password" value="<?php echo empty($detail['password']) ? NULL : $detail['password']; ?>" class="form-control" required>
                      <span class="help-block" id="label_password"></span>
                    </div>
                    <div class="form-group col-xs-6">
                      <label><?php echo translate(60);?> *</label>
                      <input type="password" name="password2" id="password2" value="<?php echo empty($detail['password2']) ? NULL : $detail['password2']; ?>" class="form-control" required>
                      <span class="help-block" id="label_password2"></span>
                    </div>
                  </div>
                  <!--div class="row">
                    <div class="form-group col-xs-6">
                      <label><?php echo translate(61);?></label>
                      <?php echo $captcha_image;?>
                      <br>
                      <input type="text" name="captcha" class="form-control" required>
                    </div>
                  </div-->
                  <div class="alert alert-info">
                    <?= translate(73) ?>
                  </div>
                  <div class="form-group">
                    <label><input type="checkbox" value="" required></label> <?= translate(64) ?>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-flat btn-primary"><?= translate(74) ?></button>
                  </div>

                  <a href="<?php echo base_url().'login';?>" style="color: black;"><?= translate(65) ?></a>
                  <br>
                  <a href="<?= site_url() ?>" style="color: black;"><?= translate(66) ?></a>
              </form>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
  $(function () {

    $('#datepicker').datepicker({
      autoclose: true
    });

    // Menghapus validasi pada kolom KTP. Perubahan oleh Nurhayati Rahayu (24/08/2021)
    //$('#no_ktp').on('change', function(){
    //  var char = $(this).val();
    //  var charLength = char.length;
    //  if(charLength == 16) {
    //    $('#label_ktp').text('No KTP Valid');
    //    var element = document.getElementById("fg_ktp");
    //    element.classList.remove("has-error");
    //    element.classList.add("has-success");
    //  } else {
    //    $('#label_ktp').text('No KTP Tidak Valid');
    //    var element = document.getElementById("fg_ktp");
    //    element.classList.remove("has-success");
    //    element.classList.add("has-error");
    //  }
    //});
    // Baris terakhir perubahan oleh Nurhayati Rahayu (24/08/2021)

    // Awal script yang ditambahkan Rahmat, 10 Agustus 2020
    $('#id_pendidikan').select2({
          dropdownPosition: 'below',
          theme: 'bootstrap',
          language: 'id',
          allowClear: true,
          placeholder: 'Pilih Pendidikan',
          ajax: {
            dataType: 'json',
            delay: 0,
            url: "<?= site_url('services/id_pendidikan') ?>",
            beforeSend: function() {
              $('#id_provinsi').prop("disabled", true);
              $('#id_kabkot').prop("disabled", true);
              $('#id_kecamatan').prop("disabled", true);
              $('#id_kelurahan').prop("disabled", true);
              $('#provinsi_perusahaan').prop("disabled", true);
              $('#kabupaten_perusahaan').prop("disabled", true);
              $('#kecamatan_perusahaan').prop("disabled", true);
              $('#kelurahan_perusahaan').prop("disabled", true);
            },
            data: function(params) {
              return {
                s: params.term
              }
            },
            processResults: function (data, page) {
              return {
                results: data
              };
            },
            error: function() {
              $('#id_provinsi').prop("disabled", true);
              $('#id_kabkot').prop("disabled", true);
              $('#id_kecamatan').prop("disabled", true);
              $('#id_kelurahan').prop("disabled", true);
              $('#provinsi_perusahaan').prop("disabled", true);
              $('#kabupaten_perusahaan').prop("disabled", true);
              $('#kecamatan_perusahaan').prop("disabled", true);
              $('#kelurahan_perusahaan').prop("disabled", true);
            },
            cache: true
          }
        }).on('select2:select', function() {
          $('#id_provinsi').prop("disabled", false);
          $('#provinsi_perusahaan').prop("disabled", false);
        });
    // Akhir script yang ditambahkan Rahmat, 10 Agustus 2020
    
    //Baris awal perbaikan kolom propinsi. Perubahan oleh Nurhayati Rahayu (19/03/2024)
    //$('#id_provinsi').prop("disabled", true);  Script yang ditambahkan Rahmat 10 Agustus 2020
    $('#id_provinsi').prop("disabled", false);
    //Baris akhir perbaikan kolom propinsi. Perubahan oleh Nurhayati Rahayu (19/03/2024)
    $('#id_kabkot').prop("disabled", true);
    $('#id_kecamatan').prop("disabled", true);
    $('#id_kelurahan').prop("disabled", true);

    // Ajax Provinsi
    $('#id_provinsi').select2({
      dropdownPosition: 'below',
      theme: 'bootstrap',
      language: 'id',
      allowClear: true,
      placeholder: 'Pilih Provinsi',
      ajax: {
        dataType: 'json',
        delay: 0,
        url: "<?= site_url('services/provinsi') ?>",
        beforeSend: function() {
          $('#id_kabkot').prop("disabled", true);
          $('#id_kecamatan').prop("disabled", true);
          $('#id_kelurahan').prop("disabled", true);
        },
        data: function(params) {
          return {
            s: params.term
          }
        },
        processResults: function (data, page) {
          return {
            results: data
          };
        },
        error: function() {
          $('#id_kabkot').prop("disabled", true);
          $('#id_kecamatan').prop("disabled", true);
          $('#id_kelurahan').prop("disabled", true);
        },
        cache: true
      }
    }).on('select2:select', function() {
      $('#id_kabkot').prop("disabled", false);
    });
    // Ajax Kabupaten Kota
    $('#id_kabkot').select2({
      theme: 'bootstrap',
      allowClear: true,
      placeholder: 'Pilih Kab/Kota',
      ajax: {
        dataType: 'json',
        delay: 0,
        url: "<?= site_url('services/kab_kota') ?>",
        beforeSend: function() {
          $('#id_kecamatan').prop("disabled", true);
          $('#id_kelurahan').prop("disabled", true);
        },
        data: function(params) {
          return {
            s: params.term,
            q: $("#id_provinsi").val()
          }
        },
        processResults: function (data, page) {
          return {
            results: data
          };
        },
        error: function() {
          $('#id_kecamatan').prop("disabled", true);
          $('#id_kelurahan').prop("disabled", true);
        },
        cache: true
      }
    }).on('select2:select', function () {
      $('#id_kecamatan').prop("disabled", false);
    });
    // Ajax Kecamatan
    $('#id_kecamatan').select2({
      theme: 'bootstrap',
      allowClear: true,
      placeholder: 'Pilih Kecamatan',
      ajax: {
        dataType: 'json',
        delay: 0,
        url: "<?= site_url('services/kecamatan') ?>",
        beforeSend: function() {
          $('#id_kelurahan').prop("disabled", true);
        },
        data: function(params) {
          return {
            s: params.term,
            q: $("#id_kabkot").val()
          }
        },
        processResults: function (data, page) {
          return {
            results: data
          };
        },
        error: function() {
          $('#id_kelurahan').prop("disabled", true);
        },
        cache: true
      }
    }).on('select2:select', function () {
      $('#id_kelurahan').prop("disabled", false);
    });
    // Ajax Kelurahan
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

    // PERUSAHAAN
    $('#provinsi_perusahaan').prop("disabled", true); // Script yang ditambahkan Rahmat, 10 Agustus 2020
    $('#kabupaten_perusahaan').prop("disabled", true);
    $('#kecamatan_perusahaan').prop("disabled", true);
    $('#kelurahan_perusahaan').prop("disabled", true);

    // Ajax Provinsi
    $('#provinsi_perusahaan').select2({
      theme: 'bootstrap',
      language: 'id',
      allowClear: true,
      placeholder: 'Pilih Provinsi',
      ajax: {
        dataType: 'json',
        delay: 0,
        url: "<?= site_url('services/provinsi') ?>",
        beforeSend: function() {
          $('#kabupaten_perusahaan').prop("disabled", true);
          $('#kecamatan_perusahaan').prop("disabled", true);
          $('#kelurahan_perusahaan').prop("disabled", true);
        },
        data: function(params) {
          return {
            s: params.term
          }
        },
        processResults: function (data, page) {
          return {
            results: data
          };
        },
        error: function() {
          $('#kabupaten_perusahaan').prop("disabled", true);
          $('#kecamatan_perusahaan').prop("disabled", true);
          $('#kelurahan_perusahaan').prop("disabled", true);
        },
        cache: true
      }
    }).on('select2:select', function() {
      $('#kabupaten_perusahaan').prop("disabled", false);
    });
    // Ajax Kabupaten Kota
    $('#kabupaten_perusahaan').select2({
      theme: 'bootstrap',
      allowClear: true,
      placeholder: 'Pilih Kab/Kota',
      ajax: {
        dataType: 'json',
        delay: 0,
        url: "<?= site_url('services/kab_kota') ?>",
        beforeSend: function() {
          $('#kecamatan_perusahaan').prop("disabled", true);
          $('#kelurahan_perusahaan').prop("disabled", true);
        },
        data: function(params) {
          return {
            s: params.term,
            q: $("#provinsi_perusahaan").val()
          }
        },
        processResults: function (data, page) {
          return {
            results: data
          };
        },
        error: function() {
          $('#kecamatan_perusahaan').prop("disabled", true);
          $('#kelurahan_perusahaan').prop("disabled", true);
        },
        cache: true
      }
    }).on('select2:select', function () {
      $('#kecamatan_perusahaan').prop("disabled", false);
    });
    // Ajax Kecamatan
    $('#kecamatan_perusahaan').select2({
      theme: 'bootstrap',
      allowClear: true,
      placeholder: 'Pilih Kecamatan',
      ajax: {
        dataType: 'json',
        delay: 0,
        url: "<?= site_url('services/kecamatan') ?>",
        beforeSend: function() {
          $('#kelurahan_perusahaan').prop("disabled", true);
        },
        data: function(params) {
          return {
            s: params.term,
            q: $("#kabupaten_perusahaan").val()
          }
        },
        processResults: function (data, page) {
          return {
            results: data
          };
        },
        error: function() {
          $('#kelurahan_perusahaan').prop("disabled", true);
        },
        cache: true
      }
    }).on('select2:select', function () {
      $('#kelurahan_perusahaan').prop("disabled", false);
    });
    // Ajax Kelurahan
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

    $('#npwp').on('change', function(){
      var char = $(this).val();
      var charLength = char.length;
      if(charLength == 15) {
        $('#label_npwp').text('NPWP Valid');
        var element = document.getElementById("fg_npwp");
        element.classList.remove("has-error");
        element.classList.add("has-success");
      } else {
        $('#label_npwp').text('NPWP Tidak Valid');
        var element = document.getElementById("fg_npwp");
        element.classList.remove("has-success");
        element.classList.add("has-error");
      }
    });
    //hilangkan karakter non angka
    $(document).on("input", ".numeric", function() {
    this.value = this.value.replace(/\D/g,'');
});

    $('#no_hp').on('change', function(){
      //Menghilangkan fungsi validasi email. Perubahan oleh Nurhayati Rahayu (24/08/2021)
      //validate_email();
      //Baris terakhir perubahan oleh Nurhayati Rahayu (24/08/2021)

      var char = $(this).val();
      var charLength = char.length;
      if(charLength <= 13){
          $('#label_no_hp').text('No Hp Valid');
          var element = document.getElementById("fg_no_hp");
          element.classList.remove("has-error");
          element.classList.add("has-success");
      }else{
          $('#label_no_hp').text('No Hp Tidak Valid');
          var element = document.getElementById("fg_no_hp");
          element.classList.remove("has-success");
          element.classList.add("has-error");
      }
    });

    $('#no_telepon').on('change', function(){
        var char = $(this).val();
        var charLength = char.length;
        if(charLength <= 13){
            $('#label_no_telepon').text('No Telepon Valid');
            var element = document.getElementById("fg_no_telepon");
            element.classList.remove("has-error");
            element.classList.add("has-success");
        }else{
            $('#label_no_telepon').text('No Telepon Tidak Valid');
            var element = document.getElementById("fg_no_telepon");
            element.classList.remove("has-success");
            element.classList.add("has-error");
        }
    });
    $('#no_telepon_perusahaan').on('change', function(){
        var char = $(this).val();
        var charLength = char.length;
        if(charLength <= 13){
            $('#label_no_telepon_perusahaan').text('No Telepon Valid');
            var element = document.getElementById("fg_no_telepon_perusahaan");
            element.classList.remove("has-error");
            element.classList.add("has-success");
        }else{
            $('#label_no_telepon_perusahaan').text('No Telepon Tidak Valid');
            var element = document.getElementById("fg_no_telepon_perusahaan");
            element.classList.remove("has-success");
            element.classList.add("has-error");
        }
    });
    $('#username').on('change', function(){
        //Menghilangkan fungsi validasi email. Perubahan oleh Nurhayati Rahayu (24/08/2021)
	//validate_email_perusahaan();
        //Baris terakhir perubahan oleh Nurhayati Rahayu (24/08/2021)

        validasi_username();
    });
    $('#password').on('change', function(){
        var char = $(this).val();
        var charLength = char.length;
        if(charLength >= 5){
            $('#label_password').text('Password Valid');
            var element = document.getElementById("fg_password");
            element.classList.remove("has-error");
            element.classList.add("has-success");
        }else{
            $('#label_password').text('Password harus lebih dari 5 karakter');
            var element = document.getElementById("fg_password");
            element.classList.remove("has-success");
            element.classList.add("has-error");
        }
    });
    $('#password2').on('change', function(){
        validasi_password();
    });
  });

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

  function validate_email_perusahaan() {
    var $result = $("#label_email_perusahaan");
    var email = $("#email_perusahaan").val();
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
  function validasi_username() {
    var user = $('#username').val();
    $("#label_username").load('<?php echo base_url();?>services/validasi_username/' + user);
  }
  function validasi_password() {
    var pass1 = jQuery('#password').val();
    var pass2 = jQuery('#password2').val();
    $("#label_password2").load('<?php echo base_url();?>services/validasi_password/' + pass1 + '/' + pass2);
  }
</script>
