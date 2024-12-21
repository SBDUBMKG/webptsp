<div class="beranda-area">
			<div class="container">
				<div class="beranda-top">
					<ul>
						<li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
						<li class="me-3"><a class="text-dark fw-bold" href="<?= base_url().'katalog_pelayanan'; ?>"><?= translate(1);?></a></li>
						<li class="me-3"><a class="text-dark fw-bold" href="<?= base_url().'katalog_pelayanan/'.$uri_segments; ?>"><?= $uri_segments == 'informasi' ? translate(113) : translate(114);?></a></li>
						<li class="text-secondary mobile-none"><?= $detail_layanan['layanan'.$bahasa] ?></li>
					</ul>
				</div>
				<div class="beranda-main">
					<div class="beranda-main-item">
						<h3><?php echo translate(1);?></h3>
						<div class="Jumlah-border">
							<div class="Jumlah-border-left Jumlah-border-left3"></div>
							<div class="Jumlah-border-right Jumlah-border-right3"></div>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col d-flex mb-mobile">
							<div class="me-2 <?= $uri_segments === 'informasi' ? 'btn-katalog-green' :'btn-katalog-blue' ?>">
								<a href="<?= base_url().'katalog_pelayanan/informasi';?>" class="text-white">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle me-1" viewBox="0 0 16 16">
										<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
										<path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
									</svg><?php echo translate(113);?>
								</a>
							</div>
							<div class="<?= $uri_segments === 'jasa' ? 'btn-katalog-green' :'btn-katalog-blue' ?>">
								<a href="<?= base_url().'katalog_pelayanan/jasa';?>" class="text-white">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-raised-hand me-1" viewBox="0 0 16 16">
									<path d="M6 6.207v9.043a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H6.236a1 1 0 0 1-.447-.106l-.33-.165A.83.83 0 0 1 5 2.488V.75a.75.75 0 0 0-1.5 0v2.083c0 .715.404 1.37 1.044 1.689L5.5 5c.32.32.5.754.5 1.207"/>
									<path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
									</svg><?php echo translate(114);?>
								</a>
							</div>
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
					<div class="row mt-3" style="background-color: #D9EBE1; border-radius: 30px;">


                    <?php if( count($child) > 0 ) { $i=0; foreach ($child as $key => $value) { ?>
						<?php if($value['is_produk'] == 1){ ?>
							<div class="col-md-3 mb-2 mt-2 d-flex align-items-stretch">
								<div class="card w-100" style="border-radius: 30px;border: 2px solid #0097B1">
									<div class="card-header border-0 m-2 justify-content-center d-flex" style="border-radius: 30px;background: white;">
										<div class="rouded-circle d-flex justify-content-center p-2" style="background: #0097B1;border: 10px solid #F2F0F0;border-radius: 50%;max-width: 130px;max-height: 130px">
										<?php if (empty($value['icon'])) { ?>
											<img src="<?= site_url('/resources/frontend/images/katalog.png') ?>" class="img-fluid rounded-circle">
										<?php } else { ?>
											<img src="<?= site_url('upload/icon/'.$value['icon']) ?>" class="img-fluid rounded-circle">
										<?php } ?>
											</a>
										</div>
									</div>
									<div class="card-body text-center">
										<a href="<?= site_url('katalog_pelayanan/detail_layanan/'.$value['id_layanan']) ?>">
											<h5 style="font-size:.9rem; color:black;"><?= strtoupper($value['layanan'.$bahasa]) ?></h5>
										</a>
									</div>
									<div class="card-footer justify-content-center d-flex mb-4" style="background-color: unset; border-top: unset;">
										<a style="background-color: #ED8F61" class="btn btn-sm btn-warning text-white" href="<?= site_url('katalog_pelayanan/detail_layanan/'.$value['id_layanan']) ?>">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye me-1 text-white" viewBox="0 0 16 16">
											<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
											<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
											</svg>
											<?= $bahasa == "" ? "Lihat" : "View" ?>
										</a>
									</div>

								</div>

							</div>
							<?php } else { ?>
							<div class="col-md-3">
								<a href="<?= site_url('katalog_pelayanan/detail_layanan/'.$value['id_layanan']) ?>">
									<i class="icon" style="font-size: 0">
									<img src="<?= site_url('resources/frontend/images/katalog.png') ?>" style="width:70px">
									</i>
								</a>
								<h4 class="font-x1">
									<a href="<?= site_url('katalog_pelayanan/layanan/'.$value['id_layanan']) ?>"><?= strtoupper($value['layanan']) ?></a>
								</h4>
							</div>
							<?php } ?>
							<?php
							$i++;
							}
							}
							else {
							echo "Belum ada data.";
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
