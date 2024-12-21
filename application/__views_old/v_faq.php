<?php
$bahasa = $this->session->userdata('bahasa');
?>
<div class="wrapper row3" style="min-height:800px;">
    <section class="hoc container clear"> 
    <div class="left_content">
        <div class="single_post_content">
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <ol class="breadcrumb">
                <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
                <li><a href="<?= base_url(); ?>"><i class="fa fa-dashboard"></i> <?php echo translate(37);?></a></li> 
                Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->



                <!-- script awal yang diedit Rahmat 14 Oktober 2019 -->
                <li><a href="<?= base_url(); ?>"><?php echo translate(37);?></a></li>
                <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->
                
                <li class="active">FAQ</li>
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">
              <h1>FAQ</h1>
              <div id="comments">
                <ul>
                  <?php
                  foreach ($list_faq as $key => $value) {
                  ?>
                  <li style="color: black;background-color: #E8E8E8;border: 1px solid #42a5f5;">
                    <article>
                      <header>
                        <address>
                        <a href="#" style="color:black"><?php echo translate(38);?> : </a>
                        </address>
                      </header>
                      <div class="comcont">
                        <p style="color:black"><?php echo $value['pertanyaan'.$bahasa];?></p>
                      </div>
                      <hr style="border-top: 1px solid #42a5f5">
                      <header style="text-align:left;">
                        <address>
                        <a href="#" style="color:black"><?php echo translate(39);?> : </a>
                        </address>
                      </header>
                      <div class="comcont" style="text-align:left;">
                        <p style="color:black"><?php echo $value['jawaban'.$bahasa];?></p>
                      </div>
                    </article>
                  </li>
                  <?php 
                  }
                  ?>
                </ul>
              </div>
            </section>
          </div>
        </div>
    </div>
  </section>
</div>
