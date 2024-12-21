<div class="beranda-area">
      <div class="container">
        <div class="beranda-top">
          <ul>
            <li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
            <li class="me-3"><a class="text-dark fw-bold" href="<?= base_url().'berita/artikel'; ?>"><?= $bahasa == "" ? "Artikel" : "Article" ?></a></li>
            <li class="text-secondary"><?= $bahasa == "" ? "Detil" : "Detail" ?></li>
          </ul>
        </div>
        <div class="beranda-main">
          <div class="beranda-main-item mw-100">
            <h3><?php echo $detil['judul'.$bahasa];?></h3>
            <div class="Jumlah-border">
              <div class="Jumlah-border-left Jumlah-border-left3"></div>
              <div class="Jumlah-border-right Jumlah-border-right3"></div>
            </div>
          </div>
          <div class="row mt-3 p-3" style="background-color: #D9EBE1; border-radius: 30px;">


            <!-- Main content -->
            <section class="content">
                <span class="text-primary"><i class="fa fa-calendar text-primary me-2"></i><?php echo format_datetime($detil['tanggal_berita']);?></span>
                <div class="single_page_content">
                  <img class="img-fluid mt-2" style="" src="<?php echo base_url();?>upload/thumbnail/<?php echo $detil['thumbnail'];?>" alt="">

                  <p><?php echo $detil['isi'.$bahasa];?></p>
                  <br>
                </div>

            </section>
            <!-- <b class="pull-left"><?php echo $bahasa == '' ? 'sumber: '.$detil['sumber'] : 'source: '.$detil['sumber'];?></b> -->
            </div>
          </div>
        </div>

        </div>
      </div>
    </div>
