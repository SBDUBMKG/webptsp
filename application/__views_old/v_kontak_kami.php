<div class="wrapper row3" style="min-height: 780px;">
    <section class="hoc container clear"> 
    <div class="left_content">
        <div class="single_post_content">
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <ol class="breadcrumb">
                <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
                <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> <?php echo translate(37);?></a></li> 
                Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->



                <!-- script awal yang diedit Rahmat 14 Oktober 2019 -->
                <li><a href="<?= base_url(); ?>"><?php echo translate(37);?></a></li>
                <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->
                
                <li class="active"><?php echo translate(22);?></li>
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">
              <h1><?php echo translate(22);?></h1>
              <div class="row">
                <?php foreach ($list_kontak as $key => $value) { ?>
                <div class="col-md-8" style="margin:0px 0px 0px 0px;padding:0px;">
                  <div id="comments">
                    <ul style="margin-bottom: 0px;">
                      <li style="background-color:#42a5f5;min-height:280px">
                        <article>
                          <header>
                            <address>
                            <a href="#" style="color:black"><?php echo $value['nama'] ?></a>
                            </address>
                          </header>
                          <div class="comcont" style="color:black">
                            <p><i class="fa fa-book fa-2x"></i> : <?php echo $value['alamat'] ?></p>
                            <p><i class="fa fa-phone fa-2x"></i> : <?php echo $value['telepon'] ?></p>
                            <p><i class="fa fa-fax fa-2x"></i> : <?php echo $value['fax'] ?></p>
                            <p><i class="fa fa-envelope fa-2x"></i> : <?php echo $value['email'] ?></p>
                          </div>
                        </article>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-4" style="margin:0px 0px 0px 0px;padding:0px">
                  <div id="comments">
                    <ul style="margin-bottom: 0px;">
                      <li style="background-color:#42a5f5;min-height:280px">
                        <article>
                          <header>
                            <address>
                            <a href="#" style="color:black"><?php echo translate(30);?></a>
                            </address>
                          </header>
                          <div class="comcont" style="color:black">
                            <!--
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.814566776121!2d106.83944201419285!3d-6.155584662046495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5eac092e3eb%3A0xbaab03d1e07d43be!2sBadan+Meteorologi+Klimatologi+dan+Geofisika+Indonesia!5e0!3m2!1sid!2sid!4v1531302506696" width="100%" height="123" frameborder="0" style="border:0" allowfullscreen></iframe>
                            -->
                            <?php echo $value['map'] ?>
                          </div>
                        </article>
                      </li>
                    </ul>
                  </div>
                </div>
                <?php } ?>
              </div>
              <br>
            </section>
          </div>
        </div>
    </div>
  </section>
</div>
