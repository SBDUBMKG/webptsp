<div class="wrapper row3">
    <section class="hoc container clear"> 
    <div class="left_content">
        <div class="single_post_content">
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <ol class="breadcrumb">
                <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
                <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> <?php echo translate(37);?></a></li> 
                Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->


                <!-- script awal yang diedit Rahmat 14 Oktober 2019 -->
                <li><a href="<?= base_url();?>"><?= translate(37);?></a></li>
                <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->

                <li><a href="<?php echo base_url().'registrasi';?>"><?php echo translate(67);?></a></li>
                <li class="active"><?php echo translate(43);?></li>
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">
              <div class="row" style="border: 1px solid #97bcf4 !important; background-color: #FBFBFB; margin: 20px 0; padding: 10px">
                <h2 class="text-center"><?php echo translate(43);?></h2>
                <?php
                $errMsg = $this->session->flashdata('errMsg');
                $sucMsg = $this->session->flashdata('sucMsg');

                if ( !empty($errMsg) ) { ?>
                <div class="alert alert-danger" role="alert" style="color: black;background-color: #e44f4f;border-color: #ff0029;"><?php echo $errMsg; ?></div>
                <?php } ?>

                <?php if ( !empty($sucMsg) ) { ?>
                <!-- Script awal asli yang dinon-aktifkan Rahmat 15 Oktober 2019
                <div class="alert alert-danger" role="alert" style="color: black;background-color: #beb3fd;border-color: #1102fb;"><?php echo $sucMsg; ?></div> 
                Script akhir asli yang dinon-aktifkan Rahmat 15 Oktober 2019 -->

                <!-- script awal yang diedit Rahmat 15 Oktober 2019 -->
                <div class="alert alert-success" role="alert" style="color: black;background-color: #beb3fd;border-color: #1102fb;"><?php echo $sucMsg; ?></div>
                <!-- script akhir yang diedit Rahmat 15 Oktober 2019 -->
                
                <?php } ?>
                <form method="post" enctype="multipart/form-data">
                  <div class="alert alert-info alert-dismissible">
                    <b>DATA DIRI</b>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-3" id="fg_npwp">
                      <label>NPWP</label>
                      <input type="number" name="npwp" id="npwp" value="<?php echo empty($detail['npwp']) ? NULL : $detail['npwp']; ?>" class="form-control">
                      <span class="help-block" id="label_npwp"></span>
                    </div> 
                    <div class="form-group col-xs-3">
                      <label><?php echo translate(59);?></label>
                      <input type="file" name="foto" class="form-control-file">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-3" id="fg_ktp">
                      <label><?php echo translate(45);?> *</label>
                      <input type="number" name="no_ktp" id="no_ktp" value="<?php echo empty($detail['no_ktp']) ? NULL : $detail['no_ktp']; ?>" class="form-control" required>
                      <span class="help-block" id="label_ktp"></span>
                    </div>
                    <div class="form-group col-xs-6">
                      <label><?php echo translate(46);?> *</label>
                      <input type="text" name="nama" value="<?php echo empty($detail['nama']) ? NULL : $detail['nama']; ?>" class="form-control" required>
                    </div>                    
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-3">
                      <label><?php echo translate(47);?> *</label>
                      <input type="text" name="tempat_lahir" value="<?php echo empty($detail['tempat_lahir']) ? NULL : $detail['tempat_lahir']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group col-xs-3">
                      <label>Tanggal Lahir:</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="tanggal_lahir" value="<?php echo empty($detail['tanggal_lahir']) ? NULL : $detail['tanggal_lahir']; ?>" class="form-control pull-right" id="datepicker">
                      </div>
                    </div>
                    <div class="form-group col-xs-3">
                      <label><?php echo translate(49);?> *</label>
                      <div class="radio">
                        <label><input type="radio" name="jenis_kelamin" value="1" <?php if(isset($detail['jenis_kelamin'])){if($detail['jenis_kelamin'] == 1){echo "checked";}}?> ><?php echo translate(50);?></label>
                        <label><input type="radio" name="jenis_kelamin" value="0" <?php if(isset($detail['jenis_kelamin'])){if($detail['jenis_kelamin'] == 0){echo "checked";}}?> ><?php echo translate(51);?></label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-3">
                      <label><?php echo translate(52);?> *</label>
                      <input type="text" name="pekerjaan" value="<?php echo empty($detail['pekerjaan']) ? NULL : $detail['pekerjaan']; ?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="alert alert-info alert-dismissible">
                    <b><?php echo strtoupper(translate(53));?></b>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-6">
                      <label><?php echo translate(54);?> *</label>
                      <input type="text" name="alamat" value="<?php echo empty($detail['alamat']) ? NULL : $detail['alamat']; ?>" class="form-control" required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-3">
                      <label><?php echo translate(78);?> *</label>
                      <select class="form-control" id="id_provinsi" name="id_provinsi" required></select>
                    </div>
                    <div class="form-group col-xs-3">
                      <label><?php echo translate(55);?> *</label>
                      <select class="form-control" id="id_kabkot" name="id_kabkot" required></select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-3">
                      <label><?php echo translate(56);?> *</label>
                      <select class="form-control" id="id_kecamatan" name="id_kecamatan" required></select>
                    </div>
                    <div class="form-group col-xs-3">
                      <label>Kelurahan</label>
                      <select class="form-control" id="id_kelurahan" name="id_kelurahan" required></select>
                    </div>
                    <div class="form-group col-xs-2">
                      <label>Kode Pos *</label>
                      <input type="text" id="kode_pos" name="kode_pos" value="<?php echo empty($detail['kode_pos']) ? NULL : $detail['kode_pos']; ?>" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-3" id="fg_no_hp">
                      <label><?php echo translate(58);?> *</label>
                      <input type="text" name="no_hp" id="no_hp" value="<?= empty($detail['no_hp']) ? NULL : $detail['no_hp']; ?>" class="form-control numeric" pattern="[0-9]">
                      <span class="help-block" id="label_no_hp"></span>
                    </div>
                    <div class="form-group col-xs-3" id="fg_no_telepon">
                      <label><?php echo translate(57) ?></label>
                      <input type="text" name="no_telepon" id="no_telepon" value="<?= empty($detail['no_telepon']) ? NULL : $detail['no_telepon']; ?>" class="form-control numeric">
                      <span class="help-block" id="label_no_telepon"></span>
                    </div>
                  </div>
                  <div class="alert alert-info alert-dismissible">
                    <b>Data Akun</b>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-3">
                      <label>Email *</label>
                      <input type="email" name="email" id="email" value="<?php echo empty($detail['email']) ? NULL : $detail['email']; ?>" class="form-control" required>
                      <span class="help-block" id="label_email"></span>
                    </div>
                    <div class="form-group col-xs-3">
                      <label>Username *</label>
                      <input type="text" name="username" id="username" value="<?php echo empty($detail['username']) ? NULL : $detail['username']; ?>" class="form-control" required>
                      <span class="help-block" id="label_username"></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-3" id="fg_password">
                      <label>Password *</label>
                      <input type="password" name="password" id="password" value="<?php echo empty($detail['password']) ? NULL : $detail['password']; ?>" class="form-control" required>
                      <span class="help-block" id="label_password"></span>
                    </div>
                    <div class="form-group col-xs-3">
                      <label><?php echo translate(60);?> *</label>
                      <input type="password" name="password2" id="password2" value="<?php echo empty($detail['password2']) ? NULL : $detail['password2']; ?>" class="form-control" required>
                      <span class="help-block" id="label_password2"></span>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-xs-2">
                      <label><?php echo translate(61);?></label>
                      <?php echo $captcha_image;?>
                      <br>
                      <input type="text" name="captcha" class="form-control" required>
                    </div>
                  </div>

                        <div class="alert alert-info" style="color:#5E5E5E;background-color: #8DD5D6;border-color: #03A1A3;">
                          <?php echo translate(63);?>
                        </div>

                        <div class="form-group">
                          <label><input type="checkbox" name="ketentuan" value="1" style="display:inline;"> <?php echo translate(64);?></label> 
                        </div>

                        <div class="form-group">
                          <button class="btn btn-warning"><b><?php echo translate(74);?></b></button>
                        </div>

                        <a href="<?php echo base_url().'backend/login';?>" style="color: black;"><?php echo translate(65);?></a>
                        <br>
                        <a href="<?php echo base_url();?>" style="color: black;"><?php echo translate(66);?></a>
                        <br><br>
                      </form>
            </section>
          </div>
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.cmb_select2').select2({
            theme: 'bootstrap'
        });

        $('#datepicker').datepicker({
            autoclose: true
        });

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

        $('#npwp').on('change', function(){
            var char = $(this).val();
            var charLength = char.length;
            if(charLength == 15){
                $('#label_npwp').text('NPWP Valid');
                var element = document.getElementById("fg_npwp");
                element.classList.remove("has-error");
                element.classList.add("has-success");
            }else{
                $('#label_npwp').text('NPWP Tidak Valid');
                var element = document.getElementById("fg_npwp");
                element.classList.remove("has-success");
                element.classList.add("has-error");
            }
        });
        $('#no_ktp').on('change', function(){
            var char = $(this).val();
            var charLength = char.length;
            if(charLength == 16){
                $('#label_ktp').text('No KTP Valid');
                var element = document.getElementById("fg_ktp");
                element.classList.remove("has-error");
                element.classList.add("has-success");
            }else{
                $('#label_ktp').text('No KTP Tidak Valid');
                var element = document.getElementById("fg_ktp");
                element.classList.remove("has-success");
                element.classList.add("has-error");
            }
        });
        $('#no_telepon').on('change', function(){
            var char = $(this).val();
            var charLength = char.length;
            if(charLength <= 12){
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
        $('#no_hp').on('change', function(){
            var char = $(this).val();
            var charLength = char.length;
            if(charLength <= 12){
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
      $(document).on("input", ".numeric", function() {
          this.value = this.value.replace(/\D/g,'');
      });
        $('#username').on('change', function(){
            validate_email();
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