<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=1008245475895638&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div style="margin-top:15px">
  <div id="jssor_2" style="border-radius: 3px 3px 0 0;position:relative;margin:0 auto;top:0px;left:0px;width:948px;height:300px;overflow:hidden;visibility:hidden;">
    <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:948px;height:295px;overflow:hidden;">
        <div data-p="170.00">
            <img data-u="image" src="<?php echo base_url().'upload/pengumuman/slide1.jpg'?>" />
        </div>
        <div data-p="170.00">
            <img data-u="image" src="<?php echo base_url().'upload/pengumuman/slide2.png'?>" />
        </div>
    </div>
    <!-- Bullet Navigator -->
    <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
        <div data-u="prototype" class="i" style="width:16px;height:16px;">
            <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="b" cx="8000" cy="8000" r="5800"></circle>
            </svg>
        </div>
    </div>
    <!-- Arrow Navigator -->
    <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
            <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
        </svg>
    </div>
    <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
            <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
        </svg>
    </div>
  </div>
</div>
<div class="wrapper row3">
  <section class="hoc container clear"> 
    <div class="center btmspace-10 coloured">
      <ul id="webTicker">
        <?php
        $list_topikutama = $this->global_model->get_list_array('tbl_pengumuman','is_publish=1','id_pengumuman','desc','5');
        foreach($list_topikutama as $key => $value){
        ?>
        <li><a style="color:black" href="<?php echo base_url().'pengumuman/detil_pengumuman/'.$value['id_pengumuman'];?>"><?php echo $value['isi'.$bahasa];?></a></li>
        <?php
        }
        ?>
      </ul>
    </div>
</div>
<div class="wrapper row3">
  <section class="hoc container clear"> 
    <div class="group center">
      <article class="two_third first">
        <div class="panel panel-default">
          <div class="panel-heading"> <span class="fa fa-image"></span><b> Foto Kegiatan</b></div>
          <div class="panel-body" style="padding:0px">
            <div class="row">
              <div class="col-xs-12">
                <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:600px;height:310px;overflow:hidden;visibility:hidden;">
                  <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:570px;height:305px;overflow:hidden;">
                      <?php
                      foreach($list_foto as $key => $value) {
                      ?>
                      <div style="extt-align:center">
                          <img data-u="image" src="<?php echo base_url().'upload/kegiatan/'.$value['nama']?>" />
                          <div data-u="caption" data-t="0" style="position:absolute;top:250px;left:30px;z-index:0;background-color:black;font-size:20px;color:#ffffff;line-height:30px;text-align:center;">
                            <a href="<?php echo base_url().'galeri/galeri_foto/detil'.$value['id_kegiatan']?>"><?php echo substr($value['judul'.$bahasa], 0,40);?></a>
                          </div>
                      </div>
                      <?php } ?>
                  </div>
                  <!-- Bullet Navigator -->
                  <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                      <div data-u="prototype" class="i" style="width:16px;height:16px;">
                          <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                              <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                          </svg>
                      </div>
                  </div>
                  <!-- Arrow Navigator -->
                  <div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:35px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                      <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                          <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                      </svg>
                  </div>
                  <div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:35px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                      <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                          <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                      </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="panel-footer text-left"><ul><li><a href="<?php echo base_url().'galeri/galeri_foto'?>" class="btn btn-info">INDEX FOTO</a></li></ul></div>
        </div>
      </article>
      <article class="one_third">
        <div class="panel panel-default">
          <div class="panel-heading"> <span class="fa fa-calendar"></span><b> Agenda</b></div>
          <div class="panel-body" style="padding:0px">
            <div class="row">
              <div class="col-xs-12" id="my-calendar">
              </div>
            </div>
          </div>
        </div>
      </article>
    </div>
  </section>
