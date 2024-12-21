<div class="wrapper row3">
  <main class="hoc container clear">
    <div class="content"> 
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>">Home</a></li>
        <li class="active"><?php echo $title ?></li>
      </ol>
      <h1><span><?php echo $title ?></span></h1>
      <div id="gallery">
        <figure>
          <ul class="nospace clear">
            <?php foreach($list_foto as $keys => $value){ ?>
            <li class="one_quarter">
              <a href="<?php echo base_url()."galeri/galeri_foto/detil_kegiatan/".$value['id_kegiatan'];?>">
                <p class="text-center"><?php echo substr($value['judul'.$bahasa],0,20);?></p>
                <a href="<?php echo base_url()."galeri/galeri_foto/detil_kegiatan/".$value['id_kegiatan'];?>">
                  <img style="min-height:121px" src="<?php echo base_url()."upload/kegiatan/".$value['nama'];?>" alt="<?php echo $value['judul'.$bahasa];?>">
                </a>
                <a class="btn btn-sm btn-block btn-flat" href="<?php echo base_url()."galeri/galeri_foto/detil_kegiatan/".$value['id_kegiatan'];?>">
                  <i class="fa fa-search"></i> <?php echo translate(28); ?>
                </a>
              </a>
            </li>
            <?php    
            }   
            ?>
          </ul>
        </figure>
      </div>
    </div>
    <div class="clear"></div>
  </main>
</div>