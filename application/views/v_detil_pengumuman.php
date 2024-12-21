<div class="beranda-area">
      <div class="container">
        <div class="beranda-top">
          <ul>
            <li class="me-3"><a class="text-dark fw-bold" href="<?= base_url(); ?>"><?= translate(37);?></a></li>
            <li class="me-3"><a class="text-dark fw-bold" href="<?= base_url().'pengumuman'; ?>"><?= $bahasa == "" ? "Pengumuman" : "Announcement" ?></a></li>
            <li class="text-secondary"><?= $bahasa == "" ? "Detil" : "Detail" ?></li>
          </ul>
        </div>
        <div class="beranda-main">
          <div class="beranda-main-item">
            <h3><?php echo $detil_pengumuman['judul'.$bahasa];?></h3>
            <div class="Jumlah-border">
              <div class="Jumlah-border-left Jumlah-border-left3"></div>
              <div class="Jumlah-border-right Jumlah-border-right3"></div>
            </div>
          </div>
          <div class="row mt-3 p-3" style="background-color: #D9EBE1; border-radius: 30px;">
          

            <!-- Main content -->
            <section class="content">
                <span class="text-primary"><i class="fa fa-calendar text-primary me-2"></i><?php echo substr($detil_pengumuman['created_date'],0,10);?></span>
                <div class="single_page_content">
                  <p><?php echo $detil_pengumuman['isi'.$bahasa];?></p>
                  <br>
                </div>
                <?php
                $gambar = $detil_pengumuman['gambar'];
                if(!empty($gambar)){
                ?>
                <div class="single_page_content">
                  <center><img src="<?php echo base_url().'upload/pengumuman/'.$gambar;?>" width="100%"></center>
                </div>
                <?php } ?>
            
                <?php
                $file = $detil_pengumuman['file'];
                if(!empty($file)){
                ?>
                <div class="single_page_content">
                    <table class="table table-striped">
                      <thead>
                        <th>File Lampiran</th>
                        <th style="text-align:center">Download</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td><?php echo $detil_pengumuman['judul'.$bahasa];?></td>
                          <td style="text-align:center"><a href="<?php echo base_url().'upload/pengumuman/'.$file;?>" target="blank" title="download"><i class="fa fa-download"></i></a></td>
                        </tr>
                      </tbody>
                    </table>
                </div>
                <?php } ?>
            </section>
              
            </div>
          </div>
        </div>  
        
        </div>                      
      </div>
    </div>