</div>
<div class="wrapper row3">
  <section class="hoc container clear"> 
    <div class="group">
      <article class="one_half first">
        <div class="panel panel-default">
          <div class="panel-heading"><b> <?php echo strtoupper(translate(19));?></b><a href="<?php echo base_url().'berita/minerba'?>" class="pull-right btn btn-xs btn-info">INDEX</a></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-12">
                <ul class="demo1">
                  <?php 
                  $berita = $this->global_model->get_list_array('tbl_berita','','id','DESC','10'); 
                  foreach ($berita as $key_berita_ticker => $value_berita_ticker) {
                  ?>
                  <li class="news-item text-justify">
                    <table>
                      <tr>
                        <td width="30%" style="margin:0px"><?php echo !empty($value_berita_ticker['thumbnail']) ? '<img src="'.base_url().'upload/thumbnail/'.$value_berita_ticker['thumbnail'].'" />' : '<img src="'.base_url().'resources/frontend/images/noimage.png" />' ?></td>
                        <td style="margin:0px"><?php echo $value_berita_ticker['judul'.$bahasa]?>...<a href="#">Selengkapnya...</a></td>
                      </tr>
                    </table>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="panel-footer"></div>
        </div>
      </article> 
      <article class="one_half">
        <div class="panel panel-default">
          <div class="panel-heading"><b><?php echo strtoupper(translate(26));?></b></div>
            <div class="panel-body">
              <div class="row">
                <div class="col-xs-12">
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#facebook" aria-controls="facebook" role="tab" data-toggle="tab"><i class="fa fa-facebook"></i></a></li>
                    <li role="presentation"><a href="#twitter" aria-controls="twitter" role="tab" data-toggle="tab"><i class="fa fa-twitter"></i></a></li>
                    <li role="presentation"><a href="#instagram" aria-controls="instagram" role="tab" data-toggle="tab"><i class="fa fa-instagram"></i></a></li>
                  </ul>
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="facebook">
                      <div class="fb-page" data-href="https://www.facebook.com/ditjenminerbakesdm/" data-tabs="timeline" data-width="427" data-height="385" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/ditjenminerbakesdm/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ditjenminerbakesdm/">Direktorat Jenderal Mineral dan Batubara</a></blockquote></div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="twitter">
                      <a class="twitter-timeline" data-width="427"
  data-height="385" href="https://twitter.com/humasminerba?ref_src=twsrc%5Etfw">Tweets by humasminerba</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </article>
    </div>
  </section>
</div>
<div class="wrapper row3">
  <section class="hoc container clear"> 
    <div class="group">
      <article class="one_third first">
        <div class="panel panel-default">
          <div class="panel-heading"><b> <?php echo strtoupper(translate(6));?></b><a href="<?php echo base_url().'berita/artikel'?>" class="pull-right btn btn-xs btn-info">INDEX</a></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-12">
                <table class="table">
                  <?php 
                  $artikel = $this->global_model->get_list_array('tbl_artikel','','id','DESC','5'); 
                  foreach ($artikel as $key_a => $value_a) {
                  ?>
                    <tr><td><?php echo $value_a['judul'.$bahasa]?>...<a href="<?php echo base_url().'berita/artikel/detil/'.$value_a['id']?>">Selengkapnya...</a></td></tr>
                  <?php } ?>
                </table>
              </div>
            </div>
          </div>
          <div class="panel-footer"></div>
        </div>
      </article>
      <article class="one_third">
        <div class="panel panel-default">
          <div class="panel-heading"><b> <?php echo strtoupper(translate(3));?></b><a href="<?php echo base_url().'berita/press_release'?>" class="pull-right btn btn-xs btn-info">INDEX</a></div>
          <div class="panel-body">
            <div class="row">
              <div class="col-xs-12">
                <table class="table">
                  <?php 
                  $press_release = $this->global_model->get_list_array('tbl_press_release','','id','DESC','5'); 
                  foreach ($press_release as $key_pr => $value_pr) {
                  ?>
                    <tr><td><?php echo $value_pr['judul'.$bahasa]?>...<a href="<?php echo base_url().'berita/press_release/detil/'.$value_pr['id']?>">Selengkapnya...</a></td></tr>
                  <?php } ?>
                </table>
              </div>
            </div>
          </div>
          <div class="panel-footer"></div>
        </div>
      </article>
      <article class="one_third">
        <div class="panel panel-default">
          <div class="panel-heading"> <span class="fa fa-list-alt"></span><b> <?php echo strtoupper(translate(9));?></b></div>
            <div class="panel-body">
              <div class="row">
                <div class="col-xs-12">
                  <ul class="tautan">
                    <?php 
                    $tautan = $this->global_model->get_list_array('tbl_tautan','','urutan');
                    foreach ($tautan as $key => $value) {
                    ?>
                    <li class="news-item text-justify">
                      <table cellpadding="4">
                        <tr>
                          <td>
                            <a href="<?php echo $value['link']?>">
                              <img src="<?php echo base_url().'upload/tautan/'.$value['gambar']?>" alt="<?php echo $value['judul']?>" />
                            </a>
                          </td>
                        </tr>
                      </table>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          <div class="panel-footer"></div>
        </div>
      </article>
    </div>
  </section>
</div>
<script>
var bahasa = '<?php echo $bahasa;?>';
var hari = '<?php echo $bahasa == "" ? "in" : "en";?>';
  $(document).ready(function(){
      $("#my-calendar").zabuto_calendar({
          ajax: {
              url: "<?php echo base_url();?>home/show_data",
              modal: true
          },
            language: hari
          
      });
  });
  if(bahasa === ''){
    tday=new Array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    tmonth=new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
  }else{
    tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
    tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
  }
</script>
