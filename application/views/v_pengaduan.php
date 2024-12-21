<?php if(!$recaptcha_v2) { ?>
    <!-- reCAPTCHA JS-->
<script src="https://www.google.com/recaptcha/api.js?render=6Ldg38IpAAAAAAlXVYcpwc8ucVEWTse_ryZwlpYz"></script>
<?php } ?>
<style type="text/css">
  /* a { */
    /* color: white; */
    /* font-weight:bold; */
    /* text-decoration: underline; */
  /* } */
</style>
<div class="beranda-area">
			<div class="container">
				<div class="beranda-top">
					<ul>
					<li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
					<li class="text-secondary"><?php echo $bahasa == "" ? "Pengaduan" : "Complaint" ?></li>
					</ul>
				</div>
				<div class="beranda-main">
					<div class="beranda-main-item">
						<h3><?php echo $bahasa == "" ? "Pengaduan" : "Complaint" ?></h3>
						<div class="Jumlah-border">
							<div class="Jumlah-border-left Jumlah-border-left3"></div>
							<div class="Jumlah-border-right Jumlah-border-right3"></div>
						</div>
					</div>
          <div style="min-height: inherit;" class="beranda-item beranda-item1 mt-4 pt-4 text-white text-start">
            <?php echo translate(36);?>
          </div>
					<div class="text-dark mt-3 pt-3">
						<div class="widgetcontent fst-italic fw-normal" style="color:black">
              <!-- Main content -->
              <section class="content">
                      <div class="box box-default">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-md-12">
                              <?php
                              $errMsg = $this->session->flashdata('errMsg');
                              $sucMsg = $this->session->flashdata('sucMsg');

                              if ( !empty($errMsg) ) {
                              ?>
                              <div class="alert alert-danger" role="alert" style="color: black;background-color: #e44f4f;border-color: #ff0029;"><?php echo $errMsg; ?></div>
                              <?php
                              }
                              ?>

                              <?php
                              if ( !empty($sucMsg) ) {
                              ?>
                              <div class="alert alert-danger" role="alert" style="color: black;background-color: #beb3fd;border-color: #1102fb;"><?php echo $sucMsg; ?></div>
                              <?php
                              }
                              ?>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-8">
                              <form method="post">
                                <div class="data-diri-item">
                                  <div class="form-group">
                                    <label><?php echo translate(33);?></label>
                                    <input type="text" name="nama" value="<?php echo empty($detail['nama']) ? NULL : $detail['nama']; ?>" class="form-control" required>
                                  </div>
                                  <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="<?php echo empty($detail['email']) ? NULL : $detail['email']; ?>" class="form-control" required>
                                  </div>
                                  <div class="form-group">
                                    <label><?php echo translate(14);?></label>
                                    <textarea rows=8 type="text" name="pengaduan" class="form-control" required><?php echo empty($detail['saran']) ? NULL : $detail['saran']; ?></textarea>
                                  </div>
                                  <!-- <div class="form-group">
                                    <label>Captcha <?php echo $captcha_image; ?></label>
                                    <input type="text" name="captcha" class="form-control" required>
                                  </div> -->
                                  <!-- <div class="form-group">
                                    <button class="btn btn-success"><?php echo translate(34);?></button>
                                  </div> -->
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
                                </div>
                                <div class="check-btn">
                                  <button class="btn btn-sm text-white"><a><?php echo translate(34);?></a></button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <br>
<!-- Pengaduan katanye gak usah di tampilin -->
                      <!-- <div class="box box-default">
                        <div class="box-header">
                          <h6><?php echo $total_pengaduan ?> <?php echo translate(14);?></h6>
                          <hr class="mt-0" style="border: 0;height: 1px;background: #333;background-image: linear-gradient(to right, #ccc, #333, #ccc);">
                        </div>
                          <?php foreach ($list_pengaduan as $key => $value) { ?>
                          <div class="beranda-item beranda-item1 mt-3 pt-4">
                            <div class="row">
                              <div class="col text-start">
                                <h6 class="text-white"><?php echo $value['nama'] ?></h6>
                                <p><?php echo translate(15);?> : <?php echo $value['waktu_pengaduan'] ?></p>
                              </div>
                              <div class="col d-flex justify-content-end">
                                <img src="<?php echo base_url()."resources/frontend/images/user_foto.png";?>" alt="" style="width:60px;">
                              </div>
                            </div>
                            <div class="row text-start mb-4 mt-3">
                              <p><?php echo $value['pengaduan'] ?></p>
                            </div>
                            <hr style="border: 0; height: 2px; background-color: white;">
                            <div class="row text-start">
                              <h6 class="text-white"><?php echo translate(35);?> :</h6>
                              <p style="color:white"><?php echo $value['response'] ?></p>
                            </div>
                          </div>
                          <?php } ?>
                      </div> -->
                </section>
						</div>
					</div>
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
