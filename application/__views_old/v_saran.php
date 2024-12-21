<div class="wrapper row3">
    <section class="hoc container clear"> 
    <div class="left_content">
        <div class="single_post_content">
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <!--
              <h1>
                Saran
                <small></small>
              </h1>
              -->
              <ol class="breadcrumb">
                <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
                <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> <?php echo translate(37);?></a></li> 
                Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->


                <!-- script awal yang diedit Rahmat 14 Oktober 2019 -->
                <li><a href="<?= base_url(); ?>"><?php echo translate(37);?></a></li>
                <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->

                <li class="active"><?php echo translate(31);?></li>
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">
              <!-- filter -->
              <div class="box box-default">
                <h1><?php echo translate(31);?></h1>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="alert alert-info" style="color:black;background-color: #E8E8E8;border-color: #42a5f5;"><?php echo translate(32);?></div>
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
                        <div class="form-group">
                          <label><?php echo translate(33);?></label>
                          <input type="text" name="nama" value="<?php echo empty($detail['nama']) ? NULL : $detail['nama']; ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" name="email" value="<?php echo empty($detail['email']) ? NULL : $detail['email']; ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label><?php echo translate(31);?></label>
                          <textarea rows=8 type="text" name="saran" class="form-control" required><?php echo empty($detail['saran']) ? NULL : $detail['saran']; ?></textarea>
                        </div>
                        <div class="form-group">
                          <label>Captcha <?php echo $captcha_image; ?></label>
                          <input type="text" name="captcha" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <button class="btn btn-warning"><?php echo translate(34);?></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <br>

              <div class="box box-default">
                <div class="box-header">
                  <h1><?php echo $total_saran ?> <?php echo translate(31);?></h1>
                  <hr style="border: 0;height: 1px;background: #333;background-image: linear-gradient(to right, #ccc, #333, #ccc);">
                </div>
                <div class="box-body">
                  <div id="comments">
                    <ul>
                      <?php foreach ($list_saran as $key => $value) { ?>
                      <li style="color: black;background-color: #E8E8E8;border: 1px solid #42a5f5;">
                        <article>
                          <header>
                            <figure class="avatar" style="border-radius:50%;"><img src="<?php echo base_url()."resources/frontend/images/user_foto.png";?>" alt="" style="width:60px;"></figure>
                            <address style="color:black">
                            <?php echo $value['nama'] ?>
                            </address>
                            <time style="color:black"><?php echo translate(15);?> : <?php echo $value['waktu_saran'] ?></time>
                          </header>
                          <div class="comcont">
                            <p style="color:black"><?php echo $value['saran'] ?></p>
                          </div>
                          <hr style="border-top: 1px solid #42a5f5">
                          <header>
                            <!--
                            <figure class="avatar" style="border-radius:50%;"><img src="<?php echo base_url()."resources/frontend/images/user_foto.png";?>" alt="" style="width:60px;"></figure>
                            -->
                            <address style="color:black">
                            <?php echo translate(35);?> :
                            </address>
                            <!--
                            <time style="color:black"><?php echo translate(15);?> : <?php echo $value['waktu_saran'] ?></time>
                            -->
                          </header>
                          <div class="comcont">
                            <p style="color:black"><?php echo $value['response'] ?></p>
                          </div>
                        </article>
                      </li>
                      <?php } ?>
                    </ul>
                  </div>
                </div>
              </div>
            </section>
          </div>
      </div>
    </div>
  </section>
</div>
