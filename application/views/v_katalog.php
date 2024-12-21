<div class="beranda-area">
			<div class="container">
				<div class="beranda-top">
					<ul>
						<li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
						<li class="fw-bold text-dark"><?php echo translate(1);?></li>
					</ul>
				</div>
				<div class="beranda-main">
					<div class="beranda-main-item">
						<h3><?php echo strtoupper(translate(1));?></h3>
						<div class="Jumlah-border">
							<div class="Jumlah-border-left Jumlah-border-left3"></div>
							<div class="Jumlah-border-right Jumlah-border-right3"></div>
						</div>
					</div>
					<div class="row mt-3 mb-4">
						<div class="col d-flex mobile-none">
						</div>
						<div class="col d-flex justify-content-end">
							<div class="hd-searchbar">
								<form class="search" method="post" action="<?php echo base_url().'search_katalog/index';?>">
									<button class="cari-katalog" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
									<input id="search_katalog" name="search_katalog" style="background: white; padding-left: 40px;" maxlength="100" type="search" placeholder="<?= $bahasa == "" ? "  Cari layanan informasi/jasa" : "  Search for information/services" ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="">
								</form>
							</div>
							<div class="d-flex" id="langChange">
								<div class="d-flex align-items-center me-1">
									<input type="radio" name="l" id="toAr" checked />
									<a href="<?= base_url().'katalog_pelayanan/proses_pesanan/' ?>">
										<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
										<path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
										</svg>
									</a>
								</div>
								<div class="d-flex align-items-center">
									<input type="radio" name="l" id="toEn" checked />
									<a style="padding:4px 8px; text-align:center;" href="<?= base_url().'katalog_pelayanan/proses_pesanan/' ?>"><?= $this->cart->total_items() ?></a>
								</div>
							</div>
						</div>
					</div>
					<div class="beranda-main2">
						<div class="row mt-3" style="background-color: #D9EBE1; border-radius: 30px;">
							<div class="col-md-6 col-lg-6">
								<div class="beranda-item beranda-item1" style="margin: 85px 20px">
									<div class="beranda-circle">
										<div class="beranda-circle2">
                                            <a href="<?= site_url('katalog_pelayanan/informasi') ?>">
											<img src="<?= site_url('resources/frontend/images/katalog/layanan_informasi.png') ?>" class="img-fluid" alt="">
                                            </a>
										</div>
									</div>
									<h5><?php echo strtoupper(translate(113));?></h5>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="beranda-item beranda-item2" style="margin: 85px 20px">
									<div class="beranda-circle">
										<div class="beranda-circle2">
                                            <a href="<?= site_url('katalog_pelayanan/jasa') ?>">
											<img src="<?= site_url('resources/frontend/images/katalog/layanan_jasa.png') ?>" class="img-fluid" alt="">
                                            </a>
										</div>
									</div>
									<h5><?php echo strtoupper(translate(114));?></h5>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
