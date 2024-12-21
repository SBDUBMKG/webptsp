<?php
$lang = $this->session->userdata('lang');
?>
<style>
#modal_pengumuman_content *{
   background-color: #fff;
}
</style>

<div class="hero-area">
    <div class="container">
        <div class="hero-item">
            <div class="main-content3">
                <div id="owl-csel3" class="owl-carousel owl-theme owl-loaded">
                    <div class="owl-stage-outer">
                        <div class="owl-stage">
                    <?php foreach ($list_slider as $value): ?>
                        <div class="item owl-item">
                        <a href="<?= $value['link'] ?>" style="position: relative">
                            <img
                                style="border-radius: 20px; position: relative; height: 385px; object-fit: cover;"
                                src="<?= $bahasa == "" ? base_url().'upload/slider/'.$value['slider'] : base_url().'upload/slider/'.$value['slider_en']?>"
                                alt="<?= $value['title'] ?>"
                            >
                            <div class="slider-title">
                                <span> <?= $value['title'] ?></span>
                            </div>
                        </a>
                        </div>
                    <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="owl-theme">
                    <div class="owl-controls">
                        <div class="custom-nav owl-nav"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- pela-area start -->
<div class="pela-area">
    <div class="container">
        <div class="pela-wrap">
            <marquee style="padding: 3px!important; font-size: 14px;" class="marquee-pengumuman" behavior="scroll" direction="left"onmouseover="this.stop();" onmouseout="this.start();">
            <?php
                $list_topikutama = $this->global_model->get_list_array('tbl_pengumuman','is_publish=1','id_pengumuman','desc','5');
                foreach($list_topikutama as $key => $value) {
            ?>
            <img src="<?= base_url().'resources/themes/frontend_ptsp/images/pela.png'?>" class="img-fluid" alt=""> <a style="color:#FFFFFF;font-weight: 400;" href="<?= base_url().'pengumuman/detil_pengumuman/'.$value['id_pengumuman'] ?>"> <?php $isi = $value['isi'.$bahasa]; echo substr(strip_tags($isi),0,150);?> ...</a>
            <?php } ?>
            </marquee>
        </div>
    </div>
</div>

