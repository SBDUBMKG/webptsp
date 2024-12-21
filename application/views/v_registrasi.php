<div class="beranda-area">
			<div class="container">
				<div class="beranda-top">
					<ul>
						<li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
						<li class="text-secondary"><?php echo translate(42);?></li>
					</ul>
				</div>
				<div class="beranda-main">
					<div class="beranda-main-item">
						<h3><?php echo translate(42);?></h3>
						<div class="Jumlah-border">
							<div class="Jumlah-border-left Jumlah-border-left3"></div>
							<div class="Jumlah-border-right Jumlah-border-right3"></div>
						</div>
					</div>
					<div class="beranda-main2">
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="beranda-item beranda-item1">
									<div class="beranda-circle">
										<div class="beranda-circle2">
                    <a href="<?= site_url('registrasi/registrasi_perorangan') ?>">
											<img src="<?= site_url('resources/frontend/images/r_orang.png') ?>" class="img-fluid" alt="">
                    </a>
										</div>
									</div>
									<h5><?php echo translate(43);?></h5>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="beranda-item beranda-item2 bimt-mobile">
									<div class="beranda-circle">
										<div class="beranda-circle2">
                    <a href="<?= site_url('registrasi/registrasi_perusahaan') ?>">
											<img src="<?= site_url('resources/frontend/images/r_perusahaan.png') ?>" class="img-fluid" alt="">
</a>
										</div>
									</div>
									<h5><?php echo translate(44);?></h5>
								</div>
							</div>
						</div>
					</div>			
				</div>												
			</div>
		</div>