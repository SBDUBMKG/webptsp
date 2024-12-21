<div class="wrapper row3">
  <main class="hoc container center clear">
    <div class="content"> 
      <div class="error_page">
      <?php if($bahasa=='_en'){ ?>
        <h3>We Are Sorry</h3>
        <figure>
          <img src="<?php echo base_url().'resources/frontend/images/404.png'?>" style="max-width:250px">
        </figure>
        <p>Unfortunately, the page you were looking for could not be found. It may be temporarily unavailable, moved or no longer exists</p>
        <span></span> 
        <a href="<?php echo base_url()?>" class="btn btn-sm btn-warning">Go to home page</a>
      </div>
      
      <?php } else { ?>
        <h3>Kami Mohon Maaf</h3>
        <figure>
          <img src="<?php echo base_url().'resources/frontend/images/404.png'?>" style="max-width:250px">
        </figure>
        <p>Sayangnya, halaman yang Anda cari tidak dapat ditemukan. Mungkin untuk sementara tidak tersedia, dipindahkan atau sudah tidak ada lagi</p>
        <span></span> 
        <a href="<?php echo base_url()?>" class="btn btn-sm btn-warning">Kembali ke halaman beranda</a>
      </div>
      <?php } ?>
  </div>
</main>
</div>