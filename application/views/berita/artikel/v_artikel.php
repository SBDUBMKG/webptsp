<style>
#comments ul li {
  border: 1px solid #97bcf4 !important;
}

.news-click-more {
  color: #337ab7;
}

.news-title {
  color:#565bfd;
}

.news-time-stamp {
  color:#13d260;
  font-size:10px;
}

.list-inline {
  display: flex;
  justify-content: center;
  padding-top: 20px;
}

.list-inline li {
  margin: 0px;
  padding: 0px;
}
</style>

<div class="beranda-area">
      <div class="container">
        <div class="beranda-top">
          <ul>
            <li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
            <li class="text-secondary"><?php echo translate(12); ?></li>
          </ul>
        </div>
        <div class="beranda-main">
          <div class="beranda-main-item">
            <h3><?php echo translate(12); ?></h3>
            <div class="Jumlah-border">
              <div class="Jumlah-border-left Jumlah-border-left3"></div>
              <div class="Jumlah-border-right Jumlah-border-right3"></div>
            </div>
          </div>
          <div class="row mt-3 p-3" style="background-color: #D9EBE1; border-radius: 30px;">
          
              <ul>

          <?php

          if($list != FALSE){

          ?>

            <?php $i=0; foreach($list as $key => $value){ $i++; ?>
            <div class="mb-3" style="background-color: #FFF; padding: 15px; margin-top:5px; min-height:100px; border: 2px solid #0097B1; border-radius: 30px;">
            <li>

              <article>

                <header>

                  <address style="margin-bottom:1px"><a class="news-title" href="<?php echo base_url().$this->module.'/detil/'.$value['id'];?>"> <?php echo $value['judul'.$bahasa];?></a></address>

                  <time class="news-time-stamp" datetime="2045-04-06T08:15+00:00"><i class="news-time-stamp fa fa-calendar"></i> <?php echo format_Datetime($value['tanggal_berita']);?></time>

                </header>

                <div class="comcont">

                  <img class="imgl borderedbox inspace-5" style="max-width:130px;max-height:85px;" src="<?php echo base_url();?>upload/thumbnail/<?php echo $value['thumbnail'];?>" alt="">

                  <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
                  <p style="font-size:15px;"><?php $isi = $value['isi'.$bahasa]; echo substr(strip_tags($isi),0,250);?>...<a class="news-click-more" href="<?php echo base_url().$this->module.'/detil/'.$value['id'];?>"><?php echo translate(23);?></a></p> 
                  Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->

                  <!-- script awal yang diedit Rahmat 14 Oktober 2019 -->
                  <p style="font-size:15px;"><?php $isi = $value['isi'.$bahasa]; echo substr(strip_tags($isi),0,800);?>...<a class="news-click-more" href="<?php echo base_url().$this->module.'/detil/'.$value['id'];?>"><?php echo translate(41);?></a></p> 
                  <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->

                </div>

              </article>

            </li>
          </div>

            <?php

            }

          }else{

            if($bahasa == '_en'){

          ?>

          <center>Sorry the news you were looking for was not found</center>

          <?php

            }else{

          ?>

          <center>Maaf, Berita tidak ditemukan.</center>

          <?php

            }

          } 

          ?>

        </ul>

      </div>

    </div>

    <!-- <div class="row"> -->

        <!-- <div class="pagination"><?php echo $links;?></div> -->

      <div style="margin-top: -40px !important;">
        <ul class="pagination list-inline">
          <?php echo $links;?>
            </ul>

              <div class="my-2">
                  <?php echo $links;?>
              </div>
              
            </div>
          </div>
        </div>  
        
        </div>                      
      </div>
    </div>