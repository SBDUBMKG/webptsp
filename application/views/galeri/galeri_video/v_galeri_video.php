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
            <?php foreach($list_video as $keys => $value){ ?>
            <li class="one_quarter">
              <?php 
              if($value['jenis'] == 1){
              ?>
              <p class="text-center"><?php echo substr($value['judul'.$bahasa],0,20);?></p>
              <a data-fancybox="gallery" width="100%">
                <?php
                $embed = str_replace('width="560"', 'width="240px"', $value['embed']);
                $embed = str_replace('height="315"', 'height="150px"', $embed);
                echo $embed;
                ?>
              </a>
              <?php
              }
              ?>
              <?php 
              if($value['jenis'] == 2){
              ?>
              <p class="text-center"><?php echo substr($value['judul'.$bahasa],0,20);?></p>
              <video width="240" controls>
                <source src="<?php echo base_url();?>upload/video/<?php echo $value['upload'];?>">
              </video>
              <?php
              }
              ?>
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