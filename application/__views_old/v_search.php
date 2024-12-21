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
  .centered {
    /* text-align: center; */
    /* font-size: 0; */
  }
  .centered > li {
    /* float: none; */
    /* display: inline-block; */
    /* text-align: left; */
    /* font-size: 13px; */
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
<div class="wrapper row3" style="min-height:400px;">
  <main class="hoc container clear"> 
    <div class="content"> 
      <ol class="breadcrumb">
        <li>
          <a style="color:#13d260;" href="<?php echo base_url();?>">Home
          </a>
        </li>
        <li class="active">
          <?php echo $title ?>
        </li>
      </ol>
      <div id="comments">
        <ul>
          <?php
          if($list_berita != FALSE){
          ?>
          <?php $i=0; foreach($list_berita as $key => $value){ $i++; ?>
          <li style="min-height:170px">
            <article>
              <header>
                <address style="margin-bottom:1px">
                  <a class="news-title" href="<?php echo base_url().'berita/minerba/detil/'.$value['id'];?>" style="color:#565bfd"> 
                    <?php echo $value['judul'.$bahasa];?>
                  </a>
                </address>
                <time datetime="2045-04-06T08:15+00:00" style="color:#13d260;font-size:10px;">
                  <i class="news-time-stamp fa fa-calendar">
                  </i> 
                  <?php echo format_Datetime($value['tanggal_berita']);?>
                </time>
              </header>
              <div class="comcont">
                <img class="imgl borderedbox inspace-5" style="max-width:130px;max-height:85px;" src="<?php echo base_url();?>upload/thumbnail/<?php echo $value['thumbnail'];?>" alt="">
                <p style="font-size:15px;">
                  <?php $isi = $value['isi'.$bahasa]; echo substr(strip_tags($isi),0,800);?>... 
                  <a class="news-click-more" href="<?php echo base_url().'berita/minerba/detil/'.$value['id'];?>">
                    <?php echo translate(41);?>
                  </a>
                </p> 
              </div>
            </article>
          </li>
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
        </ul>
      </div>
    </div>
    <!-- <div class="row centered dataTables_paginate paging_simple_numbers"> -->
    <!-- <div class="pagination"><?php // echo $links;?></div> -->
    <div style="margin-top: -40px !important;">
      <ul class="pagination list-inline">
        <?php echo $links;?>
      </ul> 
    </div>
    <!-- </div> -->
    <div class="clear">
    </div>
  </main>
</div>
