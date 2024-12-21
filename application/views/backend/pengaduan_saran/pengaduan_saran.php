    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengaduan dan Saran
        <small></small>
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- filter -->

      <?php

      ?>
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-info">Bapak ibu yang terhormat sampaikan keluhan anda tentang perizinan. Kami akan sangat senang apabila pengaduan tersebut disertai dengan bukti otentik. Jangan lupa lengkapi data anda agar kami dapat merespon dengan baik.</div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control">
              </div>
              <div class="form-group">
                <label>Pengaduan</label>
                <textarea rows=8 type="text" name="pengaduan" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <button class="btn btn-warning">Simpan</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php 
      $list_pengaduan  = array(
        array(
          "id_pengaduan" => 113,
          "nama" => "Daini Ahmad",
          "waktu_pengaduan" => "25-03-2017",
          "pengaduan" => "Berkas apa saja yang diajukan untuk mengajukan permohonan pelayanan penggunaan alat geofisika? sebaiknya semua syarat dituliskan saat mengisi form pengajuan, dijelaskan pada bagian terpisah",
          "avatar" => "https://upload.wikimedia.org/wikipedia/commons/7/70/User_icon_BLACK-01.png",
        ),
        array(
          "id_pengaduan" => 114,
          "nama" => "Will Smith",
          "waktu_pengaduan" => "25-03-2017",
          "pengaduan" => "I am working on WB entertainment, i need weather prediction",
          "avatar" => "https://upload.wikimedia.org/wikipedia/commons/7/70/User_icon_BLACK-01.png",
        ),
      );

      $list_pengaduan_respon = array(
        "113" => array(
          array(
            "id_response"  => 1,
            "id_pengaduan"  => 113,
            "nama" => "CS PTSP 1 Menjawab",
            "waktu_respon" => "26-03-2017",
            "respon" => "Adapun syarat yang diperlukan adalah....",
            "avatar" => "https://upload.wikimedia.org/wikipedia/commons/7/70/User_icon_BLACK-01.png",
          ),
        ),
        "114" => array(
          array(
            "id_response"  => 1,
            "id_pengaduan"  => 114,
            "nama" => "CS PTSP 2 Menjawab",
            "waktu_respon" => "26-03-2017",
            "respon" => "Hello Mr Smith, here you can....",
            "avatar" => "https://upload.wikimedia.org/wikipedia/commons/7/70/User_icon_BLACK-01.png",
          ),
        ),
      );

      ?>
      <div class="box box-default">
        <div class="box-header">
          <h4>50 Pengaduan</h4>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <?php foreach ($list_pengaduan as $key => $value) { ?>
              <div class="box box-widget">
                <div class="box-header with-border">
                  <div class="user-block">
                    <img class="img-circle" src="<?php echo $value['avatar'] ?>" alt="User Image">
                    <span class="username"><a href="#"><?php echo $value['nama'] ?></a></span>
                    <span class="description"><?php echo $value['waktu_pengaduan'] ?></span>
                  </div>
                  <div class="box-tools">
                    <!-- <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read">
                      <i class="fa fa-circle-o"></i></button> -->
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                  </div>
                </div>
                <div class="box-body">
                  <p><?php echo $value['pengaduan'] ?></p>
                </div>

                <?php
                $id_pengaduan = $value['id_pengaduan'];
                $list_respon = (empty($list_pengaduan_respon[$id_pengaduan])) ? array() : $list_pengaduan_respon[$id_pengaduan];
                
                foreach ($list_respon as $respon) {
                ?>
                <div class="box-footer box-comments">
                  <div class="box-comment">
                    <img class="img-circle img-sm" src="<?php echo $value['avatar'] ?>" alt="User Image">

                    <div class="comment-text">
                          <span class="username">
                            <?php echo $respon['nama'] ?>
                            <!-- <span class="text-muted pull-right">8:03 PM Today</span> -->
                          </span>
                          <p><?php echo $respon['respon'] ?></p>
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="box-footer">
                  <form action="#" method="post">
                    <!-- <img class="img-responsive img-circle img-sm" src="http://adnan-pc/BMKG/backend/dist/img/user5-128x128.jpg" alt="Alt Text"> -->
                    <div class="img-push">
                      <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                    </div>
                  </form>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </section>