<!-- katalog-area start -->
<div class="katalog-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="katalog-item katalog-item1">
                    <div class="katalog-circle">
                        <div class="katalog-circle2">
                            <a href="<?= site_url('katalog_pelayanan') ?>">
                                <img src="<?= base_url().'resources/themes/frontend_ptsp/images/icons/katalog.png'?>" class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                    <a href="<?= site_url('katalog_pelayanan') ?>">
                        <h5><?= strtoupper(translate(1)) ?></h5>
                    </a>
                    <span></span>
                    <p><?= translate(6) ?></p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="katalog-item katalog-item2">
                    <div class="katalog-circle">
                        <div class="katalog-circle2">
                            <a href="<?= site_url('/cek_status') ?>">
                                <img src="<?= base_url().'resources/themes/frontend_ptsp/images/icons/monitor-01.png'?>" class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                    <a href="<?= site_url('/cek_status') ?>">
                        <h5> <?= strtoupper(translate(2)) ?></h5>
                    </a>
                    <span></span>
                    <p><?= translate(7) ?></p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="katalog-item">
                    <div class="katalog-circle">
                        <div class="katalog-circle2">
                            <a href="<?= site_url('registrasi') ?>">
                                <img src="<?= base_url().'resources/themes/frontend_ptsp/images/icons/pendaftaran.png'?>" class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                    <a href="<?= site_url('registrasi') ?>">
                        <h5> <?= strtoupper(translate(3)) ?></h5>
                    </a>
                    <span></span>
                    <p><?= translate(8) ?></p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="katalog-item katalog-item4">
                    <div class="katalog-circle">
                        <div class="katalog-circle2">
                            <a href="javascript:void(Tawk_API.toggle())">
                                <img src="<?= base_url().'resources/themes/frontend_ptsp/images/icons/chat-01.png'?>" class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                    <a href="javascript:void(Tawk_API.toggle())">
                        <h5> <?= strtoupper(translate(5)) ?></h5>
                    </a>
                    <span></span>
                    <p><?= translate(40) ?></p>
                </div>
            </div>
        </div>

    </div>
    <div class="mt-5" style="background-color: #0097B1;">
        <div class="row">
            <a href="<?= site_url().'skm'?>">
                <h5 class="fw-bold text-white text-center mt-2 mb-0">SURVEI KEPUASAN MASYARAKAT</h5>
                <h6 class="fw-bold text-dark text-center mb-2">LAYANAN PTSP BMKG TAHUN <?= ((int) date('Y') - 1) ?></h6>
            </a>
        </div>
    </div>
    <div class="" style="background-color: #FFF; height: 100%; padding: 1em 0;">
        <div class="container-fluid">
        <div class="row justify-content-center w-100" style="">
            <div class="col-md-12 col-lg-4 d-flex justify-content-end">
                <!-- <img style="max-height: 220px" src="<?= base_url().'resources/themes/frontend_ptsp/images/skm1.png'?>" class="img-fluid p-2" alt=""> -->
                <div id="unsur_skm" style="height: 100%; "></div>
            </div>
            <div class="col-md-12 col-lg-4 d-flex justify-content-center text-center" style="height: 300px;">
                    <div class="mt-4 mb-5 " style="border-color: #0097B1 !important; width: 75%; border: solid 0.7em; border-radius: 3em;">
                        <h4 class="fw-bold fs-4 mt-2" style="color: #0097B1;">Nilai SKM</h4>
                        <h4 class="fw-bold" style="color: #0097B1; font-size: 4em;">
                            <?= $skm_value ?>
                        </h4>
                        <span class="badge" style="background-color: #00BE62; margin-bottom: 2.3em; font-size: 1.4em;">
                            <?= $skm_predicate ?>
                        </span>
                        <div class="position-relative">
                            <div class="position-absolute start-50 mt-3 translate-middle">
                                <div class="bg-white" style="border-color: #0097B1 !important; border: solid 0.5em; border-radius: 2em;">
                                    <p class="fw-bold mt-2 ps-3 pe-3 mb-0 fs-6" style="color: #0097B1;">
                                        <?= $skm_respondent ?>
                                        Responden
                                    </p>
                                    <div class="mb-1">
                                        <i class="fa-solid fa-person"></i>
                                        <i class="fa-solid fa-person"></i>
                                        <i class="fa-solid fa-person"></i>
                                        <i class="fa-solid fa-person"></i>
                                        <i class="fa-solid fa-person"></i>
                                        <i class="fa-solid fa-person"></i>
                                        <i class="fa-solid fa-person"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-12 col-lg-4 d-flex justify-content-center w-full">
                <div id="skm_per_tahun" style="height: 100%;max-width: 460px"></div>
            </div>
        </div>
        </div>
    </div>
    <div class="container">
        <div class="Jumlah-wrap">
            <div class="row">
                <div id="permohonanCol" class="col-md-6 col-lg-4 mb-3">
                    <div class="Jumlah-item h-100">
                        <h3>Jumlah Permohonan Layanan</h3>
                        <div class="Jumlah-border">
                            <div class="Jumlah-border-left"></div>
                            <div class="Jumlah-border-right"></div>
                        </div>
                        <div id="jumlah_permohonan_layanan" style="height: 92%"></div>
                        <!-- <h4> Tahun 2024</h4> -->
                        <!-- <img src="<?= base_url().'resources/themes/frontend_ptsp/images/jumlah-chart.png'?>" class="img-fluid" alt=""> -->
                    </div>
                </div>
                <div id="pengumumanCol" class="col-md-6 col-lg-4 mb-3" style="height: max-content">
                    <div class="Jumlah-item" style=";">
                        <h3> Kalender Pengumuman</h3>
                        <div class="Jumlah-border">
                            <div class="Jumlah-border-left"></div>
                            <div class="Jumlah-border-right"></div>
                        </div>
                        <div id="kalender_pengumuman" class="calender clickable" style="height:350px">
                        </div>
                        <div class="Kalender-footer" style="">
                            <span id="divider"></span>
                            <?= $pengumuman_content ?>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modal_pengumuman" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                          <div class="modal-dialog modal-xl modal-dialog-centered ">
                            <div class="modal-content" style="background-color:#169FB8; border-radius:1.3rem;">
                              <div class="modal-header">
                                <h5 class="modal-title text-white" id="exampleModalToggleLabel">Pengumuman</h5>
                                <button type="button" class="btn-light btn rounded btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                  <div id="modal_pengumuman_tanggal" class="text-white text-bold h5" data-bs-date=""></div>
                                  <div id="modal_pengumuman_content" style="background-color: #fff"></div>
                              </div>
                              <div class="modal-footer">
                                <button class="btn btn-light mx-auto rounded-pill" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>

                    </div>
                </div>
                <div id="pengunjungCol" class="col-md-6 col-lg-4 mb-3">
                    <div class="Jumlah-item Jumlah-item3 h-100">
                        <h3> Statistik Pengunjung</h3>
                        <div class="Jumlah-border">
                            <div class="Jumlah-border-left"></div>
                            <div class="Jumlah-border-right"></div>
                        </div>
                        <div class="d-flex flex-column">
                        <div class="col-12">
                            <ul class="mt-2">
                                <li><img src="<?= base_url().'resources/themes/frontend_ptsp/images/online-man.png'?>" class="img-fluid" alt=""> Online</li>
                                <li> <?= $pengunjung_on ?> </li>
                            </ul>
                            <ul>
                                <li><img src="<?= base_url().'resources/themes/frontend_ptsp/images/online-man.png'?>" class="img-fluid" alt=""> Hari ini</li>
                                <li> <?= $pengunjung_hi ?> </li>
                            </ul>
                            <ul>
                                <li><img src="<?= base_url().'resources/themes/frontend_ptsp/images/online-man.png'?>" class="img-fluid" alt=""> Bulan ini</li>
                                <li> <?= $pengunjung_bi ?> </li>
                            </ul>
                            <ul>
                                <li><img src="<?= base_url().'resources/themes/frontend_ptsp/images/online-man.png'?>" class="img-fluid" alt=""> Tahun ini</li>
                                <li> <?= $pengunjung_ti ?> </li>
                            </ul>
                            <ul>
                                <li><img src="<?= base_url().'resources/themes/frontend_ptsp/images/online-man2.png'?>" class="img-fluid" alt=""> Total</li>
                                <li> <?= $pengunjung_all ?> </li>
                            </ul>
                        </div>
                        <!-- <div class="jumlah-chart2 col-12"> -->
                            <div id="statistik_pengunjung_tahunan" style=""></div>
                        <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- katalog-area end -->

