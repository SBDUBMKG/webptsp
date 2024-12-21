<div class="beranda-area">
      <div class="container">
        <div class="beranda-top">
          <ul>
            <li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
            <li class="text-secondary"><?= $bahasa == "" ? "Pengumuman" : "Announcement" ?></li>
          </ul>
        </div>
        <div class="beranda-main">
          <div class="beranda-main-item">
            <h3><?= $bahasa == "" ? "Pengumuman" : "Announcement" ?></h3>
            <div class="Jumlah-border">
              <div class="Jumlah-border-left Jumlah-border-left3"></div>
              <div class="Jumlah-border-right Jumlah-border-right3"></div>
            </div>
          </div>
          <div class="row mt-3 p-3" style="background-color: #D9EBE1; border-radius: 30px;">
          
            <?php $i=0; foreach($list_pengumuman as $key => $value){ $i++; ?>
              <div class="col-md-4 mb-2 mt-2">
                <div class="beranda-item beranda-item1" style="background-color: #FFF; padding: 15px; margin-top:5px; min-height:100px; border: 2px solid #0097B1;">
                    <a href="<?php echo base_url().'pengumuman/detil_pengumuman/'.$value['id_pengumuman'];?>">
                      <h5 class="mt-2" style="text-align: left; font-size:.9rem; color:black;"><?php echo $value['judul'.$bahasa];?></h5>
                    </a>
                    <p class="text-info text-start pt-2 d-flex align-items-center" style="font-size: 10px;">
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-calendar-week me-1" viewBox="0 0 16 16">
                        <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                      </svg>
                    <?php echo substr($value['created_date'],0,10);?>
                    </p>
                </div>
              </div>
              <?php } ?>
              <div class="my-2">
                  <?php echo $links;?>
              </div>
              
            </div>
          </div>
        </div>  
        
        </div>                      
      </div>
    </div>
