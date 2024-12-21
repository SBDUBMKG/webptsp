    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cetak Laporan Keuangan
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- filter -->
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Filter</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jenis Laporan</label>
                <select class="form-control">
                  <option>Laporan keuangan pelayanan PTSP</option>
                  <option>Laporan kondisi jaringan komunikasi dari Sistem Interface PTSP</option>
                </select>
              </div>
              <div class="form-group">
                <label>Jenis Layanan</label>
                <select class="form-control">
                  <option>Layanan MKG</option>
                </select>
              </div>
              <div class="form-group">
                <label>Jenis Permintaan</label>
                <select class="form-control">
                  <option>Informasi khusus Meteorologi, Klimatologi dan Geofisika</option>
                </select>
              </div>
              <div class="form-group">
                <label>Tahun</label>
                <select class="form-control">
                  <option>2018</option>
                  <option>2019</option>
                  <option>2020</option>
                  <option>2021</option>
                  <option>2022</option>
                </select>
              </div>
              <div class="form-group">
                <label>Bulan</label>
                <select class="form-control">
                  <option>Januari</option>
                  <option>Februari</option>
                  <option>Maret</option>
                  <option>April</option>
                  <option>Mei</option>
                  <option>Juni</option>
                  <option>Juli</option>
                  <option>Agustus</option>
                  <option>September</option>
                  <option>Otober</option>
                  <option>November</option>
                  <option>Desember</option>
                </select>
              </div>
              <div class="form-group">
                <button class="btn btn-warning">Proses</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="box box-default">
        <div class="box-header with-border">
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Laporan keuangan Pelayanan Data/Informasi/Jasa PTSP BMKG Bulan Januari Tahun 2018</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                <tr>
                  <th style="text-align: center;">No</th>
                  <th style="text-align: center;">No Pelanggan</th>
                  <th style="text-align: center;">Nama Pelanggan</th>
                  <th style="text-align: center;">No Invoice</th>
                  <th style="text-align: center;">Status Pelunasan</th>
                  <th style="text-align: center;">Biaya Data/Jasa/Informasi</th>
                  <th style="text-align: center;">Tanggal Permohonan</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i=1; $i < 6; $i++) { 
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo $i;?></td>
                  <td style="text-align: center;">NP-000045</td>
                  <td style="text-align: center;">Andi Firman</td>
                  <td style="text-align: center;">201803110001</td>
                  <?php 
                    if($i % 2 == 1){
                  ?>
                  <td style="text-align: center;color:green"; >Sudah Dibayar</td>
                  <?php
                  }else{
                  ?>
                  <td style="text-align: center;color:red"; >Belum Dibayar</td>
                  <?php
                  }
                  ?>
                  <td style="text-align: center;">Rp. 9.860.000,00</td>
                  <td style="text-align: center;">05-03-2018</td>
                </tr>
                <?php
                }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
          </div>
        </div>
      </div>
    </section>
