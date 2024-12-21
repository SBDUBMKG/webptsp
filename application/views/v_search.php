<div class="beranda-area">
      <div class="container">
        <div class="beranda-top">
          <ul>
            <li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
            <li class="text-secondary"><?= $bahasa == "" ? "Pencarian" : "Search" ?></li>
          </ul>
        </div>
        <div class="beranda-main">
          <div class="beranda-main-item">
            <h3><?= $bahasa == "" ? "Berita" : "News" ?></h3>
            <div class="Jumlah-border">
              <div class="Jumlah-border-left Jumlah-border-left3"></div>
              <div class="Jumlah-border-right Jumlah-border-right3"></div>
            </div>
          </div>
          <div class="row mt-3 p-3" style="background-color: #D9EBE1; border-radius: 30px;">

            <?php
            if($list_berita != FALSE){
            ?>
            <?php $i=0; foreach($list_berita as $key => $value){ $i++; ?>
              <div class="col-md-4 mb-2 mt-2">
                <div class="beranda-item beranda-item1" style="background-color: #FFF; padding: 15px; margin-top:5px; min-height:250px; border: 2px solid #0097B1;">
                    <a href="<?php echo base_url().'berita/ptsp/detil/'.$value['id'];?>">
                      <h5 class="mt-2" style="text-align: left; font-size:.9rem; color:black;"><?php echo $value['judul'.$bahasa];?></h5>
                    </a>
                    <p class="text-info text-start pt-2 d-flex align-items-center" style="font-size: 10px;">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-calendar-week me-1" viewBox="0 0 16 16">
                        <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                      </svg>
                    <?php echo format_Datetime($value['tanggal_berita']);?>
                    </p>
                    <div class="d-block">
                      <img src="<?php echo base_url();?>upload/thumbnail/<?php echo $value['thumbnail'];?>" class="mt-2 me-1" style="max-width: 130px;max-height: 85px; float: left;">
                      <p class="text-dark pt-1" style="font-size:12px; text-align: justify;">
                        <?php $isi = $value['isi'.$bahasa]; echo substr(strip_tags($isi),0,300);?>...
                        <a href="<?php echo base_url().'berita/ptsp/detil/'.$value['id'];?>">
                          <?php echo translate(41);?>
                        </a>
                      </p>
                    </div>

                </div>
              </div>
              <?php
              }
              }else{
              if($bahasa == '_en'){
              ?>
              <center>Sorry the news you were looking for was not found
              </center>
              <?php
              }else{
              ?>
              <center>Maaf, Berita tidak ditemukan.
              </center>
              <?php
              }
              }
              ?>
              <div class="my-2">
                  <?php echo $links;?>
              </div>

            </div>
            <div class="beranda-main-item mt-4">
              <h3><?= $bahasa == "" ? "Katalog Pelayanan" : "Catalog Services" ?></h3>
              <div class="Jumlah-border">
                <div class="Jumlah-border-left Jumlah-border-left3"></div>
                <div class="Jumlah-border-right Jumlah-border-right3"></div>
              </div>
            </div>
            <div class="row mt-3 p-3" style="background-color: #D9EBE1; border-radius: 30px;">

              <?php
              if($list_katalog != FALSE){
              ?>
              <?php $i=0; foreach($list_katalog as $key => $value){ $i++; ?>
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

                <?php
                }
                }else{
                if($bahasa == '_en'){
                ?>
                <center>Sorry the catalog services you were looking for was not found
                </center>
                <?php
                }else{
                ?>
                <center>Maaf, Katalog Layanan tidak ditemukan.
                </center>
                <?php
                }
                }
                ?>
                <div class="my-2">
                    <?php echo $links;?>
                </div>
            </div>
          </div>
        </div>

        </div>
      </div>
    </div>
