    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cetak Laporan Jarkom
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
              <h3 class="box-title">Laporan Kondisi Jaringan Komunikasi Dan Sistem PTSP BMKG Bulan Januari Tahun 2018</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                <tr>
                  <th style="text-align: center;">No</th>
                  <th style="text-align: center;">Waktu (menit)</th>
                  <th style="text-align: center;">Sumber</th>
                  <th style="text-align: center;">Tujuan</th>
                  <th style="text-align: center;">Protokol</th>
                  <th style="text-align: center;">Info</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i=1; $i < 6; $i++) { 
                ?>
                <tr>
                  <td style="text-align: center;"><?php echo $i;?></td>
                  <td style="text-align: center;">9028195</td>
                  <td style="text-align: center;">10.0.0.109</td>
                  <td style="text-align: center;">Broadcast</td>
                  <td style="text-align: center;">ARP</td>
                  <td style="text-align: center;">who has 10.0.0.17 Tell 10.0.0.101</td>
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