<!-- berita-area start -->
<div class="berita-area">
    <div class="container">
        <div class="berita-main">
            <div class="berita-top">
                <div class="berita-top-left" style="max-width: 400px;">
                    <!-- <div class="row"> -->
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                          <li class="nav-item me-0" role="presentation">
                            <button class="nav-link btn-sm active" id="pills-berita-tab" data-bs-toggle="pill" data-bs-target="#pills-berita" type="button" role="tab" aria-controls="pills-berita" aria-selected="true"><?= $bahasa == "" ? "Berita" : "News"?></button>
                          </li>
                          <li class="nav-item" role="presentation">
                            <button class="nav-link btn-sm" id="pills-artikel-tab" data-bs-toggle="pill" data-bs-target="#pills-artikel" type="button" role="tab" aria-controls="pills-artikel" aria-selected="false"><?= $bahasa == "" ? "Artikel" : "Article"?></button>
                          </li>
                        </ul>
                    <!-- </div> -->
                    <div class="Jumlah-border">
                        <div class="Jumlah-border-left Jumlah-border-left2"></div>
                        <div class="Jumlah-border-right Jumlah-border-right2"></div>
                    </div>
                </div>
                <!-- <div class="berita-top-right">
                    <a href="<?= base_url().'berita/ptsp'?>"><?= $bahasa == "" ? "Lihat Semua" : "See All"?> <img src="<?= base_url().'resources/themes/frontend_ptsp/images/calender-more2.png'?>" class="img-fluid" alt=""></a>
                </div> -->
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-berita" role="tabpanel" aria-labelledby="pills-berita-tab">
                    <div class="berita-top-right d-flex justify-content-end">
                        <a href="<?= base_url().'berita/ptsp'?>"><?= $bahasa == "" ? "Lihat Semua" : "See All"?> <img src="<?= base_url().'resources/themes/frontend_ptsp/images/calender-more2.png'?>" class="img-fluid" alt=""></a>
                    </div>
                    <div class="berita-slider">
                        <div class="main-content2">
                            <div id="owl-csel5" class="owl-carousel owl-theme">
                            <?php
                                $berita = $this->global_model->get_list_array('tbl_berita','id_jenis_konten=1 AND is_publish = 1','id','DESC','5');
                                foreach ($berita as $key_berita_ticker => $value_berita_ticker) {
                            ?>
                                <div class="berita-item">
                                    <div class="berita-img">
                                        <?= !empty($value_berita_ticker['thumbnail']) ? '<img class="img-fluid" style="height:200px;object-fit: cover;" src="'.base_url().'upload/thumbnail/'.$value_berita_ticker['thumbnail'].'" />' : '<img class="img-fluid" src="'.base_url().'resources/frontend/images/noimage.png" />' ?>
                                    </div>
                                    <div class="calculator-logo">
                                        <a href="<?= base_url().'berita/ptsp/detil/'.$value_berita_ticker['id']?>"><img src="<?= base_url().'resources/themes/frontend_ptsp/images/jumat-calculator.png'?>" class="img-fluid" alt=""> <?= format_datetime($value_berita_ticker['tanggal_berita'])?></a>
                                    </div>
                                    <div class="demi">
                                        <a href="<?= base_url().'berita/ptsp/detil/'.$value_berita_ticker['id']?>"><?= ($lang_code == 'id') ? substr($value_berita_ticker['judul'.$bahasa],0,100) : substr($value_berita_ticker['judul'.$bahasa],0,100) ?></a>
                                    </div>
                                    <div class="malang">
                                        <p style="font-size: 10px;"><?php $isi = $value_berita_ticker['isi'.$bahasa]; echo substr(strip_tags($isi),0,300);?>... </p>
                                    </div>
                                    <div class="baca">
                                        <a href="<?= base_url().'berita/ptsp/detil/'.$value_berita_ticker['id']?>"><?= $bahasa == "" ? "Baca Selengkapnya" : "View More"?> <img src="<?= base_url().'resources/themes/frontend_ptsp/images/calender-more2.png'?>" class="img-fluid" alt=""></a>
                                    </div>
                                </div>
                            <?php } ?>

                            </div>
                            <div class="owl-theme">
                                <div class="owl-controls">
                                    <div class="custom-nav owl-nav custom-nav-5"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="tab-pane fade" id="pills-artikel" role="tabpanel" aria-labelledby="pills-artikel-tab">
                    <div class="berita-top-right d-flex justify-content-end">
                        <a href="<?= base_url().'berita/artikel'?>"><?= $bahasa == "" ? "Lihat Semua" : "See All"?> <img src="<?= base_url().'resources/themes/frontend_ptsp/images/calender-more2.png'?>" class="img-fluid" alt=""></a>
                    </div>
                     <div class="berita-slider">
                        <div class="main-content2">
                            <div id="owl-csel4" class="owl-carousel owl-theme">

                            <?php
                            $artikel = $this->global_model->get_list_array('tbl_berita','id_jenis_konten=2 AND is_publish = 1','id','DESC','5');
                            foreach ($artikel as $key_artikel_ticker => $value_artikel_ticker) {
                            ?>
                                <div class="berita-item">
                                    <div class="berita-img">
                                        <?= !empty($value_artikel_ticker['thumbnail']) ? '<img style="height:200px;object-fit:cover;" src="'.base_url().'upload/thumbnail/'.$value_artikel_ticker['thumbnail'].'" />' : '<img src="'.base_url().'resources/frontend/images/noimage.png" />' ?>
                                    </div>
                                    <div class="calculator-logo">
                                        <a href="<?= base_url().'berita/artikel/detil/'.$value_artikel_ticker['id']?>"><img src="<?= base_url().'resources/themes/frontend_ptsp/images/jumat-calculator.png'?>" class="img-fluid" alt=""> <?= format_datetime($value_artikel_ticker['tanggal_berita'])?></a>
                                    </div>
                                    <div class="demi">
                                        <a href="<?= base_url().'berita/artikel/detil/'.$value_artikel_ticker['id']?>"><?= ($lang_code == 'id') ? substr($value_artikel_ticker['judul'.$bahasa],0,100) : substr($value_artikel_ticker['judul'.$bahasa],0,100) ?></a>
                                    </div>
                                    <div class="malang">
                                        <p style="font-size: 10px;"><?php $isi = $value_artikel_ticker['isi'.$bahasa]; echo substr(strip_tags($isi),0,300);?>... </p>
                                    </div>
                                    <div class="baca">
                                        <a href="<?= base_url().'berita/artikel/detil/'.$value_artikel_ticker['id']?>"><?= $bahasa == "" ? "Baca Selengkapnya" : "View More"?> <img src="<?= base_url().'resources/themes/frontend_ptsp/images/calender-more2.png'?>" class="img-fluid" alt=""></a>
                                    </div>
                                </div>
                            <?php } ?>


                            </div>
                            <div class="owl-theme">
                                <div class="owl-controls">
                                    <div class="custom-nav owl-nav custom-nav-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>


        </div>
        <div class="Tautan">
            <div class="Tautan-top">
                <h3><?= $bahasa == "" ? "Tautan" : "Link"?></h3>
                <div class="Jumlah-border">
                    <div class="Jumlah-border-left Jumlah-border-left2"></div>
                    <div class="Jumlah-border-right Jumlah-border-right2"></div>
                </div>
            </div>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-11">
                        <div class="tautan-slider">
                            <div class="owl-carousel owl-theme owl-carousel-slider">
                                <?php
                                    $tautan = $this->global_model->get_list_array('tbl_tautan','','urutan');
                                    foreach ($tautan as $key => $value) {
                                ?>
                                <div class="item">
                                    <a href="<?php echo $value['link']?>"><img src="<?php echo base_url().'upload/tautan/'.$value['gambar']?>" class="img-fluid" alt="Lapor"> </a>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- berita-area end -->
