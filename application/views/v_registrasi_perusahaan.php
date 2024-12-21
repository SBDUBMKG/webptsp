<?php if(!$recaptcha_v2) { ?>
  <!-- reCAPTCHA JS-->
  <script src="https://www.google.com/recaptcha/api.js?render=6Ldg38IpAAAAAAlXVYcpwc8ucVEWTse_ryZwlpYz"></script>
<?php } ?>
<div class="data-area">
			<div class="container">
				<div class="data-main">
					<div class="data-top">
						<ul>
							<li><a class="text-dark" href="<?= base_url();?>"><?= translate(37);?></a></li>
							<li><a class="text-dark" href="<?php echo base_url().'registrasi';?>"><?php echo translate(67);?></a></li>
							<li><?php echo translate(44);?></li>
						</ul>
					</div>
					<div class="data-top-item">
						<h3> <?php echo translate(44);?></h3>


            <?php
                $errMsg1 = $this->session->flashdata('errMsg');
                $sucMsg = $this->session->flashdata('sucMsg');

  				if(!empty($errMsg) && $errMsg !== null){
  					echo "<div class='alert text-red'><b>Error</b><ul>";
  						foreach($errMsg as $errInput){
  							echo "<li class='text-red'>".$errInput."</li>";
  						}
  					echo "</ul></div>";
  				}
                if ( !empty($errMsg1) ) { ?>
                <div class="alert alert-danger" role="alert" style="color: black;background-color: #e44f4f;border-color: #ff0029;"><?php echo $errMsg1; ?></div>
                <?php } ?>
                <?php if ( !empty($sucMsg) ) { ?>
                <div class="alert alert-success" role="alert" style="color: black;background-color: #beb3fd;border-color: #1102fb;"><?php echo $sucMsg; ?></div>
                <?php } ?>


						<div class="Jumlah-border">
							<div class="Jumlah-border-left Jumlah-border-left5"></div>
							<div class="Jumlah-border-right Jumlah-border-right5"></div>
						</div>
					</div>
          <form method="post" enctype="multipart/form-data">
            <div class="data-diri">
              <div class="data-diri-top">
                <h3><img src="images/diri-man.png" class="img-fluid" alt=""> <?php echo strtoupper(translate(110));?></h3>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="row data-diri-item">
                    <div class="form-group col-md-6" id="fg_ktp">
                      <label><?php echo translate(45);?> *</label>
                      <input type="text" name="no_ktp" id="no_ktp" value="<?php echo empty($detail['no_ktp']) ? NULL : $detail['no_ktp']; ?>" class="form-control" required>
                      <span class="help-block" id="label_ktp"></span>
                    </div>
                    <div class="form-group col-md-6" id="fg_foto_ktp">
                      <label><?php echo translate(109);?> *</label>
                      <input type="file" name="foto_ktp" id="foto_ktp" class="form-control" required>
                      <span class="help-block" id="label_foto_ktp"></span>
                    </div>
                    <div class="form-group col-md-6">
                      <label><?php echo translate(46);?> *</label>
                      <input type="text" name="nama" value="<?php echo empty($detail['nama']) ? NULL : $detail['nama']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label><?php echo translate(52);?> *</label>
                      <input type="text" name="pekerjaan" value="<?php echo empty($detail['pekerjaan']) ? NULL : $detail['pekerjaan']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                      <label><?php echo translate(108);?> *</label>
                      <select class="form-control" id="id_pendidikan" name="id_pendidikan" required></select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="data-diri">
              <div class="data-diri-top">
                <h3><img src="images/diri-home.png" class="img-fluid" alt=""><?php echo strtoupper(translate(53));?></h3>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="row data-diri-item">
                    <div class="form-group col-md-6">
                      <label><?php echo translate(54);?> *</label>
                      <input type="text" name="alamat" value="<?php echo empty($detail['alamat']) ? NULL : $detail['alamat']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6" id="fg_no_hp">
                      <label><?php echo translate(58);?> *</label>
                      <input type="text" name="no_hp" id="no_hp" value="<?= empty($detail['no_hp']) ? NULL : $detail['no_hp']; ?>" class="form-control numeric" >
                      <span class="help-block" id="label_no_hp"></span>
                    </div>
                    <div class="form-group col-md-6">
                      <label><?php echo translate(78);?> *</label>
                      <select class="form-control" id="id_provinsi" name="id_provinsi" required></select>
                    </div>
                    <div class="form-group col-md-6">
                      <label><?php echo translate(55);?> *</label>
                      <select class="form-control" id="id_kabkot" name="id_kabkot" required></select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="data-diri">
              <div class="data-diri-top">
                <h3><img src="images/diri-home.png" class="img-fluid" alt=""><?php echo strtoupper(translate(70));?></h3>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="row data-diri-item">
                    <div class="form-group col-md-6" id="fg_npwp">
                      <label>NPWP</label>
                      <input type="text" name="npwp" id="npwp" value="<?php echo empty($detail['npwp']) ? NULL : $detail['npwp']; ?>" class="form-control">
                      <span class="help-block" id="label_npwp"></span>
                    </div>
                    <div class="form-group col-md-6">
                      <label><?= translate(71) ?> *</label>
                      <input type="text" name="perusahaan" value="<?= empty($detail['perusahaan']) ? NULL : $detail['perusahaan']; ?>" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="row data-diri-item">
                    <div class="form-group col-xs-12">
                      <label><?= translate(72) ?> *</label>
                      <input type="text" name="alamat_perusahaan" value="<?= empty($detail['alamat_perusahaan']) ? NULL : $detail['alamat_perusahaan']; ?>" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 mb-4">
                  <div class="row data-diri-item">
                    <div class="form-group col-md-6">
                      <label><?php echo translate(78);?> *</label>
                      <select class="form-control" id="provinsi_perusahaan" name="provinsi_perusahaan" required></select>
                    </div>
                    <div class="form-group col-md-6">
                      <label><?php echo translate(55);?> *</label>
                      <select class="form-control" id="kabupaten_perusahaan" name="kabupaten_perusahaan" required></select>
                    </div>

                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="row data-diri-item">
                    <div class="form-group col-md-6" id="fg_email_perusahaan">
                      <label>Email Perusahaan *</label>
                      <input type="email" name="email_perusahaan" id="email_perusahaan" value="<?php echo empty($detail['email_perusahaan']) ? NULL : $detail['email_perusahaan']; ?>" class="form-control" required>
                      <span class="help-block" id="label_email_perusahaan"></span>
                    </div>
                    <div class="form-group col-md-6" id="fg_email_perusahaan">
                      <label>No Telepon Perusahaan *</label>
                      <input type="text" name="no_telepon_perusahaan" id="no_telepon_perusahaan" value="<?php echo empty($detail['no_telepon_perusahaan']) ? NULL : $detail['no_telepon_perusahaan']; ?>" class="form-control" required>
                      <span class="help-block" id="label_no_telepon_perusahaan"></span>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="data-diri">
              <div class="data-diri-top">
                <h3><img src="images/diri-lock.png" class="img-fluid" alt=""><?php echo strtoupper(translate(111));?></h3>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="row data-diri-item">
                    <div class="form-group col-md-6">
                      <label>Email *</label>
                      <input type="email" name="email" id="email" value="<?php echo empty($detail['email']) ? NULL : $detail['email']; ?>" class="form-control" required>
                      <span class="help-block" id="label_email"></span>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Username *</label>
                      <input type="text" name="username" id="username" value="<?php echo empty($detail['username']) ? NULL : $detail['username']; ?>" class="form-control" required>
                      <span class="help-block" id="label_username"></span>
                    </div>
                    <div class="form-group col-md-6" id="fg_password">
                      <label>Password *</label>
                      <input type="password" name="password" id="password" value="<?php echo empty($detail['password']) ? NULL : $detail['password']; ?>" class="form-control" required>
                      <span class="help-block" id="label_password"></span>
                    </div>
                    <div class="form-group col-md-6">
                      <label><?php echo translate(60);?> *</label>
                      <input type="password" name="password2" id="password2" value="<?php echo empty($detail['password2']) ? NULL : $detail['password2']; ?>" class="form-control" required>
                      <span class="help-block" id="label_password2"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php if($recaptcha_v2) { ?>
              <div class="row">
                  <div class="col-xs-12">
                      <div class="g-recaptcha" data-sitekey="6Lc2RcopAAAAAGNQo3Yr3HRDueNO9eCzkcsNAcSm"></div>

                  </div>
              </div>
              <?php } else { ?>
              <!-- Your form fields -->
              <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response" />
            <?php } ?>
            <div class="keten text-white"><?php echo translate(63);?>
            </div>
            <div class="checkbox">
              <ul>
                <li><input type="checkbox" id="check" required></li>
                <li><label for="check"><?php echo translate(64);?></label></li>
              </ul>
            </div>
            <div class="check-btn">
              <button class="btn btn-sm text-white"><a><?php echo translate(74);?></a></button>
            </div>
            <div class="check-footer">
              <a href="<?php echo base_url().'login';?>" style="color: black;"><?php echo translate(65);?></a>
              <a href="<?php echo base_url();?>" style="color: black;"><?php echo translate(66);?></a>
            </div>
          </form>


				</div>
			</div>
		</div>
    <?php if($recaptcha_v2) { ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <?php } else { ?>

<script>
    // Generate and store the reCAPTCHA token
    grecaptcha.ready(function() {
        grecaptcha.execute('6Ldg38IpAAAAAAlXVYcpwc8ucVEWTse_ryZwlpYz', {action: 'login'}).then(function(token) {
            document.getElementById('g-recaptcha-response').value = token;
            //console.log(token);
            //console.log(document.getElementById('g-recaptcha-response').value);
        });
    });
</script>
<?php } ?>
