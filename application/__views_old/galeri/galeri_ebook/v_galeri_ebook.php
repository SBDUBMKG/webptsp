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
            <?php foreach($list_ebook as $key => $value){ ?>
            <li class="one_quarter">
              <a data-fancybox="gallery" href="<?php echo base_url()."upload/ebook/".$value['sampul'];?>"><img src="<?php echo !empty($value['sampul']) ? base_url()."upload/ebook/".$value['sampul'] : base_url()."resources/frontend/images/noimage-pdf.png";?>"></a>
              <a class="btn btn-sm btn-block btn-flat gallerypdf" data-fancybox-type="iframe" href="<?php echo base_url().'upload/ebook/'.$value['lampiran']; ?>"><i class="fa fa-search"></i> <?php echo translate(28)?></a>
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