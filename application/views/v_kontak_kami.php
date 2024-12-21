<div class="beranda-area">
			<div class="container">
				<div class="beranda-top">
					<ul>
					<li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
					<li class="text-secondary"><?php echo translate(22);?></li>
					</ul>
				</div>
				<div class="beranda-main">
					<div class="beranda-main-item">
						<h3><?php echo translate(22);?></h3>
						<div class="Jumlah-border">
							<div class="Jumlah-border-left Jumlah-border-left3"></div>
							<div class="Jumlah-border-right Jumlah-border-right3"></div>
						</div>
					</div>	
          <?php foreach ($list_kontak as $key => $value) { ?>
          <div class="beranda-item beranda-item1 mt-4 pt-4">
                    <div class="row">
                      <div class="col-md-6 py-3">
                          <article>
                            <header>
                              <address style="text-align:left;">
                              <a href="#" class="fw-bold" style="color:white;"><?php echo $value['nama'] ?></a>
                              <hr style="border: 0; border-top: 3px solid #fff; ">
                              </address>
                            </header>
                            <div class="text-dark comcont" style="color:black; text-align:left;">
                              <p class="mb-4"><i class="fa fa-book fa-2x me-4"></i> <?php echo $value['alamat'] ?></p>
                              <p class="mb-4"><i class="fa fa-phone fa-2x me-4"></i> <?php echo $value['telepon'] ?></p>
                              <p class="mb-4"><i class="fa fa-fax fa-2x me-4"></i> <?php echo $value['fax'] ?></p>
                              <p class="mb-4"><i class="fa fa-envelope fa-2x me-4"></i> <?php echo $value['email'] ?></p>
                            </div>
                          </article>
                      </div>
                      <div class="col-md-6 py-3">
                        <article>
                            <header>
                              <address>
                              <a href="#" class="fw-bold" style="color:white"><?php echo translate(30);?></a>
                              </address>
                            </header>
                            <div class="comcont" style="background: white; border-radius: 30px;">
                              <div class="d-flex align-items-center p-3">
                                <?php echo $value['map'] ?>
                              </div>
                            </div>
                          </article>
                      </div>
                    </div>
                  </div>	
                  <?php } ?>
				</div>												
			</div>
		</div>