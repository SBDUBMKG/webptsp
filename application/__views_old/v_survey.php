<div class="wrapper row3">
    <section class="hoc container clear"> 
    <div class="left_content">
      <div class="single_post_content">
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <ol class="breadcrumb">
                <!-- Script awal asli yang dinon-aktifkan Rahmat 14 Oktober 2019
                <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo translate(37);?></a></li>
                Script akhir asli yang dinon-aktifkan Rahmat 14 Oktober 2019 -->


                <!-- script awal yang diedit Rahmat 14 Oktober 2019 -->
                <li><a href="#"><?= translate(37);?></a></li>
                <!-- script akhir yang diedit Rahmat 14 Oktober 2019 -->


                <li class="active"><?php echo translate(31);?></li>
              </ol>
            </section>

            <!-- Main content -->
            <section class="content">
              <!-- filter -->
              <div class="box box-default">
                <h1>Survey</h1>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="alert alert-info" style="color:black;background-color: #E8E8E8;border-color: #42a5f5;"><?php echo 'Kuisioner kepuasan stakeholders terhadap pelayanan terpadu satu pintu BMKG';?></div>
                      <?php
                      $errMsg = $this->session->flashdata('errMsg');
                      $sucMsg = $this->session->flashdata('sucMsg');

                      if ( !empty($errMsg) ) {
                      ?>
                      <div class="alert alert-danger" role="alert" style="color: black;background-color: #e44f4f;border-color: #ff0029;"><?php echo $errMsg; ?></div>
                      <?php
                      }
                      ?>

                      <?php
                      if ( !empty($sucMsg) ) {
                      ?>
                      <div class="alert alert-danger" role="alert" style="color: black;background-color: #beb3fd;border-color: #1102fb;"><?php echo $sucMsg; ?></div>
                      <?php
                      }
                      ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <form method="post">
                      <table class="table table-bordered">
                        <tr>
                          <td rowspan="2">No</td>
                          <td rowspan="2">Pertanyaan</td>
                          <td colspan="4">Tanggapan</td>
                        </tr>
                        <tr>
                          <td>Sangat Tidak Setuju</td>
                          <td>Tidak Setuju</td>
                          <td>Setuju</td>
                          <td>Sangat Setuju</td>
                        </tr>

                        <tr>
                          <td>Sangat Tidak Setuju</td>
                          <td>Tidak Setuju</td>
                          <td>Sangat Tidak Setuju</td>
                          <td>Tidak Setuju</td>
                          <td>Setuju</td>
                          <td>Sangat Setuju</td>
                        </tr>

                      </table>

                        <?php
                        $i = 1;
                        foreach ($list_kategori_survey as $kategori_survey) {
                        ?>
                        <div class="form-group" style="background-color: lightblue;padding: 5px 10px;">
                          <label><?php echo $i.'. '.$kategori_survey['kategori_survey'];?></label>
                        </div>
                        <?php
                          $kon = 'id_kategori_survey = '.$kategori_survey['id_kategori_survey'];
                          $list_pertanyaan_survey = $this->global_model->get_list_array('m_pertanyaan_survey', $kon);                        
                          foreach ($list_pertanyaan_survey as $pertanyaan_survey) {
                            $radio_name = str_replace(" ","_",$pertanyaan_survey['pertanyaan_survey']);
                            $radio_name = strtolower($radio_name);
                        ?>
                        <div class="form-group">
                          <label><?php echo $pertanyaan_survey['pertanyaan_survey'];?></label>
                          <br>
                          <label class="radio-inline"><input type="radio" name="<?php echo $radio_name;?>">Sangat Tidak Setuju</label>
                          <label class="radio-inline"><input type="radio" name="<?php echo $radio_name;?>">Tidak Setuju</label>
                          <label class="radio-inline"><input type="radio" name="<?php echo $radio_name;?>">Setuju</label>
                          <label class="radio-inline"><input type="radio" name="<?php echo $radio_name;?>">Sangat Setuju</label>
                        </div>
                        <?php
                          }
                          echo "<br>";
                          $i++;
                        }
                        ?>

                        <div class="form-group">
                          <button class="btn btn-warning"><?php echo translate(34);?></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
      </div>
    </div>
  </section>
</div>
